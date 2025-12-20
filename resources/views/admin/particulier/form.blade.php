@extends('admin.admin')

@section('title')
    <title>Nouveau Particulier - Green Connect</title>
@endsection

@section('adminContent')
    <form action="{{ route($particulier->exists? 'admin.particulier.update' :'admin.particulier.store',$particulier) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($particulier->exists? 'PUT' : 'POST')
            <!-- SECTION 1 -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">1</div>
                <h2 class="text-xl font-semibold"> Information Utilisateur</h2>
            </div>
            <!-- Nom  & Préom  -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Nom <span class="text-red-700 font-medium">*</span></label>
                    <input type="text" placeholder="Moringa" name="nom" value="{{old('nom',$particulier->nom) }}"
                        class="w-full form-control @error('nom') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                    >
                    @error('nom')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                <div>
                    <label class="block font-medium mb-1">Prénoms <span class="text-red-700 font-medium">*</span></label>
                    <input type="text" placeholder="Jean Josue" name="prenom" value="{{old('prenom',$particulier->prenom) }}"
                        class="w-full form-control @error('prenom') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                    >
                    @error('prenom')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
    
            <!-- Email -->
            <div class="mt-6">
                <label class="block font-medium mb-1">Email <span class="text-red-700 font-medium">*</span></label>
                <input type="email" placeholder="jogndoe@gmail.com" name="email" value="{{old('email',$particulier->email) }}"
                    class="w-full form-control @error('email') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <!-- Photo -->
            <div class="mt-6">
                <label class="block font-medium mb-1">Avatar </label>
                <input type="file" name="profile_photo_path"
                    class="w-full form-control @error('profile_photo_path') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                @error('profile_photo_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Téléphone -->
            <div class="mt-6">
                <label class="block font-medium mb-1">Téléphone <span class="text-red-700 font-medium">*</span></label>
                <input type="text" placeholder="0154789065" name="phone" value="{{old('phone',$particulier->phone) }}"
                    class="w-full form-control @error('phone') is-invalid mb-2 @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                >
                @error('phone')
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