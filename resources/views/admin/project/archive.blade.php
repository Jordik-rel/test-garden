@extends('admin.admin')
@section('title')
    <title>Archive - Gardena Connect</title>
@endsection

@section('adminContent')
    <div class="p-6 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Archive des payements</h2>
         <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-6 py-3">Particulier</th>
                        <th class="px-6 py-3">Jardinier</th>
                        <th class="px-6 py-3">Nom du projet</th>
                        <th class="px-6 py-3">Date début</th>
                        <th class="px-6 py-3">Budget</th>
                        <th class="px-6 py-3">Numéro jardinier</th>
                         <th class="px-6 py-3">Id Transaction</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm">

                    @forelse ($payements as $payement)
                        <tr
                            class="cursor-pointer hover:bg-gray-50 transition"
                        >
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full" />
                                <div>
                                    <p class="font-semibold">{{ $payement->mission->projet->user->nom }} {{ $payement->mission->projet->user->prenom }}</p>
                                    <p class="text-gray-500 text-xs">Particulier</p>
                                </div>
                            </td>

                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full" />
                                <div>
                                    <p class="font-semibold">{{ $payement->jardinier->user->nom }} {{ $payement->jardinier->user->prenom }}</p>
                                    <p class="text-gray-500 text-xs">Jardinier</p>
                                </div>
                            </td>

                            <td class="px-6 py-4">{{ $payement->mission->projet->titre }}</td>

                            <td class="px-6 py-4">
                                {{ $payement->misison->date_debut }}
                            </td>

                            <td class="px-6 py-4">
                               
                                <span class=" text-green-600 bg-green-100 px-3 py-1 rounded-full text-xs">
                                  {{ $payement->montant }}                                
                                </span>
                            </td>

                            <td class="px-6 py-4 font-medium">{{ $payement->numero_jardinier }}</td>
                            <td class="px-6 py-4 font-medium">{{ $payement->transaction_id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500 text-sm">Aucun payement</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $payements->links() }}
        </div>
    </div>
@endsection