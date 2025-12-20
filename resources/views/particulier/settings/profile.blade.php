@extends('particulier.particulier')

@section('title')
<title>Mon profile - Gardena Connect</title>
@endsection

@section('particulierContent')
<h2 class="text-xl py-2 text-end px-10 font-extralight">Parametre / Mon Profile</h2>

<div class="min-h-screen flex justify-center py-10">
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- 🟩 SIDEBAR À GAUCHE -->
        <div class="md:col-span-1">
            @include('particulier.settings.setting')
        </div>

        <!-- 🟦 CONTENU PRINCIPAL À DROITE -->
        <div class="md:col-span-3 space-y-8">

            <!-- PARAMETRES DU COMPTE -->
            <div class="bg-white rounded-xl shadow p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Parametre du compte</h2>

                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-700">Informations personnel</h3>

                    <form action="{{ route('particulier.settings.profile.update') }}" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        @method('patch')
                        <div>
                            <label class="text-sm font-medium text-gray-700">Prenoms <span class="text-red-600">*</span></label>
                            <input type="text" value="{{ $user->prenom }}" name="prenom"
                                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Nom <span class="text-red-600">*</span></label>
                            <input type="text" value="{{ $user->nom }}" name="nom"
                                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Email <span class="text-red-600">*</span></label>
                            <input type="email" value="{{ $user->email }}" name="email"
                                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Téléphone <span class="text-red-600">*</span></label>
                            <input type="text" value="{{ $user->phone }}" name="phone"
                                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button 
                                class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-green-700 transition">
                                Enregistrer les changements
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SECURITY SECTION -->
            <div class="bg-white rounded-xl shadow p-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Sécurité</h2>

                <form action="{{ route('account.password') }}" method="post" class="space-y-6">
                    @csrf
                    @method('put')
                    <div>
                        <label class="text-sm font-medium text-gray-700">Ancien mot de passe</label>
                        <input type="password"
                            class="mt-2 w-full border border-gray-300 rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                            <input type="password"
                                class="mt-2 w-full border border-gray-300 rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                            <input type="password"
                                class="mt-2 w-full border border-gray-300 rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-green-700 transition">
                            Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>

            <!-- DELETE ACCOUNT -->
            <div class="bg-white border border-red-200 rounded-xl p-8">
                <h2 class="text-xl font-semibold text-red-600 mb-2">Supprimer le compte</h2>

                <p class="text-gray-600 mb-6">
                    Si vous supprimez votre compte, il aura plus de retour en arriere. S'il vous plait soyez conscient de action.
                </p>
                <form action="{{ route('profile.destroy') }}" method="post">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded-lg font-semibold shadow hover:bg-red-700 transition">
                        Supprimer le compte
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection
