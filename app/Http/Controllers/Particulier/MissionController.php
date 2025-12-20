<?php

namespace App\Http\Controllers\Particulier;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        return view('particulier.paiements',compact('mission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function callback(Request $request,Mission $mission)
    {
        // Vérifie si le paiement a réussi
        if ($request->status == 'approved') {

            // Mise à jour de la mission
            $mission->update([
                'status' => 3, // Exemple : payé et en attente du jardinier
                'paid_at' => now()
            ]);

            return redirect()
                ->route('particulier.projet.show', $mission->projet_id)
                ->with('success', 'Paiement effectué avec succès !');
        }
        return redirect()
        ->back()
        ->with('error', 'Le paiement a échoué ou a été annulé.');
    }
}
