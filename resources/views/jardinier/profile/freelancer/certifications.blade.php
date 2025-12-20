<!-- Mes Certifications -->
<div class="section-header flex justify-between items-center" data-aos="fade-up">
    <h2>Mes Certifications</h2>
    <a href="{{route('jardinier.certification.create')}}" class="bg-green-700 rounded-md px-2 py-1 text-white font-extralight" type="button" aria-label="">
        Ajouter une certification
    </a>
</div>

@if ($user->jardinier->certifications->isEmpty())
    <div class="h-[90vh] p-6 w-full rounded-xl border-slate-300 border-1 hover:border-green-700">
        <h3 class="text-center font-medium text-slate-300 w-full p-4">Aucune certification ajouté </h3>
    </div>
@else

    @php
        $certifications = $user->jardinier->certifications;
    @endphp
    
    <div class="wishlist-grid">
        <!-- Certifications Item 1 -->
        @foreach ($certifications as $certification)
            <div class="wishlist-card" data-aos="fade-up" data-aos-delay="100">
                <div class="wishlist-image">
                    <img src="{{ asset('assets/img/product/product-1.webp') }}" alt="Product" loading="lazy">
                    <form action="{{route('jardinier.certification.destroy',$certification)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove" type="button" aria-label="Supprimer Certification">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
                <div class="wishlist-content">
                    <h4>{{ $certification->nom }}</h4>
                    <div class="flex justify-between items-center mb-1">
                        <div class="order-id">
                            <span class="font-semibold text-slate-700">Date d'obtention</span>
                        </div>
                        <div class="font-light text-slate-400">{{ $certification->date_obtention }}</div>
                    </div>
                    <div class="flex justify-between items-center mb-3">
                        <div class="order-id">
                            <span class="font-semibold text-slate-700">AWS AMAZONE</span>
                        </div>
                    </div>
                    <div class="w-full mx-auto">
                        <a href="{{route('jardinier.certification.edit',$certification)}}" class="rounded-md bg-yellow-500 text-white font-semibold px-2 py-1 w-full text-center">Modifier</a>
                    </div>
                </div>
            </div>
        @endforeach
    
    </div>

@endif
