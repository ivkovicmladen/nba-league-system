<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- User Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="d-flex align-items-start mb-4">

                        <!-- Profile Image -->
                        <div class="me-4">
                            @if($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}"
                                alt="{{ $user->full_name }}"
                                class="rounded"
                                style="width: 200px; height: 200px; object-fit: cover; border: 4px solid #667eea;">
                            @else
                            <div class="rounded d-flex align-items-center justify-content-center text-white fw-bold"
                                style="width: 200px; height: 200px; font-size: 64px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: 4px solid #667eea;">
                                {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                            </div>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="flex-grow-1">
                            <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Full Name</p>
                                    <p class="font-semibold">{{ $user->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="font-semibold">{{ $user->email }}</p>
                                </div>
                                @if($user->date_of_birth)
                                <div>
                                    <p class="text-sm text-gray-600">Date of Birth</p>
                                    <p class="font-semibold">{{ $user->date_of_birth->format('F j, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Age</p>
                                    <p class="font-semibold">{{ $user->date_of_birth->age }} years old</p>
                                </div>
                                @endif
                                <div>
                                    <p class="text-sm text-gray-600">Account Type</p>
                                    <p class="font-semibold">{{ ucfirst($user->type) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Member Since</p>
                                    <p class="font-semibold">{{ $user->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('profile.edit') }}" style="display: inline-block; padding: 8px 16px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 5px; font-size: 14px;">
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Active Contract Card -->
                    @if($activeContract)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Current Contract</h3>
                            <div class="bg-green-50 border-l-4 border-green-500 p-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Role</p>
                                        <p class="font-semibold text-lg">{{ ucfirst($activeContract->role) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Employer</p>
                                        <p class="font-semibold">
                                            @if($activeContract->employer_id === 'admin')
                                            League Administration
                                            @else
                                            {{ $activeContract->employer->full_name }}
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Salary</p>
                                        <p class="font-semibold text-green-600">${{ number_format($activeContract->salary, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Contract Period</p>
                                        <p class="font-semibold">
                                            @if($activeContract->date_from && $activeContract->date_to)
                                            {{ $activeContract->date_from->format('M j, Y') }} - {{ $activeContract->date_to->format('M j, Y') }}
                                            @elseif($activeContract->date_to)
                                            Until {{ $activeContract->date_to->format('M j, Y') }}
                                            @else
                                            Not specified
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Time Remaining</p>
                                        <p class="font-semibold">
                                            @if($activeContract->date_to)
                                            {{ $activeContract->date_to->diffForHumans() }}
                                            @else
                                            No end date
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status</p>
                                        <p class="font-semibold text-green-600">Active</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @if($user->isPerson())
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Current Contract</h3>
                            <div class="bg-gray-50 border-l-4 border-gray-400 p-4">
                                <p class="text-gray-600">You don't have an active contract currently.</p>
                                <a href="{{ route('contracts.index') }}" class="text-blue-600 underline mt-2 inline-block">
                                    Check for pending offers
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif

                    <!-- Stats Card -->
                    @if($stats)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">
                                @if($user->isPerson() && $activeContract)
                                {{ ucfirst($activeContract->role) }} Statistics
                                @elseif($user->isTeam())
                                Team Statistics
                                @endif
                            </h3>

                            @if($user->isPerson() && $activeContract && $activeContract->role === 'player')
                            <!-- Player Stats -->
                            <div class="grid grid-cols-4 gap-4">
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <p class="text-3xl font-bold text-blue-600">{{ $stats->games_played }}</p>
                                    <p class="text-sm text-gray-600">Games Played</p>
                                </div>
                                <div class="text-center p-4 bg-green-50 rounded-lg">
                                    <p class="text-3xl font-bold text-green-600">{{ number_format($stats->points_per_game, 1) }}</p>
                                    <p class="text-sm text-gray-600">PPG</p>
                                </div>
                                <div class="text-center p-4 bg-purple-50 rounded-lg">
                                    <p class="text-3xl font-bold text-purple-600">{{ number_format($stats->rebounds_per_game, 1) }}</p>
                                    <p class="text-sm text-gray-600">RPG</p>
                                </div>
                                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                    <p class="text-3xl font-bold text-yellow-600">{{ number_format($stats->assists_per_game, 1) }}</p>
                                    <p class="text-sm text-gray-600">APG</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-2xl font-bold">{{ $stats->points }}</p>
                                    <p class="text-sm text-gray-600">Total Points</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-2xl font-bold">{{ $stats->rebounds }}</p>
                                    <p class="text-sm text-gray-600">Total Rebounds</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-2xl font-bold">{{ $stats->assists }}</p>
                                    <p class="text-sm text-gray-600">Total Assists</p>
                                </div>
                            </div>

                            @elseif($user->isPerson() && $activeContract && $activeContract->role === 'coach')
                            <!-- Coach Stats -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-green-50 rounded-lg">
                                    <p class="text-3xl font-bold text-green-600">{{ $stats->wins }}</p>
                                    <p class="text-sm text-gray-600">Wins</p>
                                </div>
                                <div class="text-center p-4 bg-red-50 rounded-lg">
                                    <p class="text-3xl font-bold text-red-600">{{ $stats->losses }}</p>
                                    <p class="text-sm text-gray-600">Losses</p>
                                </div>
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <p class="text-3xl font-bold text-blue-600">{{ number_format($stats->win_loss_percentage * 100, 1) }}%</p>
                                    <p class="text-sm text-gray-600">Win Percentage</p>
                                </div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg mt-4">
                                <p class="text-2xl font-bold">{{ $stats->wins + $stats->losses }}</p>
                                <p class="text-sm text-gray-600">Total Games Coached</p>
                            </div>

                            @elseif($user->isPerson() && $activeContract && $activeContract->role === 'referee')
                            <!-- Referee Stats -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <p class="text-3xl font-bold text-blue-600">{{ $stats->games_count }}</p>
                                    <p class="text-sm text-gray-600">Games Officiated</p>
                                </div>
                                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                    <p class="text-3xl font-bold text-yellow-600">{{ number_format($stats->average_rating, 2) }}/5.00</p>
                                    <p class="text-sm text-gray-600">Average Rating</p>
                                </div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg mt-4">
                                <p class="text-2xl font-bold">{{ $stats->points }}</p>
                                <p class="text-sm text-gray-600">Total Rating Points</p>
                            </div>

                            @elseif($user->isTeam())
                            <!-- Team Stats -->
                            <div class="grid grid-cols-4 gap-4">
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <p class="text-3xl font-bold text-blue-600">{{ $stats->games_played }}</p>
                                    <p class="text-sm text-gray-600">Games Played</p>
                                </div>
                                <div class="text-center p-4 bg-green-50 rounded-lg">
                                    <p class="text-3xl font-bold text-green-600">{{ $stats->wins }}</p>
                                    <p class="text-sm text-gray-600">Wins</p>
                                </div>
                                <div class="text-center p-4 bg-red-50 rounded-lg">
                                    <p class="text-3xl font-bold text-red-600">{{ $stats->losses }}</p>
                                    <p class="text-sm text-gray-600">Losses</p>
                                </div>
                                <div class="text-center p-4 bg-purple-50 rounded-lg">
                                    <p class="text-3xl font-bold text-purple-600">{{ number_format($stats->win_rate * 100, 1) }}%</p>
                                    <p class="text-sm text-gray-600">Win Rate</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-2xl font-bold">{{ $stats->points_scored }}</p>
                                    <p class="text-sm text-gray-600">Points Scored</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-2xl font-bold">{{ $stats->points_conceded }}</p>
                                    <p class="text-sm text-gray-600">Points Conceded</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-2xl font-bold {{ $stats->point_differential >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $stats->point_differential >= 0 ? '+' : '' }}{{ $stats->point_differential }}
                                    </p>
                                    <p class="text-sm text-gray-600">Point Differential</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Contract History -->
                    @if($contractHistory->isNotEmpty())
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Contract History</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Employer</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Period</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Salary</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($contractHistory as $contract)
                                        <tr>
                                            <td class="px-4 py-3">{{ ucfirst($contract->role) }}</td>
                                            <td class="px-4 py-3">
                                                @if($contract->employer_id === 'admin')
                                                League Admin
                                                @else
                                                {{ $contract->employer->full_name }}
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($contract->date_from)
                                                {{ $contract->date_from->format('Y-m-d') }}
                                                @else
                                                N/A
                                                @endif
                                                to
                                                @if($contract->date_to)
                                                {{ $contract->date_to->format('Y-m-d') }}
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">${{ number_format($contract->salary, 2) }}</td>
                                            <td class="px-4 py-3">
                                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;
                                            @if($contract->status === 'Completed') background-color: #e5e7eb; color: #374151;
                                            @elseif($contract->status === 'Rejected') background-color: #fecaca; color: #991b1b;
                                            @elseif($contract->status === 'Terminated') background-color: #fed7aa; color: #9a3412;
                                            @endif">
                                                    {{ $contract->status }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
</x-app-layout>