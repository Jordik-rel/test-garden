@extends('admin.admin')

@section('title')
    <title>Nouveau Particulier - Green Connect</title>
@endsection

@section('adminContent')
    <form action="{{ route($localisation->exists? 'admin.localisation.update' :'admin.localisation.store',$localisation) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($localisation->exists? 'PUT' : 'POST')
            <!-- SECTION 1 -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">2</div>
                <h2 class="text-xl font-semibold"> Information Localisation</h2>
            </div>

            <!-- Ville -->
            <div class="mt-6">
                <label class="form-label block font-medium mb-1">Ville <span class="text-red-700 font-medium">*</span></label>
                <input type="text" placeholder="Cotonou" name="ville" value="{{old('ville',$localisation->ville) }}"
                    class="w-full form-control @error('ville') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                @error('ville')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            
            <!-- Quartier -->
            <div class="mt-6">
                <label class="form-label block font-medium mb-1">Quartier <span class="text-red-700 font-medium">*</span></label>
                <input type="text" placeholder="tokpa" name="quartier" value="{{old('quartier',$localisation->quartier) }}"
                    class="w-full form-control @error('quartier') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                @error('quartier')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="mt-4 w-[80%] mx-auto">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                    Sauvegarder
                </button>
            </div>
    </form>
@endsection