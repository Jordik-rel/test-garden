@extends('jardinier.profile.base')

@section('title')
    <title>Postuler - Gardena Connect</title>
@endsection

@section('content')
    <div class="w-full my-6 max-w-5xl mx-auto bg-slate-50 p-6 space-y-2">
        <h1 class="text-xl font-bold text-slate-700 mb-3">Soumettre une proposition</h1>
        <form action="{{ route('jardinier.proposition.store',$projet) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="border rounded-lg p-6 bg-white mb-4">
                <!-- Title -->
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Détail du post</h2>
    
                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
    
                    <!-- Left section -->
                    <div class="flex-1">
    
                        <!-- Job title -->
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $projet->titre }}
                        </h3>
    
                        <!-- Category + Date -->
                        <div class="flex items-center gap-4 mt-2">
                            @forelse ($projet->competence as $competence)
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                    {{ $competence->nom }}
                                </span>
                            @empty
                                <span>Aucune compétence ajoutée</span>
                            @endforelse
    
                            <span class="text-sm text-gray-500">Posté {{ $projet->relative_date }}</span>
                        </div>
    
                        <!-- Description -->
                        <p class="text-gray-700 leading-relaxed mt-4">
                            {{$projet->description}}
                        </p>
    
                        <!-- Link -->
                        <a href="{{ route('jardinier.projet.show',$projet) }}" class="text-green-600 font-medium mt-4 inline-block hover:underline">
                            Consulter le projet
                        </a>
                    </div>
    
                    <!-- Right section -->
                    <div class="md:w-48 border-l md:pl-6 flex flex-col gap-6 text-sm">
    
                        <!-- Experience level -->
                        <div>
                            <div class="font-semibold text-gray-900"><i class="fa-solid fa-user-graduate mr-1"></i>Niveau d'entrée</div>
                            <div class="text-gray-500">
                                @switch($projet->niveau_experience)
                                    @case(1)
                                        Débutant
                                        @break
                                    @case(2)
                                        Intermédiaire
                                        @break
                                    @case(3)
                                        Expert  
                                        @break                              
                                    @default
                                        Non défini
                                @endswitch 
                            </div>
                        </div>
    
                        <!-- Budget -->
                        <div>
                            <div class="font-semibold text-gray-900"><i class="fa-solid fa-tags mr-1"></i>
                                @if ($projet->tarif_type == 0)
                                    {{ $projet->tarif_min }} - {{ $projet->tarif_max }} Franc CFA/heure
                                @else
                                    {{ $projet->budget }} Franc CFA 
                                @endif 
                            </div>
                            <div class="text-gray-500">
                                @switch($projet->tarif_type)
                                    @case(0)
                                        Prix horaire
                                        @break
                                    @case(1)
                                        Prix fixe
                                        @break
                                    @default
                                        Aucun tarif spécifié
                                @endswitch
                            </div>
                        </div>
    
                        <!-- Duration -->
                        <div>
                            <div class="font-semibold text-gray-900"> <i class="fa-regular fa-calendar mr-1"></i>
                                @switch($projet->duree)
                                    @case(1)
                                        Moins 1 mois
                                        @break
                                    @case(2)
                                        1 à 3 mois
                                        @break
                                    @case(3)
                                        3 à 6 mois
                                        @break
                                    @case(4)
                                        Plus de 6 mois 
                                        @break
                                    @default
                                        Non défini
                                @endswitch
                            </div>
                            <div class="text-gray-500">Durée</div>
                        </div>
                    </div>
    
                </div>
            </div>
    
            <div class="border rounded-lg p-6 bg-white mb-4">
        
                <!-- Title -->
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Conditions</h2>
    
                <p class="text-gray-700 mb-6">
                    Quel est le montant total que vous souhaitez proposer pour ce travail ?
                </p>
    
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-10">
    
                    <!-- Left section (Inputs) -->
                    <div x-data="{
                            offre: {{ $projet->tarif_type == 0 ? $projet->tarif_min : $projet->budget }},
                            feeRate: 0.10,
    
                            get fee() {
                                return this.offre * this.feeRate;
                            },
                            get receive() {
                                return this.offre - this.fee;
                            }
                        }" 
                        class="flex-1 space-y-6"
                    >
                        <!-- Alerte si montant reçu <= 0 -->
                        <div x-show="receive <= 0" 
                            class="p-3 rounded-lg bg-red-100 text-red-700 border border-red-300 text-sm">
                            ⚠️ Le montant que vous recevrez doit être supérieur à 0.
                        </div>
    
                        <!-- Offre -->
                        <div>
                            <div class="mb-3">
                                <label for="offre" class="text-black font-semibold px-1 mb-1">Offre</label>
    
                                <input 
                                    type="number"
                                    id="offre"
                                    name="tarif_propose"
                                    class="form-control @error('tarif_propose') is-invalid @enderror"
                                    x-model.number="offre"
                                    min="0"
                                >
                                @error('tarif_propose')
                                    <div class="text-red-600 text-sm mt-1"> {{ $message }} </div>
                                @enderror
                            </div>
    
                            <p class="text-sm text-gray-500 mt-1">
                                Montant total que le client verra sur votre proposition
                            </p>
                        </div>
    
                        <!-- Service fee -->
                        <div>
                            <label class="block text-gray-900 font-medium mb-1">10% Frais de service pour les jardiniers</label>
    
                            <div class="flex justify-between items-center border rounded-lg px-4 py-2 bg-gray-100">
                                <span class="text-gray-400">
                                    - <span x-text="fee.toFixed(0)"></span> Franc CFA
                                </span>
                            </div>
    
                            <p class="text-sm text-gray-500 mt-1">
                                Ces frais sont fixes pendant toute la durée du contrat.
                            </p>
                        </div>
    
                        <!-- Vous percevez -->
                        <div>
                            <label class="block text-gray-900 font-medium mb-1">Vous percevez</label>
    
                            <div class="flex justify-between items-center border rounded-lg px-4 py-2 bg-gray-50">
                                <span class="text-gray-700">
                                    <span x-text="receive.toFixed(0)"></span> Franc CFA
                                </span>
                            </div>
    
                            <p class="text-sm text-gray-500 mt-1">
                                Le montant estimé que vous recevrez après déduction des frais de service
                            </p>
                        </div>
    
                    </div>
    
    
                    <!-- Right section (Badge illustration + info) -->
                    <div class="flex flex-col items-center text-center md:w-40 pt-6 md:pt-0">
                        <img src="{{ asset('logo.png') }}"
                            class="w-20 opacity-80" alt="Green Connect Logo">
                        
                        <p class="text-gray-600 text-sm mt-3">
                            Comprendre la protection à prix fixe Green Connect.
                        </p>
    
                        <a href="#" class="text-green-600 text-sm font-medium hover:underline">
                            Apprendre plus
                        </a>
                    </div>
    
                </div>
            </div>
    
            <!-- How long will this project take? -->
            <div class="border rounded-xl p-6 mb-6 bg-white">
                <label class="block text-gray-700 font-medium mb-3">
                    Combien de temps de temps ce projet vous prendrait?
                </label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white 
                            focus:ring-1 focus:ring-green-600 focus:border-green-600 outline-none"
                            name="duree"
                >
                    <option>Sélectionnez une durée</option>
                    <option value="1" {{ old('duree' , $projet->duree) == 1 ? 'selected' : '' }} >Moins d'un mois</option>
                    <option value="2" {{ old('duree' , $projet->duree) == 2 ? 'selected' : '' }} >Entre 1 et 3 mois</option>
                    <option value="3" {{ old('duree' , $projet->duree) == 3 ? 'selected' : '' }} >Entre 3 et 6 mois</option>
                    <option value="4" {{ old('duree' , $projet->duree) == 4 ? 'selected' : '' }} >Plus de 6 mois</option>
                </select>
                @error('duree')
                    <div class="text-red-600 text-sm mt-1">{{$message}}</div>
                @enderror
            </div>
    
    
            <!-- Additional Details -->
            <div class="border rounded-xl p-6 bg-white">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Informations addditionnelle</h2>
                <div class="mb-4">
                    <!-- Cover Letter Label -->
                    <label class="block text-gray-700 font-medium mb-2">Motivation</label>
        
                    <!-- Textarea -->
                    <textarea
                        class="w-full h-48 @error('message') is-invalid @enderror border border-gray-300 rounded-lg p-4 resize-none 
                            focus:ring-1 focus:ring-green-600 focus:border-green-600 outline-none"
                        placeholder="Expliquez pourquoi vous êtes la personne la plus qualifiée pour ce projet..."
                        name="message" 
                    ></textarea>
                    @error('message')
                        <div class="text-red-600 text-sm mt-1"> {{ $message }} </div>
                    @enderror
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Pièces jointes</h2>
                <p class="text-sm font-medium mb-4">
                    Ajoutez des exemples de votre travail pour renforcer votre proposition. 
                    Veuillez supprimer toutes vos coordonnées, car leur divulgation avant la signature d'un contrat est contraire à notre politique.
                </p>
                <div>
                    <label for="piece" class="form-label block text-gray-700 font-medium mb-2">Jusqu'à 3 fichiers (4 Mo maximum chacun)</label>
                     <input type="file" name="support[]" multiple id="piece"
                                    class="w-full form-control @error('support') is-invalid @enderror @error('support.*') is-invalid @enderror border rounded-lg p-2 focus:ring-1 focus:ring-green-700 focus:outline-none">
                    @error('support')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    @error('support.*')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex items-center space-x-6 mt-6">
    
                <!-- Submit button -->
                <button 
                    type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold 
                        px-6 py-2 rounded-md transition">
                    Soumettre ma proposition
                </button>
    
                <!-- Cancel link -->
                <a href="{{ route('jardinier.dashboard') }}" class="text-green-600 font-medium">
                    Annuler
                </a>
    
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection