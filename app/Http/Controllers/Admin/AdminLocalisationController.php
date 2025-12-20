<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocalisationRequest;
use App\Models\Localisation;
use Illuminate\Http\Request;

class AdminLocalisationController extends Controller
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
        $localisation = new Localisation();
        return view('admin.particulier.location',['localisation'=>$localisation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocalisationRequest $request)
    {
        dd($request);
        $localisation = Localisation::create($request->validated());
        return redirect()->route('admin.particulier.index')->with('succes','Adresse ajoutée avec succès');
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
    public function edit(Localisation $localisation)
    {
        return view('admin.particulier.location',['localisation'=>$localisation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocalisationRequest $request, Localisation $localisation)
    {
        $localisation->update($request->validated());
        return redirect()->route('admin.particulier.index')->with('update','Adresse mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Localisation $localisation)
    {
        $localisation->delete();
        return redirect()->route('admin.particulier.index')->with('delete','Adresse mise à jour avec succès');
    }
}
