<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlantCategorie;
use Illuminate\Http\Request;

class CategoriePlanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriePlantes = PlantCategorie::paginate(10);
        return view('admin.plant.categoriePlant.index',['categoriePlantes'=>$categoriePlantes]);
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
        $data = $request->validate([
            'nom'=>['required','string','max:255'],
            'role'=>['required','string','max:255']
        ]);
        $categoriePlante = PlantCategorie::create($data);
        return redirect()->back()->with('succes','Nouvelle Catégorie de plante ajouté');
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
    public function update(Request $request, PlantCategorie $categorie)
    {
        $data = $request->validate([
            'nom'=>['required','string','max:255'],
            'role'=>['required','string','max:255']
        ]);

        // dd($categorie);

        $categorie->update($data);

        // dd($categorie);

        return redirect()->back()->with('update','Categorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlantCategorie $categorie)
    {
        // dd( $categorie);
        $categorie->delete();
        return redirect()->back()->with('delete','Catgéorie supprimée avec succès');
    }
}
