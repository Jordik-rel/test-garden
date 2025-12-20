@extends('admin.admin')
@section('title')
    <title>Bibliothèque - Green Connect</title>
@endsection

@section('adminContent')
    <div class="text-white p-6 ">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-black">Plantes</h2>
                <p class="text-gray-400 text-sm">
                    La liste de toutes les plantes diponibles avec leurs noms, date d'ajout, description, catégories.
                </p>
            </div>
            <a href="{{ route('admin.plant.create') }}" class="no-underline">
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                Ajouter une plante
                </button>
            </a>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-300 text-gray-900 text-sm">
                    <th class="pb-3">Nom</th>
                    <th class="pb-3">Catégories</th>
                    <th class="pb-3">Valeur nutritionnelle</th>
                    <th class="pb-3">Date d'ajout</th>
                    <th class="pb-3">Actions</th>
                </tr>
            </thead>

            <tbody class="text-sm">
                @forelse ($plants as $plant)
                    <tr class="border-b border-gray-300">
                        <td class="py-4 flex items-center gap-3">
                            <img src="{{ $plant->image ? asset('storage/'.$plant->image[0])  : asset('https://i.pravatar.cc/50?img=1') }}" class="w-10 h-10 rounded-full" />
                            <div>
                                <p class="font-semibold text-black">{{ $plant->nom }}</p>
                                <p class="text-gray-400">{{ $plant->nom_local }}</p>
                            </div>
                        </td>

                        <td>
                            @foreach ($plant->plant_categorie as $categorie)
                                <p class="text-black">{{ $categorie->nom }}</p>
                            @endforeach
                        </td>

                        <td>
                            @foreach ($plant->valeur_nutritionnelle as $valeur)
                                <span class="bg-green-100/40 text-green-400 px-3 py-1 rounded-full text-xs">{{ $valeur->nom }}</span>
                            @endforeach
                        </td>

                        <td><p class="text-black">{{ $plant->created_at->format('d M, Y') }}</p></td>

                        <td class="flex justify-center items-center whitespace-nowrap text-sm text-gray-500">
                            <a href="{{route('admin.plant.show',$plant)}}" class="mr-3"><i class="fa-solid fa-eye text-green-600"></i></a>
                            <a href="{{ route('admin.plant.edit',$plant) }}" 
                                class="text-orange-600 hover:text-orange-900 no-underline mr-4"
                            >
                                <i class="fa-solid fa-edit text-orange-600"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{route('admin.plant.destroy',$plant)}}" method="post" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fa-solid fa-trash text-red-600"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Aucune plante trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection