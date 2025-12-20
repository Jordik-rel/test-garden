@extends('particulier.particulier')

@section('title')
    <title>Noter jardinier - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="px-6 py-10 max-w-7xl mx-auto space-y-6">

        <h2 class="text-xl text-center font-semibold py-4">Mes avis</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($avis as $avi)
                <div class="border border-slate-200 shadow-sm rounded-xl p-5 bg-white hover:shadow-md transition-all">
                    
                    {{-- NOTE (Étoiles) --}}
                    <div class="flex justify-between">
                        <div class="flex space-x-1 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star 
                                    text-xl 
                                    {{ $i <= $avi->note ? 'text-yellow-400' : 'text-gray-300' }}">
                                </i>
                            @endfor
                        </div>
                        <div>
                            <h2 class="text-gray-700 text-sm mb-3 font-bold">{{ $avi->jardinier->user->prenom }} {{ $avi->jardinier->user->nom }}</h2>
                        </div>
                    </div>

                    {{-- COMMENTAIRE --}}
                    <p class="text-gray-700 text-sm mb-3">
                        {{ $avi->commentaire ?? 'Pas de commentaire.' }}
                    </p>

                    {{-- INFOS --}}
                    <div class="text-xs text-gray-500 flex justify-between items-center">
                        <span>
                            Projet : 
                            <strong>{{ $avi->projet->titre ?? '—' }}</strong>
                        </span>
                        <span>{{ $avi->created_at->format('d/m/Y') }}</span>
                    </div>

                </div>
            @empty
                <div class="w-full border border-slate-200 hover:border-green-600 py-6 text-center font-medium rounded-lg">
                    Aucun avis
                </div>
            @endforelse
        </div>

    </div>
@endsection
