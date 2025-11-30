<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function show()
    {
        $user = Auth::user();

        // Get active contract
        $activeContract = $user->contracts()
            ->where('status', 'Active')
            ->with('employer')
            ->first();

        // Get contract history
        $contractHistory = $user->contracts()
            ->whereIn('status', ['Completed', 'Terminated', 'Rejected'])
            ->with('employer')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get role-specific stats
        $stats = null;
        if ($user->isPerson() && $activeContract) {
            if ($activeContract->role === 'player') {
                $stats = $user->playerStats;
            } elseif ($activeContract->role === 'coach') {
                $stats = $user->coachStats;
            } elseif ($activeContract->role === 'referee') {
                $stats = $user->refereeStats;
            }
        } elseif ($user->isTeam()) {
            $stats = $user->teamStats;
        }

        return view('profile.show', compact('user', 'activeContract', 'contractHistory', 'stats'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = $request->user();

        // Delete old image if exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Store new image
        $imagePath = $request->file('image')->store('avatars', 'public');

        $user->update([
            'image' => $imagePath,
        ]);

        return back()->with('image-updated', 'true');
    }

    public function deleteImage(Request $request)
    {
        $user = $request->user();

        if ($user->image) {
            Storage::disk('public')->delete($user->image);
            $user->update(['image' => null]);
        }

        return back()->with('image-deleted', 'true');
    }
}
