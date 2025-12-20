@extends('jardinier.profile.base')

@section('title')

    <title>Blog - Green Connect</title>
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
                                <h2 class="text-lg font-semibold text-center text-slate-400">{{ $blog->exists ?' Modifier votre article' :'Ajouter un nouvel article' }}</h2>
                            </div>
                        </div>
                        <div class="content-area">
                            <form id="addcompetence" action="{{ route($blog->exists? 'jardinier.blog.update' :'jardinier.blog.store',$blog)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method($blog->exists? 'PUT' : 'POST')
                                <div class="mb-3">
                                    <label for="title" class="form-label text-black font-semibold px-1 mb- 1">Titre <span class="text-red-600">*</span></label>
                                    <input type="text" name="title" value="{{old('title',$blog->title)}}" class="form-control @error('title') is-invalid mb-1 @enderror" id="title">
                                    @error('title')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label text-black font-semibold px-1 mb-1">Sous-titre <span class="text-red-600">*</span></label>
                                    <input type="text" name="subtitle" value="{{old('subtitle',$blog->subtitle)}}" class="form-control @error('subtitle') is-invalid mb-1 @enderror" id="subtitle">
                                    @error('subtitle')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label text-black font-semibold px-1 mb-1">Photo </label>
                                    <input type="file" name="image" value="{{old('image','storage/'.$blog->image)}}" class="form-control @error('image') is-invalid mb-1 @enderror" id="image">
                                    @error('image')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="text-black font-semibold px-1 mb-1">Description <span class="text-red-600">*</span></label>
                                    <textarea name="description" id="description"  class="form-control @error('description') is-invalid mb-1 @enderror">{{old('description',$blog->description)}}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    @if($blog->exists)
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