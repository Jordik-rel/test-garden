@extends('admin.admin')

@section('title')
    <title>Jardinier - Green Connect</title>
@endsection

@section('adminContent')
    <form action="{{ route($jardinier->exists? 'admin.jardinier.update' :'admin.jardinier.store',$jardinier) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($jardinier->exists? 'PUT' : 'POST')
            <!-- SECTION 1 -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">1</div>
                <h2 class="text-xl font-semibold"> Information Jardinier</h2>
            </div>

            <!-- Utilisateur -->
            <div class="w-full flex flex-col mb-3">
                <label for="user" class="form-label">Nom & Prénoms</label>
                <select name="user_id" id="user" class="form-control @error('user_id') is-invalid @enderror">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"> {{ $user->nom }} {{ $user->prenom }}</option>
                    @endforeach
                </select>
                @error("user_id")
                    <div class="invalid-feedback">
                            {{ $message }}
                    </div>
                @enderror
            </div>
    
            <!-- Profession -->
            <div class="w-full flex flex-col mb-3">
                <label for="profession" class="form-label">Profession</label>
                <select name="profession" id="profession" class="form-control @error('profession') is-invalid @enderror">
                    <option value="jardinier"> Jardinier</option>
                    <option value="ovirus"> Ovirus</option>
                </select>
                @error("profession")
                    <div class="invalid-feedback">
                            {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Description -->
            <div class="w-full flex flex-col mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $jardinier->description }}</textarea>
                @error("description")
                    <div class="invalid-feedback">
                            {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex justify-between items-center mb-2">
                <div class="w-[50%] mr-2">
                    <label for="tarif_horaire" class="form-label">Tarif Horaire</label>
                    <input type="text" name="tarif_horaire" class="form-control @error('tarif_horaire') is-invalid @enderror" placeholder="{{old('tarif_horaire',$jardinier->tarif_horaire)}}" id="tarif_horaire" value="{{old('tarif_horaire',$jardinier->tarif_horaire)}}">
                    @error("tarif_horaire")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-[50%] mr-2">
                    <label for="tarif_journalier" class="form-label">Tarif Journalière</label>
                    <input type="text" name="tarif_journalier" class="form-control @error('tarif_journalier') is-invalid @enderror" placeholder="{{old('tarif_journalier',$jardinier->tarif_journalier)}}" id="tarif_journalier" value="{{old('tarif_journalier',$jardinier->tarif_journalier)}}">
                    @error("tarif_journalier")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="w-full flex flex-col mb-1">
                <label for="site_web" class="text-black font-semibold px-1 mb-1">Site web</label>
                <input type="text" value="" name="site_web" placeholder="www.majardinierie.com" class="form-control w-full border-[1px] @error('site_web') is-invalid @enderror focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md" id="site_web" autocomplete="off">
                <x-input-error :messages="$errors->get('site_web')" class="mt-2" />
            </div>
            <div class="block mb-2">
                <label for="disponible" class="inline-flex items-center mb-1">
                    <input id="disponible" type="checkbox" value="1" {{ old('disponible', $jardinier->disponible ?? false) ? 'checked' : '' }} class="rounded dark:bg-gray-900 border-slate-500  @error('disponible') is-invalid @enderror dark:border-gray-700 text-green-600 shadow-sm focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-gray-800" name="disponible">
                    <span class="ms-2 text-md text-gray-600 dark:text-gray-400">{{ __('Disponible') }}</span>
                </label>
                @error("disponible")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-4 w-[80%] mx-auto">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                    Sauvegarder
                </button>
            </div>
    </form>
@endsection