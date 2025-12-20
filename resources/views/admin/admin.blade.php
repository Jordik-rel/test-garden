<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        @yield('title')
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <!-- <link href="/public/css/styles.css" rel="stylesheet" /> -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-green-600">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">
               <img src="{{ asset('logo.png') }}" 
                    class="img-fluid object-contain" 
                    style="max-height: 85px;" 
                    alt="Logo Green Connect"
                >
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Paramètre</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="logout-link dropdown-item"
                                >
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Se déconnecter</span>
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu px-2">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <!-- <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Général
                            </a> -->
                            <div class="px-3  ">
                                <div class="sb-sidenav-menu-heading text-lg uppercase text-start border-b-[1px] border-b-slate-200">Général</div>
                                <ul class="p-0 list-none">
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.plant.index') }}">Bibliothèque</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{route('admin.invalidate')}}">Blog</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="px-3  ">
                                <div class="sb-sidenav-menu-heading text-lg uppercase text-start border-b-[1px] border-b-slate-200">Projets</div>
                                <ul class="p-0 list-none">
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.projet.index') }}">Les projets</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.mission.index') }}">Gestion des projets</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="px-3  ">
                                <div class="sb-sidenav-menu-heading text-lg uppercase text-start border-b-[1px] border-b-slate-200">Sécurité</div>
                                <ul class="p-0 list-none">
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.particulier.index') }}">Particuliers</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.jardinier.index') }}">Jardiniers</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="">Rôles</a>
                                    </li>
                                </ul>
                            </div>
                             <div class="px-3  ">
                                <div class="sb-sidenav-menu-heading text-lg uppercase text-start border-b-[1px] border-b-slate-200">Indispensable</div>
                                <ul class="p-0 list-none">
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.categorie.index') }}">Catégories plantes</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.vertu.index') }}">Vertus médicinales</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.valeur.index') }}">Valeur nutrtionnelles</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="px-3  ">
                                <div class="sb-sidenav-menu-heading text-lg uppercase text-start border-b-[1px] border-b-slate-200">Journal</div>
                                <ul class="p-0 list-none">
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="layout-static.html">Accès projets</a>
                                    </li>
                                    <li>
                                        <a class="nav-link fs-6 fw-light" href="{{ route('admin.projet.archive') }}">Archive</a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="mt-8 px-5">
                    @if(session("succes"))
                        <div class="alert alert-success flex align-items-center justify-center h-fit" role="alert">
                            <i class="fa-regular fa-circle-check mr-2"></i>
                            <div class="mb-1 text-green-700 ">
                                {{ session("succes") }}
                            </div>
                        </div>
                    @endif
                    @if(session("update"))
                        <div class="alert alert-warning flex align-items-center justify-center h-fit" role="alert">
                            <i class="fa-regular fa-circle-check mr-2"></i>
                            <div class="mb-1 text-orange-600 ">
                                {{ session("update") }}
                            </div>
                        </div>
                    @endif
                    @if (session("message"))
                        <div class="alert alert-success flex align-items-center justify-center h-fit" role="alert">
                            <i class="fa-regular fa-circle-check mr-2"></i>
                            <div class="mb-1 text-white ">
                                {{ session("message") }}
                            </div>
                        </div>
                    @endif
                    @if(session("error"))
                        <div class="alert alert-danger flex align-items-center justify-center h-fit" role="alert">
                            <div class="mb-1 text-red-800 ">
                                <i class="fa-regular fa-danger mr-2"></i>
                                {{ session("error") }}
                            </div>
                        </div>
                    @endif
                    @yield("adminContent")
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Gardena Connect 2025 <span class="ml-2">Réalisé par MIKA_Technologie</span></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/datatables-simple-demo.js') }}"></script>
        <script src="{{ asset('/js/datatables-simple-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/datatables-simple-demo.js') }}"></script>
    </body>
</html>