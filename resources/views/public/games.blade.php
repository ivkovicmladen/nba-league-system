<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Completed Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($games->isEmpty())
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                            <p class="text-blue-700">No games have been completed yet.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-left">Team 1</th>
                                        <th class="px-4 py-2 text-center">Score</th>
                                        <th class="px-4 py-2 text-left">Team 2</th>
                                        <th class="px-4 py-2 text-left">Referee</th>
                                        <th class="px-4 py-2 text-center">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($games as $game)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-3">{{ $game->date->format('M j, Y') }}</td>
                                            <td class="px-4 py-3">
                                                <strong class="{{ $game->points1 > $game->points2 ? 'text-green-600' : '' }}">
                                                    {{ $game->team1->full_name }}
                                                </strong>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <strong class="text-lg">{{ $game->points1 }} - {{ $game->points2 }}</strong>
                                            </td>
                                            <td class="px-4 py-3">
                                                <strong class="{{ $game->points2 > $game->points1 ? 'text-green-600' : '' }}">
                                                    {{ $game->team2->full_name }}
                                                </strong>
                                            </td>
                                            <td class="px-4 py-3">{{ $game->referee->full_name }}</td>
                                            <td class="px-4 py-3 text-center">
                                                @if($game->referee_rating)
                                                    <span style="background-color: #fef08a; color: #854d0e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                                        {{ $game->referee_rating }}/5 ⭐
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $games->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>