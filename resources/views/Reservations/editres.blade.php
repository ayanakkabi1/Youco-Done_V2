<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Reservation</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                
                    <div class="bg-red-50 border-l-4 border-red-400 p-4">
                        <p class="text-sm text-red-700">
                            <strong>Notice:</strong> This reservation is for today. Changes are no longer permitted.
                        </p>
                        <a href="{{ route('reservations.index') }}" class="mt-3 inline-block text-sm font-bold text-red-700 underline">Back to list</a>
                    </div>
               
                    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-label value="Restaurant" />
                            <x-input type="text" value="{{ $reservation->restaurant->name }}" class="block mt-1 w-full bg-gray-100" disabled />
                        </div>

                        <div class="mb-4">
                            <x-label for="reservation_date" value="New Date" />
                            <x-input id="reservation_date" type="date" name="reservation_date" class="block mt-1 w-full" 
                                     value="{{ $reservation->reservation_date" 
                                     min="{{ date('Y-m-d', strtotime('+1 day')) }}" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="reservation_time" value="New Time" />
                            <x-input id="reservation_time" type="time" name="reservation_time" class="block mt-1 w-full" 
                                     value="{{ $reservation->reservation_time }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <a href="{{ route('reservations.index') }}" class="text-sm text-gray-600 underline">Cancel</a>
                            <x-button>Update Reservation</x-button>
                        </div>
                    </form>
                
            </div>
        </div>
    </div>
</x-app-layout>