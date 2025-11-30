<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\TeamStats;
use App\Models\PlayerStats;
use App\Models\CoachStats;
use App\Models\RefereeStats;

class PublicStatsController extends Controller
{
    public function games()
    {
        $games = Game::with(['team1', 'team2', 'referee'])
            ->where('game_status', 'completed')
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('public.games', compact('games'));
    }

    public function stats()
    {
        $teams = User::where('type', 'team')
            ->with('teamStats')
            ->get()
            ->sortByDesc(function ($team) {
                return $team->teamStats ? $team->teamStats->win_rate : 0;
            });

        $topScorers = PlayerStats::with('user')
            ->where('games_played', '>', 0)
            ->orderBy('points', 'desc')
            ->limit(10)
            ->get();

        $topCoaches = CoachStats::with('user')
            ->whereRaw('(wins + losses) > 0')
            ->get()
            ->sortByDesc('win_loss_percentage')
            ->take(10);

        $topReferees = RefereeStats::with('user')
            ->where('games_count', '>', 0)
            ->get()
            ->sortByDesc('average_rating')
            ->take(10);

        return view('public.stats', compact('teams', 'topScorers', 'topCoaches', 'topReferees'));
    }
}