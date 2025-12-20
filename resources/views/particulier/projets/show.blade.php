@extends('particulier.particulier')

@section('title')
    <title>Review - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Détails du poste</h1>

            <!-- <button type="submit"
                class="bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 transition">
                Postez ce travail
            </button> -->
        </div>
    
        {{-- CARD WRAPPER --}}
        <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
            {{-- TITRE DU PROJET --}}
            <div class="p-6 border-b flex justify-between">
                <h2 class="text-xl font-semibold mb-2">
                    {{ $projet->titre ?? 'Titre non défini' }}
                </h2>
            </div>

            {{--  DESCRIPTION --}}
            <div class="p-6 border-b flex flex-col justify-between">
                <h2 class="mb-1 font-bold">Description</h2>
                <p class="whitespace-pre-line text-gray-700">
                    {{ $projet->description ?? 'Aucune description fournie' }}
                </p>
            </div>

            {{-- COMPETENCES --}}
            <div class="p-6 border-b flex flex-col justify-between">
                <div>
                    <h3 class="font-semibold text-lg mb-1">Compétences</h3>
                    @forelse ($projet->competence as $competence)
                        <span class="inline-block bg-gray-200 px-2 py-1 rounded-lg mr-2 mb-2">
                            {{ $competence->nom }}
                        </span>
                    @empty
                        <p class="text-gray-700">Aucune compétence sélectionnée</p>
                    @endforelse
                </div>
            </div>

            {{-- SCOPE --}}
            <div class="p-6 border-b flex flex-col justify-between">
                <h3 class="font-semibold text-lg mb-1">Réalisation</h3>
                <ul class="text-gray-700 font-medium w-full">
                    <li class="flex justify-between items-center w-full space-y-3">
                        <h2 class="font-semibold text-lg">Taille du poste: </h2>
                        @switch($projet->taille_poste)
                            @case(1)
                                Petit
                                @break
                            @case(2)
                                Moyen 
                                @break
                            @case(3)
                                Grand
                                @break
                            @default
                                Non défini
                        @endswitch
                    </li>
                    <li class="flex justify-between items-center w-full space-y-3">
                        <h2 class="font-semibold text-lg">Durée:</h2>
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
                        @endswitch
                    </li>
                    <li class="flex justify-between items-center w-full space-y-3">
                        <h2 class="text-lg font-semibold">Niveau d'expérience : </h2>
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
                    </li>
                    <li class="flex justify-between items-center w-full space-y-3">
                        <h2 class="text-lg font-semibold">Type d'emploi</h2>
                        @switch($projet->type_emploi)
                            @case(0)
                                Projet ponctuel
                                @break
                            @case(1)
                                Projet long terme   
                                @break
                            @default
                                Non défini 
                        @endswitch
                    </li>
                </ul>
            </div>

            {{-- BUDGET --}}
            <div class="p-6 border-b flex justify-between">
                <div>
                    <h3 class="font-semibold text-lg mb-1">Budget</h3>

                    <p class="text-gray-700">
                        @if($projet->tarif_type == 0)
                            De {{ $projet->tarif_min }} Franc CFA/h à {{ $projet->tarif_max}} Franc CFA/h
                        @elseif($projet->tarif_type == 1)
                            {{ $projet->budget}} Franc CFA (prix fixe)
                        @else
                            Non défini
                        @endif
                    </p>
                </div>
            </div>
        </div>
    
        {{-- ACTION BUTTONS --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('particulier.dashboard') }}"
                class="border px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-green-800 transition ">
                Retour
            </a>
            @if ($projet->is_Post == 0)
                <form action="{{ route('particulier.projet.submit', $projet) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="is_Post" value="1"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700"
                    >
                        Postez ce travail
                    </button>
                </form>
            @else
                <a href="{{ route('particulier.projet.edit',$projet) }}"
                    class="border px-4 py-2 rounded-lg bg-orange-600 text-white hover:bg-orange-700 transition ">
                    Modifier
                </a>
            @endif
        </div>
    </div>
@endsection