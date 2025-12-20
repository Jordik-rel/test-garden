@extends('jardinier.profile.base')

@section('title')

    <title>Experiences/Mon compte - Green Connect</title>
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
                                <h2 class="text-lg font-semibold text-center text-slate-400">{{ $experience->exists ?' Modifier votre experience' :'Ajouter une experience' }}</h2>
                            </div>
                        </div>
                        <div class="content-area">
                            <form id="addcompetence" action="{{ route($experience->exists? 'jardinier.experience.update' :'jardinier.experience.store',$experience)}}" method="POST">
                                @csrf
                                @method($experience->exists? 'PUT' : 'POST')
                                <div class="mb-3">
                                    <label for="compagny" class="text-black font-semibold px-1 mb-1">Nom compagnie</label>
                                    <input type="text" name="compagny" value="{{old('compagny',$experience->compagny)}}" class="form-control @error('nom') is-invalid @enderror" id="compagny">
                                </div>
                                <div class="mb-3">
                                    <label for="nomPoste" class="text-black font-semibold px-1 mb-  1">Intitulé du poste</label>
                                    <input type="text" name="nomPoste" value="{{old('nomPoste',$experience->nomPoste)}}" class="form-control @error('nomPoste') is-invalid @enderror" id="nomPoste">
                                </div>
                                <div class="flex justify-between items-center mb-3 w-full">
                                    <div class="mr-2 w-1/2">
                                        <label for="pays" class="text-black font-semibold px-1 mb-1">Pays</label>
                                        <input type="text" name="pays" value="{{old('pays',$experience->pays)}}" class="form-control @error('pays') is-invalid @enderror" id="pays">
                                    </div>
                                    <div class="w-1/2">
                                        <label for="ville" class="text-black font-semibold px-1 mb-  1">Ville</label>
                                        <input type="text" name="ville" value="{{old('ville',$experience->ville)}}" class="form-control @error('ville') is-invalid @enderror" id="ville">
                                    </div>
                                </div>
                                 <div class="">
                                        <label for="duree" class="text-black font-semibold px-1 mb- 1">Durée</label>
                                        <input type="text" name="duree" value="{{old('duree',$experience->duree)}}" class="form-control @error('duree') is-invalid @enderror" id="duree">
                                    </div>
                                <div class="mb-4">
                                    <label for="description" class="text-black font-semibold px-1 mb-1">Description</label>
                                    <textarea name="description" id="description"  class="form-control @error('description') is-invalid @enderror">{{old('description',$experience->description)}}</textarea>
                                </div>
                                <div class="w-full">
                                    @if($experience->exists)
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