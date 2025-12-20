@extends('admin.admin')
@section('title')
    <title>Categorie plant - Biblitoheque</title>
@endsection

@section('adminContent')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Catégories Plantes</h1>
                <p class="mt-2 text-sm text-gray-700">
                    La liste des différentes catégories de plantes avec leur nom, date d'ajout.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal"
                    class="inline-flex items-center justify-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700 focus:outline-none"
                >
                    Ajouter une categorie
                </button>

                <!-- ADD Categorie Plant Modal -->
                 <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">                               
                            <div class="relative bg-white rounded-xl shadow-xl px-8 py-6 w-[500px] mx-auto">                                       
                                <!-- Close button -->
                                <button 
                                    type="button"
                                    class="absolute top-[-18px] right-[-18px] h-8 w-8 rounded-full bg-slate-100 
                                        text-gray-500 hover:text-gray-700 hover:bg-slate-200 
                                        flex items-center justify-center text-xl"
                                    data-bs-dismiss="modal">
                                    &times;
                                </button>

                                <div class="modal-body">
                                    <div class="bg-white px-4 py-2 rounded-md">
                                        <h3 class="text-center">
                                            Ajouter une categorie de plante
                                        </h3>
                                        <form action="{{route('admin.categorie.store')}}" method="POST" class="mt-6 flex flex-col justify-between">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nom" class="form-label text-black font-semibold px-1 mb-1">Nom <span class="text-red-600">*</span></label>
                                                <input type="text" name="nom" placeholder="médicinales" class="form-control @error('nom') is-invalid mb-1 @enderror" id="nom">
                                                @error('nom')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="role" class="form-label text-black font-semibold px-1 mb-1">Role <span class="text-red-600">*</span></label>
                                                <input type="text" name="role" placeholder="médicinales" class="form-control @error('role') is-invalid mb-1 @enderror" id="role">
                                                @error('role')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                class="bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700">
                                                Sauvegarder
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nom</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date d'ajout</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nombre de plants</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">

                            @foreach ($categoriePlantes as $categoriePlante)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ $categoriePlante->nom }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoriePlante->created_at->format('d M, Y') }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoriePlante->plant->count() }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoriePlante->role }}</td>
                                    <td class="flex justify-center items-center whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                                        <!-- Bouton Modifier -->
                                        <a href="#" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modifierModal{{ $categoriePlante->id }}"
                                            class="text-orange-600 hover:text-orange-900 no-underline mr-3"
                                        >
                                            <i class="fa-solid fa-edit text-orange-600"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{route('admin.categorie.destroy',$categoriePlante)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i class="fa-solid fa-trash text-red-600"></i></button>
                                        </form>

                                        <!-- Modal UPDATE -->
                                        <div class="modal fade" id="modifierModal{{ $categoriePlante->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    
                                                    <div class="relative bg-white rounded-xl shadow-xl px-8 py-6 w-[500px] mx-auto">
                                                        
                                                        <!-- Bouton close -->
                                                        <button type="button"
                                                            class="absolute top-[-18px] right-[-18px] h-8 w-8 rounded-full bg-slate-100 
                                                                text-gray-500 hover:text-gray-700 hover:bg-slate-200 flex items-center justify-center text-xl"
                                                            data-bs-dismiss="modal">
                                                            &times;
                                                        </button>

                                                        <!-- TITRE -->
                                                        <h3 class="text-center text-sm mb-4">
                                                            Modifier {{ $categoriePlante->nom }}
                                                        </h3>

                                                        <!-- FORMULAIRE -->
                                                        <form action="{{ route('admin.categorie.update', $categoriePlante) }}" method="POST" class="space-y-4">
                                                            @csrf
                                                            @method('PUT')

                                                            <div>
                                                                <label for="nom-{{ $categoriePlante->id }}" class="form-label text-black font-semibold px-1 mb-1">
                                                                    Nom <span class="text-red-600">*</span>
                                                                </label>
                                                                <input type="text" 
                                                                    name="nom" 
                                                                    id="nom-{{ $categoriePlante->id }}"
                                                                    value="{{ old('nom', $categoriePlante->nom) }}"
                                                                    class="form-control @error('nom') is-invalid @enderror"
                                                                    placeholder="médicinales">

                                                                @error('nom')
                                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div>
                                                                <label for="role-{{ $categoriePlante->id }}" class="form-label text-black font-semibold px-1 mb-1">
                                                                    Role <span class="text-red-600">*</span>
                                                                </label>
                                                                <input type="text" 
                                                                    name="role" 
                                                                    id="role-{{ $categoriePlante->id }}"
                                                                    value="{{ old('role', $categoriePlante->role) }}"
                                                                    class="form-control @error('role') is-invalid @enderror"
                                                                    placeholder="bof">

                                                                @error('role')
                                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <button type="submit"
                                                                    class="bg-orange-600 text-white py-2 rounded-lg font-medium hover:bg-orange-700 w-full">
                                                                Modifier
                                                            </button>

                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{ $categoriePlantes->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection