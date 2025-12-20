@extends('particulier.particulier')

@section('title')
    <title>Carte de Payements - Gardena Connect</title>
@endsection

@section('particulierContent')
    <h2 class="text-xl py-2 text-end px-10 font-extralight">Parametre / Cartes de payements</h2>

    <div class="min-h-screen flex justify-center py-10">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- 🟩 SIDEBAR À GAUCHE -->
            <div class="md:col-span-1">
                @include('particulier.settings.setting')
            </div>
            <div class="md:col-span-3 space-y-2">
                <div class=" flex justify-end items-center">
                    <button class=" px-2 py-1 bg-green-600 text-white font-medium text-center rounded-md"><a href="{{ route('particulier.settings.payement.create')}}" class="hover:text-white">+ Nouvelle Carte</a></button>
                </div>
                <div class="grid {{ $payements->isEmpty() ? '' : 'grid-cols-1 md:grid-cols-2' }} gap-6">
                    @forelse ($payements as $payement)
                        <div class="w-full bg-white border border-gray-300 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                            <!-- HEADER -->
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600 text-xl flex items-center justify-between space-x-4">
                                    <div>
                                        <i class="fa-solid fa-credit-card"></i>
                                    </div>
                                </div>
                                <div class="space-x-2">
                                    @if ($payement->status)
                                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700 font-medium mr-2">
                                            Adresse par défaut
                                        </span>
                                    @endif
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600 font-semibold">
                                        {{$payement->reseau}}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- CARD NUMBER -->
                            <div class="mt-4 text-xl font-semibold text-gray-800">
                                {{ $payement->numéro }}
                            </div>
    
                            <!-- DATE -->
                            <p class="text-gray-500 text-sm mt-2">
                                Ajouté le {{ $payement->created_at }}
                            </p>
    
                            <!-- ACTION BUTTONS -->
                            <div class="flex flex-wrap gap-3 mt-5">
    
                                <!-- Modifier -->
                                <a href="{{ route('particulier.settings.payement.edit',$payement) }}" 
                                     class="flex items-center gap-1 px-3 py-1.5 bg-orange-600 text-white rounded-md text-sm hover:bg-orange-700">
                                    <i class="bi bi-pencil"></i>
                                    Modifier
                                </a>
    
                                <!-- Supprimer -->
                                <form action="{{route('particulier.settings.payement.destroy',$payement)}}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
    
                                <!-- Définir comme carte -->
                                 @if (!$payement->status)
                                    <form action="{{route('particulier.settings.payement.default',$payement)}}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-gray-700 text-white rounded-md text-sm hover:bg-black">
                                            Définir par défaut
                                        </button>
                                    </form>
                                @endif
                            </div>
    
                        </div>
                    @empty
                        <div class="h-[70vh] flex items-center justify-center bg-white border border-gray-200 hover:border-green-600 hover:border-1 rounded-xl">
                            <h3 class="text-center font-medium text-gray-400">Aucune moyen de paiement ajouté</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection