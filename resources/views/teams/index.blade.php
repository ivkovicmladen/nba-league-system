<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div style="background-color: #10b981; color: white; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 class="text-lg font-semibold">All Teams</h3>
                        <a href="{{ route('teams.create') }}" 
                           style="display: inline-block; 
                                  padding: 10px 20px; 
                                  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                  color: white; 
                                  text-decoration: none; 
                                  border-radius: 8px; 
                                  font-weight: 600; 
                                  font-size: 14px;
                                  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                                  transition: all 0.3s ease;"
                           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.15)';"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                            + Create New Team
                        </a>
                    </div>

                    @if($teams->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full" style="border-collapse: separate; border-spacing: 0;">
                                <thead style="background-color: #374151;">
                                    <tr>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #9ca3af;">Image</th>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #9ca3af;">Team Name</th>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #9ca3af;">Email</th>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #9ca3af;">Founded</th>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #9ca3af;">Record</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: #4b5563;">
                                    @foreach($teams as $team)
                                        <tr style="border-bottom: 1px solid #374151;">
                                            <td style="padding: 12px;">
                                                @if($team->image)
                                                    <img src="{{ asset('storage/' . $team->image) }}" 
                                                         alt="{{ $team->full_name }}"
                                                         style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover;">
                                                @else
                                                    <div style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">
                                                        {{ substr($team->first_name, 0, 1) }}{{ substr($team->last_name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td style="padding: 12px; font-weight: 600;">{{ $team->full_name }}</td>
                                            <td style="padding: 12px; color: #9ca3af;">{{ $team->email }}</td>
                                            <td style="padding: 12px; color: #9ca3af;">{{ $team->date_of_birth ? $team->date_of_birth->format('Y') : 'N/A' }}</td>
                                            <td style="padding: 12px;">
                                                @if($team->teamStats)
                                                    <span style="color: #10b981;">{{ $team->teamStats->wins }}W</span> - 
                                                    <span style="color: #ef4444;">{{ $team->teamStats->losses }}L</span>
                                                @else
                                                    <span style="color: #6b7280;">No stats</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div style="margin-top: 20px;">
                            {{ $teams->links() }}
                        </div>
                    @else
                        <p style="text-align: center; color: #9ca3af; padding: 40px 0;">
                            No teams created yet. Create your first team!
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>