@extends('particulier.particulier')

@section('title')
    <title>Review - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-7xl mx-auto py-10 px-6">
        <form action="{{ route('particulier.projet.store') }}" method="post">
            @csrf
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
                        {{ session('projet.titre') ?? 'Titre non défini' }}
                    </h2>
                    <a href="{{ route('particulier.projet.title') }}"
                        class="w-8 h-8 flex items-center justify-center border rounded-full text-green-600 hover:bg-gray-100">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </div>

                {{--  DESCRIPTION --}}
                <div class="p-6 border-b flex justify-between">

                    <p class="whitespace-pre-line text-gray-700">
                        {{ session('projet.description') ?? 'Aucune description fournie' }}
                    </p>
    
                    <a href="{{ route('particulier.projet.description') }}"
                        class="w-8 h-8 flex items-center justify-center border rounded-full text-green-600 hover:bg-gray-100">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </div>
    
                {{-- COMPETENCES --}}
                <div class="p-6 border-b flex justify-between">
                    <div>
                        <h3 class="font-semibold text-lg mb-1">Compétences</h3>
    
                        @if(session('projet.competences'))
                            @foreach($competences as $comp)
                                <span class="inline-block bg-gray-200 px-2 py-1 rounded-lg mr-2 mb-2">
                                    {{ $comp->nom }}
                                </span>
                            @endforeach
                        @else
                            <p class="text-gray-700">Aucune compétence sélectionnée</p>
                        @endif
                    </div>
    
                    <a href="{{ route('particulier.projet.skills') }}"
                        class="w-8 h-8 flex items-center justify-center border rounded-full text-green-600 hover:bg-gray-100">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </div>
    
                {{-- SCOPE --}}
                <div class="p-6 border-b flex justify-between">
                    <div>
                        <h3 class="font-semibold text-lg mb-1">Réalisation</h3>
                        <ul class="text-gray-700 font-medium list-disc list-outside ml-5">
                            <li>
                                @switch(session('projet.taille_poste'))
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
                            <li>
                                @switch(session('projet.duree'))
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
                            <li>
                                @switch(session('projet.niveau_experience'))
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
                            <li>
                                @switch(session('projet.type_emploi'))
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
    
                    <a href="{{ route('particulier.projet.duration') }}"
                    class="w-8 h-8 flex items-center justify-center border rounded-full text-green-600 hover:bg-gray-100">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </div>
    
                {{-- BUDGET --}}
                <div class="p-6 border-b flex justify-between">
                    <div>
                        <h3 class="font-semibold text-lg mb-1">Budget</h3>
    
                        <p class="text-gray-700">
                            @if(session('projet.tarif_type') == 0)
                               De {{ session('projet.tarif_min') }} Franc CFA/h à {{ session('projet.tarif_max') }} Franc CFA/h
                            @elseif(session('projet.tarif_type') == 1)
                                {{ session('projet.budget') }} Franc CFA (prix fixe)
                            @else
                                Non défini
                            @endif
                        </p>
                    </div>
    
                    <a href="{{ route('particulier.projet.budget') }}"
                        class="w-8 h-8 flex items-center justify-center border rounded-full text-green-600 hover:bg-gray-100">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </div>
            </div>
    
            {{-- ACTION BUTTONS --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('particulier.projet.description') }}"
                    class="border px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-green-800 transition ">
                    Retour
                </a>
                <div class="flex gap-4">
                    <button type="submit" name="is_Post" value="0"
                        class="text-green-700 bg-slate-100 px-5 py-2 rounded-lg hover:bg-slate-200">
                        Enregistrer comme brouillon
                    </button>

                    <button type="submit" name="is_Post" value="1"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700"
                    >
                        Postez ce travail
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection