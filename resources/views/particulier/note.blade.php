@extends('particulier.particulier')

@section('title')
    <title>Noter jardinier - Gardena Connect</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('particulierContent')
    <div 
        x-data="ratingComponent()" 
        class="w-full max-w-md mx-auto p-4 bg-white shadow-md rounded-lg"
    >
        <h2 class="text-2xl font-semibold mb-3 text-center">Noter la prestation</h2>

        <form action="{{route('particulier.projet.avis_store',$projet)}}" method="post">
            @csrf

            <!-- ÉTOILES -->
            <div class="flex space-x-3 justify-center mb-4">
                <template x-for="star in 5">
                    <i 
                        class="fa-solid fa-star text-4xl cursor-pointer transition-all duration-200"
                        
                        @click="setRating(star)"
                        @mouseover="hoverRating = star"
                        @mouseleave="hoverRating = 0"

                        :class="{
                            'text-yellow-400 scale-110': star <= (hoverRating || rating),
                            'text-gray-300': star > (hoverRating || rating)
                        }"
                    ></i>
                </template>
            </div>

            <!-- Champs hidden pour envoyer la note -->
            <input type="hidden" name="note" x-model="rating">

            <!-- COMMENTAIRE -->
            <textarea 
                name="commentaire"
                x-model="commentaire"
                class="w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-600"
                rows="3"
                placeholder="Laissez un commentaire sur la prestation..."
            ></textarea>

            <!-- BOUTON -->
            <button
                type="submit"
                class="mt-3 w-full bg-green-600 text-white py-2 rounded-md font-semibold hover:bg-green-700 transition"
            >
                Envoyer la note
            </button>
        </form>

    </div>

    <script>
        function ratingComponent() {
            return {
                rating: 0,
                hoverRating: 0,
                commentaire: '',

                setRating(value) {
                    this.rating = value;
                }
            }
        }
    </script>

@endsection
