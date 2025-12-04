<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Search Players & Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('search.index') }}" class="space-y-4">
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- Search Input -->
                            <div class="flex-grow">
                                <input type="text" 
                                       name="query" 
                                       value="{{ $query ?? '' }}"
                                       placeholder="Search by player name or team name..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       autofocus>
                            </div>
                            
                            <!-- Type Filter -->
                            <div class="md:w-48">
                                <select name="type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="all" {{ ($type ?? 'all') === 'all' ? 'selected' : '' }}>All</option>
                                    <option value="players" {{ ($type ?? '') === 'players' ? 'selected' : '' }}>Players Only</option>
                                    <option value="teams" {{ ($type ?? '') === 'teams' ? 'selected' : '' }}>Teams Only</option>
                                </select>
                            </div>
                            
                            <!-- Search Button -->
                            <button type="submit" 
                                    style="background-color: #2563eb; color: white; padding: 12px 32px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($query)
                <!-- Teams Results -->
                @if($teams->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-4">🏀 Teams ({{ $teams->count() }})</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($teams as $team)
                                    <a href="{{ route('search.team', $team->id) }}" 
                                       class="block p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-lg transition">
                                        <div class="flex items-center gap-4">
                                            <!-- Team Logo -->
                                            @if($team->image)
                                                <img src="{{ asset('storage/' . $team->image) }}" 
                                                     alt="{{ $team->full_name }}"
                                                     class="rounded-lg"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="rounded-lg" 
                                                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
                                                    {{ substr($team->first_name, 0, 1) }}{{ substr($team->last_name, 0, 1) }}
                                                </div>
                                            @endif
                                            
                                            <!-- Team Info -->
                                            <div class="flex-grow">
                                                <h4 class="font-bold text-lg">{{ $team->full_name }}</h4>
                                                @if($team->teamStats)
                                                    <p class="text-sm text-gray-600">
                                                        {{ $team->teamStats->wins }}W - {{ $team->teamStats->losses }}L
                                                        ({{ number_format($team->teamStats->win_rate * 100, 1) }}%)
                                                    </p>
                                                @else
                                                    <p class="text-sm text-gray-500">No stats</p>
                                                @endif
                                            </div>
                                            
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Players Results -->
                @if($players->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-4">👤 Players ({{ $players->count() }})</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($players as $player)
                                    <a href="{{ route('search.player', $player->id) }}" 
                                       class="block p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-lg transition">
                                        <div class="flex items-center gap-4">
                                            <!-- Player Photo -->
                                            @if($player->image)
                                                <img src="{{ asset('storage/' . $player->image) }}" 
                                                     alt="{{ $player->full_name }}"
                                                     class="rounded-full"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="rounded-full" 
                                                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
                                                    {{ substr($player->first_name, 0, 1) }}{{ substr($player->last_name, 0, 1) }}
                                                </div>
                                            @endif
                                            
                                            <!-- Player Info -->
                                            <div class="flex-grow">
                                                <h4 class="font-bold text-lg">{{ $player->full_name }}</h4>
                                                @php
                                                    $contract = $player->contracts->first();
                                                    $employer = $contract ? $contract->employer : null;
                                                @endphp
                                                @if($employer)
                                                    <p class="text-sm text-gray-600">{{ $employer->full_name }}</p>
                                                @endif
                                                
                                                @if($player->playerStats)
                                                    <p class="text-sm text-blue-600 font-semibold mt-1">
                                                        {{ number_format($player->playerStats->points / max($player->playerStats->games_played, 1), 1) }} PPG
                                                        • {{ number_format($player->playerStats->rebounds / max($player->playerStats->games_played, 1), 1) }} RPG
                                                        • {{ number_format($player->playerStats->assists / max($player->playerStats->games_played, 1), 1) }} APG
                                                    </p>
                                                @endif
                                            </div>
                                            
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- No Results -->
                @if($teams->count() === 0 && $players->count() === 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-12 text-center">
                            <div class="text-6xl mb-4">🔍</div>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">No results found</h3>
                            <p class="text-gray-500">Try searching with a different name or term</p>
                        </div>
                    </div>
                @endif
            @else
                <!-- Welcome Message -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <div class="text-6xl mb-4">🏀</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Search Players & Teams</h3>
                        <p class="text-gray-600 mb-4">Enter a player name or team name to view detailed statistics</p>
                        <div class="flex justify-center gap-4 text-sm text-gray-500">
                            <span>✓ View player stats</span>
                            <span>✓ View team rosters</span>
                            <span>✓ Compare performance</span>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>