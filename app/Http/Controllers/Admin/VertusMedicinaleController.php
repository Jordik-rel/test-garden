<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VertuMedicinale;
use Illuminate\Http\Request;

class VertusMedicinaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vertus = VertuMedicinale::paginate(10);
        return view('admin.plant.vertu.index',['vertus'=>$vertus]);
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
        $vertu = VertuMedicinale::create($request->validate([
            'nom'=>['required','string','max:255','unique:vertu_medicinales,nom']
        ]));

        return redirect()->back()->with('succes','Nouvelle vertu médicinale ajoutée');
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
    public function update(Request $request, VertuMedicinale $vertu)
    {
        $vertu->update($request->validate([
            'nom'=>['required','string','max:255','unique:vertu_medicinales,nom']
        ]));

        return redirect()->back()->with('update','Vertu médicinale mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VertuMedicinale $vertu)
    {
        $vertu->delete();
        return redirect()->back()->with('delete','Vertu médicinale supprimée avec succès');
    }
}
