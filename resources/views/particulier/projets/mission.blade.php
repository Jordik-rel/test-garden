@extends('particulier.particulier')

@section('title')
    <title>Ma mission - Gardena Connect</title>
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('particulierContent')
    <div class="p-6 bg-white rounded-xl shadow-sm min-h-full flex md:grid-cols-2 justify-between">
        <div class="w-full {{ $projet->status == 3 ? 'md:w-full' : 'md:w-[70%]' }}  mx-auto py-10 px-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold">Détails du poste</h1>
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
                <a href="{{ route('particulier.projet.index') }}"
                    class="border px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-green-800 transition ">
                    Retour
                </a>
            </div>
        </div>
        @if ($projet->status != 3)
            <div x-data="{ showForm: false , showMessage: false}" 
                class="w-full md:w-[25%] px-3 py-2 space-y-2 rounded-sm shadow-md bg-slate-100 h-fit md:mt-10">

                <button 
                    @click="showMessage = !showMessage"
                    class="w-full bg-slate-300 rounded-md py-2 text-slate-500 font-semibold"
                >
                    Envoyer un message
                </button>
                <div x-show="showMessage" x-transition>
                    <form action="">
                        @csrf
                        <div>
                            <label for="" class="text-slate-700 mb-1 px-1 font-medium">Envoyez un message <span class="text-red-600">*</span></label>
                            <textarea name="message" id="" class="w-full mb-2 focus:outline-none focus:border-green-700 focus:ring-0 border-1 border-green-600 rounded-md" placeholder="Merci de bien vouloir me confirmer la date de début des travaux"></textarea>
                        </div>
                        <button class="w-full bg-green-600 rounded-md py-2 text-slate-100 font-semibold">Envoyer</button>
                    </form>
                </div>

                <!-- BOUTON TOGGLE -->
                <div x-data="{ showModal: false }">

                    <!-- Bouton -->
                    <button 
                        @click="showModal = true"
                        class="w-full bg-green-600 rounded-md py-2 text-white font-medium"
                    >
                        Approuver la fin de la mission
                    </button>

                    <!-- MODAL -->
                    <div 
                        x-show="showModal"
                        x-transition.opacity
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                    >
                        <div 
                            x-show="showModal"
                            x-transition.scale
                            class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 text-center"
                        >

                            <!-- ICON -->
                            <div class="flex justify-center">
                                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                                    <span class="text-green-600 text-3xl">✓</span>
                                </div>
                            </div>

                            <!-- TITLE -->
                            <h2 class="mt-4 text-xl font-semibold text-gray-800">
                                Approbation de fin de mission
                            </h2>

                            <!-- TEXT -->
                            <p class="text-gray-600 mt-2 text-sm leading-relaxed">
                            Etes vous sur d'approuver la fin de la mission? 
                            </p>

                            <p class="text-red-600 mt-1 text-sm leading-relaxed">En cas d'approbation aucun retour en arrière n'est possible.</p>

                            <!-- BUTTONS -->
                            <div class="flex justify-between mt-6 gap-4">
                                <button 
                                    @click="showModal = false"
                                    class="w-1/2 border border-gray-300 py-2 rounded-lg font-medium text-gray-700 hover:bg-gray-100"
                                >
                                    Non
                                </button>

                                <form action="{{ route('particulier.projet.validation',$projet) }}" method="POST" class="w-1/2">
                                    @csrf
                                    <button name="status" value="3"
                                        type="submit"
                                        class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700"
                                    >
                                        OUI
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>            
        @endif
    </div>    
@endsection