@extends('particulier.particulier')

@section('title')
    <title>Competence - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-6xl mx-auto py-12 px-6">
        <form action="{{ route('particulier.projet.setp2') }}" method="post">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- LEFT SECTION -->
                <div>
                    <p class="text-sm text-gray-500 mb-4">2/5 &nbsp;&nbsp; Publication d'un emploi</p>

                    <h1 class="text-4xl font-semibold leading-tight mb-6 w-[80%]">
                        Quelles sont les principales compétences requises pour votre travail?
                    </h1>
                </div>

                <div>
                    <label class="block font-light text-gray-700 mb-2">
                        Recherchez des compétences
                    </label>
                    <select 
                        name="competences[]" id="valeur" multiple 
                        class="form-select form-control @error('competences') is-invalid @enderror w-full border border-gray-300 rounded-lg mb-1 p-2 focus:ring-2 focus:ring-green-700 focus:outline-none">
                        @forelse ($competences as $competence)
                            <option value="{{ $competence->id }}">{{ $competence->nom }}</option> 
                        @empty
                            <option value="">Aucune compétence - Contactez le service</option> 
                        @endforelse
                    </select>
                    <p class="text-sm text-gray-500 mb-4">Pour de meilleurs résultats, ajoutez 3 à 5 compétences</p>

                    <!-- <div class="mt-6">
                        <h2 class="text-sm font-medium text-gray-700 mb-3">Exemple de titre</h2>

                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>
                                Tonte de la pelouse et désherbage
                            </li>
                            <li>
                                Création d'un petit potager 
                            </li>
                            <li>
                                Conseils pour choisir les bonnes plantes
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="flex justify-between items-center mt-16 border-t pt-6">

                <a href="{{ route('particulier.projet.title') }}"
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