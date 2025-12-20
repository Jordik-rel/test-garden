@php
    $user = Auth::user()
@endphp

<div class="col-lg-3">
    <div class="profile-menu collapse d-lg-block" id="profileMenu">
        <!-- User Info -->
        <div class="user-info" data-aos="fade-right">
            <div class="user-avatar">
                <img src="{{ asset('/assets/img/person/person-f-1.webp') }}" alt="Profile" loading="lazy">
                <span class="status-badge"><i class="bi bi-shield-check"></i></span>
            </div>
            <h4>{{ $user->prenom }} {{ $user->nom }}</h4>
            <div class="user-status">
                <i class="bi bi-award"></i>
                <span>Membre jardinier</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="menu-nav">
            <ul class="nav flex-column" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#freelancer">
                    <i class="bi bi-box-seam"></i>
                    <span>Freelancer</span>
                    <span class="badge">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#blog">
                    <i class="bi bi-heart"></i>
                    <span>Mon blog</span>
                    <span class="badge">12</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#payement">
                    <i class="bi bi-wallet2"></i>
                    <span>Méthodes de payement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#services">
                    <i class="bi bi-star"></i>
                    <span>Mes services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#adresses">
                    <i class="bi bi-geo-alt"></i>
                    <span>Addresses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#parametre">
                    <i class="bi bi-gear"></i>
                    <span>Paramètres</span>
                    </a>
                </li>
            </ul>

            <div class="menu-footer">
                <a href="#" class="help-link">
                    <i class="bi bi-question-circle"></i>
                    <span>Centre d'aide</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="logout-link"
                    >
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Se déconnecter</span>
                    </x-dropdown-link>
                </form>
                <!-- <a href="#" class="logout-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Se déconnecter</span>
                </a> -->
            </div>
        </nav>
    </div>
</div>