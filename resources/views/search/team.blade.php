<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $team->full_name }} - Team Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('search.index') }}" class="text-blue-600 hover:text-blue-800">
                    ← Back to Search
                </a>
            </div>

            <!-- Team Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-8">
                    <div class="flex items-center gap-6">
                        <!-- Team Logo -->
                        @if($team->image)
                            <img src="{{ asset('storage/' . $team->image) }}" 
                                 alt="{{ $team->full_name }}"
                                 class="rounded-lg"
                                 style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #2563eb;">
                        @else
                            <div class="rounded-lg" 
                                 style="width: 120px; height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 48px; border: 4px solid #2563eb;">
                                {{ substr($team->first_name, 0, 1) }}{{ substr($team->last_name, 0, 1) }}
                            </div>
                        @endif
                        
                        <!-- Team Info -->
                        <div class="flex-grow">
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $team->full_name }}</h1>
                            
                            @if($team->teamStats)
                                <div class="flex gap-6 text-lg">
                                    <span class="font-semibold">
                                        <span class="text-green-600">{{ $team->teamStats->wins }}</span> - 
                                        <span class="text-red-600">{{ $team->teamStats->losses }}</span>
                                    </span>
                                    <span class="text-gray-600">
                                        ({{ number_format($team->teamStats->win_rate * 100, 1) }}% Win Rate)
                                    </span>
                                </div>
                            @endif
                            
                            <div class="mt-3 flex gap-6 text-sm text-gray-600">
                                <span>📅 Founded: {{ $team->date_of_birth ? $team->date_of_birth->format('Y') : 'N/A' }}</span>
                                <span>📧 {{ $team->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Statistics -->
            @if($team->teamStats)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-6">📊 Team Statistics</h2>
                        
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600 font-semibold uppercase mb-2">Games Played</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $team->teamStats->games_played }}</p>
                            </div>
                            
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <p class="text-sm text-green-600 font-semibold uppercase mb-2">Wins</p>
                                <p class="text-3xl font-bold text-green-600">{{ $team->teamStats->wins }}</p>
                            </div>
                            
                            <div class="text-center p-4 bg-red-50 rounded-lg">
                                <p class="text-sm text-red-600 font-semibold uppercase mb-2">Losses</p>
                                <p class="text-3xl font-bold text-red-600">{{ $team->teamStats->losses }}</p>
                            </div>
                            
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-600 font-semibold uppercase mb-2">Points For</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $team->teamStats->points_scored }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $team->teamStats->games_played > 0 ? number_format($team->teamStats->points_scored / $team->teamStats->games_played, 1) : '0' }} PPG
                                </p>
                            </div>
                            
                            <div class="text-center p-4 bg-orange-50 rounded-lg">
                                <p class="text-sm text-orange-600 font-semibold uppercase mb-2">Points Against</p>
                                <p class="text-3xl font-bold text-orange-600">{{ $team->teamStats->points_conceded }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $team->teamStats->games_played > 0 ? number_format($team->teamStats->points_conceded / $team->teamStats->games_played, 1) : '0' }} PPG
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Coaching Staff -->
            @if($team->activeCoachContracts && $team->activeCoachContracts->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-4">👔 Coaching Staff</h2>
                        
                        <div class="space-y-3">
                            @foreach($team->activeCoachContracts as $contract)
                                @php $coach = $contract->user; @endphp
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                    @if($coach->image)
                                        <img src="{{ asset('storage/' . $coach->image) }}" 
                                             alt="{{ $coach->full_name }}"
                                             class="rounded-full"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded-full" 
                                             style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 20px;">
                                            {{ substr($coach->first_name, 0, 1) }}{{ substr($coach->last_name, 0, 1) }}
                                        </div>
                                    @endif
                                    
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-lg">{{ $coach->full_name }}</h4>
                                        <p class="text-sm text-gray-600">Coach</p>
                                    </div>
                                    
                                    @if($coach->coachStats)
                                        <div class="text-right">
                                            <p class="font-semibold">
                                                <span class="text-green-600">{{ $coach->coachStats->wins }}</span> - 
                                                <span class="text-red-600">{{ $coach->coachStats->losses }}</span>
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ number_format($coach->coachStats->win_loss_percentage * 100, 1) }}% Win Rate
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Active Roster -->
            @if($team->activePlayerContracts && $team->activePlayerContracts->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-4">👥 Active Roster ({{ $team->activePlayerContracts->count() }} Players)</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($team->activePlayerContracts as $contract)
                                @php $player = $contract->user; @endphp
                                <a href="{{ route('search.player', $player->id) }}" 
                                   class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-lg transition">
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
                                    
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-lg">{{ $player->full_name }}</h4>
                                        @if($player->playerStats && $player->playerStats->games_played > 0)
                                            <p class="text-sm text-blue-600 font-semibold mt-1">
                                                {{ number_format($player->playerStats->points / $player->playerStats->games_played, 1) }} PPG
                                                • {{ number_format($player->playerStats->rebounds / $player->playerStats->games_played, 1) }} RPG
                                                • {{ number_format($player->playerStats->assists / $player->playerStats->games_played, 1) }} APG
                                            </p>
                                        @else
                                            <p class="text-sm text-gray-500">No stats yet</p>
                                        @endif
                                    </div>
                                    
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center text-gray-500">
                        No active players on this team yet.
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>