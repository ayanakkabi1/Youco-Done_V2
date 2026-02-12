<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Restaurant</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($reservations as $reservation)
                            <tr>
                                <td class="px-6 py-4">{{ $reservation->restaurant->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $reservation->date_reservation}} 
                                    at {{ $reservation->heure_reservation }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    @can('update', $reservation)
                                            <a href="{{ route('reservations.edit', $reservation) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>
                                       
                                   
                                        <span class="text-gray-400 italic">View Only</span>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($reservations->isEmpty())
                    <p class="text-center py-4 text-gray-500">No reservations found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>