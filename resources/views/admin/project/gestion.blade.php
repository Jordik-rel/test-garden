@extends('admin.admin')
@section('title')
    <title>Mission - Gardena Connect</title>
@endsection

@section('adminContent')
    <div class="p-6 shadow-sm">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold mb-4">Gestion fin de mission</h2>
            <button  type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal"
                    class="px-2 py-1 rounded-md bg-green-600 text-white font-medium text-center flex items-center">
                    <i class="fa-solid fa-coins mr-2"></i>Payer
            </button>

            <!-- Modal payement jardinier -->
              <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
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
                                            Effectuer le versement au jardinier
                                        </h3>
                                        <form action="{{ route('admin.valeur.store') }}" method="POST" class="mt-6 space-y-3 flex flex-col justify-between">
                                            @csrf
                                            <div class="mt-6">
                                                <label for="jardinier" class="text-black font-semibold px-1 mb-1">Jardinier <span class="text-red-700 font-medium">*</span></label>
                                                <select name="jardinier" id="jardinier" class="form-select w-full form-control @error('jardinier') is-invalid @enderror border rounded-lg p-2 focus:ring-2 focus:ring-green-600 focus:outline-none">
                                                    @foreach ($jardiniers as $jardinier)
                                                        <option value="{{ $jardinier->id }}">{{ $jardinier->user->prenom }} {{ $jardinier->user->nom }}</option>
                                                    @endforeach
                                                </select>
                                                 @error('jardinier')
                                                    <div class="alert alert-danger mt-1">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="jardinier_numero" class="form-label text-black font-semibold px-1 mb-1">Numéro du jardinier <span class="text-red-600">*</span></label>
                                                <input type="text" name="numero_jardinier" placeholder="01 56 78 90 29" class="form-control @error('numero_jardinier') is-invalid mb-1 @enderror" id="jardinier_numero">
                                                @error('numero_jardinier')
                                                    <div class="alert alert-danger mt-1">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="montant" class="form-label text-black font-semibold px-1 mb-1">Montant <span class="text-red-600">*</span></label>
                                                <input type="number" name="montant" placeholder="1000" class="form-control @error('montant') is-invalid mb-1 @enderror" id="nom">
                                                @error('montant')
                                                    <div class="alert alert-danger mt-1">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="admin_numero" class="form-label text-black font-semibold px-1 mb-1">Numéro du transfert <span class="text-red-600">*</span></label>
                                                <input type="text" name="numero_admin" placeholder="01 56 78 90 29" class="form-control @error('numero_admin') is-invalid mb-1 @enderror" id="admin_numero">
                                                @error('numero_admin')
                                                    <div class="alert alert-danger mt-1">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="grid md:grid-cols-2 items-center space-x-2">
                                                <div>
                                                    <label for="reference" class="form-label text-black font-semibold px-1 mb-1">Réference <span class="text-red-600">*</span></label>
                                                    <input type="text" name="reference" placeholder="payement" class="form-control @error('reference') is-invalid mb-1 @enderror" id="admin_numero">
                                                    @error('reference')
                                                        <div class="alert alert-danger mt-1">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="id_transaction" class="form-label text-black font-semibold px-1 mb-1">ID de la transaction <span class="text-red-600">*</span></label>
                                                    <input type="text" name="transaction_id" placeholder="11569876" class="form-control @error('transaction_id') is-invalid mb-1 @enderror" id="id_transaction">
                                                    @error('transaction_id')
                                                        <div class="alert alert-danger mt-1">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700">
                                                Payer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-6 py-3">Particulier</th>
                        <th class="px-6 py-3">Nom du projet</th>
                        <th class="px-6 py-3">Date début</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Budget</th>
                        <th class="px-6 py-3">Prix jardinier</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse ($missions as $mission)
                        @if ($mission->jardinier_payement==null)
                            <tr
                                onclick="window.location='{{ route('admin.mission.show',$mission) }}'"
                                class="cursor-pointer hover:bg-gray-50 transition"
                            >
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full" />
                                    <div>
                                        <p class="font-semibold">{{ $mission->projet->user->nom }} {{ $mission->projet->user->prenom }}</p>
                                        <p class="text-gray-500 text-xs">Particulier</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">{{ $mission->projet->titre }}</td>

                                <td class="px-6 py-4">
                                    {{ $mission->date_debut }}
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            1 => 'text-slate-600 bg-slate-100',
                                            2 => 'text-green-600 bg-green-100',
                                            3 => 'text-red-600 bg-red-100',
                                            4 => 'text-blue-600 bg-blue-100',
                                            5 => 'text-yellow-600 bg-yellow-100',
                                            6 => 'text-purple-600 bg-purple-100',
                                        ];

                                        $classes = $statusClasses[$mission->projet->status] ?? 'text-gray-600 bg-gray-100';
                                    @endphp
                                    <span class=" {{ $classes}} px-3 py-1 rounded-full text-xs">
                                    @switch($mission->projet->status)
                                            @case(1) En attente @break
                                            @case(2) En cours @break
                                            @case(3) Terminé @break
                                            @case(4) Attribué @break
                                            @case(5) Fini par le jardinier @break
                                            @case(6) En attente de validaion client @break
                                            @default Inconnu
                                        @endswitch                                 
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-medium">{{ $mission->montant }}</td>
                                 <td class="px-6 py-4 font-medium">{{ $mission->montant*0.9 }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500 text-sm">Aucune mission trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $missions->links() }}
        </div>
    </div>
@endsection