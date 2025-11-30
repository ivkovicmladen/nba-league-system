<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TeamStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TeamController extends Controller
{
    public function index()
    {
        $teams = User::where('type', 'team')->paginate(10);
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('avatars', 'public');
        }

        $team = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'team',
            'image' => $imagePath,
        ]);

        // Create team stats record
        TeamStats::create([
            'team_id' => $team->id,
            'games_played' => 0,
            'wins' => 0,
            'losses' => 0,
            'points_scored' => 0,
            'points_conceded' => 0,
        ]);

        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
    }
}