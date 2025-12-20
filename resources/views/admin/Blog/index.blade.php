@extends('admin.admin')
@section('title')
    <title>Post Validation - Green Connect</title>
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
                    <th scope="col">Titre</th>
                    <th scope="col">Sous titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td class="h-[20px] w-[20px] object-fill"><img src="{{$blog->image ? asset('storage/' . $blog->image) : asset('logo.png')}}" alt="" class="w-full"></td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->subtitle }}</td>
                        <td>{{ $blog->description }}</td>
                        <td class=" flex justify-center items-center">
                            <a href="{{route('jardinier.blog.show',$blog)}}" class="mr-3"><i class="fa-solid fa-eye text-green-600"></i></a>
                            <a href="" class="mr-3" data-bs-toggle="modal" data-bs-target="#modifierModal{{ $blog->id }}"><i class="fa-brands fa-pied-piper-hat text-orange-500"></i></a>
                            <a href=""><i class="fa-solid fa-trash text-red-600"></i></a>
                            <!-- <div class="dropdown">
                                <div class="cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis text-xl text-slate-400"></i>
                                </div>
                                <ul class="dropdown-menu px-1 font-light text-base">
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modifierModal{{ $blog->id }}">
                                            Analyser
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{route('jardinier.blog.destroy',$blog)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-red-500">Supprimer</button>
                                        </form>
                                    </li>
                                </ul>
                            </div> -->
                        </td>
                        <!-- Modale Bootstrap -->
                        <div class="modal fade" id="modifierModal{{ $blog->id }}" tabindex="-1" aria-hidden="true">
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
                                                <h3 class="text-center text-lg">
                                                    Autorisez-vous la publication de cet article ?
                                                </h3>
                                                <form action="{{ route('admin.analyse', $blog) }}" method="POST" class="mt-6 flex justify-between">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        name="status"
                                                        value="0"
                                                        class="w-[48%] border border-gray-300 text-red-600 py-2 rounded-lg font-medium hover:bg-red-100">
                                                        NON
                                                    </button>
                                                    <button type="submit"
                                                        name="status"
                                                        value="1"
                                                        class="w-[48%] bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700">
                                                        OUI
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    </div>
@endsection
