<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Create Contract Offer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('contracts.store') }}">
                        @csrf

                        <div class="mb-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
                            <p class="font-bold">Contract Rules:</p>
                            <ul class="list-disc ml-5 mt-2">
                                <li>Each person can only have ONE active contract at a time</li>
                                <li>Only persons without active contracts appear in the list</li>
                                @if(Auth::user()->isAdmin())
                                <li>Admins can only create <strong>referee</strong> contracts</li>
                                @elseif(Auth::user()->isTeam())
                                <li>Teams can only create <strong>player</strong> and <strong>coach</strong> contracts</li>
                                @endif
                            </ul>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Select Person
                            </label>


                            <select name="user_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="">Choose a person...</option>
                                @foreach($persons as $person)
                                <option value="{{ $person->id }}">
                                    {{ $person->full_name }} ({{ $person->email }})
                                </option>
                                @endforeach
                            </select>

                            
                            @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Role
                            </label>
                            <select name="role" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="">Select role...</option>
                                @foreach($allowedRoles as $role)
                                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            @if(Auth::user()->isAdmin())
                            <p class="text-sm text-gray-600 mt-1">As an admin, you can only create referee contracts.</p>
                            @elseif(Auth::user()->isTeam())
                            <p class="text-sm text-gray-600 mt-1">As a team, you can only create player and coach contracts.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Salary
                            </label>
                            <input type="number" name="salary" step="0.01" min="0"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700"
                                placeholder="5000000.00" required>
                            @error('salary')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Contract Duration (Years)
                            </label>
                            <select name="contract_years" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="">Select duration...</option>
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                            </select>
                            @error('contract_years')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Send Contract Offer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>