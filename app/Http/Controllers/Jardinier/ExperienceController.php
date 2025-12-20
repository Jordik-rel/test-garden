<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
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
        $experience = new Experience();
        return view('jardinier.profile.freelancer.experienceForm',['experience'=>$experience]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request)
    {
        $experience = Experience::create($request->validated());
        return redirect()->route('jardinier.myaccount')->with('succes','Nouvelle expérience ajoutée avec succès');
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
    public function edit(Experience $experience)
    {
        return view('jardinier.profile.freelancer.experienceForm',['experience'=>$experience]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        return redirect()->route('jardinier.myaccount')->with('update','Expérience mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
       $experience->delete();
        return redirect()->route('jardinier.myaccount')->with('delete','Expérience supprimée avec succès');
    }
}
