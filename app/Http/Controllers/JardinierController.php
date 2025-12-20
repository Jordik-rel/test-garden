<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminJardinierRequest;
use App\Models\Jardinier;
use Illuminate\Http\Request;

class JardinierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jardiniers = Jardinier::all();
        return view('admin.jardinier.index',['jardiniers'=>$jardiniers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jardinier.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminJardinierRequest $request)
    {
        $jardinier = Jardinier::create($request->validated());
        return redirect()->route('admin.jardinier.index')->with('succes','Jardinier ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jardinier $jardinier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jardinier $jardinier)
    {
        return view('admin.jardinier.form',['jardinier'=>$jardinier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminJardinierRequest $request, Jardinier $jardinier)
    {
        $jardinier->update($request->validated());
        return redirect()->route('admin.jardinier.index')->with('succes','Jardinier mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jardinier $jardinier)
    {
        $jardinier->delete();
        return redirect()->route('admin.jardinier.index')->with('succes','Jardinier supprimé avec succès');
    }
}
