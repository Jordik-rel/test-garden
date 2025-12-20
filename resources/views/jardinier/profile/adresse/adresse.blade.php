<!-- Addresses Tab -->
@php 
    $user = Auth::user();
@endphp

<div class="tab-pane fade" id="adresses">
    <div class="section-header" data-aos="fade-up">
        <h2>Mes Addresses</h2>
        <div class="header-actions">
            <a href="{{route('jardinier.localisation.create')}}" class="bg-green-700 rounded-md px-2 py-2 m-auto text-white font-extralight" type="button" aria-label="">
                Ajouter une adresse
            </a>
        </div>
    </div>

    @if ($user->localisation->isEmpty())
        <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
            <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucune adresse ajoutée </h3>
        </div>
    @else

        @php
            $localisations = $user->localisation;
        @endphp
        <div class="addresses-grid">
            @foreach ($localisations as $localisation)
                <div class="address-card {{ $localisation->status ? 'default' : '' }}" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header">
                        <h4>Localisation</h4>
                        @if ($localisation->status)
                            <span class="default-badge"> 'Adresse par défaut' </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="address-text">{{ $localisation->quartier }}<br>{{$localisation->ville}}<br>Republique du Bénin</p>
                        <div class="contact-info">
                            <div><i class="bi bi-person"></i> {{ $user->prenom }} {{$user->nom}}</div>
                            <div><i class="bi bi-telephone"></i> {{ $user->phone }}</div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{route('jardinier.localisation.edit',$localisation)}}">
                            <button type="button" class="btn-edit">
                                <i class="bi bi-pencil"></i>
                                Modifier
                            </button>
                        </a>
                        <form action="{{route('jardinier.localisation.destroy',$localisation)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">
                                <i class="bi bi-trash"></i>
                                Supprimer
                            </button>
                        </form>
                        @if (!$localisation->status)
                            <form action="{{route('jardinier.default',$localisation)}}" method="post">
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
</div>