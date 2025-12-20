<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jardinier\CertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
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
        $certification = new Certification();
        return view('jardinier.profile.freelancer.certificationForm',['certification'=>$certification]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificationRequest $request)
    {
        $certification = Certification::create($request->validated());
        return redirect()->route('jardinier.myaccount')->with('succes','Nouvelle certification ajoutée avec succès');
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
    public function edit(Certification $certification)
    {
         return view('jardinier.profile.freelancer.certificationForm',['certification'=>$certification]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificationRequest $request, Certification $certification)
    {
        $certification->update($request->validated());
        return redirect()->route('jardinier.myaccount')->with('update','Certification mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        $certification->delete();
        return redirect()->route('jardinier.myaccount')->with('delete','Certification supprimée avec succès');
    }
}
