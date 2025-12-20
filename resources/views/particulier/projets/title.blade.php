@extends('particulier.particulier')

@section('title')
    <title>Titre - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-6xl mx-auto py-12 px-6">
        <form action="{{ route('particulier.projet.setp1') }}" method="post">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- LEFT SECTION -->
                <div>
                    <p class="text-sm text-gray-500 mb-4">1/5 &nbsp;&nbsp; Publication d'un emploi</p>

                    <h1 class="text-4xl font-semibold leading-tight mb-6">
                        Commençons par un titre<br>
                        fort.
                    </h1>

                    <p class="text-gray-600 leading-relaxed w-4/5">
                        Cela permet à votre poste de se démarquer auprès des bons candidats. 
                        C'est la première chose qu'ils verront, alors faites en sorte que ça compte
                    </p>
                </div>

                <div>
                    <label class="block font-light text-gray-700 mb-2">
                        Donnez un titre à votre offre d'emploi
                    </label>
    
                    <input 
                        type="text" 
                        placeholder="Aménagement de jardin" name="titre"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-700 focus:outline-none"
                    />
                    @error('titre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>        
                    @enderror
                    <div class="mt-6">
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
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-16 border-t pt-6">

                <a href="{{ route('particulier.dashboard') }}"
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