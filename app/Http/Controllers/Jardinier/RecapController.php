<?php

namespace App\Http\Controllers\Jardinier;

use App\Http\Controllers\Controller;
use App\Mail\JardinierMissionValidation;
use App\Models\Mission;
use App\Models\Projet;
use App\Models\Proposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RecapController extends Controller
{

    /**
     * Fonction pour consulter tous les projets en cours d'un jardinier
     */
    public function mes_projets()
    {
        $missions = Mission::where('jardinier_id', Auth::user()->jardinier->id)
                            ->whereHas('projet', function ($query) {
                                $query->whereIn('status', [2, 4,5,6]);
                            })
                            ->with('projet')
                            ->paginate(10);
        // dd($missions);
        return view('jardinier.projets.mes_projets',['missions'=>$missions]);
    }

    public function show_projet(Mission $mission)
    {
        // dd($mission);
        return view('jardinier.projets.show_projet',[
            'mission'=>Mission::where('id',$mission->id)->where('jardinier_id',Auth::user()->jardinier->id)->first()]
        );
    }


    /**
     * Fonction pour consulter toutes les propositions d'un jardinier classé par status
     */
    public function mes_propositions()
    {
        $propositions = Proposition::where('user_id',Auth::id())->paginate(10);
        return view('jardinier.projets.mes_propositions',['propositions'=>$propositions]);
    }

    /**
     * Fonction pour consulter la proposition faite
     */
    public function show_proposition(Proposition $proposition)
    {
        // dd($proposition);
        return view('jardinier.projets.show_proposition',[
            'proposition'=>$proposition
        ]);
    }


    /**
     * Fonction pour afficher l'historiques des projets réalisés 
     */
    public function historiques()
    {
        $projets = Mission::where('jardinier_id',Auth::user()->jardinier->id)
                            ->whereIn('status',[2,3])->paginate(10);
        return view('jardinier.projets.historiques',['missions'=>$projets]);
    }

    public function validation_mission(Request $request,Mission $mission)
    {
         $status = $request->validate([
            'status'=>'required|integer'
        ]);

        if($mission->jardinier->id != Auth::user()->jardinier->id){
            abort(403,'Action non autorisée');
        }

        $mission->projet()->update($status);
        $particulier = $mission->user;
        Mail::to($particulier->email)->send(new JardinierMissionValidation($mission));
        return redirect()->route('jardinier.projets');
    }
}
