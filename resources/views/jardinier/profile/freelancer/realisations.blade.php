<!-- Mes réalisations antérieurs -->
@php
    $realisations = $user->jardinier->realisations;
@endphp
    @if( $realisations->isEmpty())
    <div class="collapse order-details" id="realisation1">
            <div class="order-footer w-full">
                <a href="{{route('jardinier.realisation.create')}}" class="w-full text-center bg-slate-200 p-2 rounded-md text-grey-600 font-extralight" >Ajouter une Réalisation</button></a>
            </div>
    </div>
    @else
    <div class="collapse order-details" id="realisation1">
        <div class="details-content">
            <div class="detail-section">
                <div class="flex justify-between items-center">
                    <h5>Mes Réalisations</h5>
                    <!-- <button type="button" class="bg-green-700 px-2 py-1 rounded-md text-white font-extralight" data-bs-toggle="modal" data-bs-target="#addrealisation">Ajouter une réalisation</button> -->
                     <a href="{{route('jardinier.realisation.create')}}" class="bg-green-700 px-2 py-1 rounded-md text-white font-extralight" >Ajouter une réalisation</a>
                </div>
                <div class="info-grid">
                    <h5>Total ({{ $realisations->count() }})</h5>
                </div>
            </div>
            @foreach($realisations as $realisation)
                <div class="detail-section">
                    <div class="order-content">
                        <div class="order-items">
                            <h3 class="mb-2 font-extralight">{{$realisation->titre}}</h3>
                            <div class="flex justify-between">
                                <div class="product-grid">
                                    <img src="assets/img/product/product-1.webp" alt="Product" loading="lazy">
                                    <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                                    <img src="assets/img/product/product-3.webp" alt="Product" loading="lazy">
                                </div>
                                <div class="text-orange-600">
                                    <a href="{{route('jardinier.realisation.edit',$realisation)}}"><i class="bi bi-pencil text-orange-500"></i></a>
                                </div>
                            </div>
                            <div class="order-info">
                                <div class="info-row">
                                    <span>Status</span>
                                    <span class="status processing">{{ $realisation->status }}</span>
                                </div>
                                <div class="info-row">
                                    <span>Durée</span>
                                    <span>{{ $realisation->duree }}</span>
                                </div>
                                <div class="info-column">
                                    <span>Description:</span>
                                    <span class="text-slate-400">
                                        {{ $realisation->description }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif


<!-- Ajouter une(des) Réalisation(s) -->
<!-- <div class="modal fade" id="addrealisation" tabindex="-1" aria-labelledby="addrealisationModal" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addrealisation">Ajouter Réalisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="addcompetence" action="{{ route('jardinier.realisation.store')}}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="titre" class="text-black font-semibold px-1 mb-1">Nom réalisation</label>
                        <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" id="titre">
                    </div>
                    <div class="mb-2">
                        <label for="status" class="text-black font-semibold px-1 mb-1">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="en cours"> En cours</option>
                            <option value="non commencé"> Non réalisé</option>
                            <option value="fini">Fini</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="duree" class="text-black font-semibold px-1 mb-  1">Durée</label>
                        <input type="text" name="duree" class="form-control @error('duree') is-invalid @enderror" id="duree">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="text-black font-semibold px-1 mb-1">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->