@extends('admin.admin')
@section('title')
    <title>Projects - Gardena Connect</title>
@endsection

@section('adminContent')
    <div class="flex flex-col">
        <div class="mb-3">
            <!-- <div class="flex justify-end">
                <div class="p-2 bg-green-600 text-white font-medium w-fit no-underline rounded-md mb-2"><a href="{{route('jardinier.blog.create')}}" class="text-white no-underline">Ajouter un article</a></div>
            </div>     -->
            <form action="" class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass text-green-600"></i></span>
                <input type="text" class="form-control p-2 focus:border-slate-100" placeholder="Rechercher un article" aria-label="Username" aria-describedby="basic-addon1">
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Durée</th>
                    <th scope="col">Nombre de soumissions</th>
                    <th scope="col">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projets as $projet)
                    <tr>
                        <td class="px-6 py-4"> {{ $loop->iteration }} </td>
                        <td class="px-6 py-4">{{ $projet->titre }}</td>
                        <td class="px-6 py-4">{{ Str::limit($projet->description, 50,'...') }}</td>
                        <td class="px-6 py-4">
                            @switch($projet->duree)
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
                        </td>
                        <td class="px-6 py-4">{{ $projet->propositions->count() }}</td>
                        <td class=" px-6 py-4">
                            @php
                                $statusClasses = [
                                    2 => 'text-green-600 bg-green-100',
                                    3 => 'text-red-600 bg-red-100',
                                    4 => 'text-blue-600 bg-blue-100',
                                    5 => 'text-yellow-600 bg-yellow-100',
                                    6 => 'text-purple-600 bg-purple-100',
                                ];

                                $classes = $statusClasses[$projet->status] ?? 'text-gray-600 bg-gray-100';
                            @endphp
                            <span class=" {{ $classes}} px-3 py-1 rounded-full text-xs">
                                @switch($projet->status)
                                    @case(1) En attente     @break
                                    @case(2) En cours @break
                                    @case(3) Terminé      @break
                                    @case(4) Attribué @break
                                    @case(5) Fini par le jardinier @break
                                    @case(6) En attente de validaion client @break
                                    @default Inconnu
                                @endswitch                                 
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $projets->links() }}
    </div>
@endsection