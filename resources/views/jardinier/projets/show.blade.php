@extends('jardinier.profile.base')

@section('title')
    <title>Consulter Projet - Gardena Connect</title>
@endsection

@section('content')
    <div class="w-full my-6 max-w-5xl mx-auto bg-white border rounded-lg shadow-sm p-6">
    
        <!-- Header -->
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 mr-2">
                    {{ $projet->titre }}
                </h1>

                <div class="text-sm text-gray-500 mt-1">
                    Posté {{ $projet->relative_date }} · Bénin
                </div>
            </div>
            <a href="{{ route('jardinier.proposition.create',$projet) }}">
                <button class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium">
                    Postuler
                </button>
            </a>
        </div>

        <!-- Summary -->
        <div class="mt-6 border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Résumé</h2>

            <p class="text-gray-700 leading-relaxed">
                {{$projet->description}}
            </p>
        </div>

        <!-- Infos: Price + Level -->
        <div class="mt-6 flex items-center gap-10">
            <div>
                <div class="text-gray-900 text-lg font-semibold">
                    @if ($projet->tarif_type == 0)
                        {{ $projet->tarif_min }} - {{ $projet->tarif_max }} Franc CFA/heure
                    @else
                        {{ $projet->budget }} Franc CFA 
                    @endif 
                </div>
                <div class="text-gray-500 text-sm">
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
                </div>
            </div>

            <div>
                <div class="text-gray-900 text-lg font-semibold">Niveau d'entré</div>
                <div class="text-gray-500 text-sm">
                    @switch($projet->niveau_experience)
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
                </div>
            </div>
        </div>

        <!-- Skills -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-3">Compétence et expertise</h2>

            <div class="flex flex-wrap gap-2">
                @forelse ($projet->competence as $competence)
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">{{ $competence->nom }}</span>
                @empty
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">Aucune compétence ajouté</span>
                @endforelse
            </div>
        </div>

        <!-- Client Info -->
        <div class="mt-10 border-t pt-6 flex justify-between items-start">
            
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-1 space-y-3">A propos des projets antérieurs</h3>

                <div class="text-sm text-gray-600 flex items-center gap-2 space-x-2">
                    
                    @if ($projet->user->payements->isEmpty())
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span> Payement non vérifié
                    @else
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Payement verifié
                    @endif
                </div>
                <div class="text-sm text-gray-600 mt-1">{{ $projet->user->localisation()->where('status',1)->first()->quartier }}, {{ $projet->user->localisation()->where('status',1)->first()->ville }} — Benin</div>
                <div class="text-sm text-gray-600 mt-1">{{ $projet->user->projets->count() }} jobs postés</div>
            </div>
        </div>

        <!-- Client History -->
        <div class="mt-10 border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Historique des projets réalisés ({{ $projet->user->projets->where('status','3')->count() }})</h2>

            <div class="space-y-6 mb-4">
                @forelse ($projet->user->projets->where('status','3') as $end)
                    <div>
                        <a class="text-green-600 font-medium hover:underline cursor-pointer">
                           {{$end->titre}}
                        </a>

                        <div class="flex space-x-1 my-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star 
                                    text-xl 
                                    {{ $i <= $end->avis_particulier->note ? 'text-yellow-400' : 'text-gray-300' }}">
                                </i>
                            @endfor
                        </div>

                        <div class="text-sm text-gray-600 mt-1">
                            {{ $end->created_at }} • 
                            @switch($end->tarif_type)
                                @case(0)
                                    Prix horaire
                                    @break
                                @case(1)
                                    Prix fixe
                                    @break
                                @default
                                    Aucun tarif spécifié
                            @endswitch
                            @if ($end->tarif_type == 0)
                                {{ $end->tarif_min }} - {{ $end->tarif_max }} Franc CFA/heure
                            @else
                                {{ $end->budget }} Franc CFA 
                            @endif 
                        </div>
                    </div>
                @empty
                    <div class="text-center border-1 border-slate-300 hover:border-green-600 hover:border-1 rounded-md w-full py-6 px-4">
                        Aucun historique 
                    </div>
                @endforelse
                <!-- One History Item -->
                <!-- <div>
                    <a class="text-green-600 font-medium hover:underline cursor-pointer">
                        Odoo Developer Needed for Cloud System Development
                    </a>

                    <div class="mt-1 text-yellow-500">★★★★☆ 4.0</div>

                    <div class="text-sm text-gray-600 mt-1">
                        Jul 2025 – Oct 2025 • Fixed-price
                    </div>
                </div> -->

            </div>
        </div>

    </div>

@endsection