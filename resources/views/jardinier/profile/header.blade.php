@php
  $user = Auth::user();
@endphp

<header id="header" class="header sticky-top">
  <nav class="w-full h-[100px] flex flex-col justify-between">
      <div class="flex justify-end items-center w-full bg-green-600 h-fit text-white font-semibold p-3 max-md:justify-between">
          <div class="flex items-center border-r-2 border-white px-2">
              <a href="#" class="text-white">Accéder au support</a>
          </div>
          <div class="flex items-center px-2">
              <a href="#" class="text-white">+ 229 01 XX XX XX XX</a>
          </div>
      </div>
      <div class="flex justify-between items-center p-2 bg-slate-50">
        <a href="{{ route('jardinier.dashboard') }}">
          <img src="{{ asset('logo.png') }}" alt="Logo Gardena" class="h-20 object-fit">
        </a>
        <div class="flex justify-between items-center space-x-6 text-sm font-medium hover:text-gray-600">
          <a href="{{ route('jardinier.projets') }}">Projets</a>
          <a href="{{ route('jardinier.soumissions') }}">Mes Propositions</a>
          <a href="{{ route('jardinier.historisques') }}">Historiques réalisations</a>
        </div>
        <div class="flex items-center gap-4 text-lg">
            <!-- Aide -->
            <i class="fa-regular fa-circle-question cursor-pointer"></i>

            <!-- Notifications -->
            <i class="fa-regular fa-bell cursor-pointer"></i>

            <!-- Avatar (ouvre menu) -->
            <button id="userMenuBtn">
                <i class="fa-regular fa-circle-user cursor-pointer"></i>
            </button>
        </div>
        <!-- Dropdown -->
        <div id="userMenu"
            class="hidden absolute right-5 top-35 w-25 bg-white rounded-2xl shadow-xl border p-4 z-50">

            <!-- Header -->
            <div class="flex items-center justify-start space-x-4">
                <i class="fa-regular fa-circle-user text-xl mr-2"></i>
                <p class="font-semibold text-lg">{{ $user->username }}</p>
            </div>

            <!-- Menu items -->
            <a href="{{ route('jardinier.myaccount') }}" class="mt-2 flex items-center gap-3 cursor-pointer hover:text-gray-600">
                <i class="fa-solid fa-gear text-gray-600"></i>
                <span>Paramètres du compte</span>
            </a>

            <!-- Separator -->
            <div class="border-t my-2"></div>

            <!-- Logout -->
            <div class="flex items-center gap-3 cursor-pointer text-red-600">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="logout-link dropdown-item"
                    >
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Se déconnecter</span>
                    </x-dropdown-link>
                </form>
            </div>
        </div>
      </div>
  </nav>
</header>

