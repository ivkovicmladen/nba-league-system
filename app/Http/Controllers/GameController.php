<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\PlayerStats;
use App\Models\CoachStats;
use App\Models\RefereeStats;
use App\Models\TeamStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function create()
    {
        $teams = User::where('type', 'team')->get();
        
        $referees = User::where('type', 'person')
            ->whereHas('contracts', function ($query) {
                $query->where('role', 'referee')
                      ->where('status', 'Active');
            })
            ->get();

        return view('games.complete', compact('teams', 'referees'));
    }

    public function getCoaches($teamId)
    {
        $coaches = User::where('type', 'person')
            ->whereHas('contracts', function ($query) use ($teamId) {
                $query->where('role', 'coach')
                      ->where('status', 'Active')
                      ->where('employer_id', $teamId);
            })
            ->get()
            ->map(function ($coach) {
                return [
                    'id' => $coach->id,
                    'name' => $coach->full_name,
                ];
            });

        return response()->json($coaches);
    }

    public function getPlayers($teamId)
    {
        $players = User::where('type', 'person')
            ->whereHas('contracts', function ($query) use ($teamId) {
                $query->where('role', 'player')
                      ->where('status', 'Active')
                      ->where('employer_id', $teamId);
            })
            ->get()
            ->map(function ($player) {
                return [
                    'id' => $player->id,
                    'name' => $player->full_name,
                ];
            });

        return response()->json($players);
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'team1_id' => 'required|integer|different:team2_id',
            'team2_id' => 'required|integer',
            'coach1_id' => 'required|integer',
            'coach2_id' => 'required|integer',
            'referee_id' => 'required|integer',
            'referee_grade' => 'required|integer|min:1|max:5',
            'game_date' => 'required|date',
        ]);

        $team1Players = $request->input('team1_players', []);
        $team2Players = $request->input('team2_players', []);

        // Calculate totals
        $team1Total = 0;
        $team1ActiveCount = 0;
        foreach ($team1Players as $playerId => $data) {
            if (isset($data['played'])) {
                $team1ActiveCount++;
                $team1Total += intval($data['points'] ?? 0);
            }
        }

        $team2Total = 0;
        $team2ActiveCount = 0;
        foreach ($team2Players as $playerId => $data) {
            if (isset($data['played'])) {
                $team2ActiveCount++;
                $team2Total += intval($data['points'] ?? 0);
            }
        }

        // Validate
        if ($team1ActiveCount < 8) {
            return back()->withErrors(['error' => 'Team 1 must have at least 8 active players!']);
        }

        if ($team2ActiveCount < 8) {
            return back()->withErrors(['error' => 'Team 2 must have at least 8 active players!']);
        }

        if ($team1Total === $team2Total) {
            return back()->withErrors(['error' => 'Teams cannot have the same score!']);
        }

        // Start transaction
        DB::beginTransaction();

        try {
            // Create game
            $game = Game::create([
                'team1_id' => $request->team1_id,
                'team2_id' => $request->team2_id,
                'points1' => $team1Total,
                'points2' => $team2Total,
                'referee_id' => $request->referee_id,
                'referee_rating' => $request->referee_grade,
                'date' => $request->game_date,
                'game_status' => 'completed',
            ]);

            // Update player stats for team 1
            foreach ($team1Players as $playerId => $data) {
                if (isset($data['played'])) {
                    $stats = PlayerStats::firstOrCreate(['user_id' => $playerId]);
                    $stats->points += intval($data['points'] ?? 0);
                    $stats->rebounds += intval($data['rebounds'] ?? 0);
                    $stats->assists += intval($data['assists'] ?? 0);
                    $stats->games_played += 1;
                    $stats->save();
                }
            }

            // Update player stats for team 2
            foreach ($team2Players as $playerId => $data) {
                if (isset($data['played'])) {
                    $stats = PlayerStats::firstOrCreate(['user_id' => $playerId]);
                    $stats->points += intval($data['points'] ?? 0);
                    $stats->rebounds += intval($data['rebounds'] ?? 0);
                    $stats->assists += intval($data['assists'] ?? 0);
                    $stats->games_played += 1;
                    $stats->save();
                }
            }

            // Update team stats
            $team1Won = $team1Total > $team2Total ? 1 : 0;
            $team1Lost = $team1Total < $team2Total ? 1 : 0;

            $team1Stats = TeamStats::firstOrCreate(['team_id' => $request->team1_id]);
            $team1Stats->games_played += 1;
            $team1Stats->wins += $team1Won;
            $team1Stats->losses += $team1Lost;
            $team1Stats->points_scored += $team1Total;
            $team1Stats->points_conceded += $team2Total;
            $team1Stats->save();

            $team2Won = $team2Total > $team1Total ? 1 : 0;
            $team2Lost = $team2Total < $team1Total ? 1 : 0;

            $team2Stats = TeamStats::firstOrCreate(['team_id' => $request->team2_id]);
            $team2Stats->games_played += 1;
            $team2Stats->wins += $team2Won;
            $team2Stats->losses += $team2Lost;
            $team2Stats->points_scored += $team2Total;
            $team2Stats->points_conceded += $team1Total;
            $team2Stats->save();

            // Update coach stats
            $coach1Stats = CoachStats::firstOrCreate(['user_id' => $request->coach1_id]);
            $coach1Stats->wins += $team1Won;
            $coach1Stats->losses += $team1Lost;
            $coach1Stats->save();

            $coach2Stats = CoachStats::firstOrCreate(['user_id' => $request->coach2_id]);
            $coach2Stats->wins += $team2Won;
            $coach2Stats->losses += $team2Lost;
            $coach2Stats->save();

            // Update referee stats
            $refStats = RefereeStats::firstOrCreate(['user_id' => $request->referee_id]);
            $refStats->points += $request->referee_grade;
            $refStats->games_count += 1;
            $refStats->save();

            DB::commit();

            return redirect()->route('games.create')->with('success', 'Game completed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}