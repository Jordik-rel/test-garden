@extends('particulier.particulier')
@section('title')
    <title>Les propositions - Gardena Connect</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('particulierContent')
    <div class="p-6 bg-white rounded-xl shadow-sm">
        <div x-data="{ show: false }" class="flex flex-col gap-4">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Les propositions</h2>
                @if (!$projet->propositions->isEmpty() )
                    <button 
                        @click="show = !show" 
                        class="bg-green-600 text-white font-semibold rounded-md px-3 py-2"
                    >
                        <i class="fa-solid fa-magnifying-glass text-white mr-2"></i>
                        Selectionner
                    </button>
                @endif
            </div>

            <!-- FORMULAIRE QUI APPARAÎT -->
            <div 
                x-show="show"
                x-transition
                class="fixed inset-0 bg-black/40 flex items-center justify-center"
            >
                <div class="bg-white p-6 rounded-lg shadow-lg w-[45%]" x-data="combobox()">
                    <form action="{{ route('particulier.projet.select',$projet) }}" method="post">
                        @csrf
                        @method('put')
                        <h3 class="text-lg font-semibold mb-3">Sélection votre équipier</h3>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                        <select name="jardinier" id="jardiniers" class="form-select w-full form-control @error('jardinier') is-invalid @enderror border-1 outline-none rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                            @foreach ($projet->propositions as $proposition)
                                <option value="{{ $proposition->user->id }}" > <img src="{{ $proposition->user->profile_photo_path ? asset('storage/'.$proposition->user->profile_photo_path) : asset('images/profile_img.jpg')}}" alt="User profile" class="h-10 w-10 rounded-full"> {{ $proposition->user->nom }} {{ $proposition->user->prenom }}</option>
                            @endforeach
                        </select>
                        @error('jardinier')
                            <div class="text-red-600 bg-red-100">{{ $message }}</div>
                        @enderror
                        <div class="flex justify-between items-center mt-4">
                            <button type="button" @click="show = false" class="px-4 py-2 bg-gray-200 text-slate-700 rounded-md">Annuler</button>
                            <button type="sumbit" class="bg-green-600 text-white font-semibold rounded-md px-4 py-2">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-6 py-3">Jardinier</th>
                        <th class="px-6 py-3">Réalisations</th>
                        <th class="px-6 py-3">Nombre missions</th>
                        <th class="px-6 py-3">Localisation</th>
                        <th class="px-6 py-3">Tarif en FCFA</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse ($propositions as $proposition)
                            <tr 
                                onclick="window.location='{{ route('particulier.projet.proposition.show', [$projet,$proposition]) }}'"
                                class="cursor-pointer hover:bg-gray-50 transition"
                            >
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <img src="{{ $proposition->user->profile_photo_path ? asset('storage/'.$proposition->user->profile_photo_path) :asset('https://i.pravatar.cc/40?img=1')}}" class="w-10 h-10 rounded-full" />
                                    <div>
                                        <p class="font-semibold">{{ $proposition->user->nom }} {{ $proposition->user->prenom }}</p>
                                        <p class="text-gray-500 text-xs">{{ $proposition->user->jardinier->profession }}</p>
                                    </div>
                                </td>
        
                                <td class="px-6 py-4">
                                    <div class="flex -space-x-2">
                                    {{-- @forelse ($proposition->support as $support)
                                            <img class="w-8 h-8 rounded-full border-2 border-white" src="{{ asset('storage/'.$support) }}" />
                                        @empty
                                            <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/40?img=3" />
                                        @endforelse --}}
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">Agency Website</td>
        
                                <td class="px-6 py-4">
                                    <span class="{{ $proposition->user->localisation->where('default', true)->isEmpty() ? ' text-orange-600 bg-orange-100 ' : 'text-green-600 bg-green-100 '  }}px-3 py-1 rounded-full text-xs">
                                        @if (!$proposition->user->localisation->where('default', true)->isEmpty()) 
                                        {{ $proposition->user->localisation->where('default', true)->first()?->ville}}
                                        @else
                                            Aucune localisation ajoutée
                                        @endif
                                    </span>
                                </td>
            
                                <td class="px-6 py-4 font-medium">{{ $proposition->tarif_propose }}</td>

                                <td class="px-6 py-4 font-medium ">
                                    @php
                                        $statusClasses = [
                                            1 => 'text-orange-600 bg-orange-100',
                                            2 => 'text-green-600 bg-green-100',
                                            3 => 'text-red-600 bg-red-100',
                                        ];

                                        $classes = $statusClasses[$proposition->status] ?? 'text-gray-600 bg-gray-100';
                                    @endphp
                                    <span class=" {{ $classes}} px-3 py-1 rounded-full text-xs">
                                        @switch($proposition->status)
                                            @case(1)
                                                En attente
                                                @break
                                            @case(2)
                                                Accepté
                                                @break
                                            @case(3)
                                                Refusé
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </span>
                                </td>
                            </tr>                   
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 text-sm">En attente de proposition</td>
                        </tr>
                    @endforelse
                    <!-- Row 1 -->

                        <!-- Row 2 -->
                    <!-- <tr>
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full" />
                            <div>
                            <p class="font-semibold">Kaiya George</p>
                            <p class="text-gray-500 text-xs">Project Manager</p>
                            </div>
                        </td>

                        <td class="px-6 py-4">Technology</td>

                        <td class="px-6 py-4">
                            <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/40?img=3" />
                            <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/40?img=4" />
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-orange-600 bg-orange-100 px-3 py-1 rounded-full text-xs">Pending</span>
                        </td>

                        <td class="px-6 py-4 font-medium">24.9K</td>
                    </tr> -->
                </tbody>
            </table>
            {{ $propositions->links() }}
        </div>
    </div>
    <script>
        function combobox() {
            return {
                open: false,
                search: "",
                items: [
                    { id: 1, name: "Leslie Alexander", avatar: "https://i.pravatar.cc/40?img=1" },
                    { id: 2, name: "Michael Foster", avatar: "https://i.pravatar.cc/40?img=2" },
                    { id: 3, name: "Dries Vincent", avatar: "https://i.pravatar.cc/40?img=3" },
                    { id: 4, name: "Lindsay Walton", avatar: "https://i.pravatar.cc/40?img=4" },
                    { id: 5, name: "Courtney Henry", avatar: "https://i.pravatar.cc/40?img=5" },
                ],
                filtered: [],

                init() {
                    this.filtered = this.items;
                },

                filterItems() {
                    this.filtered = this.items.filter(i =>
                        i.name.toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                select(user) {
                    this.search = user.name;
                    this.open = false;
                }
            }
        }
    </script>

@endsection
