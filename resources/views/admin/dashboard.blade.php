<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex">
        
        <aside class="w-64 bg-indigo-900 text-white hidden md:block">
            <div class="p-6 text-2xl font-bold border-b border-indigo-800">
                Youco'Done <span class="text-indigo-400">Admin</span>
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center py-3 px-6 bg-indigo-800 text-white border-l-4 border-white">
                    <i class="fas fa-chart-line mr-3"></i> Dashboard
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-indigo-200 hover:bg-indigo-800 hover:text-white transition">
                    <i class="fas fa-utensils mr-3"></i> Restaurants
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-indigo-200 hover:bg-indigo-800 hover:text-white transition">
                    <i class="fas fa-calendar-check mr-3"></i> Réservations
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-indigo-200 hover:bg-indigo-800 hover:text-white transition">
                    <i class="fas fa-credit-card mr-3"></i> Paiements
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-semibold text-gray-800">Vue d'ensemble</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ now()->format('d F Y') }}</span>
                    <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-600">
                    <p class="text-sm text-gray-500 uppercase font-bold">Restaurants Actifs</p>
                    <p class="text-2xl font-black text-gray-900"></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Réservations Confirmées</p>
                    <p class="text-2xl font-black text-gray-900">A</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Chiffre d'Affaires</p>
                    <p class="text-2xl font-black text-gray-900">A€</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-pink-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Nouveaux Clients</p>
                    <p class="text-2xl font-black text-gray-900">A</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Répartition par Ville</h3>
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-indigo-600 border-b">
                                <th class="pb-3 font-semibold">Ville</th>
                                <th class="pb-3 text-right font-semibold">Nombre de Restaurants</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($restaurantsByCity as $city)
                            <tr>
                                <td class="py-3 text-gray-700">{{ $city->ville }}</td>
                                <td class="py-3 text-right font-medium">{{ $city->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Top Restaurants (Réservations)</h3>
                    <div class="space-y-4">
                        @foreach($Restaurants as $restaurant)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-2 h-2 rounded-full bg-indigo-400 mr-3"></div>
                                <span class="text-gray-700">{{ $restaurant->nom }}</span>
                            </div>
                            <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">
                                $ réservations
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>