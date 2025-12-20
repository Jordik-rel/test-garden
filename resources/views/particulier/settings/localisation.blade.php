@extends('particulier.particulier')

@section('title')
<title>Ma Localisation - Gardena Connect</title>
@endsection

@section('particulierContent')

<h2 class="text-xl py-2 text-end px-10 font-extralight">Parametre / Localisation</h2>

<div class="min-h-screen flex justify-center py-10">

    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- 🟩 SIDEBAR -->
        <div class="md:col-span-1">
            @include('particulier.settings.setting')
        </div>

        <!-- 🟦 CONTENT -->
        <div class="md:col-span-3 space-y-2">
            <div class=" flex justify-end items-center">
                <button class=" px-2 py-1 bg-green-600 text-white font-medium text-center rounded-md"><a href="{{ route('particulier.settings.create_localisation')}}" class="hover:text-white">+ Localisation</a></button>
            </div>
            @if ($user->localisation->isEmpty())
                <!-- EMPTY STATE -->
                <div class="h-[70vh] flex items-center justify-center bg-white border border-gray-200 rounded-xl">
                    <h3 class="text-center font-medium text-gray-400">Aucune adresse ajoutée</h3>
                </div>

            @else
                @php
                    $localisations = $user->localisation;
                @endphp

                <!-- GRID RESPONSIVE -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @foreach ($localisations as $localisation)

                        <div class="bg-white shadow rounded-xl p-5 border {{ $localisation->status ? 'border-green-500' : 'border-gray-200' }}">

                            <!-- HEADER -->
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-800">Localisation</h4>

                                @if ($localisation->status)
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700 font-medium">
                                        Adresse par défaut
                                    </span>
                                @endif
                            </div>

                            <!-- ADDRESS BODY -->
                            <div class="mt-4 text-gray-600 space-y-1">
                                <p class="leading-5 space-y-1 flex flex-col">
                                    <span class="font-light">{{ $localisation->quartier }}, {{ $localisation->ville }}  </span>
                                    <span class="font-medium">République du Bénin </span>
                                </p>

                                <div class="mt-3 pt-3 border-t border-gray-200 space-y-2 text-sm">
                                    <div class="flex items-center gap-2 font-semibold">
                                        <i class="fa-solid fa-user text-green-500"></i>
                                        <span>{{ $user->prenom }} {{ $user->nom }}</span>
                                    </div>

                                    <div class="flex items-center gap-2 font-semibold">
                                        <i class="fa-solid fa-phone text-green-500"></i>
                                        <span>{{ $user->phone }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- ACTIONS -->
                            <div class="mt-5 flex flex-wrap gap-2">

                                <a href="{{route('particulier.settings.localisation.edit',$localisation)}}" 
                                    class="flex items-center gap-1 px-3 py-1.5 bg-orange-600 text-white rounded-md text-sm hover:bg-orange-700">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>

                                <form action="{{route('particulier.settings.localisation.destroy',$localisation)}}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>

                                @if (!$localisation->status)
                                    <form action="{{route('particulier.settings.localisation.default',$localisation)}}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-gray-700 text-white rounded-md text-sm hover:bg-black">
                                            Définir par défaut
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>
    </div>
</div>

@endsection
