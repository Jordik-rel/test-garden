@extends('particulier.particulier')

@section('title')
    <title>Description - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-6xl mx-auto py-12 px-6">
        <form action="{{ route('particulier.projet.setp5') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- LEFT SECTION -->
                <div>
                    <p class="text-sm text-gray-500 mb-4">5/5 &nbsp;&nbsp; Publication d'un emploi</p>

                    <h1 class="text-4xl font-semibold leading-tight mb-6 w-[50%]">
                        Commencez la conversation.
                    </h1>
                    <div class="mt-3">
                        <h2 class="text-sm font-medium text-gray-700 mb-3">Les talents recherchent:</h2>

                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>
                                Des attentes claires concernant votre tâche ou vos livrables
                            </li>
                            <li>
                                Les compétences requises pour votre travail
                            </li>
                            <li>
                                Bonne communication
                            </li>
                            <li>Détails sur la façon dont vous ou votre équipe aimez travailler</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="mb-6">
                        <label class="block font-medium mb-2">Décrivez ce dont vous avez besoin <span class="text-red-700 font-medium">*</span></label>
                        <textarea 
                            placeholder="Vous avez déja une description? Collez-le ici!" name="description"
                            class="w-full h-40 form-control @error('description') is-invalid 'mb-1' @enderror border border-gray-300 rounded-lg mb-1 py-2 focus:ring-2 focus:ring-green-700 focus:outline-none"
                        >
                        </textarea>
                        @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label class="block font-medium mb-1">Joindre un fichier</label>
                        <input type="file" name="support"
                            class="w-full form-control @error('support') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                        @error('support')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-16 border-t pt-6">

                <a href="{{ route('particulier.projet.budget') }}"
                    class="text-gray-600 hover:text-gray-700 border border-gray-300 px-3 py-1 rounded-lg hover:bg-gray-100 transition no-underline">
                        Retour
                </a>

                <button type="submit"
                    class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition no-underline">
                        Suivant
                </button>

            </div>
        </form>
    </div>
@endsection