 <!-- Mon Blog Tab -->
@php
    $user = Auth::user()
@endphp
<div class="tab-pane fade" id="blog">
    <div class="section-header" data-aos="fade-up">
        <h2>Mon Blog</h2>
         <div class="header-actions">
            <a href="{{route('jardinier.blog.create')}}" class="bg-green-700 rounded-md px-2 py-2 m-auto text-white font-extralight" type="button" aria-label="">
                Ajouter un article
            </a>
        </div>
    </div>

    @if ($user->jardinier->blogs->isEmpty())
        <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
            <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucun article ajouté </h3>
        </div>
    @else

        @php
            $blogs = $user->jardinier->blogs;
        @endphp

        <div class="wishlist-grid">
            @foreach ($blogs as $blog)
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
                                {{ $blog->description }}
                            </div>
                        </div>
                        <div class="w-full mx-auto">
                            @if($blog->status == 2)
                                <button type="button" class="btn  btn-light border rounded-md px-3 d-flex align-items-center justify-center gap-2 w-full">
                                    <i class="bi bi-lock"></i>
                                    Etude en cours
                                </button>
                            @elseif ($blog->status == 1)
                                <button type="button" class="btn  bg-green-600 hover:bg-green-800  text-white font-medium text-lg border rounded-md px-3 d-flex align-items-center justify-center gap-2 w-full">
                                    <i class="bi bi-trophy-fill text-white"></i>
                                    Publié
                                </button>
                            @else
                                <a href="{{route('jardinier.blog.edit',$blog)}}">
                                    <button type="button" class="btn-modify">
                                        <i class="bi bi-pencil"></i>
                                        Modifier
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endif

    <div class="wishlist-grid">
        <!-- Wishlist Item 1 -->

        <!-- Wishlist Item 2 -->
        <!-- <div class="wishlist-card" data-aos="fade-up" data-aos-delay="200">
            <div class="wishlist-image">
                <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                <button class="btn-remove" type="button" aria-label="Remove from wishlist">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="wishlist-content">
                <h4>Consectetur adipiscing elit</h4>
                <h5>Subtitle</h5>
                <div class="product-meta">
                    <div class="price">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit...
                    </div>
                </div>
                <button type="button" class="btn-modify">Modifier</button>
            </div>
        </div> -->

        <!-- Wishlist Item 3 -->
        <!-- <div class="wishlist-card" data-aos="fade-up" data-aos-delay="300">
            <div class="wishlist-image">
                <img src="assets/img/product/product-3.webp" alt="Product" loading="lazy">
                <button class="btn-remove" type="button" aria-label="Remove from wishlist">
                    <i class="bi bi-trash"></i>
                </button>
                <div class="out-of-stock-badge">Out of Stock</div>
            </div>
            <div class="wishlist-content">
                <h4>Sed do eiusmod tempor</h4>
                <h5>Subtitle</h5>
                <div class="product-meta">
                    <div class="price">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit...
                    </div>
                </div>
                <button type="button" class="btn-modify">Modifier</button>
            </div>
        </div> -->
    </div>
</div>