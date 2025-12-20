<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayementRequest;
use App\Models\Payement;
use Illuminate\Http\Request;

class PayementController extends Controller
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
        $payement = new Payement();
        return view('jardinier.profile.payement.form',['payement'=>$payement]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayementRequest $request)
    {
        $payement = Payement::create($request->validated());
        return redirect()->route('jardinier.myaccount')->with('succes','Nouveau moyen de payement ajouté');
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
    public function edit(Payement $payement)
    {
        return view('jardinier.profile.payement.form',['payement'=>$payement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PayementRequest $request, Payement $payement)
    {
        $payement->update($request->validated());
        return redirect()->route('jardinier.myaccount')->with('update','Moyen de payement mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payement $payement)
    {
        $payement->delete();
        return redirect()->route('jardinier.myaccount')->with('delete','Moyen de payement supprimé');
    }

    public function changeMethode(Request $request,Payement $payement){
        $payements = Payement::all();
        foreach($payements as $item){
            if($item->status){
                $item->status = false;
                $item->save();
                break;
            }
        }
        $payement->status = true;
        $payement->save();
        return redirect()->route('jardinier.myaccount')->with('update','Moyen de payement mise à jour avec succès');
    }
}
