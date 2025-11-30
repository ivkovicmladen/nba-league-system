<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Contracts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">Person</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Employer</th>
                                <th class="px-4 py-2">Salary</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contracts as $contract)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $contract->user->full_name }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($contract->role) }}</td>
                                    <td class="px-4 py-2">
                                        {{ $contract->employer_id === 'admin' ? 'League Admin' : $contract->employer->full_name }}
                                    </td>
                                    <td class="px-4 py-2">${{ number_format($contract->salary, 2) }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-xs
                                            @if($contract->status === 'Active') bg-green-200 text-green-800
                                            @elseif($contract->status === 'Pending') bg-yellow-200 text-yellow-800
                                            @else bg-gray-200 text-gray-800
                                            @endif">
                                            {{ $contract->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-sm">{{ $contract->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $contracts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>