@extends('layouts.admin') 

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-900">Gestion des Réservations</h1>
            <div class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow-md">
                Total : {{ $reservations->count() }}
            </div>
        </div>

        {{-- Tableau --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-purple-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-purple-50">
                        <th class="px-6 py-4 text-purple-700 font-semibold uppercase text-sm">Client</th>
                        <th class="px-6 py-4 text-purple-700 font-semibold uppercase text-sm">Restaurant</th>
                        <th class="px-6 py-4 text-purple-700 font-semibold uppercase text-sm">Date & Heure</th>
                        <th class="px-6 py-4 text-purple-700 font-semibold uppercase text-sm">Convives</th>
                        <th class="px-6 py-4 text-purple-700 font-semibold uppercase text-sm">Statut</th>
                        <th class="px-6 py-4 text-purple-700 font-semibold uppercase text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-purple-50">
                    @foreach($reservations as $res)
                    <tr class="hover:bg-purple-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $res->user->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $res->restaurant->name }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            <span class="block">{{ $res->res_date }}</span>
                            <span class="text-xs text-purple-400">{{ $res->res_time }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">
                                👥 {{ $res->guests_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($res->status == 'confirmed')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Confirmé</span>
                            @elseif($res->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">En attente</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Annulé</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-purple-600 hover:text-purple-900 font-semibold transition">Détails</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination (si nécessaire) --}}
        <div class="mt-6">
            {{-- $reservations->links() --}}
        </div>
    </div>
</div>
@endsection