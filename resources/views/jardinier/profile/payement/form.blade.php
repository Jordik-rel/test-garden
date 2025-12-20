@extends('jardinier.profile.base')

@section('title')

    <title>Carte - Green Connect</title>
@endsection
@section('content')

    <main class="main">
        <section id="account" class="account section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <!-- Mobile Menu Toggle -->
                <div class="mobile-menu d-lg-none mb-4">
                    <button class="mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu">
                    <i class="bi bi-grid"></i>
                    <span>Menu</span>
                    </button>
                </div>

                <div class="row g-4">
                    <!-- Profile Menu -->
                    @include('jardinier.profile.profilemenu')
                    <div class="col-lg-9">
                        <div class="flex justify-between items-center mb-3 px-4">
                            <div class="w-[20%]">
                                <a href="{{route('jardinier.myaccount')}}">
                                    <i class="fa-solid fa-arrow-left font-semibold text-lg text-green-700"></i>
                                </a>
                            </div>
                            <div class="w-[80%] mx-auto">
                                <h2 class="text-lg font-semibold text-center text-slate-400">{{ $payement->exists ?' Modifier votre carte' :'Ajouter une nouvelle carte' }}</h2>
                            </div>
                        </div>
                        <div class="content-area">
                            <form id="addcompetence" action="{{ route($payement->exists? 'user.payement.update' :'user.payement.store',$payement)}}" method="POST">
                                @csrf
                                @method($payement->exists? 'PUT' : 'POST')
                                <div class="mb-3">
                                    <label for="reseau" class="text-black font-semibold px-1 mb-1">Réseau</label>
                                    <select name="reseau" id="reseau" class="form-control @error('reseau') is-invalid @enderror">
                                        <option value="MTN" {{  $payement->reseau == 'MTN' ? 'selected' : '' }} >MTN</option>
                                        <option value="MOOV" {{  $payement->reseau == 'MOOV' ? 'selected' : '' }}> MOOV</option>
                                        <option value="CELtiis" {{  $payement->reseau == 'Celtiis' ? 'selected' : '' }}> Celtiis</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="numéro" class="form-label text-black font-semibold px-1 mb-  1">Numéro de téléphone</label>
                                    <input type="text" name="numéro" value="{{old('numéro',$payement->numéro)}}" class="form-control @error('numéro') is-invalid @enderror" id="numéro">
                                </div>
                                <div class="w-full">
                                    @if($payement->exists)
                                        <button 
                                            type="submit" 
                                            class="w-full text-white bg-yellow-500  hover:bg-orange-700 font-extralight rounded-md px-2 py-2 text-center"
                                        >
                                             Modifier    
                                        </button>
                                    @else
                                        <button 
                                            type="submit" 
                                            class="w-full text-white bg-green-600 hover:bg-green-700 font-extralight rounded-md px-2 py-2 text-center"
                                        >
                                            Ajouter   
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection