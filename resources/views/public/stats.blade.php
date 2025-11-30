<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('League Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Team Standings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">🏆 Team Standings</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left">Rank</th>
                                    <th class="px-4 py-2 text-left">Team</th>
                                    <th class="px-4 py-2 text-center">GP</th>
                                    <th class="px-4 py-2 text-center">W</th>
                                    <th class="px-4 py-2 text-center">L</th>
                                    <th class="px-4 py-2 text-center">Win%</th>
                                    <th class="px-4 py-2 text-center">PTS</th>
                                    <th class="px-4 py-2 text-center">PA</th>
                                    <th class="px-4 py-2 text-center">Diff</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $index => $team)
                                    @if($team->teamStats)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3"><strong>{{ $index + 1 }}</strong></td>
                                        <td class="px-4 py-3"><strong>{{ $team->full_name }}</strong></td>
                                        <td class="px-4 py-3 text-center">{{ $team->teamStats->games_played }}</td>
                                        <td class="px-4 py-3 text-center text-green-600"><strong>{{ $team->teamStats->wins }}</strong></td>
                                        <td class="px-4 py-3 text-center text-red-600">{{ $team->teamStats->losses }}</td>
                                        <td class="px-4 py-3 text-center"><strong>{{ number_format($team->teamStats->win_rate * 100, 1) }}%</strong></td>
                                        <td class="px-4 py-3 text-center">{{ $team->teamStats->points_scored }}</td>
                                        <td class="px-4 py-3 text-center">{{ $team->teamStats->points_conceded }}</td>
                                        <td class="px-4 py-3 text-center {{ $team->teamStats->point_differential >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $team->teamStats->point_differential >= 0 ? '+' : '' }}{{ $team->teamStats->point_differential }}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Scorers -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">⭐ Top Scorers</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left">Rank</th>
                                    <th class="px-4 py-2 text-left">Player</th>
                                    <th class="px-4 py-2 text-center">GP</th>
                                    <th class="px-4 py-2 text-center">PTS</th>
                                    <th class="px-4 py-2 text-center">PPG</th>
                                    <th class="px-4 py-2 text-center">REB</th>
                                    <th class="px-4 py-2 text-center">AST</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topScorers as $index => $stats)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3"><strong>{{ $index + 1 }}</strong></td>
                                        <td class="px-4 py-3"><strong>{{ $stats->user->full_name }}</strong></td>
                                        <td class="px-4 py-3 text-center">{{ $stats->games_played }}</td>
                                        <td class="px-4 py-3 text-center text-green-600"><strong>{{ $stats->points }}</strong></td>
                                        <td class="px-4 py-3 text-center"><strong>{{ number_format($stats->points_per_game, 1) }}</strong></td>
                                        <td class="px-4 py-3 text-center">{{ $stats->rebounds }}</td>
                                        <td class="px-4 py-3 text-center">{{ $stats->assists }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Coaches -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">👔 Top Coaches</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left">Rank</th>
                                    <th class="px-4 py-2 text-left">Coach</th>
                                    <th class="px-4 py-2 text-center">W</th>
                                    <th class="px-4 py-2 text-center">L</th>
                                    <th class="px-4 py-2 text-center">Win%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topCoaches as $index => $stats)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3"><strong>{{ $index + 1 }}</strong></td>
                                        <td class="px-4 py-3"><strong>{{ $stats->user->full_name }}</strong></td>
                                        <td class="px-4 py-3 text-center text-green-600">{{ $stats->wins }}</td>
                                        <td class="px-4 py-3 text-center text-red-600">{{ $stats->losses }}</td>
                                        <td class="px-4 py-3 text-center"><strong>{{ number_format($stats->win_loss_percentage * 100, 1) }}%</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Referees -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">🏁 Top Referees</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left">Rank</th>
                                    <th class="px-4 py-2 text-left">Referee</th>
                                    <th class="px-4 py-2 text-center">Games</th>
                                    <th class="px-4 py-2 text-center">Avg Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topReferees as $index => $stats)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3"><strong>{{ $index + 1 }}</strong></td>
                                        <td class="px-4 py-3"><strong>{{ $stats->user->full_name }}</strong></td>
                                        <td class="px-4 py-3 text-center">{{ $stats->games_count }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span style="background-color: #fef08a; color: #854d0e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                                {{ number_format($stats->average_rating, 2) }}/5.00 ⭐
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>