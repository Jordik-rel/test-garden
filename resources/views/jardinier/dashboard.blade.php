@extends('jardinier.profile.base')

@section('title')
    <title>Dashboard - Gardena Connect</title>
@endsection

@section('content')
    <div class="max-w-5xl mx-auto">

        <!-- Search -->
        <div class="my-6">
            <input type="text" placeholder="Cherchez des jobs par mots-clés, compétences, etc."
                class="w-full p-3 rounded-lg border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <h1 class="text-lg font-semibold mb-2">Emplois susceptibles de vous intéresser</h1>

        <!-- Tabs -->
        <!-- <div class="flex gap-6 text-sm mb-4">
            <button class="border-b-2 border-green-600 font-semibold text-slate-900">Meilleurs offres</button>
            <button class="text-slate-500">Offres récentes</button>
            <button class="text-slate-500">Jobs enregistrés</button>
        </div> -->

        <p class="text-sm text-slate-500 mb-6">
            Parcourez les offres d'emploi qui correspondent à votre expérience et aux préférences de recrutement d'un client. Classées par ordre de pertinence.
        </p>

        <div class="space-y-6">
            @forelse ($projets as $projet)
                <a href="{{ route('jardinier.projet.show',$projet) }}">
                    <div class="bg-white p-6 mb-2 border border-slate-200 hover:border-green-600 rounded-md shadow-sm hover:shadow-md transition cursor-pointer">                   
                        <!-- Header -->
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-slate-500">Posté {{ $projet->relative_date  }}</p>
                                <h2 class="text-lg font-semibold mt-1">{{ $projet->titre }}</h2>
                                <p class="text-sm text-slate-600 mt-1">
                                    @switch($projet->tarif_type)
                                        @case(0)
                                            Prix horaire
                                            @break
                                        @case(1)
                                            Prix fixe
                                            @break
                                        @default
                                            Aucun tarif spécifié
                                    @endswitch
                                    ·  @switch($projet->niveau_experience)
                                            @case(1)
                                                Débutant
                                                @break
                                            @case(2)
                                                Intermédiaire
                                                @break
                                            @case(3)
                                                Expert  
                                                @break                              
                                            @default
                                                Non défini
                                        @endswitch 
                                    · 
                                    Durée: 
                                    @switch($projet->duree)
                                        @case(1)
                                            Moins 1 mois
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
                                            Non défini
                                    @endswitch, 
                                    Budget:
                                    @if ($projet->tarif_type == 0)
                                        +{{ $projet->tarif_min }} Franc CFA/heure
                                    @else
                                        {{ $projet->budget }} Franc CFA 
                                    @endif 
                                    
                                </p>
                            </div>

                            <!-- <div class="flex gap-2">
                                <button class="w-9 h-9 border rounded-lg grid place-items-center text-slate-500"><i class="fa-regular fa-heart text-pink-600"></i></button>
                            </div> -->
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-slate-700 mt-3">
                            {{ Str::limit($projet->description, 120, '...') }}
                            <a href="{{ route('jardinier.projet.show',$projet) }}" class="text-green-600 font-medium">Lire plus</a>
                        </p>

                        <!-- Footer -->
                        <div class="flex justify-between items-center mt-5 text-sm">
                            <div class="flex items-center gap-3 text-slate-600">
                                <span class="bg-blue-50 text-green-700 font-semibold px-3 py-1 rounded-full">
                                    @if ($projet->user->payements->isEmpty())
                                        <i class="fa-solid fa-triangle-exclamation text-yellow-600"></i> Payment unverified
                                    @else
                                        <i class="fa-solid fa-comments-dollar text-green-700"></i> Payment verified
                                    @endif
                                </span>
                                <span class="flex space-x-3 items-center"><i class="fa-solid fa-location-dot text-lg text-green-600"></i> {{ $projet->user->localisation()?->where('status',1)->first()->quartier }}, {{ $projet->user->localisation()?->where('status',1)->first()->ville }} </span> 
                            </div>

                            <a href="{{ route('jardinier.proposition.create',$projet) }}">
                                <button class="px-4 py-2 border rounded-lg hover:bg-green-100">Postuler</button>
                            </a>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-4 border-slate-200 hover:border-green-600 rounded-md ">Aucun projet disponible pour le moment</div>
            @endforelse
        </div>
    </div>
@endsection