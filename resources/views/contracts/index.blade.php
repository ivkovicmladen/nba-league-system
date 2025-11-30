<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Contract Offers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($pendingContracts->isEmpty())
                    <p class="text-gray-600">You have no pending contract offers.</p>
                    @else
                    <h3 class="text-lg font-semibold mb-4">Pending Offers ({{ $pendingContracts->count() }})</h3>

                    @foreach($pendingContracts as $contract)
                    <div class="border rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-lg">{{ ucfirst($contract->role) }} Position</h4>
                                <p class="text-gray-600">
                                    From: <strong>{{ $contract->employer_id === 'admin' ? 'League Administration' : $contract->employer->full_name }}</strong>
                                </p>
                                <p class="text-gray-600">
                                    Salary: <strong>${{ number_format($contract->salary, 2) }}</strong>
                                </p>
                                <p class="text-sm text-gray-500 mt-2">
                                    Offered: {{ $contract->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <form method="POST" action="{{ route('contracts.accept', $contract) }}">
                                    @csrf
                                    <button type="submit" style="background-color: #16a34a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                        ✓ Accept
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('contracts.reject', $contract) }}">
                                    @csrf
                                    <button type="submit" style="background-color: #dc2626; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;"
                                        onclick="return confirm('Are you sure you want to reject this offer?')">
                                        ✗ Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>