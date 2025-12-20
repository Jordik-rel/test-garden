<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ValeurNutritionnelle;
use Illuminate\Http\Request;

class ValeurNutritionnelleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('bonjour');
        $valeurNutritionnelle = ValeurNutritionnelle::paginate(10);
        return view('admin.plant.valeur.index',['valeurNutritionnelles'=>$valeurNutritionnelle]);
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
        $valeur = ValeurNutritionnelle::create($request->validate([
            'nom'=>['required','string','max:255']
        ]));

        return redirect()->back()->with('succes','Nouvelle valeur Nutrtionnelle ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, ValeurNutritionnelle $valeur)
    {
        $valeur->update($request->validate([
            'nom'=>['required','string','max:255']
        ]));
        return redirect()->back()->with('update','Valeur nutritionnelle mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ValeurNutritionnelle $valeur)
    {
        $valeur->delete();
        return redirect()->back()->with('delete','Valeur nutritionnelle supprimée avec succès');
    }
}
