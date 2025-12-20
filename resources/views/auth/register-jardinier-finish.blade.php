@extends('base')
@section('title')
    <title>Green Connect - Inscription</title>
    @vite('resources/css/app.css')
@endsection
@section('content')
    <!-- <div class="p-4 bg-slate-100">
        <h1 class="text-center font-extralight text-4xl text-green-800">AGANMA</h1>
    </div> -->
    <div class="flex justify-center items-start w-full p-10">
        <div class="flex flex-col w-[50%] mr-10">
            <h2 class="text-3xl text-green-800 font-semibold text-center w-[70%]">Créer un compte pour réaliser mon premier projet</h2>
            <img src="/loginpage-removebg-preview.png" alt="" class="w-full object-contain">
        </div>
        <div class="w-[30%] mt-10">
            <div class="p-8 bg-slate-50 shadow-sm w-full">
                <h3 class="text-center text-2xl mb-2 text-green-700">Félicitations {{ Auth::user()->prenom }}</h3>
                <div>
                    <h4 class="mb-4 px-1 text-center">Finalisez votre inscription pour trouver le travail que vous aimez</h4>
                    <div class="">
                        <form method="POST" action="{{ route('register-jardinier.finish') }}">
                            @csrf
                            <div class="w-full flex flex-col mb-2">
                                <label for="" class="text-black font-semibold px-1 mb-1">Profession <span class="text-red-600 font-light">*</span></label>
                                <input type="text" placeholder="Jardinier" value="{{old('profession')}}" name="profession" class="form-control w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md @error('profession') is-invalid @enderror">
                                <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-2">
                                <label for="" class="text-black font-semibold px-1 mb-1">Tarif horaire <span class="text-red-600 font-light">*</span></label>
                                <input type="text" placeholder="1000" value="{{old('tarif_horaire')}}" name="tarif_horaire" class="form-control w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md @error('tarif_horaire') is-invalid @enderror">
                                <x-input-error :messages="$errors->get('tarif_horaire')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-2">
                                <label for="" class="text-black font-semibold px-1 mb-1">Tarif journalier <span class="text-red-600 font-light">*</span></label>
                                <input type="text" placeholder="50000" value="{{old('tarif_journalier')}}" name="tarif_journalier" class="form-control w-full outline-none ring-0 focus:border-none border-[1px] focus:border-green-700 border-solid border-slate-400 rounded-md @error('tarif_journalier') is-invalid @enderror">
                                <x-input-error :messages="$errors->get('tarif_journalier')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-2">
                                <label for="" class="text-black font-semibold px-1 mb-1">Description <span class="text-red-600 font-light">*</span></label>
                                <textarea name="description" id="description" placeholder="Je suis un jardinier" class="form-control w-full outline-none ring-0 focus:border-none border-[1px] focus:border-green-700 border-solid border-slate-400 rounded-md @error('description') is-invalid @enderror"></textarea>
                                @error("description")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col mb-1">
                                <label for="site_web" class="text-black font-semibold px-1 mb-1">Site web</label>
                                <input type="text" value="" name="site_web" placeholder="www.majardinieri.com" class="form-control w-full border-[1px] @error('description') is-invalid @enderror focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md" id="site_web" autocomplete="off">
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
                            <button type="" class="w-full text-center bg-red-600 text-white font-bold p-2 rounded-sm">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection

