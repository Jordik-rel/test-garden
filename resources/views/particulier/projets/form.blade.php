@extends('particulier.particulier')

@section('title')
    <title>Projet - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-6xl mx-auto py-12 px-6">
        <form action="{{ route('particulier.projet.update', $projet) }}" method="post" class="mb-16">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- LEFT SECTION -->
                <div>
                    <p class="text-sm text-gray-500 mb-4">Publication d'un emploi</p>
    
                    <h1 class="text-4xl font-semibold leading-tight mb-6">
                        Vous ne trouver pas de spécialiste?
                    </h1>
    
                    <p class="text-gray-600 leading-relaxed w-4/5">
                        Modifier les informations de votre projet en le rendant le plus explicite et spécial vous permet d'attirer les meilleurs candidats. 
                        Augmenter vos prix ou booster votre projet pour une meilleure visibilité.
                    </p>
                </div>
    
                <div>
                     <div>
                        <div>
                            <label class="block font-light text-gray-700 mb-2">
                                Donnez un titre à votre offre d'emploi <span class="text-red-600">*</span>
                            </label>
            
                            <input 
                                type="text" 
                                placeholder="Aménagement de jardin"
                                name="titre"
                                value="{{ old('titre',$projet->titre) }}"
                                class="w-full border @error('titre) is-invalid mb-1 @enderror border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-700 focus:outline-none"
                            />
                            @error('titre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label class="block font-light text-gray-700 mb-2">
                                Recherchez des compétences <span class="text-red-600">*</span>
                            </label>
                            <select 
                                name="competences[]" id="valeur" multiple 
                                class="form-select form-control @error('competences') is-invalid @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                @forelse ($competences as $competence)
                                    <option value="{{ $competence->id }}" >{{ $competence->nom }}</option> 
                                @empty
                                    <option value="">Aucune compétence - Contactez le service</option> 
                                @endforelse
                            </select>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-1 mt-3">
                            <div>
                                <label for="taille" class="form-label block font-light text-gray-700 mb-2">
                                    Quelle est la taille de votre projet? <span class="text-red-600">*</span>
                                </label>
                                <select 
                                    name="taille_poste" id="taille" 
                                    class="form-control @error('taille_poste') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                        <option value="1" {{ old('taille_poste' , $projet->taille_poste) == 1 ? 'selected' : '' }} >Petit</option>
                                        <option value="2" {{ old('taille_poste' , $projet->taille_poste) == 2 ? 'selected' : '' }} >Moyen</option>
                                        <option value="3" {{ old('taille_poste' , $projet->taille_poste) == 3 ? 'selected' : '' }} >Grand</option>
                                </select>
                                @error('taille_poste')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="duree" class="form-label block font-light text-gray-700 mb-2">
                                    Combien de temps cela prendrait? <span class="text-red-600">*</span>
                                </label>
                                <select 
                                    name="duree" id="duree"  
                                    class="form-select form-control @error('duree') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                        <option value="1" {{ old('duree' , $projet->duree) == 1 ? 'selected' : '' }} >Moins 1 mois</option>
                                        <option value="2" {{ old('duree' , $projet->duree) == 2 ? 'selected' : '' }} >1 à 3 mois</option>
                                        <option value="3" {{ old('duree' , $projet->duree) == 3 ? 'selected' : '' }} >3 à 6 mois</option> 
                                        <option value="4" {{ old('duree' , $projet->duree) == 4 ? 'selected' : '' }} >Plus de 6 mois</option>
                                </select>
                                @error('duree')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-1 mt-3">
                            <div>
                                <label for="niveau" class="form-label block font-light text-gray-700 mb-2">
                                    Niveau d’expérience <span class="text-red-600">*</span>
                                </label>
                                <select 
                                    name="niveau_experience" id="niveau"  
                                    class="form-select form-control @error('niveau_experience') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                        <option value="1" {{ old('niveau_experience', $projet->niveau_experience) == 1 ? 'selected' : '' }} >Debutant</option>
                                        <option value="2" {{ old('niveau_experience', $projet->niveau_experience) == 2 ? 'selected' : '' }} >Intermédiaire</option>
                                        <option value="3" {{ old('niveau_experience', $projet->niveau_experience) == 3 ? 'selected' : '' }} >Expert</option> 
                                </select>
                                @error('niveau_experience')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="emploi" class="form-label block font-light text-gray-700 mb-2">
                                    Type d'emploi <span class="text-red-600">*</span>
                                </label>
                                <select 
                                    name="type_emploi" id="emploi"  
                                    class="form-select form-control @error('type_emploi') is-invalid 'mb-1' @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                        <option value="0" {{ old('type_emploi' , $projet->type_emploi ) == 0 ? 'selected' : ''}} >Projet ponctuel</option>
                                        <option value="1" {{ old('type_emploi' , $projet->type_emploi ) == 1 ? 'selected' : ''}} >Projet long terme </option>
                                </select>
                                @error('type_emploi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="tarif" class="form-label block font-light text-gray-700 mb-2">
                                Type de tarification <span class="text-red-600">*</span>
                            </label>

                            <select 
                                name="tarif_type" id="tarif" 
                                class="form-control w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                                <option value="0" {{ old('tarif_type',$projet->tarif_type) == 0 ? 'selected' : '' }}>Paiement à l'heure</option>
                                <option value="1" {{ old('tarif_type',$projet->tarif_type) == 1 ? 'selected' : '' }}>Paiement fixe</option>
                            </select>
                            @error('tarif_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Paiement à l’heure --}}
                        <div id="hourlyFields" class="{{ old('tarif_type') == 0 ? '' : 'hidden' }}">
                            <div class="flex items-center gap-20 mt-3">

                                <div>
                                    <label class="text-gray-700 font-medium">De <span class="text-red-600">*</span></label>
                                    <div class="flex items-center mt-2">
                                        <input 
                                            type="number"
                                            name="tarif_min"
                                            placeholder="1000"
                                            value="{{ old('tarif_min',$projet->tarif_min) }}"
                                            class="border rounded-lg px-4 py-2 w-32"
                                        >
                                        <span class="ml-2 text-gray-600">/hr</span>
                                    </div>
                                    @error('tarif_min')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-gray-700 font-medium">À <span class="text-red-600">*</span></label>
                                    <div class="flex items-center mt-2">
                                        <input 
                                            type="number"
                                            name="tarif_max"
                                            placeholder="5000"
                                            value="{{ old('tarif_max',$projet->tarif_max) }}"
                                            class="border rounded-lg px-4 py-2 w-32"
                                        >
                                        <span class="ml-2 text-gray-600">/hr</span>
                                    </div>
                                    @error('tarif_max')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Paiement fixe --}}
                        <div id="fixedFields" class="{{ old('tarif_type') == 1 ? '' : 'hidden' }}">
                            <div class="mt-3">
                                <label class="text-gray-700 font-medium">Montant fixe <span class="text-red-600">*</span></label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="number"
                                        name="budget"
                                        placeholder="10000"
                                        value="{{ old('budget',$projet->budget) }}"
                                        class="border rounded-lg px-4 py-2 w-full"
                                    >
                                    <span class="ml-2 text-gray-600">Franc CFA</span>
                                </div>
                                @error('budget')
                                    <div class="alert alert-danger">{{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="block font-medium mb-2">Décrivez ce dont vous avez besoin <span class="text-red-700 font-medium">*</span></label>
                            <textarea 
                                placeholder="Vous avez déja une description? Collez-le ici!" name="description"
                                class="w-full h-40 form-control @error('description') is-invalid 'mb-1' @enderror border border-gray-300 rounded-lg mb-1 py-2 focus:ring-2 focus:ring-green-700 focus:outline-none"
                            >
                            {{ old('description',$projet->description) }}
                            </textarea>
                            @error('description')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label class="block font-medium mb-1">Joindre un fichier</label>
                            <input type="file" name="support"
                                class="w-full form-control @error('support') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                            @error('support')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>   
                </div>
            </div>
            <div class="flex justify-between items-center mt-16 border-t pt-6">
    
                <a href="{{ route('particulier.dashboard') }}"
                    class="text-gray-600 hover:text-gray-700 border border-gray-300 px-3 py-1 rounded-lg hover:bg-gray-100 transition no-underline">
                        Retour
                </a>
    
                <button type="submit"
                    class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition no-underline">
                        Poster
                </a>
    
            </div>
        </form>
    </div>

    <script>
        const selectTarif = document.getElementById('tarif');
        const hourlyFields = document.getElementById('hourlyFields');
        const fixedFields = document.getElementById('fixedFields');

        function updateFields() {
            if (selectTarif.value === "0") {
                hourlyFields.classList.remove("hidden");
                fixedFields.classList.add("hidden");
            } else {
                hourlyFields.classList.add("hidden");
                fixedFields.classList.remove("hidden");
            }
        }

        // Lors du chargement (utile après validation)
        updateFields();

        // Lors du changement
        selectTarif.addEventListener('change', updateFields);
    </script>

@endsection