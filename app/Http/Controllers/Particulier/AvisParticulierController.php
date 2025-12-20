<?php

namespace App\Http\Controllers\Particulier;

use App\Http\Controllers\Controller;
use App\Models\AvisParticulier;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisParticulierController extends Controller
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
    public function create(Projet $projet)
    {
        return view('particulier.note',['projet'=>$projet]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Projet $projet)
    {
        $validate = $request->validate([
            'note'=>['required','integer','max:5','min:0'],
            'commentaire'=>['required','max:2000']
        ]);
        if($projet->user_id != Auth::id()){
            abort(403,'Accès refusé');
        }
        $avis = AvisParticulier::create([
            'note'=>$validate['note'],
            'commentaire'=>$validate['commentaire'],
            'jardinier_id'=>$projet->mission->jardinier->id,
            'projet_id'=> $projet->id,
            'user_id'=> Auth::id()
        ]);
        return redirect()->route('particulier.projets.rapport')->with('succes','Merci pour votre avis sur l\'exécution du projet');
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
    public function update(Request $request, string $id)
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
