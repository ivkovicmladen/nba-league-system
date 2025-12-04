<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $player->full_name }} - Player Profile
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

            <!-- Player Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-8">
                    <div class="flex items-center gap-6">
                        <!-- Player Photo -->
                        @if($player->image)
                            <img src="{{ asset('storage/' . $player->image) }}" 
                                 alt="{{ $player->full_name }}"
                                 class="rounded-full"
                                 style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #2563eb;">
                        @else
                            <div class="rounded-full" 
                                 style="width: 120px; height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 48px; border: 4px solid #2563eb;">
                                {{ substr($player->first_name, 0, 1) }}{{ substr($player->last_name, 0, 1) }}
                            </div>
                        @endif
                        
                        <!-- Player Info -->
                        <div class="flex-grow">
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $player->full_name }}</h1>
                            
                            @php
                                $contract = $player->contracts->first();
                                $employer = $contract ? $contract->employer : null;
                            @endphp
                            
                            @if($employer)
                                <a href="{{ route('search.team', $employer->id) }}" class="text-xl text-blue-600 hover:text-blue-800 font-semibold">
                                    {{ $employer->full_name }}
                                </a>
                            @endif
                            
                            <div class="mt-3 flex gap-6 text-sm text-gray-600">
                                <span>📅 Born: {{ $player->date_of_birth ? $player->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                                @if($contract)
                                    <span>💰 Salary: ${{ number_format($contract->salary) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Season Statistics -->
            @if($player->playerStats)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-6">📊 Season Statistics</h2>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <!-- Games Played -->
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600 font-semibold uppercase mb-2">Games Played</p>
                                <p class="text-4xl font-bold text-gray-900">{{ $player->playerStats->games_played }}</p>
                            </div>
                            
                            <!-- Points -->
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-600 font-semibold uppercase mb-2">Points Per Game</p>
                                <p class="text-4xl font-bold text-blue-600">
                                    {{ $player->playerStats->games_played > 0 ? number_format($player->playerStats->points / $player->playerStats->games_played, 1) : '0.0' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Total: {{ $player->playerStats->points }}</p>
                            </div>
                            
                            <!-- Rebounds -->
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <p class="text-sm text-green-600 font-semibold uppercase mb-2">Rebounds Per Game</p>
                                <p class="text-4xl font-bold text-green-600">
                                    {{ $player->playerStats->games_played > 0 ? number_format($player->playerStats->rebounds / $player->playerStats->games_played, 1) : '0.0' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Total: {{ $player->playerStats->rebounds }}</p>
                            </div>
                            
                            <!-- Assists -->
                            <div class="text-center p-4 bg-purple-50 rounded-lg">
                                <p class="text-sm text-purple-600 font-semibold uppercase mb-2">Assists Per Game</p>
                                <p class="text-4xl font-bold text-purple-600">
                                    {{ $player->playerStats->games_played > 0 ? number_format($player->playerStats->assists / $player->playerStats->games_played, 1) : '0.0' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Total: {{ $player->playerStats->assists }}</p>
                            </div>
                        </div>

                        <!-- Total Stats -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold mb-4">Career Totals</h3>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-3 bg-gray-50 rounded">
                                    <p class="text-2xl font-bold text-gray-900">{{ $player->playerStats->points }}</p>
                                    <p class="text-sm text-gray-600">Total Points</p>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded">
                                    <p class="text-2xl font-bold text-gray-900">{{ $player->playerStats->rebounds }}</p>
                                    <p class="text-sm text-gray-600">Total Rebounds</p>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded">
                                    <p class="text-2xl font-bold text-gray-900">{{ $player->playerStats->assists }}</p>
                                    <p class="text-sm text-gray-600">Total Assists</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-12 text-center text-gray-500">
                        No statistics available for this player yet.
                    </div>
                </div>
            @endif

            <!-- Contract Information -->
            @if($contract)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-4">📝 Contract Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold mb-1">Status</p>
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full font-semibold">
                                    {{ $contract->status }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold mb-1">Salary</p>
                                <p class="text-xl font-bold text-gray-900">${{ number_format($contract->salary) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold mb-1">Contract Start</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ $contract->date_from ? \Carbon\Carbon::parse($contract->date_from)->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>