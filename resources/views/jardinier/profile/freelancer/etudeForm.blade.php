@extends('jardinier.profile.base')

@section('title')

    <title>Educations/Mon compte - Green Connect</title>
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
                                <h2 class="text-lg font-semibold text-center text-slate-400">{{ $education->exists ?' Modifier votre education' :'Ajouter une education' }}</h2>
                            </div>
                        </div>
                        <div class="content-area">
                            <form id="addcompetence" action="{{ route($education->exists? 'jardinier.education.update' :'jardinier.education.store',$education)}}" method="POST">
                                @csrf
                                @method($education->exists? 'PUT' : 'POST')
                                <div class="mb-3">
                                    <label for="nomEcole" class="text-black font-semibold px-1 mb-1">Nom Ecole</label>
                                    <input type="text" name="nomEcole" value="{{old('nomEcole',$education->nomEcole)}}" class="form-control @error('nomEcole') is-invalid @enderror" id="nomEcole">
                                </div>
                                <div class="mb-3">
                                    <label for="nomFormation" class="text-black font-semibold px-1 mb-1">Nom Formation</label>
                                    <input type="text" name="nomFormation" value="{{old('nomFormation',$education->nomFormation)}}" class="form-control @error('nomFormation') is-invalid @enderror" id="nomFormation">
                                </div>
                                <div class="mb-3">
                                    <label for="domaine" class="text-black font-semibold px-1 mb-1">Domaine d'etude</label>
                                    <input type="text" name="domaine" value="{{old('domaine',$education->domaine)}}" class="form-control @error('domaine') is-invalid @enderror" id="domaine">
                                </div>
                                <div class="mb-3">
                                    <label for="niveauetude" class="text-black font-semibold px-1 mb-1">Niveau d'etude</label>
                                    <select name="niveauetude" id="niveauetude" class="form-control @error('niveauetude') is-invalid @enderror">
                                        <option value="baccalaureat professionnel" {{  $education->niveauetude == 'baccalaureat professionnel' ? 'selected' : '' }} >Baccalaureat professionnel</option>
                                        <option value="bac+1" {{  $education->niveauetude == 'bac+1' ? 'selected' : '' }}> Bac+1</option>
                                        <option value="bac+2" {{  $education->niveauetude == 'bac+2' ? 'selected' : '' }}> Bac+2</option>
                                        <option value="licence" {{  $education->niveauetude == 'licence' ? 'selected' : '' }}> Licence</option>
                                        <option value="master" {{  $education->niveauetude == 'master' ? 'selected' : '' }}> Master</option>
                                        <option value="ingenieur" {{  $education->niveauetude == 'ingenieur' ? 'selected' : '' }} >Ingénieur</option>
                                        <option value="doctoract" {{  $education->niveauetude == 'doctoract' ? 'selected' : '' }} >Doctoract</option>
                                    </select>
                                </div>
                                <div class="flex justify-between items-center mb-3 w-full">
                                    <div class="mr-2 w-1/2">
                                        <label for="pays" class="text-black font-semibold px-1 mb-1">Pays</label>
                                        <input type="text" name="pays" value="{{old('pays',$education->pays)}}" class="form-control @error('pays') is-invalid @enderror" id="pays">
                                    </div>
                                    <div class="w-1/2">
                                        <label for="ville" class="text-black font-semibold px-1 mb-  1">Ville</label>
                                        <input type="text" name="ville" value="{{old('ville',$education->ville)}}" class="form-control @error('ville') is-invalid @enderror" id="ville">
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mb-3 w-full">
                                    <div class="mr-3 w-1/2">
                                        <label for="dateDebut" class="text-black font-semibold px-1 mb- 1">Date de début</label>
                                        <input type="date" name="dateDebut" value="{{old('dateDebut',$education->dateDebut)}}" class="form-control @error('dateDebut') is-invalid @enderror" id="dateDebut">
                                    </div>
                                    <div class="w-1/2">
                                        <label for="dateFin" class="text-black font-semibold px-1 mb- 1">Date de fin</label>
                                        <input type="date" name="dateFin" value="{{old('dateFin',$education->dateFin)}}" class="form-control @error('dateFin') is-invalid @enderror" id="dateFin">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="text-black font-semibold px-1 mb-1">Description</label>
                                    <textarea name="description" id="description"  class="form-control @error('description') is-invalid @enderror">{{old('description',$education->description)}}</textarea>
                                </div>
                                <div class="w-full">
                                    @if($education->exists)
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