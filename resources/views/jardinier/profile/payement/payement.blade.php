<!-- Payment Methods Tab -->
@php 
    $user = Auth::user();
@endphp
<div class="tab-pane fade" id="payement">
    <div class="section-header" data-aos="fade-up">
        <h2>Methodes de Payement</h2>
        <a href="{{route('user.payement.create')}}" class="bg-green-700 rounded-md px-2 py-1 text-white font-extralight" type="button" aria-label="">
            Ajouter une carte
        </a>
    </div>

    @if ($user->payements->isEmpty())
        <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
            <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucune carte ajouté </h3>
        </div>
    @else

        @php
            $payements = $user->payements;
        @endphp

        <div class="payment-cards-grid">
            @foreach ($payements as $payement)
                <div class="payment-card {{ $payement->status ? 'default': '' }}" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header">
                        <i class="bi bi-credit-card text-yellow-500"></i>
                        <div class="card-badges">
                            <span class="default-badge">{{ $payement->status ? 'Carte par défaut': '' }}</span>
                            <span class="card-type">{{ $payement->reseau }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-number">{{ '••• ••• ••• ' . chunk_split(substr($payement->numéro, -3)) }}</div>
                        <div class="card-info">
                            <span>Ajouté le {{ $payement->created_at }}</span>
                        </div>
                    </div>
                    <div class="card-actions flex justify-end items-center">
                        <div class="mx-auto">
                            <a href="{{ route('user.payement.edit', $payement ) }}" >
                                <button type="button" class="btn-edit">
                                    <i class="bi bi-pencil"></i>
                                    Modifier
                                </button>
                            </a>
                        </div>
                        <form action="{{route('user.payement.destroy',$payement)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">
                                <i class="bi bi-trash"></i>
                                Supprimer
                            </button>
                        </form>
                        @if (!$payement->status)
                            <form action="{{route('user.default',$payement)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn-make-default">Définir comme carte</button>
                            </form>
                        @endif
                    </div>
                </div>
            
            @endforeach
        </div>
    
    @endif

    <div class="payment-cards-grid">
        <!-- Payment Card 1 -->

        <!-- Payment Card 2 -->
        <!-- <div class="payment-card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-header">
                <i class="bi bi-credit-card"></i>
                <div class="card-badges">
                <span class="card-type">MOOV</span>
                </div>
            </div>
            <div class="card-body">
                <div class="card-number">•••• •••• •••• 7821</div>
                <div class="card-info">
                    <span>Ajouté le 05/2025</span>
                </div>
            </div>
            <div class="card-actions">
                <button type="button" class="btn-edit">
                    <i class="bi bi-pencil"></i>
                    Modifier
                </button>
                <button type="button" class="btn-remove">
                    <i class="bi bi-trash"></i>
                    Supprimer
                </button>
                <button type="button" class="btn-make-default">Définir comme carte</button>
            </div>
        </div> -->
    </div>
</div>