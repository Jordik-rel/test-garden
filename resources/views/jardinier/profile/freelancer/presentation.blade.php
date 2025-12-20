<div class="order-card" data-aos="fade-up" data-aos-delay="100">
    <div class="order-content">
        <div class="order-info">
            Good morning ! I am {{ $user->prenom  }} {{ $user->nom }} , a {{ $user->jardinier->profession }} {{ $user->jardinier->description }}.
        </div>
    </div>
    <div class="order-footer">
        <button type="button" class="btn-track" data-bs-toggle="collapse" data-bs-target="#competence1" aria-expanded="false">Mes Compétences</button>
        <button type="button" class="btn-details" data-bs-toggle="collapse" data-bs-target="#realisation1" aria-expanded="false">Mes réalisations antérieurs</button>
    </div>

    @include('jardinier.profile.freelancer.competences')

    @include('jardinier.profile.freelancer.realisations')

</div>