<div class="section-header" data-aos="fade-up">
    <h2>Mes études</h2>
    <a href="{{route('jardinier.education.create')}}" class="bg-green-700 rounded-md px-2 py-1 text-white font-extralight" type="button" aria-label="">
        Ajouter une formation
    </a>
</div>
@if ($user->jardinier->educations->isEmpty())
    <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
        <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucune formation ajoutée </h3>
    </div>
@else
     @php
        $educations = $user->jardinier->educations;
    @endphp

    <!-- Mes études-->
    @foreach ($educations as $education)
        <div class="order-card" data-aos="fade-up" data-aos-delay="200">
            <div class="order-header">
                <div class="order-id">
                    <span class="value">{{ $education->nomEcole }}</span>
                </div>
                <div class="order-date">{{ $education->ville }}, {{ $education->pays }}</div>
            </div>
            <div class="order-content">
                <div class="product-grid">
                    <img src="{{ asset('assets/img/product/product-5.webp') }}" alt="Product" loading="lazy">
                </div>
                <div class="order-info">
                    <div class="info-row">
                        <span>Nom Formation</span>
                        <span class="status shipped">Jardinier</span>
                    </div>
                    <div class="info-row">
                        <span>Date de début</span>
                        <span>{{ $education->dateDebut }}</span>
                    </div>
                    <div class="info-row">
                        <span>Date de fin</span>
                        <span class="price">{{ $education?->dateFin }}</span>
                    </div>
                </div>
            </div>
            <div class="order-footer flex justify-between items-center">
                <button type="button" class="btn-details" data-bs-toggle="collapse" data-bs-target="#etude1" aria-expanded="false">Détails formation</button>
                <div class="mx-auto">
                    <a href="{{ route('jardinier.education.edit', $education ) }}" class="w-full bg-yellow-600 hover:bg-orange-500 py-2 px-6 rounded-md text-white font-extralight text-center">Modifier</a>
                </div>
            </div>
    
            <!-- Details formations -->
            <div class="collapse order-details" id="etude1">
                <div class="details-content">
                    <div class="detail-section">
                        <div class="order-items">
                            <div class="item">
                                <img src="{{ asset('assets/img/product/product-1.webp') }}" alt="Product" loading="lazy">
                                <div class="item-info">
                                    <h6>Niveau d'étude</h6>
                                </div>
                                <div class="item-price">{{ $education->niveauetude }}</div>
                            </div>
    
                            <div class="item">
                                <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                    <h6>Domaine d'étude</h6>
                                </div>
                                <div class="item-price">{{ $education->domaine }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-section">
                        <h5>Description</h5>
                        <div class="info-grid">
                            <div class="info-column">
                                <span>{{ $education?->description }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endif
