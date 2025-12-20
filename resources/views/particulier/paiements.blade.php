@extends('particulier.particulier')

@section('title')
    <title>Paiement du projet - Gardena Connect</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
@endsection

@section('particulierContent')
    <div class="container py-5 px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-start">
            <!-- Récapitulatif du projet -->
            <div class="mr-4">
                <div class="px-2 py-3 rounded-t-md bg-green-700 text-white">
                    <h5 class="text-center text-lg font-medium">Récapitulatif du projet</h5>
                </div>
                <div class="px-3 py-2 space-y-2">
                    <div class="mb-2 space-y-2">
                        <h2 class="flex justify-between items-center text-lg font-semibold">Titre du projet : <span class="font-medium">{{ $mission->projet->titre }}</span></h2>
                        <h3 class="flex flex-col text-lg font-semibold">Description : <span class="text-sm text-gray-700 font-medium">{{ Str::limit($mission->projet->description, 100) }}</span></h3>
                    </div>
                    <div class="mb-2 space-y-2">
                        <h2 class="flex justify-between items-center text-lg font-semibold">Jardinier sélectionné : <span class="font-light text-sm">{{ $mission->jardinier->user->prenom }} {{ $mission->jardinier->user->nom }}</span></h2>
                        <h4 class="flex justify-between items-center font-semibold">Téléphone : <span class="font-light text-sm"> {{ $mission->jardinier->user->telephone }}</span></h4>
                        <h4 class="flex justify-between items-center font-semibold mb-2">Date de début : <span class="font-light text-sm"> {{ $mission->date_debut ? \Carbon\Carbon::parse($mission->date_debut)->format('d/m/Y') : 'À définir' }}</span></h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-slate-700">Montant à payer : <span class="text-green-800 font-light text-[14px] bg-green-100 py-1 px-2 rounded-full">{{ number_format($mission->montant, 0, ',', ' ') }} FCFA</span></h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <small class="text-muted">Commission plateforme (10%): {{ number_format($mission->montant * 0.10, 0, ',', ' ') }} FCFA</small><br>
                            <small class="text-muted">Montant jardinier: {{ number_format($mission->montant * 0.90, 0, ',', ' ') }} FCFA</small>
                        </div>
                    </div>
                </div>
                 <!-- Informations de sécurité -->
                <div class="mt-4 px-3 py-2">
                    <div class="card-body space-y-2">
                        <h6 class="text-lg font-semibold"><i class="fas fa-shield-alt text-green-700 mr-2"></i> Paiement sécurisé</h6>
                        <p class="text-sm font-medium text-gray-700">
                            Vos données sont protégées. L'argent sera bloqué sur la plateforme jusqu'à la validation des travaux.
                            Le jardinier recevra son paiement uniquement après votre confirmation de satisfaction.
                        </p>
                    </div>
                </div>
            </div>

            <div class="">
                <!-- Méthodes de paiement -->
                <div class="bg-slate-50 px-4 py-6 rounded-sm shadow-sm">
                    <form action="{{ route('particulier.paiement.mission',$mission) }}" method="post">
                        @csrf
                        <div class="">
                            <h5 class="text-xl text-center py-4 font-semibold text-slate-700">Choisissez votre méthode de paiement</h5>
                        </div>
                        <div x-data="{ tab: 'mobile' }" class="w-full max-w-xl mx-auto mt-6">
    
                            <!-- Inputs radio réels mais invisibles -->
                            <input type="radio" name="payment_method" value="mobile" x-model="tab" class="hidden">
                            <input type="radio" name="payment_method" value="card" x-model="tab" class="hidden">
                            <input type="radio" name="payment_method" value="direct" x-model="tab" class="hidden">
    
                            <!-- Tabs -->
                            <div class="grid grid-cols-3 gap-3">
    
                                <!-- Mobile Money -->
                                <label 
                                    @click="tab = 'mobile'"
                                    class="p-4 border rounded-xl cursor-pointer flex flex-col items-center text-center transition hover:shadow"
                                    :class="tab === 'mobile' ? 'border-green-600 bg-green-600 text-white shadow-md' : 'border-gray-300'"
                                >
                                    <i class="fa-solid fa-money-bill-transfer text-lg mb-2"
                                        :class="tab === 'mobile' ? 'text-green-100' : 'text-green-600'">
                                    </i>
                                    <p class="font-semibold text-sm">Mobile Money</p>
                                    <p class="text-xs" :class="tab === 'mobile' ? 'text-slate-300' : 'text-slate-600'">
                                        MTN, Moov, Orange…
                                    </p>
                                </label>
    
                                <!-- Carte bancaire -->
                                <label 
                                    @click="tab = 'card'"
                                    class="p-4 border rounded-xl cursor-pointer flex flex-col items-center text-center transition hover:shadow"
                                    :class="tab === 'card' ? 'border-green-600 bg-green-600 text-white shadow-md' : 'border-gray-300'"
                                >
                                    <i class="fa-solid fa-credit-card text-xl mb-2"
                                        :class="tab === 'card' ? 'text-green-100' : 'text-green-600'">
                                    </i>
                                    <p class="font-semibold text-sm">Carte bancaire</p>
                                    <p class="text-xs" :class="tab === 'card' ? 'text-slate-300' : 'text-slate-600'">
                                        Visa, Mastercard…
                                    </p>
                                </label>
    
                                <!-- Débit direct -->
                                <label 
                                    @click="tab = 'direct'"
                                    class="p-4 border rounded-xl cursor-pointer flex flex-col items-center text-center transition hover:shadow"
                                    :class="tab === 'direct' ? 'border-green-600 bg-green-600 text-white shadow-md' : 'border-gray-300'"
                                >
                                    <i class="fa-solid fa-mobile text-xl mb-2"
                                        :class="tab === 'direct' ? 'text-green-100' : 'text-green-600'">
                                    </i>
                                    <p class="font-semibold text-sm">Débit direct</p>
                                    <p class="text-xs" :class="tab === 'direct' ? 'text-slate-300' : 'text-slate-600'">
                                        Wave, UBA, EcoBank…
                                    </p>
                                </label>
    
                            </div>
    
                            <!-- Mobile Money Content -->
                            <div x-show="tab === 'mobile'" x-data="{ selectedNetwork: '' }" class="mt-2">
    
                                <!-- Input hidden pour soumettre la valeur -->
                                <input type="hidden" name="network" :value="selectedNetwork">
                                @error("network")
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
    
                                <!-- Logos cliquables -->
                                <div class="flex space-x-8 justify-center items-center mt-3">
    
                                    <!-- MTN -->
                                    <div 
                                        @click="selectedNetwork = 'mtn'"
                                        class="p-1 rounded-full cursor-pointer transition"
                                        :class="selectedNetwork === 'mtn' ? 'border-4 border-green-600 bg-green-50' : 'border-2 border-transparent'"
                                    >
                                        <img src="{{ asset('images/Momo.png') }}" class="w-18 h-18 object-fit rounded-full shadow">
                                    </div>
    
                                    <!-- MOOV -->
                                    <div 
                                        @click="selectedNetwork = 'moov'"
                                        class="p-1 rounded-full cursor-pointer transition"
                                        :class="selectedNetwork === 'moov' ? 'border-4 border-green-600 bg-green-50' : 'border-2 border-transparent'"
                                    >
                                        <img src="{{ asset('images/moov.png') }}" class="w-18 h-18 object-fit rounded-full shadow">
                                    </div>
    
                                    <!-- CELTIIS -->
                                    <div 
                                        @click="selectedNetwork = 'celtiis'"
                                        class="p-1 rounded-full cursor-pointer transition"
                                        :class="selectedNetwork === 'celtiis' ? 'border-4 border-green-600 bg-green-50' : 'border-2 border-transparent'"
                                    >
                                        <img src="{{ asset('images/celtiis.png') }}" class="w-18 h-18 object-fit rounded-full shadow">
                                    </div>
                                </div>
    
                                <!-- Formulaire -->
                                <div class="flex flex-col space-y-3 mt-3">
                                    <label for="money" class="px-1 text-slate-600 font-medium">
                                        Numéro de téléphone <span class="text-red-600">*</span>
                                    </label>
    
                                    <input type="text" name="phone" id="money" placeholder="Ex: 0196123456" 
                                        class="border-1 border-slate-400 rounded-md focus:border-green-700 focus:outline-none focus:ring-0"
                                        required>
                                    @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <p class="text-sm font-light text-slate-800">
                                        Format: 10 chiffres 01(96/97/98/99/90/91...)
                                    </p>
    
                                    <button type="submit"
                                        id="pay-btn"
                                        class="w-full py-2 text-center font-semibold bg-green-700 text-white rounded-md"
                                    >
                                        <i class="fa-solid fa-lock mr-2"></i> 
                                        Payer {{ $mission->montant }} Franc CFA
                                    </button>
                                </div>
                            </div>
    
    
                            <!-- Carte Bancaire Content -->
                            <div x-show="tab === 'card'" class="mt-4 p-4 border rounded-xl bg-white">
                                <p class="text-sm font-semibold">Paiement par carte bancaire</p>
                                <p class="text-xs text-gray-600 mt-1">Visa, Mastercard…</p>
                            </div>
    
                            <!-- Débit Direct Content -->
                            <div x-show="tab === 'direct'" class="mt-4 p-4 border rounded-xl bg-white">
                                <p class="text-sm font-semibold">Débit direct bancaire</p>
                                <p class="text-xs text-gray-600 mt-1">Wave, UBA, Ecobank…</p>
                            </div>
    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pay-btn').addEventListener('click', function() {
            // récupérer le numéro
            document.getElementById('phone-hidden').value = document.getElementById('money').value;

            // récupérer le réseau sélectionné (géré par Alpine)
            document.getElementById('network-hidden').value = document.querySelector('input[name="network"]').value;
        });
    </script>

@endsection
