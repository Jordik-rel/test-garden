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
            <div class="md:col-span-3 space-y-2">
               <form action="{{ route($localisation->exists? 'particulier.settings.localisation.update' :'particulier.settings.store_localisation',$localisation)}}" method="post">
                    @csrf
                    @method($localisation->exists? 'PUT' : 'POST')
                    <h2 class="text-xl font-semibold text-center py-4">Ma nouvelle adresse</h2>
                    <div class="mb-3">
                        <label for="ville" class="form-label text-black font-semibold px-1 mb- 1">Ville</label>
                        <input type="text" name="ville" placeholder="cotonou" value="{{old('ville',$localisation->ville)}}" class="outline-none border-1 border-slate-400 rounded-md focus:border-green-600 focus:ring-1 focus:ring-green-600 w-full @error('ville') is-invalid @enderror" id="ville">
                        @error('ville')
                            <p class="text-red-600 font-light">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quartier" class="form-label text-black font-semibold px-1 mb-1">Quartier</label>
                        <input type="text" name="quartier" placeholder="finangnon" value="{{old('quartier',$localisation->quartier)}}" class="outline-none border-1 border-slate-400 rounded-md focus:border-green-600 focus:ring-1 focus:ring-green-600 w-full @error('quartier') is-invalid @enderror" id="quartier">
                        @error('quartier')
                            <p class="text-red-600 font-light">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        @if($localisation->exists)
                            <button 
                                type="submit" 
                                class="w-full text-white bg-orange-500  hover:bg-orange-700 font-extralight rounded-md px-2 py-2 text-center"
                            >
                                    Modifier    
                            </button>
                        @else
                            <button 
                                type="submit" 
                                class="w-full text-white bg-green-600 hover:bg-green-700 font-extralight rounded-md px-2 py-2 text-center"
                            >
                                Ajouter   
                            </button>
                        @endif
                    </div>
               </form>
            </div>
        </div>
    </div>
@endsection