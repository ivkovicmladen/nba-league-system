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
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Contracts You've Offered</h3>
                        <p class="text-sm text-gray-600">Total: {{ $contracts->total() }}</p>
                    </div>

                    @if($contracts->isEmpty())
                        <p class="text-gray-600">You haven't created any contract offers yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-4 py-2 text-left">Person</th>
                                        <th class="px-4 py-2 text-left">Role</th>
                                        <th class="px-4 py-2 text-left">Salary</th>
                                        <th class="px-4 py-2 text-left">Duration</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Offered</th>
                                        <th class="px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contracts as $contract)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-3">{{ $contract->user->full_name }}</td>
                                            <td class="px-4 py-3">{{ ucfirst($contract->role) }}</td>
                                            <td class="px-4 py-3">${{ number_format($contract->salary, 2) }}</td>
                                            <td class="px-4 py-3">
                                                @if($contract->date_from && $contract->date_to)
                                                    {{ $contract->date_from->format('Y-m-d') }} to {{ $contract->date_to->format('Y-m-d') }}
                                                @elseif($contract->date_to)
                                                    Until {{ $contract->date_to->format('Y-m-d') }}
                                                @else
                                                    Not started
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;
                                                    @if($contract->status === 'Active') background-color: #bbf7d0; color: #166534;
                                                    @elseif($contract->status === 'Pending') background-color: #fef08a; color: #854d0e;
                                                    @elseif($contract->status === 'Rejected') background-color: #fecaca; color: #991b1b;
                                                    @elseif($contract->status === 'Terminated') background-color: #fed7aa; color: #9a3412;
                                                    @else background-color: #e5e7eb; color: #374151;
                                                    @endif">
                                                    {{ $contract->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">{{ $contract->created_at->format('Y-m-d') }}</td>
                                            <td class="px-4 py-3">
                                                @if($contract->status === 'Active')
                                                    <form method="POST" action="{{ route('contracts.terminate', $contract) }}" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" 
                                                                style="background-color: #dc2626; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;"
                                                                onclick="return confirm('Are you sure you want to terminate this contract?')">
                                                            Terminate
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $contracts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>