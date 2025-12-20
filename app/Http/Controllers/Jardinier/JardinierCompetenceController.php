<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\JardinierCompetenceRequest;
use App\Models\Jardinier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JardinierCompetenceController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JardinierCompetenceRequest $request)
    {
        $jardinier = Jardinier::findOrFail($request->jardinier_id);

        $jardinier->competences()->sync($request->competences);

        return back()->with('succes','Compétences enregistrées');
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
    public function update(JardinierCompetenceRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
