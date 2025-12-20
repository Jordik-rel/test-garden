@extends('admin.admin')

@section('title')
    <title>Galerie - {{ $plant->nom }}</title>

    <!-- Vendor CSS -->
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
        <div class="mb-4 px-4">
            <a href="{{ route('admin.plant.index') }}" class="no-underline font-medium text-lg flex justify-start items-center text-slate-700 hover:text-slate-900"><i class="fa-solid fa-arrow-left text-green-700 mr-2"></i></a>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4">
                <!-- Product Gallery -->
                <div class="col-lg-7" data-aos="zoom-in" data-aos-delay="150">
                    <div class="product-gallery">
                        <div class="main-showcase">
                            <div class="image-zoom-container">
                                <img src="{{ asset('storage/'.$plant->image[0]) }}" alt="Product Main" class="img-fluid main-product-image drift-zoom" id="main-product-image" data-zoom="assets/img/product/product-details-6.webp">
                                <div class="image-navigation">
                                    <button class="nav-arrow prev-image image-nav-btn prev-image" type="button">
                                    <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="nav-arrow next-image image-nav-btn next-image" type="button">
                                    <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="thumbnail-grid">
                            @foreach ($plant->image as $img)
                                <div class="thumbnail-wrapper thumbnail-item ">
                                    <img src="{{ asset('storage/'.$img) }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>

                        <div class="thumbnail-grid">
                            
                            <!-- <div class="thumbnail-wrapper thumbnail-item" data-image="assets/img/product/product-details-7.webp">
                                <img src="assets/img/product/product-details-7.webp" alt="View 2" class="img-fluid">
                            </div>
                            <div class="thumbnail-wrapper thumbnail-item" data-image="assets/img/product/product-details-8.webp">
                                <img src="assets/img/product/product-details-8.webp" alt="View 3" class="img-fluid">
                            </div>
                            <div class="thumbnail-wrapper thumbnail-item" data-image="assets/img/product/product-details-4.webp">
                                <img src="assets/img/product/product-details-4.webp" alt="View 4" class="img-fluid">
                            </div>
                            <div class="thumbnail-wrapper thumbnail-item" data-image="assets/img/product/product-details-5.webp">
                                <img src="assets/img/product/product-details-5.webp" alt="View 5" class="img-fluid">
                            </div>
                            <div class="thumbnail-wrapper thumbnail-item" data-image="assets/img/product/product-details-3.webp">
                                <img src="assets/img/product/product-details-3.webp" alt="View 6" class="img-fluid">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Tabs -->
            <div class="row mt-5" data-aos="fade-up" data-aos-delay="300">
                <div class="col-12">
                        <div class="info-tabs-container">
                            <nav class="tabs-navigation nav">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ecommerce-product-details-5-overview" type="button">Informations botanique</button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ecommerce-product-details-5-technical" type="button">Informations  Technique </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ecommerce-product-details-5-customer-reviews" type="button">Conseils </button>
                            </nav>

                            <div class="tab-content">
                                    <!-- Overview Tab -->
                                    <div class="tab-pane fade show active" id="ecommerce-product-details-5-overview">
                                        <div class="overview-content">
                                            <div class="row g-4">
                                                <div class="col-lg-8">
                                                    <div class="content-section">
                                                        <h3>Description</h3>
                                                        <p>{{ $plant->description }}</p>

                                                        <h4>Catégories</h4>
                                                        <div class="highlights-grid">
                                                            @foreach ($plant->plant_categorie as $categorie)
                                                                <div class="highlight-card">
                                                                <i class="bi bi-volume-up"></i>
                                                                <h5>{{ $categorie->nom }}</h5>
                                                                <p>{{ $categorie->role }}</p>
                                                                </div>                             
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                        <div class="package-contents">
                                                            <h4>Appelation</h4>
                                                            <ul class="contents-list">
                                                                <li><i class="bi bi-check-circle"></i>{{ $plant->nom }}</li>
                                                                <li><i class="bi bi-check-circle"></i>{{ $plant->nom_local }}</li>
                                                                <li><i class="bi bi-check-circle"></i>{{ $plant->nom_scientifique }}</li>
                                                            </ul>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Technical Details Tab -->
                                    <div class="tab-pane fade" id="ecommerce-product-details-5-technical">
                                        <div class="technical-content">
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="tech-group">
                                                            <h4>Vertus médicinales</h4>
                                                            <div class="spec-table">
                                                                @foreach ($plant->vertu_medicinale as $vertu)
                                                                    <div class="spec-row">
                                                                        <span class="spec-name">{{ $vertu->nom }}</span>
                                                                    </div>                               
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="tech-group">
                                                            <h4>Valeurs nutritionnelles</h4>
                                                            <div class="spec-table">
                                                                @foreach ($plant->valeur_nutritionnelle as $valeur)
                                                                    <div class="spec-row">
                                                                        <span class="spec-name">{{ $valeur->nom }}</span>
                                                                    </div>                              
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <!-- Reviews Tab -->
                                    <div class="tab-pane fade" id="ecommerce-product-details-5-customer-reviews">
                                        <div class="reviews-content">
                                                <div class="customer-reviews-list">
                                                    <div class="review-card">
                                                        <h5 class="review-headline">Conseil de culture</h5>
                                                            <div class="review-text">
                                                                <p>{{$plant->conseil_culture}}</p>
                                                            </div>
                                                    </div>

                                                    <div class="review-card">
                                                            <h5 class="review-headline">Précautions</h5>
                                                            <div class="review-text">
                                                                <p>{{ $plant->precautions }}</p>
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
