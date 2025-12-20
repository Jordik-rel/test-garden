<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalisationRequest;
use App\Models\Localisation;
use Illuminate\Http\Request;

class LocalisationController extends Controller
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
        return view('jardinier.profile.adresse.form',['localisation'=>$localisation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocalisationRequest $request)
    {
        // dd($request->validated());
        $localisation = Localisation::create($request->validated());
        return redirect()->route('jardinier.myaccount')->with('succes','Adresse ajoutée avec succès');
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
        return view('jardinier.profile.adresse.form',['localisation'=>$localisation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocalisationRequest $request, Localisation $localisation)
    {
        $localisation->update($request->validated());
        return redirect()->route('jardinier.myaccount')->with('update','Adresse mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Localisation $localisation)
    {
        $localisation->delete();
        return redirect()->route('jardinier.myaccount')->with('delete','Adresse supprimée avec succès');
    }

    public function changeMethode(Request $request,Localisation $localisation)
    {
        $localisations = Localisation::all();
        if($localisations->count() >2){
            foreach($localisations as $item){
                if($item->status){
                    $item->status = false;
                    $item->save();
                    break;
                }
            }
        }else{
            $localisation->status = true;
            $localisation->save();
        }
        return redirect()->route('jardinier.myaccount')->with('update','Adresse mise à jour avec succès');
    }
}
