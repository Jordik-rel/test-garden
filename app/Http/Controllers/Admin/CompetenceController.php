<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompetenceRequest;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.competences.index',[
            'competences'=>Competence::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.competences.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetenceRequest $request)
    {
        $competence = Competence::create($request->validated());
        return redirect()->route('admin.jardinier.index')->with('success','Compétence ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        // $competence;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        return view('admin.competences.form',compact('competence'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(CompetenceRequest $request, Competence $competence)
    {
        $competence->update($request->validated());
        return redirect()->route('admin.jardinier.index')->with('success','Compétence mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();
        return redirect()->route('admin.jardinier.index')->with('success','Compétence supprimée avec succès.');
    }
}
