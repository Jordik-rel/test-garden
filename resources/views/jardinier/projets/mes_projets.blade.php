@extends('jardinier.profile.base')

@section('title')
    <title>Mes projets - Gardena Connect</title>
@endsection

@section('content')
    <div class="p-6 bg-white rounded-xl shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Récap de mes projets</h2>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-6 py-3">Particulier</th>
                        <th class="px-6 py-3">Nom du projet</th>
                        <th class="px-6 py-3">Date début</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Budget</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm">

                    @forelse ($missions as $misison)
                        <tr
                            onclick="window.location='{{ route('jardinier.projets.consulter', $misison) }}'"
                            class="cursor-pointer hover:bg-gray-50 transition"
                        >
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full" />
                                <div>
                                    <p class="font-semibold">{{ $misison->projet->user->nom }} {{ $misison->projet->user->prenom }}</p>
                                    <p class="text-gray-500 text-xs">Particulier</p>
                                </div>
                            </td>

                            <td class="px-6 py-4">{{ $misison->projet->titre }}</td>

                            <td class="px-6 py-4">
                                {{ $misison->date_debut }}
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        2 => 'text-green-600 bg-green-100',
                                        3 => 'text-red-600 bg-red-100',
                                        4 => 'text-blue-600 bg-blue-100',
                                        5 => 'text-yellow-600 bg-yellow-100',
                                        6 => 'text-purple-600 bg-purple-100',
                                    ];

                                    $classes = $statusClasses[$misison->projet->status] ?? 'text-gray-600 bg-gray-100';
                                @endphp
                                <span class=" {{ $classes}} px-3 py-1 rounded-full text-xs">
                                   @switch($misison->projet->status)
                                        @case(2) En cours @break
                                        @case(4) Attribué @break
                                        @case(5) Fini par le jardinier @break
                                        @case(6) En attente de validaion client @break
                                        @default Inconnu
                                    @endswitch                                 
                                </span>
                            </td>

                            <td class="px-6 py-4 font-medium">{{ $misison->montant }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500 text-lg">Aucune mission en cours</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $missions->links() }}
        </div>
    </div>
@endsection