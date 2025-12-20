
@extends('base')
@section('title')
    <title>Green Connect - Email Verification</title>
@endsection
@section('content')
    @include('homeNav')
    <div class="flex justify-center items-start w-full p-10">
        <div class="flex flex-col w-[50%] mr-10">
            <h2 class="text-2xl text-green-800 font-semibold text-center w-[70%]">Créer un compte pour lancer mon premier projet</h2>
            <img src="images/signUp.png" alt="" class="w-full object-contain">
        </div>
        <div class="w-[35%] mt-10 flex-col justify-center items-center bg-slate-50 p-4 shadow-md">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('Un nouveau mail de vérification vous a été envoyé à votre address email. Veuillez bien le consulté.') }}
                </div>
            @endif
            <div class="flex justify-center items-center">
                <img src="un-message.png" alt="">
            </div>
            <h2 class="text-xl font-bold text-green-900 text-center mb-2 px-2">Nous avons envoyé un lien de vérification à votre adresse</h2>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                <h3 class="text-center mb-2">
                    Veuillez cliquer sur le lien de vérification que nous avons envoyé à <span class="font-semibold text-green-950">{{ Auth::user()->email }}</span> .
                </h3>
                <div class="flex justify-center">
                    <p>Vous n’avez pas reçu le mail ?</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="text-blue-700 underline ml-2 bg-transparent">Renvoyer le mail</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
@endsection

