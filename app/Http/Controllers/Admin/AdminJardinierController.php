<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminJardinierRequest;
use App\Models\Jardinier;
use App\Models\User;
use Illuminate\Http\Request;

class AdminJardinierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jardiniers = Jardinier::paginate(10);
        return view('admin.jardinier.index',['jardiniers'=>$jardiniers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role','user')->get();
        return view('admin.jardinier.form',[
            'jardinier'=>new Jardinier(),
            'users'=>$users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminJardinierRequest $request)
    {
        $jardinier = Jardinier::create($request->validated());
        return redirect()->route('admin.jardinier.index')->with('succes','Nouveau compte jardinier créé avec succès');
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
    public function edit(Jardinier $jardinier)
    {
        return view('admin.jardinier.update',[
            'jardinier'=> $jardinier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jardinier $jardinier)
    {
        $jardinier->update($request->validate([
            'profession'=>['required','string'],
            'description'=>['required','string'],
            'tarif_horaire'=>['required','integer'],
            'tarif_journalier'=>['required','integer'],
            'site_web'=>['nullable','string','url'],
        ]));

        return redirect()->route('admin.jardinier.index')->with('update','Jardinier mise à jour avec succès');
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
