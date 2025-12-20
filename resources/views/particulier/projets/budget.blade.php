@extends('particulier.particulier')

@section('title')
    <title>Budget - Gardena Connect</title>
@endsection

@section('particulierContent')
    <div class="max-w-6xl mx-auto py-12 px-6">
        <form action="{{ route('particulier.projet.setp4') }}" method="post">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                {{-- LEFT SECTION --}}
                <div>
                    <p class="text-sm text-gray-500 mb-4">4/5 &nbsp;&nbsp; Publication d'un emploi</p>

                    <h1 class="text-4xl font-semibold leading-tight mb-6 w-[80%]">
                        Parlez-nous de votre budget.
                    </h1>

                    <p class="text-gray-600 leading-relaxed w-4/5">
                        Cela nous aidera à vous mettre en relation avec les talents de votre gamme.
                    </p>
                </div>


                {{-- RIGHT SECTION = BUDGET --}}
                <div>

                    {{-- TYPE DE TARIFICATION --}}
                    <div class="flex gap-4">

                        <!-- TARIF HORAIRE -->
                        <label 
                            for="tarif_hourly"
                            class="w-1/2 border rounded-xl p-5 flex flex-col gap-2 hover:border-black transition cursor-pointer"
                            id="hourlyCard"
                            onclick="toggleCard('hourly')"
                        >
                            <input 
                                type="radio" 
                                name="tarif_type" 
                                id="tarif_hourly" 
                                value="0" 
                                class="hidden peer"
                            >
                            <div class="flex items-center justify-between">
                                <span class="text-xl">🕒</span>
                                <span id="hourlyCheck" class="w-5 h-5 rounded-full border"></span>
                            </div>
                            <span class="font-medium text-lg">Tarif horaire</span>
                        </label>

                        <!-- PRIX FIXE -->
                        <label 
                            for="tarif_fixed"
                            class="w-1/2 border rounded-xl p-5 flex flex-col gap-2 hover:border-black transition cursor-pointer"
                            id="fixedCard"
                            onclick="toggleCard('fixed')"
                        >
                            <input 
                                type="radio" 
                                name="tarif_type" 
                                id="tarif_fixed" 
                                value="1" 
                                class="hidden peer"
                            >
                            <div class="flex items-center justify-between">
                                <span class="text-xl">🏷️</span>
                                <span id="fixedCheck" class="w-5 h-5 rounded-full border"></span>
                            </div>
                            <span class="font-medium text-lg">Prix fixe</span>
                        </label>
                    </div>
                    @error('tarif_type')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>                           
                    @enderror

                    
                    {{-- SECTION TARIF HORAIRE --}}
                    <div id="hourlySection" class="mt-10">

                        <div class="flex items-center gap-20">

                            {{-- DE --}}
                            <div>
                                <label class="text-gray-700 font-medium">De</label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="number"
                                        name="tarif_min"
                                        placeholder="1000"
                                        class="border rounded-lg px-4 py-2 w-32"
                                    >
                                    <span class="ml-2 text-gray-600">/hr</span>
                                </div>
                                @error('tarif_min')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>                                   
                                @enderror
                            </div>

                            {{-- À --}}
                            <div>
                                <label class="text-gray-700 font-medium">À</label>
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="number"
                                        name="tarif_max"
                                        placeholder="5000"
                                        class="border rounded-lg px-4 py-2 w-32"
                                    >
                                    <span class="ml-2 text-gray-600">/hr</span>
                                </div>
                                @error('tarif_max')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>                                  
                                @enderror
                            </div>
                        </div>

                        <p class="mt-4 text-sm text-gray-600">
                            Il s'agit du taux moyen pour des projets similaires.
                        </p>

                        <p class="mt-6 text-gray-700 leading-relaxed">
                            Les professionnels facturent généralement <b>1000 Franc CFA – 5000 Franc CFA /heure</b>.
                        </p>
                    </div>


                    {{-- SECTION PRIX FIXE --}}
                    <div id="fixedSection" class="mt-10 hidden">

                        <p class="text-gray-700 leading-relaxed">
                            Fixez un prix pour le projet ou découpez-le en jalons.
                        </p>

                        <h2 class="mt-6 text-lg font-medium">Estimation du coût total</h2>

                        <p class="text-gray-600 mb-4">
                            Vous pourrez toujours ajuster ce montant avec votre talent.
                        </p>

                        <input 
                            type="number"
                            name="budget"
                            class="border rounded-lg px-4 py-2 w-40"
                            placeholder="10000"
                        >
                        @error('budget')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>                      
                        @enderror

                        <p class="mt-6 text-green-600 font-medium cursor-pointer hover:underline">
                            Vous n’êtes pas prêt à établir un budget ?
                        </p>
                    </div>
                    
                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex justify-between items-center mt-16 border-t pt-6">

                <a href="{{ route('particulier.projet.duration') }}"
                    class="text-gray-600 hover:text-gray-700 border border-gray-300 px-3 py-1 rounded-lg hover:bg-gray-100 transition no-underline">
                        Retour
                </a>

                <button type="submit"
                    class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition">
                    Suivant
                </button>

            </div>

        </form>
    </div>


    {{-- SCRIPT --}}
    <!-- <script>
        function selectType(type) {
            if (type === 'hourly') {
                document.getElementById('hourlyBtn').classList.add('active-card');
                document.getElementById('fixedBtn').classList.remove('active-card');

                document.getElementById('hourlyCheck').classList.add('bg-green-600');
                document.getElementById('fixedCheck').classList.remove('bg-green-600');

                document.getElementById('hourlySection').classList.remove('hidden');
                document.getElementById('fixedSection').classList.add('hidden');

            } else {
                document.getElementById('fixedBtn').classList.add('active-card');
                document.getElementById('hourlyBtn').classList.remove('active-card');

                document.getElementById('fixedCheck').classList.add('bg-green-600');
                document.getElementById('hourlyCheck').classList.remove('bg-green-600');

                document.getElementById('fixedSection').classList.remove('hidden');
                document.getElementById('hourlySection').classList.add('hidden');
            }
        }
    </script> -->
    <script>
        function toggleCard(type) {
            if (type === 'hourly') {
                document.getElementById('hourlyCard').classList.add('active-card');
                document.getElementById('fixedCard').classList.remove('active-card');

                document.getElementById('hourlyCheck').classList.add('bg-green-600');
                document.getElementById('fixedCheck').classList.remove('bg-green-600');

                // afficher section horaire
                document.getElementById('hourlySection').classList.remove('hidden');
                document.getElementById('fixedSection').classList.add('hidden');

            } else {
                document.getElementById('fixedCard').classList.add('active-card');
                document.getElementById('hourlyCard').classList.remove('active-card');

                document.getElementById('fixedCheck').classList.add('bg-green-600');
                document.getElementById('hourlyCheck').classList.remove('bg-green-600');

                // afficher section prix fixe
                document.getElementById('fixedSection').classList.remove('hidden');
                document.getElementById('hourlySection').classList.add('hidden');
            }
        }
    </script>

    <style>
        .active-card {
            border-width: 2px;
            border-color: black;
        }
    </style>
@endsection
