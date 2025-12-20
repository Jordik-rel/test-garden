<!-- Mes services Tab -->
@php 
    $user = Auth::user();
@endphp
<div class="tab-pane fade" id="services">
    <div class="section-header" data-aos="fade-up">
        <h2>Mes Services</h2>
        <div class="header-actions">
            <div class="dropdown">
                <button class="filter-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel"></i>
                    <span>Filtrer par: Récent</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Récent</a></li>
                    <li><a class="dropdown-item" href="#">Plus chère</a></li>
                    <li><a class="dropdown-item" href="#">Moins chère</a></li>
                </ul>
            </div>
            <a href="{{route('jardinier.service.create')}}" class="bg-green-700 rounded-md px-2 py-2 m-auto text-white font-extralight" type="button" aria-label="">
                Ajouter un service
            </a>
        </div>
    </div>

    @if ($user->jardinier->services->isEmpty())
        <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
            <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucun service ajouté </h3>
        </div>
    @else

        @php
            $services = $user->jardinier->services;
        @endphp
        
        <div class="reviews-grid">
            <!-- Review Card 1 -->
            @foreach ($services as $service)
                <div class="review-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="review-header">
                        <img src="{{ asset('assets/img/product/product-1.webp') }}" alt="Product" class="product-image" loading="lazy">
                        <div class="review-meta">
                            <h4>{{ $service->titre }}</h4>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span>{{ $service->prix }}Franc CFA</span>
                            </div>
                            <div class="review-date">Crée le {{ $service->created_at }}</div>
                        </div>
                    </div>
                    <div class="review-content">
                        <p>{{$service->description}}</p>
                    </div>
                    <div class="review-footer">
                        <a href="{{route('jardinier.service.edit',$service)}}"><button type="button" class="btn-edit">Modifier</button></a>
                        <form action="{{route('jardinier.service.destroy',$service)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>