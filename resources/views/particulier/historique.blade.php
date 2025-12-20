@extends('particulier.particulier')

@section('title')
    <title>Historiques projet - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="px-6 py-10 max-w-7xl mx-auto space-y-6">
         <h2 class="text-xl text-center font-semibold">Mon historique</h2>
        <div class="p-2 min-h-full">
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm">
                        <tr>
                            <th class="px-6 py-3">Nom Projet</th>
                            <th class="px-6 py-3">Durée</th>
                            <th class="px-6 py-3">Jardinier</th>
                            <th class="px-6 py-3">Tarif en FCFA</th>
                            <th class="px-6 py-3">Status projet</th>
                            <th class="px-6 py-3">Status payement</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse ($projets as $projet)
                                <tr 
                                    onclick="window.location='{{ route('particulier.projet.details',$projet) }}'"
                                    class="cursor-pointer hover:bg-gray-50 transition"
                                >
                                    <td class="px-6 py-4">
                                        {{ Str::limit($projet->titre,100) }}
                                    </td>
            
                                    <td class="px-6 py-4">
                                        @switch($projet->duree)
                                            @case(1)
                                                Moins d'un mois
                                                @break
                                            @case(2)
                                                1 à 3 mois
                                                @break
                                            @case(3)
                                                3 à 6 mois
                                                @break
                                            @case(4)
                                                Plus de 6 mois
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </td>
                                    
                                    <td class="px-6 py-4">{{ $projet->mission->jardinier->user->prenom }} {{ $projet->mission->jardinier->user->nom }}</td>
            
                                    <td class="px-6 py-4">
                                        <span class="{{ $projet->mission->jardinier==null ? ' text-orange-600 bg-orange-100 ' : 'text-green-600 bg-green-100 '  }}px-3 py-1 rounded-full text-xs">
                                            @if ($projet->mission->jardinier==null) 
                                            {{ $projet->montant}}
                                            @else
                                                {{ $projet->mission->montant }}
                                            @endif
                                        </span>
                                    </td>
                
                                    <td class="px-6 py-4 font-medium">
                                        @switch($projet->status)
                                            @case(1)
                                                En attente
                                                @break
                                            @case(2)
                                                En cours
                                                @break
                                            @case(3)
                                                Terminé
                                                @break
                                            @case(4)
                                                Attribué
                                                @break
                                            @case(5)
                                                Fini par jardinier
                                                @break
                                            @case(6)
                                                En attente de validation client
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        @php
                                            $statusClasses = [
                                                1 => 'text-orange-600 bg-orange-100',
                                                3 => 'text-green-600 bg-green-100',
                                                2 => 'text-red-600 bg-red-100',
                                            ];

                                            $classes = $statusClasses[$projet->mission->status] ?? 'text-gray-600 bg-gray-100';
                                        @endphp
                                        <span class=" {{ $classes}} px-3 py-1 rounded-full text-xs">
                                            @switch($projet->mission->status)
                                                @case(1)
                                                    En attente
                                                    @break
                                                @case(2)
                                                    Refusé
                                                    @break
                                                @case(3)
                                                    Validé
                                                    @break
                                                @default                                     
                                            @endswitch
                                        </span>
                                    </td>
                                </tr>                   
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500 text-xl">Aucun projet créer</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $projets->links() }}
            </div>
        </div>
            
    </div>
@endsection