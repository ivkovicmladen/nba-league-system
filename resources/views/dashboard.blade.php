<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">

                    <div class="d-flex align-items-center mb-4">
                        @if(Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                            alt="{{ Auth::user()->full_name }}"
                            class="rounded-circle me-3"
                            style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #667eea;">
                        @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 text-white fw-bold"
                            style="width: 80px; height: 80px; font-size: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: 3px solid #667eea;">
                            {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                        </div>
                        @endif
                        <div>
                            <h2 class="text-2xl font-bold mb-0">Welcome, {{ Auth::user()->full_name }}!</h2>
                            <p class="text-muted mb-0">{{ ucfirst(Auth::user()->type) }}</p>
                        </div>
                    </div>

                    <p class="text-blue-100">
                        @if(Auth::user()->isAdmin())
                        You have full administrative access to the NBA League System.
                        @elseif(Auth::user()->isTeam())
                        Manage your team, create contracts, and view your performance.
                        @else
                        View your contracts, check your stats, and explore the league.
                        @endif
                    </p>
                </div>
            </div>

            <!-- Quick Actions -->
            @if(Auth::user()->isAdmin())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">⚡ Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                        <!-- Complete Game -->
                        <a href="{{ route('games.create') }}" class="block p-6 bg-blue-50 hover:bg-blue-100 rounded-lg border-2 border-blue-200 transition">
                            <div class="text-4xl mb-2">🏀</div>
                            <h4 class="font-bold text-lg mb-1">Complete Game</h4>
                            <p class="text-sm text-gray-600">Record final scores and update statistics for completed games</p>
                        </a>

                        <!-- Create Contract -->
                        <a href="{{ route('contracts.create') }}" class="block p-6 bg-green-50 hover:bg-green-100 rounded-lg border-2 border-green-200 transition">
                            <div class="text-4xl mb-2">📝</div>
                            <h4 class="font-bold text-lg mb-1">Create Contract</h4>
                            <p class="text-sm text-gray-600">Offer new referee contracts to available persons</p>
                        </a>

                        <!-- My Offers -->
                        <a href="{{ route('contracts.my-offers') }}" class="block p-6 bg-orange-50 hover:bg-orange-100 rounded-lg border-2 border-orange-200 transition">
                            <div class="text-4xl mb-2">📋</div>
                            <h4 class="font-bold text-lg mb-1">My Offers</h4>
                            <p class="text-sm text-gray-600">View and manage contracts you've created</p>
                        </a>

                        <!-- All Contracts -->
                        <a href="{{ route('contracts.all') }}" class="block p-6 bg-purple-50 hover:bg-purple-100 rounded-lg border-2 border-purple-200 transition">
                            <div class="text-4xl mb-2">📊</div>
                            <h4 class="font-bold text-lg mb-1">All Contracts</h4>
                            <p class="text-sm text-gray-600">View all contracts in the league system</p>
                        </a>

                        <!-- Manage Teams -->
                        <a href="{{ route('teams.index') }}" class="block p-6 bg-teal-50 hover:bg-teal-100 rounded-lg border-2 border-teal-200 transition">
                            <div class="text-4xl mb-2">🏆</div>
                            <h4 class="font-bold text-lg mb-1">Manage Teams</h4>
                            <p class="text-sm text-gray-600">Create and manage team profiles in the league</p>
                        </a>

                    </div>
                </div>
            </div>
            @elseif(Auth::user()->isTeam())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">⚡ Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Create Contract -->
                        <a href="{{ route('contracts.create') }}" class="block p-6 bg-green-50 hover:bg-green-100 rounded-lg border-2 border-green-200 transition">
                            <div class="text-4xl mb-2">📝</div>
                            <h4 class="font-bold text-lg mb-1">Create Contract Offer</h4>
                            <p class="text-sm text-gray-600">Offer player or coach contracts to grow your roster</p>
                        </a>

                        <!-- My Offers -->
                        <a href="{{ route('contracts.my-offers') }}" class="block p-6 bg-orange-50 hover:bg-orange-100 rounded-lg border-2 border-orange-200 transition">
                            <div class="text-4xl mb-2">📋</div>
                            <h4 class="font-bold text-lg mb-1">My Offers</h4>
                            <p class="text-sm text-gray-600">View and manage your team's contract offers</p>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">⚡ Quick Actions</h3>
                    <div class="grid grid-cols-1 gap-4">

                        <!-- View Contracts -->
                        <a href="{{ route('contracts.index') }}" class="block p-6 bg-blue-50 hover:bg-blue-100 rounded-lg border-2 border-blue-200 transition">
                            <div class="text-4xl mb-2">📬</div>
                            <h4 class="font-bold text-lg mb-1">View Contract Offers</h4>
                            <p class="text-sm text-gray-600">Check pending contract offers and accept or reject them</p>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contract Notification for Persons -->
            @if(Auth::user()->isPerson())
            @php
            $pendingCount = Auth::user()->contracts()->where('status', 'Pending')->count();
            @endphp
            @if($pendingCount > 0)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                <div class="flex items-center">
                    <div class="text-3xl mr-3">🔔</div>
                    <div>
                        <p class="font-bold text-yellow-800">You have {{ $pendingCount }} pending contract offer(s)!</p>
                        <a href="{{ route('contracts.index') }}" class="text-yellow-900 underline font-semibold">View offers now →</a>
                    </div>
                </div>
            </div>
            @endif
            @endif

            <!-- League Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">🌐 League Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <a href="{{ route('games.public') }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border transition">
                            <div class="flex items-center">
                                <div class="text-3xl mr-3">🏆</div>
                                <div>
                                    <h4 class="font-bold">View All Games</h4>
                                    <p class="text-sm text-gray-600">Browse completed games and results</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('stats.public') }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border transition">
                            <div class="flex items-center">
                                <div class="text-3xl mr-3">📊</div>
                                <div>
                                    <h4 class="font-bold">League Statistics</h4>
                                    <p class="text-sm text-gray-600">Team standings, player stats, and rankings</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>