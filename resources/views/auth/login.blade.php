@extends('base')
@section('title')
    <title>Green Connect - Connexion</title>
    @vite('resources/css/app.css')
@endsection
@section('content')
    @include('homeNav')
    <!-- <div class="p-4 bg-slate-100">
        <h1 class="text-center font-extralight text-4xl text-green-800">AGANMA</h1>
    </div> -->
    @if(session('error'))
        <div class="alert alert-danger flex align-items-center justify-center h-fit" role="alert">
            <div class="mb-1 text-red-800 ">
                <i class="fa-regular fa-danger mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif
    <div class="flex justify-center items-start w-full p-10">
        <div class="flex flex-col w-[50%] mr-10 space-y-4 mx-auto">
            <img src="{{ asset('images/login.png') }}" alt="" class="w-[80%] object-contain">
            <h2 class="text-2xl text-green-800 font-semibold text-center w-[70%]">Green Connect, la solution qui donne vie à vos projets de jardinage.</h2>
        </div>
        <div class="w-[30%] mt-10">
            <div class="p-8 bg-slate-50 shadow-sm w-full">
                <h3 class="text-center font-semibold text-green-700 text-2xl mb-4">Connexion</h3>
                <div>
                    <div class="">
                        <form method="POST" action="{{ route('login') }}" id="email"class="flex flex-col">
                            @csrf
                            <div class="w-full flex flex-col mb-3">
                                <label for="input_type" class="text-black font-semibold px-1 mb-1">Email ou Telephone</label>
                                <input type="input_type" placeholder="johndoe@gmail.com ou 0198765423" name="input_type" value="{{ old('input_type') }}" id="input_type" class="form-control w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md @error('input_type') is-invalid @enderror">
                                <!-- <x-text-input id="input_type" aria-placeholder="johndoe@gmail.com ou 019876542367" class="block mt-1 w-full" type="text" name="input_type" :value="old('input_type')" required autofocus autocomplete="off" /> -->
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label for="" class="text-black font-semibold px-1 mb-1">Mot de passe</label>
                                <input type="password" placeholder="mot de passe" name="password" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-between mb-4 w-full">
                                <div class="block">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se Souvenir') }}</span>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                            </div>
                            <button type="" class="w-full text-center bg-red-600 text-white font-bold p-2 rounded-sm">Se Connecter</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-2">
                <a class=" text-sm text-black mr-1 font-bold dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="">
                    {{ __('Pas encore de compte ?') }}
                </a>
                <a href="{{ route('register') }}" class="underline text-green-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none"> {{ __('Créer un compte') }}</a>
            </div>
        </div>
        
    </div>
   
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const phone = document.getElementById('success-outlined')
            const email = document.getElementById('danger-outlined')
            const phoneInput = document.getElementById('phone')
            const emailInput = document.getElementById('email')
            phone.addEventListener('change',function(){
                if(this.checked){
                    phoneInput.style.display='flex'
                    emailInput.style.display='none'
                }
            })
            email.addEventListener('change',function(){
                if(this.checked){
                    emailInput.style.display='flex'
                    phoneInput.style.display='none'
                }
            })
        })
    </script>
@endsection

