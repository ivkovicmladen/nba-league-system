<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    // Show pending contracts for current user
    public function index()
    {
        $pendingContracts = Contract::where('user_id', Auth::id())
            ->where('status', 'Pending')
            ->with('employer')
            ->get();

        return view('contracts.index', compact('pendingContracts'));
    }

    // Show form to create new contract (Admin/Team only)
    public function create()
    {
        $user = Auth::user();

        // Get available people based on user type
        if ($user->isAdmin()) {
            // Admin can offer contracts to people WITHOUT active contracts
            $persons = User::where('type', 'person')
                ->whereDoesntHave('contracts', function ($query) {
                    $query->where('status', 'Active');
                })
                ->get();

            // Get all teams for the dropdown (admin can create contracts on behalf of teams)
            $teams = User::where('type', 'team')->get();

            $allowedRoles = ['player', 'coach', 'referee'];
        } elseif ($user->type === 'team') {
            // Teams can only offer to players and coaches without active contracts
            $persons = User::where('type', 'person')
                ->whereDoesntHave('contracts', function ($query) {
                    $query->where('status', 'Active');
                })
                ->get();

            $teams = collect(); // Empty collection for teams
            $allowedRoles = ['player', 'coach'];
        } else {
            abort(403, 'Unauthorized');
        }

        return view('contracts.create', compact('persons', 'allowedRoles', 'teams'));
    }

    // Store new contract
    public function store(Request $request)
    {
        $user = Auth::user();

        // Base validation rules
        $rules = [
            'user_id' => ['required', 'exists:users,id'],
            'role' => ['required', 'in:player,coach,referee'],
            'salary' => 'required|numeric|min:0',
            'contract_years' => 'required|integer|min:1|max:10',
        ];

        // If admin is creating contract for a team, require team selection
        if ($user->isAdmin() && in_array($request->role, ['player', 'coach'])) {
            $rules['employer_id'] = ['required', 'exists:users,id'];
        }

        $request->validate($rules);

        // Additional validation: Check if employer is a team (when provided)
        if ($request->has('employer_id') && $request->employer_id) {
            $employer = User::find($request->employer_id);
            if (!$employer || $employer->type !== 'team') {
                return back()->withErrors(['employer_id' => 'The selected employer must be a team.']);
            }
        }

        // Check business rules
        $person = User::findOrFail($request->user_id);

        // Rule: Person cannot be admin or team
        if ($person->type !== 'person') {
            return back()->withErrors(['user_id' => 'Can only create contracts for people (players, coaches, referees).']);
        }

        // Rule: Check if person already has active contract
        $hasActiveContract = Contract::where('user_id', $request->user_id)
            ->where('status', 'Active')
            ->exists();

        if ($hasActiveContract) {
            return back()->withErrors(['user_id' => 'This person already has an active contract.']);
        }

        // Determine employer ID based on role and user type
        if ($user->isAdmin()) {
            if ($request->role === 'referee') {
                // Referee contracts are offered by admin (league)
                $employerId = 'admin';
            } else {
                // Player/coach contracts must be for a team
                if (!$request->employer_id) {
                    return back()->withErrors(['employer_id' => 'You must select a team for player/coach contracts.']);
                }
                $employerId = $request->employer_id;
            }
        } else {
            // Team creating contract
            $employerId = $user->id;

            // Rule: Teams can only offer player and coach contracts
            if (!in_array($request->role, ['player', 'coach'])) {
                return back()->withErrors(['role' => 'Teams can only offer contracts to players and coaches.']);
            }
        }

        // Create contract
        Contract::create([
            'user_id' => $request->user_id,
            'employer_id' => $employerId,
            'role' => $request->role,
            'salary' => $request->salary,
            'status' => 'Pending',
            'date_from' => now(),
            'date_to' => now()->addYears((int) $request->contract_years),
        ]);

        return redirect()->route('contracts.my-offers')
            ->with('success', 'Contract offer sent successfully!');
    }

    // Accept contract
    public function accept(Contract $contract)
    {
        // Verify this contract belongs to current user
        if ($contract->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!$contract->isPending()) {
            return back()->withErrors(['error' => 'This contract is no longer pending.']);
        }

        // Check if user already has an active contract (one role rule)
        $hasActiveContract = Contract::where('user_id', Auth::id())
            ->where('status', 'Active')
            ->exists();

        if ($hasActiveContract) {
            return back()->withErrors(['error' => 'You already have an active contract. You can only have one role at a time.']);
        }

        $contract->accept();

        // REJECT (not delete) all other pending contracts for this user
        Contract::where('user_id', Auth::id())
            ->where('status', 'Pending')
            ->where('id', '!=', $contract->id)
            ->update(['status' => 'Rejected']);

        return redirect()->route('contracts.index')
            ->with('success', 'Contract accepted! You are now a ' . $contract->role . '. All other pending offers have been rejected.');
    }

    // Reject contract
    public function reject(Contract $contract)
    {
        // Verify this contract belongs to current user
        if ($contract->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!$contract->isPending()) {
            return back()->withErrors(['error' => 'This contract is no longer pending.']);
        }

        $contract->update(['status' => 'Rejected']);

        return redirect()->route('contracts.index')
            ->with('success', 'Contract rejected.');
    }

    // View all contracts (Admin only)
    public function all()
    {
        $contracts = Contract::with(['user', 'employer'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('contracts.all', compact('contracts'));
    }

    // View contracts created by current user (Team/Admin)
    public function myOffers()
    {
        $query = Contract::with(['user', 'employer']);

        if (Auth::user()->isAdmin()) {
            // Admin sees all contracts (including those created on behalf of teams)
            // No filter needed - show everything
        } elseif (Auth::user()->isTeam()) {
            $query->where('employer_id', Auth::id());
        } else {
            abort(403, 'Only teams and admins can view offered contracts.');
        }

        $contracts = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('contracts.my-offers', compact('contracts'));
    }

    // Terminate contract
    public function terminate(Contract $contract)
    {
        // Check authorization
        if (Auth::user()->isAdmin()) {
            // Admin can terminate any contract
        } elseif (Auth::user()->isTeam() && $contract->employer_id != Auth::id()) {
            abort(403, 'You can only terminate contracts you created.');
        } else if (!Auth::user()->isAdmin() && !Auth::user()->isTeam()) {
            abort(403, 'Unauthorized');
        }

        if ($contract->status !== 'Active') {
            return back()->withErrors(['error' => 'Only active contracts can be terminated.']);
        }

        $contract->terminate();

        return back()->with('success', 'Contract terminated successfully.');
    }
}
