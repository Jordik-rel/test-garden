<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\EducationRequest;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
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
        $education = new Education();
        return view('jardinier.profile.freelancer.etudeForm',['education'=>$education]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationRequest $request)
    {
        $education = Education::create($request->validated());
        return redirect()->route('jardinier.myaccount')->with('succes','Nouvelle formation ajoutée avec succès');
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
    public function edit(Education $education)
    {
        return view('jardinier.profile.freelancer.etudeForm',['education'=>$education]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationRequest $request, Education $education)
    {
        $education->update($request->validated());
        return redirect()->route('jardinier.myaccount')->with('update','Formation mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->deleteeleted();
         return redirect()->route('jardinier.myaccount')->with('delete','Formation supprimée avec succès');
    }
}
