@extends('base')
@section('title')
    <title>Green Connect - Inscription</title>
    @vite('resources/css/app.css')
@endsection
@section('content')
    @include('homeNav')
    <div class="flex justify-center items-start w-full p-10">
        <div class="flex flex-col w-[50%] mr-10">
            <h2 class="text-3xl text-green-800 font-semibold text-center w-[70%]">Créer un compte pour réaliser mon premier projet</h2>
            <img src="/loginpage-removebg-preview.png" alt="" class="w-full object-contain">
        </div>
        <div class="w-[30%] mt-10">
            <div class="p-8 bg-slate-50 shadow-sm w-full">
                <h3 class="text-center text-2xl mb-2 text-green-700">Félicitations</h3>
                <div>
                    <h4 class="mb-4 px-1 text-center">Dernière étape pour vous lancer</h4>
                    <div class="">
                        <form method="POST" action="{{ route('register.finish') }}">
                            @method('put')
                            @csrf
                            <div class="w-full flex flex-col mb-3">
                                <label for="" class="text-black font-semibold px-1 mb-1">Selectionnez le type de compte que vous souhaitez créer</label>
                                <select id="select-beast" placeholder="Selectionnez un compte..." name="role" class="w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md" autocomplete="off">
                                    <option value="">Selectionnez un compte...</option>
                                    <option value="user">Particulier</option>
                                    <option value="jardinier">Jardinier</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                            <button type="" class="w-full text-center bg-red-600 text-white font-bold p-2 rounded-sm">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

