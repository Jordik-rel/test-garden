<?php

namespace App\Http\Controllers\Particulier;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocalisationRequest;
use App\Http\Requests\PayementRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Localisation;
use App\Models\Payement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetingController extends Controller
{
    public function profile()
    {
        return view('particulier.settings.profile',['user'=>Auth::user()]);
    }

     public function update(ProfileUpdateRequest $request)
    {
        $request->user()->update($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        return redirect()->back()->with('update','Profile modifié avec succès');
    }

    public function localisation()
    {
        return view('particulier.settings.localisation',['user'=>Auth::user()]);
    }

    public function create_localisation()
    {
        return view('particulier.settings.locationForm',['localisation'=>new Localisation()]);
    }

    public function store_localisation(LocalisationRequest $request)
    {
        $localisation = Localisation::create($request->validated());
        return redirect()->route('particulier.settings.localisation')->with('succes','Adresse ajoutée avec succès');
    }

    public function edit_localisation(Localisation $localisation)
    {
        return view('particulier.settings.locationForm',['localisation'=>$localisation]);
    }

    public function update_localisation(LocalisationRequest $request,Localisation $localisation)
    {
        $localisation->update($request->validated());
        return redirect()->route('particulier.settings.localisation')->with('update','Adresse mise à jour avec succès');
    }

    public function destroy_localisation(Localisation $localisation)
    {
        if($localisation->user->id != Auth::id()){
            abort(403,'Accès refusé');
        }
        $localisation->delete();
        return redirect()->back()->with('delete','Localisation supprimé avec succès');
    }

    public function changeMethode(Request $request,Localisation $localisation)
    {
        $localisations = Localisation::where('user_id',Auth::id())->get();
        foreach($localisations as $item){
            if($item->status){
                $item->status = false;
                $item->save();
                break;
            }
        }
        $localisation->status = true;
        $localisation->save();
        return redirect()->back()->with('update','Adresse mise à jour avec succès');
    }

    public function payement_method()
    {
        return view('particulier.settings.method_payement',['payements'=>Payement::where('user_id',Auth::id())->paginate(10)]);
    }

    public function create_payement()
    {
        return view('particulier.settings.payementForm',['payement'=>new Payement()]);
    }

    public function store_payement(PayementRequest $request)
    {
         $payement = Payement::create($request->validated());
        return redirect()->route('particulier.settings.payement')->with('succes','Nouveau moyen de payement ajouté');
    }

    public function edit_payement(Payement $payement)
    {
        return view('particulier.settings.payementForm',['payement'=>$payement]);
    }

    public function update_payement(PayementRequest $request,Payement $payement)
    {
        $payement->update($request->validated());
        return redirect()->route('particulier.settings.payement')->with('update','Moyen de payement mise à jour avec succès');
    }

    public function destroy_payement(Payement $payement)
    {
        $payement->delete();
        return redirect()->back()->with('delete','Moyen de payement supprimé');
    }

    public function changeCarte(Request $request,Payement $payement){
        $payements = Payement::where('user_id',Auth::id())->get();
        foreach($payements as $item){
            if($item->status){
                $item->status = false;
                $item->save();
                break;
            }
        }
        $payement->status = true;
        $payement->save();
        return redirect()->back()->with('update','Moyen de payement mise à jour avec succès');
    }
}
