<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\RealisationRequest;
use App\Http\Requests\JardinierRequest;
use App\Models\Realisation;
use Illuminate\Http\Request;

class RealisationController extends Controller
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
        $realisation = new Realisation();
        return view('jardinier.profile.freelancer.form',['realisation'=>$realisation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RealisationRequest $request)
    {
        $realisation = Realisation::create($request->validated());
        return redirect()->route('jardinier.myaccount')->with('success','Réalisation ajoutée avec succès.');
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
    public function edit(Realisation $realisation)
    {
        return view('jardinier.profile.freelancer.form',['realisation'=>$realisation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RealisationRequest $request, Realisation $realisation)
    {
        $realisation->update($request->validated());
        return redirect()->route('jardinier.myaccount')->with('update','Réalisation mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Realisation $realisation)
    {
        $realisation->delete();
        return redirect()->back()->with('delete','Réalisation supprimée');
    }
}
