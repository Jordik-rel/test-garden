@extends('jardinier.profile.base')

@section('title')
    <title>Mes soumissions - Gardena Connect</title>
@endsection

@section('content')
    <div class="p-6 bg-white rounded-xl shadow-sm min-[90vh] maxh-fit">
        <h2 class="text-lg font-semibold mb-4">Récap de mes soumissions</h2>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-6 py-3">Particulier</th>
                        <th class="px-6 py-3">Nom du projet</th>
                        <th class="px-6 py-3">Nombre de soumission</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Budget</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm">

                    @forelse ($propositions as $proposition)
                        <tr
                            onclick="window.location='{{ route('jardinier.soumissions.consulter', $proposition) }}'"
                            class="cursor-pointer hover:bg-gray-50 transition"
                        >
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full" />
                                <div>
                                    <p class="font-semibold">{{ $proposition->projet->user->nom }} {{ $proposition->projet->user->prenom }}</p>
                                    <p class="text-gray-500 text-xs">Particulier</p>
                                </div>
                            </td>

                            <td class="px-6 py-4">{{ $proposition->projet->titre }}</td>

                            <td class="px-6 py-4">
                                {{ $proposition->projet->propositions->count() }}
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        1 => 'case1',
                                        2 => 'text-green-600 bg-green-100',
                                        3 => 'text-red-600 bg-red-100',
                                    ];

                                    $classes = $statusClasses[$proposition->status] ?? 'text-gray-600 bg-gray-100';
                                @endphp
                                <span class=" {{ $classes}} px-3 py-1 rounded-full text-xs">
                                   @switch($proposition->status)
                                       @case(1)
                                           En attente
                                           @break
                                        @case(2)
                                            Accepté
                                            @break
                                        @case(3)
                                            Refusé
                                            @break
                                       @default
                                           
                                   @endswitch
                                    
                                </span>
                            </td>

                            <td class="px-6 py-4 font-medium">{{ $proposition->tarif_propose }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 text-xl">Aucune soumission faite</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection