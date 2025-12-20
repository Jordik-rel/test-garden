@extends('particulier.particulier')

@section('title')
<title>Ajouter Carte - Gardena Connect</title>
@endsection

@section('particulierContent')
    <h2 class="text-xl py-2 text-end px-10 font-extralight">Parametre / Carte de payement</h2>

    <div class="min-h-screen flex justify-center py-10">

        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- 🟩 SIDEBAR -->
            <div class="md:col-span-1">
                @include('particulier.settings.setting')
            </div>
            <div class="md:col-span-3 space-y-2">
                <form id="addcompetence" class="space-y-4" action="{{ route($payement->exists? 'particulier.settings.payement.update' :'particulier.settings.payement.store',$payement)}}" method="POST">
                    @csrf
                    @method($payement->exists? 'PUT' : 'POST')
                    <h2 class="text-xl font-semibold text-center py-4">Ma nouvelle adresse</h2>
                    <div class="mb-3">
                        <label for="reseau" class="text-black font-semibold px-1 mb-1">Réseau</label>
                        <select name="reseau" id="reseau" class="outline-none border-1 border-slate-400 rounded-md focus:border-green-600 focus:ring-1 focus:ring-green-600 w-full @error('reseau') is-invalid @enderror">
                            <option value="MTN" {{  $payement->reseau == 'MTN' ? 'selected' : '' }} >MTN</option>
                            <option value="MOOV" {{  $payement->reseau == 'MOOV' ? 'selected' : '' }}> MOOV</option>
                            <option value="CELtiis" {{  $payement->reseau == 'Celtiis' ? 'selected' : '' }}> Celtiis</option>
                        </select>
                         @error('reseau')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="numéro" class="form-label text-black font-semibold px-1 mb-  1">Numéro de téléphone</label>
                        <input type="text" name="numéro" placeholder="0157643278" value="{{old('numéro',$payement->numéro)}}" class="outline-none border-1 border-slate-400 rounded-md focus:border-green-600 focus:ring-1 focus:ring-green-600 w-full @error('numéro') is-invalid @enderror">
                        @error('numéro')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full">
                        @if($payement->exists)
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