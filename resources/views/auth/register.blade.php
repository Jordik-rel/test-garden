@extends('base')
@section('title')
    <title>Green Connect - Inscription</title>
    @vite('resources/css/app.css')
@endsection
@section('content')
    @include('homeNav')
    <div class="flex justify-center items-start w-full p-10">
        <div class="flex flex-col w-[50%] mr-10">
            <h2 class="text-2xl text-green-800 font-semibold text-center w-[70%]">Créer un compte pour lancer mon premier projet</h2>
            <img src="{{ asset('images/signUp.png') }}" alt="" class="w-full object-contain">
        </div>
        <div class="w-[30%] mt-10">
            <div class="p-8 bg-slate-50 shadow-sm w-full">
                <h3 class="text-center text-xl mb-4">Votre compte Green Connect vous permet d’accéder à tous nos services</h3>
                <div>
                    <h4 class="mb-2 px-1">Je crée mon compte à partir de mon</h4>
                    <div class="flex justify-between items-center overflow-x-auto bg-green-100 rounded-xl p-2 mb-2 w-full">
                        <div class="w-[48%]">
                            <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off" {{ old('email') || $errors->has('email') ? 'checked' : '' }}>
                            <label class="btn btn-outline-success w-full p-2" for="danger-outlined"><i class="bi bi-envelope mr-2"></i>Email</label>
                        </div>
                        <div class="w-[48%]">
                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" {{ old('phone') || $errors->has('phone') ? 'checked' : '' }}>
                            <label class="btn btn-outline-success w-full p-2" for="success-outlined"><i class="bi bi-telephone mr-2"></i>Telephone</label>
                        </div>
                    </div>
                    <div class="">
                        <form method="POST" action="{{ route('register') }}" id="email"class="flex flex-col">
                            @csrf
                            <div class="w-full flex flex-col mb-2">
                                <label for="" class="text-black font-semibold px-1 mb-1">Email</label>
                                <input type="email" placeholder="johndoe@gmail.com" name="email" class="form-control w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md @error('email') is-invalid @enderror">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <button type="submit" class="w-full text-center bg-red-600 text-white font-bold p-2 rounded-sm">Valider</button>
                        </form>
                        <form method="POST"  id="phone" class="hidden flex-col">
                            @csrf
                            <div class="w-full flex-col mb-2">
                                <label for="" class="text-black font-semibold px-1 mb-1">Télephone</label>
                                <input type="text" placeholder="0197456789" name="phone" class="form-control  w-full border-[1px] focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md @error('phone') is-invalid @enderror">
                                <x-input-error :messages="$errors->get('telephophonene')" class="mt-2" />
                            </div>
                            <button type="submit" class="w-full text-center bg-red-600 text-white font-bold p-2 rounded-sm">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-2">
                <a class=" text-sm text-black mr-1 font-bold dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="">
                    {{ __('Vous avez déjà un compte ?') }}
                </a>
                <a href="{{ route('login') }}" class="underline text-green-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none"> {{ __('Se Connecter') }}</a>
            </div>
        </div>
        
    </div>
    @include('homeBotombar')
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const phone = document.getElementById('success-outlined')
            const email = document.getElementById('danger-outlined')
            const phoneInput = document.getElementById('phone')
            const emailInput = document.getElementById('email')
            
            if (phone.checked) {
                phoneInput.style.display = 'flex';
                emailInput.style.display = 'none';
            } else {
                emailInput.style.display = 'flex';
                phoneInput.style.display = 'none';
            }
            
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




