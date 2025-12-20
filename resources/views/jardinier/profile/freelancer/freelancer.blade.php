<!-- Freelancer Tab -->
@php 
    $user = Auth::user();
@endphp

@if ($user->jardinier)

     <div class="tab-pane fade show active" id="freelancer">
        @include('jardinier.profile.freelancer.description')
         <div class="orders-grid">
            @include('jardinier.profile.freelancer.presentation')

            @include('jardinier.profile.freelancer.certifications')

            @include('jardinier.profile.freelancer.experiences')

            @include('jardinier.profile.freelancer.etudes')
         </div>
     </div>
@else
    <div class="text-gray-600 italic flex justify-between items-center px-1">
        <p>Aucun profil jardinier n’a encore été créé.</p>
        <button class="bg-green-700 text-white font-light px-2 py-1 rounded-md" type="button" aria-label="ajouter" data-bs-toggle="modal" data-bs-target="#majouterModal">
                Ajouter un profil
        </button>
    </div>
@endif