@extends('admin.admin')
@section('title')
    <title>Nouvel Plante - Bibliothèque</title>
@endsection

@section('adminContent')
    <div class=" mx-auto p-8 mb-4">
        <form action="{{ route($plant->exists? 'admin.plant.update' :'admin.plant.store',$plant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($plant->exists? 'PUT' : 'POST')
            <!-- SECTION 1 -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">1</div>
                <h2 class="text-xl font-semibold"> Information Botanique</h2>
            </div>
            <!-- Nom commun & Nom scientifique -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Nom commun <span class="text-red-700 font-medium">*</span></label>
                    <input type="text" placeholder="Moringa" name="nom" value="{{old('nom',$plant->nom) }}"
                        class="w-full form-control @error('nom') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                    >
                    @error('nom')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                <div>
                    <label class="block font-medium mb-1">Nom scientifique <span class="text-red-700 font-medium">*</span></label>
                    <input type="text" placeholder="Moringa oleifera" name="nom_scientifique" value="{{old('nom_scientifique',$plant->nom_scientifique) }}"
                        class="w-full form-control @error('nom_scientifique') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                    >
                    @error('nom_scientifique')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
    
            <!-- Nom local -->
            <div class="mt-6">
                <label class="block font-medium mb-1">Nom local <span class="text-red-700 font-medium">*</span></label>
                <input type="text" placeholder="Yovokpatin(fon)" name="nom_local" value="{{old('nom_local',$plant->nom_local) }}"
                    class="w-full form-control @error('nom_local') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                @error('nom_local')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <!-- Photo -->
            <div class="mt-6">
                <label class="block font-medium mb-1">Photo <span class="text-red-700 font-medium">*</span></label>
                <input type="file" name="image[]" multiple
                    class="w-full form-control @error('image') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('image.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label class="block font-medium mb-1">Description <span class="text-red-700 font-medium">*</span></label>
                <textarea placeholder="Arbre aux multiple vertus,...." name="description"
                    class="w-full form-control @error('description') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                {{ old('description',$plant->description) }}
                </textarea>
                @error('description')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <!-- Divider -->
            <hr class="my-5">
    
            <!-- SECTION 2 -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">2</div>
                <h2 class="text-xl font-semibold">Informations techniques</h2>
            </div>
    
            <div class="mt-6">
                <label for="categories" class="text-black font-semibold px-1 mb-1">Catégories <span class="text-red-700 font-medium">*</span></label>
                <select name="categories[]" id="categories" multiple class="form-select w-full form-control @error('categories') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                    <!-- <option value="Mon choix1">Mon choix2</option>
                    <option value="Mon choix2">Mon choix 3</option> -->
                </select>
            </div>
    
            <div class="mt-6">
                <label for="vertu" class="text-black font-semibold px-1 mb-1">Vertus médicinales <span class="text-red-700 font-medium">*</span></label>
                <select name="vertus[]" id="vertu" multiple class="form-select form-control @error('vertus') is-invalid @enderror w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                    @foreach ($vertus as $vertu)
                        <option value="{{ $vertu->id }}">{{ $vertu->nom }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="mt-6">
                <label for="valeur" class="text-black font-semibold px-1 mb-1">Valeurs nutritionnelles <span class="text-red-700 font-medium">*</span></label>
                <select name="valeur_nutritionnelles[]" id="valeur" multiple class="form-select form-control @error('valeur_nutritionnelles') is-invalid @enderror w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                    @foreach ($valeurs as $valeur)
                        <option value="{{ $valeur->id }}">{{ $valeur->nom }}</option> 
                    @endforeach
                </select>
            </div>
            <!-- Divider -->
            <hr class="my-5">
    
            <div class="flex items-center gap-4 mb-6">
                <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">3</div>
                <h2 class="text-xl font-semibold">Conseils</h2>
            </div>
    
            <!-- Conseils de culture -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Conseils de culture <span class="text-red-700 font-medium">*</span></label>
                <textarea placeholder="Cette plante est adaptée au climat béninois..." name="conseil_culture"
                    class="w-full form-control @error('conseil_culture') is-invalid @enderror border rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                {{ old('conseil_culture',$plant->conseil_culture) }}
                </textarea>
                @error('conseil_culture')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
    
            <!-- Précautions -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Précautions <span class="text-red-700 font-medium">*</span></label>
                <textarea placeholder="Consultez toujours un professionnel de santé..." name="precautions"
                    class="w-full form-control @error('precautions') is-invalid @enderror border rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                    {{ old('precautions',$plant->precautions) }}
                </textarea>
                @error('precautions')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                Sauvegarder
            </button>
        </form>



       
    </div>

@endsection