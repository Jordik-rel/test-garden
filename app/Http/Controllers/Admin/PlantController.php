<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlantRequest;
use App\Models\Plant;
use App\Models\PlantCategorie;
use App\Models\ValeurNutritionnelle;
use App\Models\VertuMedicinale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::paginate(10);
        return view('admin.plant.index',['plants'=>$plants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plant = new Plant();
        return view('admin.plant.form',[
            'plant'=>$plant,
            'categories'=> PlantCategorie::all(),
            'valeurs'=>ValeurNutritionnelle::all(),
            'vertus'=>VertuMedicinale::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlantRequest $request)
    {
        $validated = $request->validated();
        $place = "Bibliotheque/Plant_".$request->nom_local.Auth::id();
        if($request->hasFile('image')){
            $filePaths = [];
            foreach($request->file('image') as $fichier){
                $originalName = $fichier->getClientOriginalName();             
                $chemin =  $fichier-> storeAs($place,$originalName,'public');
                $filePaths[] = $chemin;
            }
            // $originalName = $request->file('image')->getClientOriginalName();
            $validated['image'] = $filePaths;
            // $request->file('image')->storeAs('Bibliotheque',$originalName,'public');
        }

        $plant = Plant::create([
            'nom' =>$validated['nom'],
            'nom_scientifique' =>$validated['nom_scientifique'],
            'nom_local' =>$validated['nom_local'],
            'image' =>$validated['image'],
            'description' =>$validated['description'],
            'precautions' =>$validated['precautions'],
            'conseil_culture' =>$validated['conseil_culture'],
        ]);

        $plant->plant_categorie()->sync($validated['categories']);
        $plant->valeur_nutritionnelle()->sync($validated['valeur_nutritionnelles']);
        $plant->vertu_medicinale()->sync($validated['vertus']);

        return redirect()->route('admin.plant.index')->with('succes','Nouvelle plante ajoutée à la bibliothèque');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        return view('admin.plant.show',['plant'=>$plant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        return view('admin.plant.form',[
            'plant'=>$plant,
            'categories'=> PlantCategorie::all(),
            'valeurs'=>ValeurNutritionnelle::all(),
            'vertus'=>VertuMedicinale::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlantRequest $request, Plant $plant)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($plant->image && Storage::disk('public')->exists($plant->image)) {
                Storage::disk('public')->delete($plant->image);
            }
            $originalName = $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('Bibliotheque',$originalName,'public');
        } 

        $plant->update([
            'nom' => $validated['nom'],
            'nom_scientifique' => $validated['nom_scientifique'],
            'nom_local' => $validated['nom_local'] ,
            'description' => $validated['description'] ,
            'precautions' => $validated['precautions'] ,
            'conseil_culture' => $validated['conseil_culture'] ,
            'image' => $validated['image'],
        ]);

        $plant->plant_categorie()->sync($validated['categories']);
        $plant->valeur_nutritionnelle()->sync($validated['valeur_nutritionnelles']);
        $plant->vertu_medicinale()->sync($validated['vertus']);

        return redirect()->route('admin.plant.index',$plant)->with('update','Information de la plante mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        if ($plant->image && Storage::disk('public')->exists($plant->image)) {
            Storage::disk('public')->delete($plant->image);
        }
        $plant->delete();
        return redirect()->back()->with('delete','Information sur la plante supprimée');
    }
}
