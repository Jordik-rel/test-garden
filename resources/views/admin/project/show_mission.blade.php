@extends('admin.admin')
@section('title')
    <title>Ma Mission - Gardena Connect</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('adminContent')
    <div class="px-6 py-10 space-y-4">
        <div class="space-x-6 grid grid-cols-1 gap-6 md:flex ">
            <div class="w-[60%]">
                <h2 class="text-2xl font-semibold mb-6">Détails de la proposition</h2>
    
                <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
                    <div class="flex justify-between items-center">
                        <div class="p-6 border-b">
                            <h3 class="text-xl font-semibold mb-2">Tarif de la mission</h3>
                            <p class="text-gray-700">{{ $mission->montant }} FCFA</p>
                        </div>
                        <div class="p-6 border-b">
                            <h3 class="text-xl font-semibold mb-2">Versement jardinier</h3>
                            <p class="text-gray-700">{{ $mission->montant *0.9 }} FCFA</p>
                        </div>
                    </div>
                    <div class="p-6 border-b">
                        <h3 class="text-xl font-semibold mb-2">Délai estimé à </h3>
                        <p class="text-gray-700">
                            @switch($mission->projet->duree)
                                @case(1)
                                    Moins 1 mois
                                    @break
                                @case(2)
                                    1 à 3 mois
                                    @break
                                @case(3)
                                    3 à 6 mois
                                    @break
                                @case(4)
                                    Plus de 6 mois 
                                    @break
                                @default
                                    Non défini
                            @endswitch
                        </p>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Description</h3>
                        <p class="text-gray-700 p-4 border-1 border-slate-300 rounded-md hover:border-green-600">{{ $mission->projet->description }}</p>
                    </div>
                </div>
                        
            </div>
            <div class="w-[35%] space-y-4">
                <h2 class="text-2xl font-semibold mb-6">Profile</h2>
                <div class="flex justify-between items-end space-x-4 mb-2 w-full">
                    <div class="w-[60%]">
                        <a href="">
                            <img src="{{ $mission->jardinier->user->profile_photo_path ? asset('storage/'.$mission->jardinier->user->profile_photo_path) : asset('images/profile_img.jpg') }}" alt="photo de profil" class="w-full rounded-lg object-cover border border-gray-300">
                        </a>
                    </div>
                    <div class="w-[35%]">
                        <h3 class="text-xl font-semibold">{{ $mission->jardinier->user->prenom }} {{ $mission->jardinier->user->nom }}</h3>
                        <p class="text-sm text-slate-400 font-medium">{{ $mission->jardinier->profession }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 space-x-2 w-full">
                    <div class="text-xl text-slate-600 mb-4 flex flex-col items-center justify-between">
                        <div class="font-semibold flex items-center">
                            <i class="fa-solid fa-users-line"></i>
                            <span class="text-xl font-semibold ml-2">12</span>
                        </div>
                        <p class="font-medium text-slate-400 text-sm">Particuliers</p>
                    </div>
                    <div class=" text-slate-600 mb-4 flex flex-col items-center justify-between" >
                        <div class="font-semibold flex items-center">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                            <span class="font-semibold ml-2">12300</span>
                        </div>
                        <p class="font-medium text-slate-400 text-sm">Total gains</p>
                    </div>
                    <div class=" text-slate-600 mb-4 flex flex-col items-center justify-between" >
                        <div class="font-semibold flex items-center">
                            <i class="fa-solid fa-coins"></i>
                            <span class="font-semibold ml-2">1300</span>
                        </div>
                        <p class="font-medium text-slate-400 text-sm">Tarif horaire</p>
                    </div>
                </div>
                <div x-data="{ tab: 'overview' }">
                    <nav class="flex gap-4 border-b">
                        <button @click="tab='overview'" 
                                :class="tab==='overview' ? 'border-b-2 border-green-600' : ''"
                                class="px-3 py-2">
                            A propos du jardinier
                        </button>
    
                        <button @click="tab='projects'" 
                                :class="tab==='projects' ? 'border-b-2 border-green-600' : ''"
                                class="px-3 py-2">
                            Projets
                        </button>
    
                        <button @click="tab='articles'" 
                                :class="tab==='articles' ? 'border-b-2 border-green-600' : ''"
                                class="px-3 py-2">
                            Article
                        </button>
                    </nav>
                    <!-- Overview Tab -->
                    <div x-show="tab === 'overview'" class="p-4 space-y-4">
                        <div class="overview-content mb-4">
                            <p class="w-full border-1 rounded-md mb-2 border-slate-300 p-4 outline-none hover:border-green-600">
                                {{ $mission->jardinier->description }}
                            </p>
                        </div>
                        <div>
                            <h2 class="font-bold text-xl text-slate-700 mb-4">Competences</h2>
                            <div class="space-x-2 space-y-4">
                                @forelse ($mission->jardinier->competences as $competence)
                                    <span class="text-slate-600 bg-slate-200 font-semibold rounded-xl px-2 py-1">{{ $competence->nom }}</span>
                                @empty
                                    <span class="text-slate-600 bg-slate-200 font-semibold rounded-lg px-4 py-2">Aucune compétence</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
    
                    <!-- Technical Details Tab -->
                    <div x-show="tab === 'projects'" class="p-4">
                        Projets
                    </div>
    
                    <!-- Reviews Tab -->
                    <div x-show="tab === 'articles'" class="p-4">
                        <div class="reviews-content">
                            @forelse ($mission->jardinier->blogs as $blog)
                                <div class="wishlist-card" data-aos="fade-up" data-aos-delay="100">
                                    <div class="wishlist-image">
                                        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('logo.png')}}" alt="Product" loading="lazy">
                                        <form action="{{route('jardinier.blog.destroy',$blog)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-remove" type="submit" aria-label="Remove from wishlist">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        <div class="sale-badge {{$blog->status == 0 ? 'sale-badge' : ($blog->status == 1 ?'succes': 'out-of-stock-badge') }}">
                                        @switch($blog->status)
                                                @case(0)
                                                    Non publié
                                                    @break
                                                    
                                                @case(1)
                                                    Publié
                                                    @break
                                                    
                                                @case(2)
                                                    Traitement en cours
                                                    @break
                                            @endswitch                          
                                        </div>
                                    </div>
                                    <div class="wishlist-content">
                                        <h4 class="text-center font-extralight text-lg">{{ $blog->title }}</h4>
                                        <h5 class="font-light text-sm mb-1">{{ $blog->subtitle }}</h5>
                                        <div class="product-meta">
                                            <div class="price text-sm">
                                                {{ Str::limit($blog->description, 120, '...') }}  
                                                <a href="{{ route('blog.show', $blog) }}" class="text-blue-600 hover:underline">Lire plus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-700 text-sm font-medium">Aucun article posté</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-start mb-2">
            <div class="border-1 px-4 py-2 rounded-md border-slate-300 bg-slate-200 text-slate-700 font-medium">
                <a href="{{ route('admin.mission.index') }}" class="hover:text-slate-700 text-slate-700">Retour</a>
            </div>
        </div>
    </div>
@endsection
    