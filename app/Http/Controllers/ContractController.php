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
        // Get all persons WITHOUT any active contract
        $persons = User::where('type', 'person')
            ->whereDoesntHave('contracts', function ($query) {
                $query->where('status', 'Active');
            })
            ->get();

        // Determine allowed roles based on user type
        $allowedRoles = [];
        if (Auth::user()->isAdmin()) {
            $allowedRoles = ['referee'];
        } elseif (Auth::user()->isTeam()) {
            $allowedRoles = ['player', 'coach'];
        }

        return view('contracts.create', compact('persons', 'allowedRoles'));
    }

    // Store new contract
    public function store(Request $request)
    {
        // Determine allowed roles based on user type
        if (Auth::user()->isAdmin()) {
            $allowedRoles = ['referee'];
        } elseif (Auth::user()->isTeam()) {
            $allowedRoles = ['player', 'coach'];
        } else {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    // Check if user already has an active contract
                    $hasActiveContract = Contract::where('user_id', $value)
                        ->where('status', 'Active')
                        ->exists();

                    if ($hasActiveContract) {
                        $fail('This person already has an active contract.');
                    }

                    // Check if user is actually a person
                    $user = User::find($value);
                    if ($user && $user->type !== 'person') {
                        $fail('You can only create contracts for persons.');
                    }
                },
            ],
            'role' => ['required', 'in:' . implode(',', $allowedRoles)],
            'salary' => 'required|numeric|min:0',
            'contract_years' => 'required|integer|min:1|max:10',
        ]);

        $employerId = Auth::user()->isAdmin() ? 'admin' : Auth::id();

        Contract::create([
            'user_id' => $request->user_id,
            'role' => $request->role,
            'salary' => $request->salary,
            'status' => 'Pending',
            'employer_id' => $employerId,
            'date_to' => now()->addYears((int) $request->contract_years),
        ]);

        return redirect()->route('contracts.create')
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
        $query = Contract::with(['user']);

        if (Auth::user()->isAdmin()) {
            $query->where('employer_id', 'admin');
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
        if (Auth::user()->isAdmin() && $contract->employer_id !== 'admin') {
            abort(403, 'You can only terminate contracts you created.');
        }

        if (Auth::user()->isTeam() && $contract->employer_id != Auth::id()) {
            abort(403, 'You can only terminate contracts you created.');
        }

        if ($contract->status !== 'Active') {
            return back()->withErrors(['error' => 'Only active contracts can be terminated.']);
        }

        $contract->terminate();

        return back()->with('success', 'Contract terminated successfully.');
    }
}
