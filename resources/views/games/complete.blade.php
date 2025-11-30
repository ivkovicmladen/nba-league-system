<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Complete Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Error!</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong>Success!</strong> {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('games.store') }}" id="gameForm">
                @csrf

                <!-- Game Info Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6" style="background-color: #2563eb; color: white;">
                        <h3 class="text-lg font-semibold">📅 Game Information</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Game Date</label>
                                <input type="date" name="game_date" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Referee</label>
                                <select name="referee_id" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Select Referee</option>
                                    @foreach($referees as $ref)
                                    <option value="{{ $ref->id }}">{{ $ref->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Referee Grade (1-5)</label>
                                <select name="referee_grade" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Select Grade</option>
                                    <option value="1">1 - Poor</option>
                                    <option value="2">2 - Below Average</option>
                                    <option value="3">3 - Average</option>
                                    <option value="4">4 - Good</option>
                                    <option value="5">5 - Excellent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <!-- Team 1 -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6" style="background-color: #f3f4f6;">
                            <h3 class="text-xl font-bold text-center mb-4">Team 1</h3>

                            <!-- Team 1 Image Preview -->
                            <div id="team1_image_preview" class="mb-4 text-center" style="display: none;">
                                <div id="team1_image_container" class="inline-block"></div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Select Team</label>
                                <select name="team1_id" id="team1_select" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Choose team...</option>
                                    @foreach($teams as $team)
                                    <option value="{{ $team->id }}"
                                        data-image="{{ $team->image ? asset('storage/' . $team->image) : '' }}"
                                        data-initials="{{ substr($team->first_name, 0, 1) . substr($team->last_name, 0, 1) }}">
                                        {{ $team->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Coach</label>
                                <select name="coach1_id" id="coach1_select" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Select team first...</option>
                                </select>
                            </div>

                            <div class="text-center mb-4">
                                <span class="text-gray-600">Total Points:</span>
                                <div class="text-4xl font-bold" style="color: #2563eb;" id="team1_total">0</div>
                            </div>

                            <h5 class="font-semibold mb-3">Players</h5>
                            <div id="team1_players">
                                <p class="text-gray-500 text-center">Select a team to load players</p>
                            </div>
                        </div>
                    </div>

                    <!-- Team 2 -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6" style="background-color: #f3f4f6;">
                            <h3 class="text-xl font-bold text-center mb-4">Team 2</h3>

                            <!-- Team 2 Image Preview -->
                            <div id="team2_image_preview" class="mb-4 text-center" style="display: none;">
                                <div id="team2_image_container" class="inline-block"></div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Select Team</label>
                                <select name="team2_id" id="team2_select" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Choose team...</option>
                                    @foreach($teams as $team)
                                    <option value="{{ $team->id }}"
                                        data-image="{{ $team->image ? asset('storage/' . $team->image) : '' }}"
                                        data-initials="{{ substr($team->first_name, 0, 1) . substr($team->last_name, 0, 1) }}">
                                        {{ $team->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Coach</label>
                                <select name="coach2_id" id="coach2_select" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">Select team first...</option>
                                </select>
                            </div>

                            <div class="text-center mb-4">
                                <span class="text-gray-600">Total Points:</span>
                                <div class="text-4xl font-bold" style="color: #2563eb;" id="team2_total">0</div>
                            </div>

                            <h5 class="font-semibold mb-3">Players</h5>
                            <div id="team2_players">
                                <p class="text-gray-500 text-center">Select a team to load players</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" style="background-color: #16a34a; color: white; padding: 12px 40px; border: none; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer;">
                        ✅ Complete Game
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .player-row {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 0;
        }

        .stat-inputs {
            display: none;
        }

        .stat-inputs.active {
            display: block;
        }
    </style>

    <script>
        document.getElementById('team1_select').addEventListener('change', function() {
            loadTeamData(1, this.value);
        });

        document.getElementById('team2_select').addEventListener('change', function() {
            loadTeamData(2, this.value);
        });

        function loadTeamData(teamNumber, teamId) {
            if (!teamId) {
                // Hide image preview when no team selected
                document.getElementById(`team${teamNumber}_image_preview`).style.display = 'none';
                return;
            }

            // Show team image
            const select = document.getElementById(`team${teamNumber}_select`);
            const option = select.options[select.selectedIndex];
            const image = option.dataset.image;
            const initials = option.dataset.initials;
            const imageContainer = document.getElementById(`team${teamNumber}_image_container`);

            if (image) {
                imageContainer.innerHTML = `<img src="${image}" class="rounded-lg" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #2563eb;">`;
            } else {
                imageContainer.innerHTML = `<div class="rounded-lg" style="width: 120px; height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 48px; border: 3px solid #2563eb;">${initials}</div>`;
            }
            document.getElementById(`team${teamNumber}_image_preview`).style.display = 'block';

            // Existing coach fetch code
            fetch(`/games/coaches/${teamId}`)
                .then(response => response.json())
                .then(data => {
                    const coachSelect = document.getElementById(`coach${teamNumber}_select`);
                    coachSelect.innerHTML = '<option value="">Select coach...</option>';
                    data.forEach(coach => {
                        coachSelect.innerHTML += `<option value="${coach.id}">${coach.name}</option>`;
                    });
                });

            // Existing players fetch code
            fetch(`/games/players/${teamId}`)
                .then(response => response.json())
                .then(data => {
                    const playersDiv = document.getElementById(`team${teamNumber}_players`);
                    if (data.length === 0) {
                        playersDiv.innerHTML = '<p class="text-red-600 text-center">No active players found</p>';
                        return;
                    }

                    let html = '';
                    data.forEach(player => {
                        html += `
                    <div class="player-row">
                        <div class="mb-2">
                            <label class="flex items-center">
                                <input class="mr-2" type="checkbox" 
                                       name="team${teamNumber}_players[${player.id}][played]" 
                                       value="1" 
                                       id="player${teamNumber}_${player.id}"
                                       onchange="togglePlayerStats(${teamNumber}, ${player.id})">
                                <span class="font-semibold">${player.name}</span>
                            </label>
                        </div>
                        <div class="stat-inputs ml-6" id="stats${teamNumber}_${player.id}">
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <label class="block text-xs text-gray-600">Points</label>
                                    <input type="number" 
                                           name="team${teamNumber}_players[${player.id}][points]" 
                                           class="w-full px-2 py-1 border rounded team${teamNumber}_points" 
                                           min="0" value="0"
                                           onchange="updateTeamTotal(${teamNumber})">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-600">Rebounds</label>
                                    <input type="number" 
                                           name="team${teamNumber}_players[${player.id}][rebounds]" 
                                           class="w-full px-2 py-1 border rounded" 
                                           min="0" value="0">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-600">Assists</label>
                                    <input type="number" 
                                           name="team${teamNumber}_players[${player.id}][assists]" 
                                           class="w-full px-2 py-1 border rounded" 
                                           min="0" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    });
                    playersDiv.innerHTML = html;
                });
        }

        function togglePlayerStats(teamNumber, playerId) {
            const checkbox = document.getElementById(`player${teamNumber}_${playerId}`);
            const statsDiv = document.getElementById(`stats${teamNumber}_${playerId}`);

            if (checkbox.checked) {
                statsDiv.classList.add('active');
            } else {
                statsDiv.classList.remove('active');
                statsDiv.querySelectorAll('input').forEach(input => {
                    input.value = 0;
                });
                updateTeamTotal(teamNumber);
            }
        }

        function updateTeamTotal(teamNumber) {
            let total = 0;
            document.querySelectorAll(`.team${teamNumber}_points`).forEach(input => {
                const checkbox = document.getElementById(
                    input.closest('.player-row').querySelector('input[type="checkbox"]').id
                );
                if (checkbox && checkbox.checked) {
                    total += parseInt(input.value) || 0;
                }
            });
            document.getElementById(`team${teamNumber}_total`).textContent = total;
        }

        document.getElementById('gameForm').addEventListener('submit', function(e) {
            const team1 = document.getElementById('team1_select').value;
            const team2 = document.getElementById('team2_select').value;

            if (team1 === team2) {
                e.preventDefault();
                alert('Teams cannot be the same!');
                return false;
            }

            const team1Active = document.querySelectorAll('#team1_players input[type="checkbox"]:checked').length;
            if (team1Active < 8) {
                e.preventDefault();
                alert('Team 1 must have at least 8 active players!');
                return false;
            }

            const team2Active = document.querySelectorAll('#team2_players input[type="checkbox"]:checked').length;
            if (team2Active < 8) {
                e.preventDefault();
                alert('Team 2 must have at least 8 active players!');
                return false;
            }

            const points1 = parseInt(document.getElementById('team1_total').textContent);
            const points2 = parseInt(document.getElementById('team2_total').textContent);

            if (points1 === points2) {
                e.preventDefault();
                alert('Teams cannot have the same score! There must be a winner.');
                return false;
            }
        });
    </script>
</x-app-layout>