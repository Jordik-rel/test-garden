<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        @yield('title')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <!-- <link href="/public/css/styles.css" rel="stylesheet" /> -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        @vite('resources/css/app.css')
        <style>
            ul {
                list-style: none;
                /* padding-left: 0;
                margin: 0; */
            }
            .form-control:focus {
                box-shadow: none !important;
                border-color: inherit !important;
            }
        </style>
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js"></script>
    </head>
    <body>
        @php
            $user = Auth::user();
        @endphp
        <header class="bg-white text-grey-400 px-6 py-3 flex items-center justify-between w-full">

            <!-- Logo -->
            <div class="text-green-700 font-bold">
                <a href="{{ route('particulier.dashboard') }}"><img src="{{asset('logo.png')}}" alt="Logo" class="object-fill h-12 w-15"></a>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex gap-6 text-sm text-green-700 font-extralight">
                <a href="#" class="no-underline text-green-700">Embaucher des talents</a>
                <a href="{{ route('particulier.projet.index') }}" class="no-underline text-green-700">Gérer le travail</a>
                <a href="{{ route('particulier.projets.rapport') }}" class="no-underline text-green-700">Rapports</a>
                <a href="{{ route('particulier.projets.historisques') }}" class="no-underline text-green-700">Historiques</a>
            </nav>

            <div class="flex items-center border border-gray-300 rounded-full overflow-hidden bg-white">
                <!-- Icon + Input -->
                <div class="flex items-center px-4 gap-2">
                    <!-- Icône recherche -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>

                    <!-- Input -->
                    <input 
                        type="text" 
                        placeholder="Recherche"
                        class="outline-none border-0 ring-0 focus:ring-0 focus:outline-none text-sm py-2 w-56"
                    >
                </div>
            </div>


            <div class="flex items-center gap-5 text-lg">
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
                class="hidden absolute right-4 top-16 w-25 bg-white rounded-2xl shadow-xl border p-4 z-50">

                <!-- Header -->
                <div class="flex items-center justify-start">
                    <i class="fa-regular fa-circle-user text-xl mr-2"></i>
                    <p class="font-semibold text-lg">{{ $user->username }}</p>
                </div>

                <!-- Menu items -->
                <a href="{{ route('particulier.settings.profile') }}" class="mt-2 flex items-center gap-3 cursor-pointer hover:text-gray-600">
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

        </header>
        <div class="px-4">
            @if(session("succes"))
                <div class="alert alert-success flex align-items-center justify-center h-fit" role="alert">
                        {{ session("succes") }}
                </div>
            @endif

            @if(session("update"))
                <div class="alert alert-warning flex align-items-center justify-center h-fit" role="alert">
                        {{ session("update") }}
                </div>
            @endif
    
            @if(session("error"))
                <div class="alert alert-danger flex align-items-center justify-center h-fit" role="alert">
                        {{ session("error") }}
                </div>
            @endif
        </div>
        
        @yield('particulierContent')
        
        <!-- Script minimal pour toggle -->
        <script>
            document.getElementById("userMenuBtn").onclick = () => {
                document.getElementById("userMenu").classList.toggle("hidden");
            };
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                document.querySelectorAll('select[multiple]').forEach(function (selectElement) {
                    new TomSelect(selectElement, {
                        plugins: {
                            remove_button: { title: 'Supprimer' }
                        }
                    });
                });

            });
        </script>
    </body>
</html>