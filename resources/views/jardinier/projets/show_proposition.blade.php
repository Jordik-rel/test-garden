@extends('jardinier.profile.base')

@section('title')
    <title>Ma proposition - Gardena Connect</title>
@endsection

@section('content')
    <div class="px-6 py-10 max-w-7xl mx-auto space-y-4">
        <div class="space-x-6 grid grid-cols-1 gap-6 md:flex ">
            <div class="w-[60%]">
                <h2 class="text-2xl font-semibold mb-6">Détails de la proposition</h2>
    
                <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <h3 class="text-xl font-semibold mb-2">Tarif proposé</h3>
                        <p class="text-gray-700">{{ $proposition->tarif_propose }} FCFA</p>
                    </div>
                    <div class="p-6 border-b">
                        <h3 class="text-xl font-semibold mb-2">Délai estimé</h3>
                        <p class="text-gray-700">
                            @switch($proposition->duree)
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
                        </p>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Lettre de motivation</h3>
                        <p class="text-gray-700 p-4 border-1 border-slate-300 rounded-md hover:border-green-600">{{ $proposition->message }}</p>
                    </div>
                </div>
                        
            </div>
            <div class="w-[40%]">
                
            </div>
        </div>
        <div class="flex justify-between items-start mb-2">
            <div class="border-1 px-4 py-2 rounded-md border-slate-300 bg-slate-200 text-slate-700 font-medium">
                <a href="{{ route('jardinier.soumissions') }}" class="hover:text-slate-700">Retour</a>
            </div>
            <!-- <div>
                <button class="bg-green-600 text-white font-semibold rounded-md px-4 py-2">Analyser</button>
            </div> -->
        </div>
    </div>
@endsection