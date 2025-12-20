@extends('particulier.particulier')

@section('title')
    <title>Competence - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-6xl mx-auto py-12 px-6">
        <form action="{{ route('particulier.projet.setp3') }}" method="post">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- LEFT SECTION -->
                <div>
                    <p class="text-sm text-gray-500 mb-4">3/5 &nbsp;&nbsp; Publication d'un emploi</p>

                    <h1 class="text-4xl font-semibold leading-tight mb-6 w-[80%]">
                        Ensuite, estimez la portée de votre travail.
                    </h1>
                    <p class="text-sm text-gray-500 mb-4">Tenez compte de la taille de votre projet et du temps que cela prendra.</p>
                </div>

                <div>
                    <div class="mb-4">
                        <label for="taille" class="form-label block font-light text-gray-700 mb-2">
                            Quelle est la taille de votre projet?
                        </label>
                        <select 
                            name="taille_poste" id="taille" 
                            class="form-control @error('taille_poste') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                <option value="1">Petit</option>
                                <option value="2">Moyen</option>
                                <option value="3">Grand</option>
                        </select>
                        @error('taille_poste')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="duree" class="form-label block font-light text-gray-700 mb-2">
                            Combien de temps cela prendrait?
                        </label>
                        <select 
                            name="duree" id="duree"  
                            class="form-select form-control @error('duree') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                <option value="1">Moins 1 mois</option>
                                <option value="2">1 à 3 mois</option>
                                <option value="3">3 à 6 mois</option> 
                                <option value="4">Plus de 6 mois</option>
                        </select>
                        @error('duree')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="niveau" class="form-label block font-light text-gray-700 mb-2">
                            De quel niveau d’expérience aura-t-il besoin?
                        </label>
                        <select 
                            name="niveau_experience" id="niveau"  
                            class="form-select form-control @error('niveau_experience') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                <option value="1">Debutant</option>
                                <option value="2">Intermédiaire</option>
                                <option value="3">Expert</option> 
                        </select>
                        @error('niveau_experience')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="emploi" class="form-label block font-light text-gray-700 mb-2">
                            Cet emploi est-il une opportunité de sous-traitance?
                        </label>
                        <select 
                            name="type_emploi" id="emploi"  
                            class="form-select form-control @error('type_emploi') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                <option value="0">Projet ponctuel</option>
                                <option value="1">Projet long terme </option>
                        </select>
                        @error('type_emploi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-16 border-t pt-6">

                <a href="{{ route('particulier.projet.skills') }}"
                    class="text-gray-600 hover:text-gray-700 border border-gray-300 px-3 py-1 rounded-lg hover:bg-gray-100 transition no-underline">
                        Retour
                </a>

                <button type="submit"
                    class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition no-underline">
                        Suivant
                </button>

            </div>
        </form>
    </div>
@endsection