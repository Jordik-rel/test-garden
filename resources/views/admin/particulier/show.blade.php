@extends('admin.admin')

@section('title')
    <title>Particulier - Green Connect</title>

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

@endsection

@section('adminContent')
    <section id="product-details" class="product-details section">
        <div class="px-4">
            <a href="{{ route('admin.particulier.index') }}" class="no-underline font-medium text-lg flex justify-start items-center text-slate-700 hover:text-slate-900"><i class="fa-solid fa-arrow-left text-green-700 mr-2"></i></a>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row" data-aos="fade-up" data-aos-delay="300">
                <div class="col-12">
                        <div class="info-tabs-container">
                            <nav class="tabs-navigation nav">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ecommerce-product-details-5-overview" type="button">Informations personnel</button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ecommerce-product-details-5-technical" type="button">Localisation </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ecommerce-product-details-5-customer-reviews" type="button">Moyens de Payement </button>
                            </nav>

                            <div class="tab-content">
                                    <!-- Overview Tab -->
                                    <div class="tab-pane fade show active" id="ecommerce-product-details-5-overview">
                                        <div class="overview-content">
                                            <div class="row g-4">
                                                <div class="col-lg-8">
                                                    <div class="content-section">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                            <div>
                                                                <label class="block font-medium mb-1">Nom <span class="text-green-700 font-medium">*</span></label>
                                                                <input type="text" name="nom" value="{{ $particulier->nom }}" disabled
                                                                    class="w-full form-control border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                                                                >
                                                            </div>
                                                
                                                            <div>
                                                                <label class="block font-medium mb-1">Prenom <span class="text-green-700 font-medium">*</span></label>
                                                                <input type="text" name="nom" value="{{ $particulier->prenom }}" disabled
                                                                    class="w-full form-control border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="mt-4">
                                                            <label class="block font-medium mb-1">Email <span class="text-green-700 font-medium">*</span></label>
                                                            <input type="email" name="nom" value="{{ $particulier->email }}" disabled
                                                                class="w-full form-control border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                                                            >
                                                        </div>
                                                        <div class="mt-4">
                                                            <label class="block font-medium mb-1">Téléphone <span class="text-green-700 font-medium">*</span></label>
                                                            <input type="phone" name="nom" value="{{ $particulier->phone }}" disabled
                                                                class="w-full form-control border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                                                            >
                                                        </div>
                                                        <div class="mt-4">
                                                            <label class="block font-medium mb-1">Username <span class="text-green-700 font-medium">*</span></label>
                                                            <input type="text" name="nom" value="{{ $particulier->username }}" disabled
                                                                class="w-full form-control border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                        <div class="package-contents">
                                                            <img src="{{ asset('storage/'.$particulier->profile_photo_path) }}" alt="Photo de profil" class="w-full h-full object-cover">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Technical Details Tab -->
                                    <div class="tab-pane fade" id="ecommerce-product-details-5-technical">
                                       <div class="addresses-grid">
                                            @forelse ($particulier->localisation as $localisation)
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
                                            @empty
                                                <p class="text-center text-lg font-medium">Aucune Localisation associée</p>
                                            @endforelse 
                                        </div>
                                    </div>

                                    <!-- Reviews Tab -->
                                    <div class="tab-pane fade" id="ecommerce-product-details-5-customer-reviews">
                                        <div class="reviews-content">
                                                <div class="customer-reviews-list">
                                                    <div class="review-card">
                                                        <h5 class="review-headline">Conseil de culture</h5>
                                                            <div class="review-text">
                                                                <p></p>
                                                            </div>
                                                    </div>

                                                    <div class="review-card">
                                                            <h5 class="review-headline">Précautions</h5>
                                                            <div class="review-text">
                                                                <p></p>
                                                            </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/drift-zoom/Drift.min.js') }}"></script>

    <script>
        AOS.init();

        // GESTION DES THUMBNAILS
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail-item');

        thumbnails.forEach(t => {
            t.addEventListener('click', () => {
                const imgURL = t.dataset.image;
                mainImage.src = imgURL;
                mainImage.setAttribute('data-zoom', imgURL);

                thumbnails.forEach(x => x.classList.remove('active'));
                t.classList.add('active');
            });
        });

        // GLIGHTBOX
        GLightbox({
            selector: '.thumbnail-item img'
        });

        // DRIFT ZOOM
        new Drift(mainImage, {
            paneContainer: document.querySelector('.image-zoom-container'),
            inlinePane: false
        });
    </script>

@endsection
