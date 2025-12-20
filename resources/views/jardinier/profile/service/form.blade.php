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
                                <h2 class="text-lg font-semibold text-center text-slate-400">{{ $service->exists ?' Modifier votre service' :'Ajouter un service' }}</h2>
                            </div>
                        </div>
                        <div class="content-area">
                            <form id="addcompetence" action="{{ route($service->exists? 'jardinier.service.update' :'jardinier.service.store',$service)}}" method="POST">
                                @csrf
                                @method($service->exists? 'PUT' : 'POST')
                                <div class="mb-3">
                                    <label for="titre" class="text-black font-semibold px-1 mb-1">Titre service</label>
                                    <input type="text" name="titre" value="{{old('titre',$service->titre)}}" class="form-control @error('titre') is-invalid @enderror" id="titre">
                                </div>
                                <div class="mb-3">
                                    <label for="prix" class="form-label text-black font-semibold px-1 mb-  1">Prix du service</label>
                                    <input type="text" name="prix" value="{{old('prix',$service->prix)}}" class="form-control @error('prix') is-invalid @enderror" id="prix">
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="text-black font-semibold px-1 mb-1">Description</label>
                                    <textarea name="description" id="description"  class="form-control @error('description') is-invalid @enderror">{{old('description',$service->description)}}</textarea>
                                </div>
                                <div class="w-full">
                                    @if($service->exists)
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