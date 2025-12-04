<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'all'); // all, players, teams
        
        $players = collect();
        $teams = collect();
        
        if ($query) {
            // Search players (people with active player contracts)
            if ($type === 'all' || $type === 'players') {
                $players = User::where('type', 'person')
                    ->where(function($q) use ($query) {
                        $q->where('first_name', 'LIKE', "%{$query}%")
                          ->orWhere('last_name', 'LIKE', "%{$query}%")
                          ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"]);
                    })
                    ->whereHas('contracts', function($q) {
                        $q->where('role', 'player')
                          ->where('status', 'Active');
                    })
                    ->with(['playerStats', 'contracts' => function($q) {
                        $q->where('status', 'Active')->with('employer');
                    }])
                    ->limit(20)
                    ->get();
            }
            
            // Search teams
            if ($type === 'all' || $type === 'teams') {
                $teams = User::where('type', 'team')
                    ->where(function($q) use ($query) {
                        $q->where('first_name', 'LIKE', "%{$query}%")
                          ->orWhere('last_name', 'LIKE', "%{$query}%")
                          ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"]);
                    })
                    ->with('teamStats')
                    ->limit(10)
                    ->get();
            }
        }
        
        return view('search.index', compact('players', 'teams', 'query', 'type'));
    }
    
    public function showPlayer($id)
    {
        $player = User::where('type', 'person')
            ->whereHas('contracts', function($q) {
                $q->where('role', 'player');
            })
            ->with(['playerStats', 'contracts' => function($q) {
                $q->where('status', 'Active')->with('employer');
            }])
            ->findOrFail($id);
            
        return view('search.player', compact('player'));
    }
    
    public function showTeam($id)
    {
        $team = User::where('type', 'team')
            ->with([
                'teamStats',
                'activePlayerContracts.user.playerStats',
                'activeCoachContracts.user.coachStats'
            ])
            ->findOrFail($id);
            
        return view('search.team', compact('team'));
    }
}