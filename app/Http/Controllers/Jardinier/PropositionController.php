<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\Propositionrequest;
use App\Models\Projet;
use App\Models\Proposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropositionController extends Controller
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
        $user = Auth::user();
        if($user->localisation->isEmpty() || $user->payements->isEmpty() || $user->jardinier->services->isEmpty()){
            return redirect()->route('jardinier.myaccount')->with('update','Veuillez completer votre profile afin de postuler à votre première offre.');
        }
        return view('jardinier.projets.proposition',compact('projet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Propositionrequest $request) 
    {
        $data = $request->validated();
        $place = "Propositions/Projet_".$request->projet_id."/Jardinier_".auth()->id();
        if($request->hasFile('support')){
            $filePaths = [];
            foreach($request->file('support') as $fichier){
                $originalName = $fichier->getClientOriginalName();             
                $chemin =  $fichier-> storeAs($place,$originalName,'public');
                $filePaths[] = $chemin;
            }
            $data['support'] = json_encode($filePaths);
        }
        $proposition = Proposition::create($data);
        return redirect()->route('jardinier.dashboard')->with('success','Proposition soumise avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposition $proposition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposition $proposition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposition $proposition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposition $proposition)
    {
        //
    }
}
