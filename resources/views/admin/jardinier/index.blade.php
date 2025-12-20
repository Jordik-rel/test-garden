@extends('admin.admin')

@section('title')
    <title>Jardinier - Administrateur</title>
@endsection

@section('adminContent')
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-900">Jardinier</h2>
        <p class="text-gray-600 mb-6">
           La liste des différents jardiniers enregistré sur Green Connect avec leurs nom, email, télephone, project commandé.
        </p>

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.jardinier.create') }}">
                <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Ajouter un jardinier
                </button>
            </a>
        </div>

        <div class="overflow-hidden border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de Services</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total projets</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($jardiniers as $jardinier)
                        <tr>
                            <td class="px-6 py-4">{{ $jardinier->user->nom }} {{ $jardinier->user->prenom }} </td>
                            <td class="px-6 py-4">{{ $jardinier->user->email }}</td>
                            <td class="px-6 py-4">{{ $jardinier->user->phone }}</td>
                            <td class="px-6 py-4">{{ $jardinier->services->count() }}</td>
                             <td class="px-6 py-4">{{ $jardinier->mission->count() }}</td>
                            <td class="px-6 py-4 flex justify-between items-center cursor-pointer">
                                <a href="{{ route('admin.jardinier.show',$jardinier) }}" class="text-green-600 hover:text-green-700"><i class="fa-solid fa-eye text-green-600"></i></a>
                                <a href="{{ route('admin.jardinier.edit',$jardinier) }}" class="text-orange-600 hover:text-orange-700"><i class="fa-solid fa-edit text-orange-600"></i></a>
                                <form action="{{ route('admin.jardinier.destroy',$jardinier) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700"><i class="fa-solid fa-trash text-red-600"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Aucun jardinier trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $jardiniers->links() }}
        </div>
    </div>
@endsection