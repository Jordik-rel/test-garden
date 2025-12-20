@extends('particulier.particulier')

@section('title')
    <title>Dashboard - Gardena Connect</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('particulierContent')
    <div class="px-10 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-xl font-medium">Bonjour, {{ $user->prenom }}</h2>
                <h1 class="text-2xl font-semibold mt-2">
                    {{ (!$user->localisation->isEmpty() && !$user->payements->isEmpty() && $user->email_verified_at)
                        ? 'Il est tant de vous lancer'
                        : 'Dernières étapes avant de pouvoir embaucher'
                    }}
                </h1>
            </div> 
            <a href="{{ route('particulier.projet.title') }}" class="no-underline">       
                <button class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
                    <span class="text-lg">+</span>
                    Poster un emploi
                </button>
            </a>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="border rounded-xl p-6 bg-white">
                <div class="flex justify-between items-center">
                    <p class="text-xs font-semibold text-gray-500 mb-2">
                        Obligatoire pour publier un travail
                    </p>
                </div>
                @if (!$user->localisation->isEmpty())
                    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-800">
                        <span class="text-green-600 text-lg"><i class="fa-solid fa-circle-check"></i></span>
                        Localisation ajouté
                    </h3>

                    <div class="flex justify-end mt-10 text-green-700 text-xl">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                @else
                    <a href="{{ route('particulier.settings.localisation') }}" class="no-underline">
                        <p class="text-lg font-semibold no-underline text-gray-500 mb-3 hover:text-gray-700 cursor-pointer">
                            Vérifiez votre Localisation
                        </p>
                    </a>

                    <p class="text-sm text-gray-600">
                        Confirmez votre addresse, pour pouvoir publier votre premier job post.
                    </p>
                @endif

            </div>

            <!-- Card 2 -->
            <div class="border rounded-xl p-6 bg-white">
                <div class="flex justify-between items-center">
                    <p class="text-xs font-semibold text-gray-500 mb-2">
                        Obligatoire pour embaucher
                    </p>
                </div>

                @if (!$user->payements->isEmpty())
                    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-800">
                        <span class="text-green-600 text-lg"><i class="fa-solid fa-circle-check"></i></span>
                        Carte ajoutée
                    </h3>

                    <div class="flex justify-end mt-10 text-green-700 text-xl">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                @else
                    <a href="{{ route('particulier.settings.payement') }}" class="no-underline">
                        <h3 class="text-lg font-semibold mb-3 text-orange-600 cursor-pointer">
                            Ajouter une méthode de facturation
                        </h3>
                    </a>

                    <p class="text-sm text-gray-600">
                        Cela peut augmenter votre vitesse d’embauche jusqu’à 3 fois. 
                        Il n'y a aucun coût tant que vous n'avez pas embauché.
                    </p>
                @endif
            </div>

            <!-- Card 3 -->
            <div class="border rounded-xl p-6 bg-white space-y-2">
                <p class="text-xs font-semibold text-gray-500 mb-2">
                    Obligatoire pour embaucher
                </p>

                <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-800">
                    <span class="text-green-600 text-lg"><i class="fa-solid fa-circle-check"></i></span>
                    Adresse e-mail vérifiée
                </h3>

                <div class="flex justify-end mt-10 text-green-700 text-xl">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="min-h-screen bg-white p-8">
        <!-- Titre -->
        <h1 class="text-3xl font-semibold mb-8">Aperçu</h1>

        <!-- Container principal -->
        <div class="w-full border hover:border-green-700 hover:border-2 rounded-xl bg-white flex items-center justify-center py-20 px-4">
            @if($projets->isEmpty())
                <div class="text-center">
                    <!-- Icône / image -->
                    <div class="flex justify-center mb-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/591/591722.png" 
                            class="w-20 h-20 opacity-80" 
                            alt="briefcase"/>
                    </div>

                    <!-- Message -->
                    <p class="text-gray-600 text-lg mb-8">
                        Aucun poste ni contrat en cours pour le moment
                    </p>

                    <!-- Boutons -->
                    <div class="flex justify-center gap-4">
                        <button class="px-6 py-3 border border-green-600 text-green-700 rounded-lg hover:bg-green-50">
                            <i class="fa-solid fa-magnifying-glass"></i> Trouver un talent
                        </button>
                        <a href="{{ route('particulier.projet.title') }}" class="no-underline"> 
                            <button class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">
                                <span>＋</span> Publier une offre
                            </button>
                        </a>
                    </div>
                </div>
            @else
                <div class="w-full flex items-center space-x-4 overflow-x-auto py-2">

                    <!-- Left arrow -->
                    <button class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                        <span class="text-xl">←</span>
                    </button>
                    @foreach ($projets as $projet)
                        <!-- Card -->
                        <div class="w-80 h-[300px] flex flex-col justify-between border rounded-xl p-6 shadow-sm hover:shadow-md transition">                               
                            <!-- Header -->
                            <div class="flex relative justify-between items-start mb-4" x-data="{ open: false }">

                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600">
                                    <i class="fa-solid fa-list"></i>
                                </div>

                                <!-- Bouton ... -->
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-700 relative">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <!-- Dropdown -->
                                <div x-show="open"
                                    @click.outside="open = false"
                                    x-transition
                                    class="absolute right-0 mt-4 w-40 bg-white border rounded-lg shadow-lg z-50">

                                    <a href="{{ route('particulier.projet.edit', $projet) }}"
                                    class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fa-solid fa-pen"></i>
                                        Modifier
                                    </a>

                                    <form action="{{ route('particulier.projet.destroy', $projet) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center gap-2 w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">
                                            <i class="fa-solid fa-trash"></i>
                                            Supprimer
                                        </button>
                                    </form>

                                </div>
                            </div>
                            
                            <a href="{{ route('particulier.projet.show',$projet) }}" class="cursor-pointer no-underline text-black">
                                <!-- Title -->
                                <div class="flex-shrink-0">
                                    <p class="font-semibold">{{ $projet->titre }}</p>
                                    <span class="w-fit inline-block mt-2 bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm">
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
                                    </span>
                                </div>

                                <!-- Description -->
                                {{-- @if ($projet->is_Post === 0) 
                                <p class="mt-4 text-gray-700">Ajouter des détails à votre projet</p>
                                    
                                @endif --}}
                                
                                @if ((int)$projet->is_Post === 1)
                                    <a href="{{ route('particulier.projet.proposition',$projet) }}">
                                        <button class="w-full mt-6 border border-green-600 text-green-700 font-semibold py-2 rounded-lg hover:bg-green-50">
                                            Consulter les propositions
                                        </button>
                                    </a>
                                @else
                                    <form method="POST" action="{{ route('particulier.projet.submit',$projet) }}">
                                        @csrf
                                        @method('PUT')
                                        <button name="is_Post" value="1" type="submit"
                                            class="w-full mt-6 border border-green-600 bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700">
                                            Publier le projet
                                        </button>
                                    </form>  
                                @endif
                            </a>
                        </div>                    
                    @endforeach


                    <!-- Add new job card -->
                    <div class="w-80 h-[300px] flex-shrink-0 border-dashed border-2 rounded-xl p-6 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition">
                        <a href="{{ route('particulier.projet.title') }}">
                            <div class="text-green-700 text-3xl">+</div>
                            <p class="mt-2 text-green-700">Poster un job</p>
                        </a>
                    </div>

                    <!-- Right arrow -->
                    <button class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                        <span class="text-xl">→</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection