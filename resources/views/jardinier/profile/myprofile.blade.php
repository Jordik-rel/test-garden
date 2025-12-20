@extends('jardinier.profile.base')

@section('title')

<title>Mon compte - Green Connect</title>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

@endsection

@section('content')

  <main class="main">

      <!-- Page Title -->
      <div class="page-title bg-green-900 text-white">
          <div class="container d-lg-flex justify-content-between align-items-center">
              <h1 class="mb-2 mb-lg-0 text-white">Mon compte</h1>
              <nav class="breadcrumbs">
                  <ol>
                      <li><a href="{{ route('jardinier.dashboard') }}" class="text-white">Tableau de bord</a></li>
                      <li class="current">Mon compte</li>
                  </ol>
              </nav>
          </div>
      </div>
      <!-- End Page Title -->

      <!-- Account Section -->
      <section id="account" class="account section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <!-- Mobile Menu Toggle -->
          <div class="mobile-menu d-lg-none mb-4">
            <button class="mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu">
              <i class="bi bi-grid"></i>
              <span>Menu</span>
            </button>
          </div>

          <div class="row g-4">
            <!-- Profile Menu -->
            @include('jardinier.profile.profilemenu')

            <!-- Content Area -->
            <div class="col-lg-9">
              <div class="content-area">
                <div class="tab-content">
                  @if (session('succes'))
                      <div class="alert alert-success text-center p-2 rounded-md bg-green-100 text-green-800">
                          {{ session('succes') }}
                      </div>
                  @endif
                  
                  @if (session('update'))
                      <div class="alert alert-warning text-center p-2 rounded-md bg-yellow-100 text-yellow-800">
                          {{ session('update') }}
                      </div>
                  @endif

                  @if (session('delete'))
                      <div class="alert alert-danger text-center p-2 rounded-md bg-red-100 text-red-800">
                          {{ session('delete') }}
                      </div>
                  @endif
                  
                  <!-- Freelancer Tab -->
                  @include('jardinier.profile.freelancer.freelancer')

                  <!-- Blog Tab -->
                  @include('jardinier.profile.blog.blog')

                  <!-- Payment Methods Tab -->
                  @include('jardinier.profile.payement.payement')

                  <!-- Service Tab -->
                  @include('jardinier.profile.service.service')

                  <!-- Addresses Tab -->
                  @include('jardinier.profile.adresse.adresse')

                  <!-- Settings Tab -->
                  @include('jardinier.profile.parametre.parametre')
                </div>
              </div>
            </div>
          </div>

        </div>

      </section><!-- /Account Section -->

  </main>

@endsection