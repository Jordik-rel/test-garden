<div class="section-header" data-aos="fade-up">
    <h2>Expérience Professionnelle</h2>
    <a href="{{route('jardinier.experience.create')}}" class="bg-green-700 rounded-md px-2 py-1 text-white font-extralight" type="button" aria-label="">
        Ajouter une experience
    </a>
</div>  

@if ($user->jardinier->experiences->isEmpty())
    <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
        <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucune expérience ajoutée </h3>
    </div>
@else

    @php
        $experiences = $user->jardinier->experiences;
    @endphp

    <!-- Expérience Professionnelle Card -->
     @foreach ($experiences as $experience)
        <div class="order-card" data-aos="fade-up" data-aos-delay="200">
            <div class="order-header">
                <div class="order-id">
                    <span class="value">{{ $experience->compagny }}</span>
                </div>
                <div class="order-date">{{ $experience->ville }}, {{ $experience->pays }}</div>
            </div>
            <div class="order-content">
                <div class="product-grid">
                    <img src="{{ ('assets/img/product/product-5.webp') }}" alt="Product" loading="lazy">
                </div>
                <div class="order-info">
                    <div class="info-row">
                        <span>Titre du poste</span>
                        <span class="status shipped">{{ $experience->nomPoste }}</span>
                    </div>
                    <div class="info-row">
                        <span>Durée</span>
                        <span>{{ $experience->duree }}</span>
                    </div>
                </div>
            </div>
            <div class="order-footer justify-between items-center">
                <button type="button" class="btn-details" data-bs-toggle="collapse" data-bs-target="#experience1" aria-expanded="false">Détails poste</button>
                <div class="mx-auto">
                    <a href="{{route('jardinier.experience.edit',$experience)}}" class="w-full bg-yellow-600 hover:bg-orange-500 py-2 px-6 rounded-md text-white font-extralight text-center">Modifier</a>
                </div>
            </div>
    
            <!-- Order Details -->
            <div class="collapse order-details" id="experience1">
                <div class="details-content">
                    <div class="detail-section">
                        <h5>Description</h5>
                        <div class="info-grid">
                            <div class="info-column">
                                <span>{{ $experience?->description }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
     @endforeach
    
@endif
