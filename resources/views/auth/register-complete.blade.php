@extends('base')
@section('title')
    <title>Green Connect - Inscription</title>
    @vite('resources/css/app.css')
@endsection
@section('content')
    @include('homeNav')
    <div class="flex justify-center items-start w-full p-10">
        <div class="flex flex-col w-[50%] mr-10">
            <h2 class="text-3xl text-green-800 font-semibold text-center w-[70%]">Créer un compte pour faire votre premiere demande</h2>
            <img src="{{ asset('images/ob4.png') }}" alt="" class="w-full object-contain">
        </div>
        <div class="w-[30%] mt-10">
            <div class="p-8 bg-slate-50 shadow-sm w-full">
                <h3 class="text-center text-2xl mb-2 text-green-700">Félicitations</h3>
                <div>
                    <h4 class="mb-4 px-1 text-center">Plus qu’une étape pour commencer par créer vos projets</h4>
                    <div class="">
                        <form method="POST" action="{{ route('register.complete') }}">
                            @method('put')
                            @csrf
                            <div class="flex mb-3">
                                <div class="w-full flex flex-col mr-2">
                                    <label for="" class="text-black font-semibold px-1 mb-1">Nom</label>
                                    <input type="text" placeholder="DOE" name="nom" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md">
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                </div>
                                <div class="w-full flex flex-col">
                                    <label for="" class="text-black font-semibold px-1 mb-1">Prénoms</label>
                                    <input type="text" placeholder="John" name="prenom" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md">
                                    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                </div>
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label for="" class="text-black font-semibold px-1 mb-1">Téléphone</label>
                                <input type="text" value="01 XX XX XX XX" name="phone" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md {{ Auth::user()->phone ? 'bg-slate-300' : '' }}" {{ Auth::user()->phone ? 'disabled' : '' }}>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label for="" class="text-black font-semibold px-1 mb-1">Email</label>
                                <input type="email" value="{{Auth::user()->email}}" name="email" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md {{ Auth::user()->email ? 'bg-slate-300' : '' }}" >
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label for="" class="text-black font-semibold px-1 mb-1">Mot de passe</label>
                                <input type="password" placeholder="" name="password" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label for="" class="text-black font-semibold px-1 mb-1">Confirmer votre mot de passe</label>
                                <input type="password" placeholder="" name="password_confirmation" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <button type="" class="w-full text-center bg-red-600 text-white font-bold p-2 rounded-sm">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection

