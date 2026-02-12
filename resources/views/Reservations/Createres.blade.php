
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                @if($errors->has('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        <p>{{ $errors->first('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <x-label for="restaurant_id" value="Choisir un restaurant" />
                        <select name="restaurant_id" id="restaurant_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                            @foreach($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                    {{ $restaurant->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="restaurant_id" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-6">
                            <x-label for="date_reservation" value="Date" />
                            <x-input id="date_reservation" name="date_reservation" type="text" class="mt-1 block w-full" 
                                     placeholder="Sélectionnez une date" value="{{ old('date_reservation') }}" required />
                            <x-input-error for="date_reservation" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-label for="heure_reservation" value="Heure" />
                            <x-input id="heure_reservation" name="heure_reservation" type="text" class="mt-1 block w-full" 
                                     placeholder="Sélectionnez l'heure" value="{{ old('heure_reservation') }}" required />
                            <x-input-error for="heure_reservation" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <x-label for="nombre_personnes" value="Nombre de convives (Max 20)" />
                        <x-input id="nombre_personnes" name="nombre_personnes" type="number" min="1" max="20" class="mt-1 block w-full" value="{{ old('nombre_personnes', 1) }}" required />
                        <x-input-error for="nombre_personnes" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Réserver ma table') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration de la date (Interdit aujourd'hui et le passé)
            flatpickr("#date_reservation", {
                locale: "fr",
                minDate: "tomorrow", 
                dateFormat: "Y-m-d",
            });

            // Configuration de l'heure (Créneaux de 30 min)
            flatpickr("#heure_reservation", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 30,
            });
        });
    </script>
</x-app-layout>