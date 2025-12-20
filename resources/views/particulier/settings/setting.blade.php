@php
    $user = Auth::user();
@endphp

<!-- 📌 SIDEBAR -->
<div class="bg-white rounded-xl shadow p-6">
    
    <!-- Avatar -->
    <div class="flex flex-col items-center">
        <img 
            src="https://i.pravatar.cc/150" 
            class="w-24 h-24 rounded-full border-4 border-white shadow"
            alt="User"
        >
        <h3 class="mt-3 text-lg font-semibold">{{ $user->prenom }} {{ $user->nom }}</h3>
        <span class="mt-1 px-3 py-1 text-sm bg-blue-50 text-green-600 rounded-full flex items-center gap-1">
            <i class="fa-solid fa-gem text-green-600"></i> {{ $user->role === 'user' ? 'Particulier' : '' }}
        </span>
    </div>

    <hr class="my-4">

    <!-- Menu -->
    <ul class="space-y-5 mb-9">

        <a href="{{ route('particulier.settings.localisation') }}"  class="flex justify-between items-center font-medium text-gray-700 hover:text-green-600 cursor-pointer">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-location-dot"></i> Localisation
            </span>
            <span class="bg-green-600 text-white text-xs px-2 py-1 rounded-full">{{ $user->localisation->count() }}</span>
        </a>

        <a href="{{ route('particulier.settings.payement') }}"  class="flex justify-between items-center font-medium text-gray-700 hover:text-green-600 cursor-pointer">
            <span class="flex items-center gap-3">
                <i class="fa-solid fa-credit-card"></i> Cartes
            </span>
            <span class="bg-green-600 text-white text-xs px-2 py-1 rounded-full">{{ $user->payements->count() }}</span>
        </a>

        <a href="{{ route('particulier.settings.profile') }}" class="flex justify-between items-center font-medium text-gray-700 hover:text-green-600 cursor-pointer">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-user"></i> Profile
            </span>
        </a>

    </ul>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="w-full py-2 hover:text-red-600 flex items-center gap-2">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Se déconnecter</span>
        </button>
    </form>
</div>