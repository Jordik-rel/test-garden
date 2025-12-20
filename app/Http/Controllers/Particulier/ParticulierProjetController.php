<?php

namespace App\Http\Controllers\Particulier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Particulier\ParticulierProjetRequest;
use App\Mail\MissionValidation;
use App\Models\AvisParticulier;
use App\Models\Competence;
use App\Models\Jardinier;
use App\Models\Mission;
use App\Models\Projet;
use App\Models\Proposition;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use function Symfony\Component\Clock\now;

class ParticulierProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projets = Projet::where('user_id',Auth::id())
                            ->whereIn('status',[2,4,5,6])
                            ->paginate(10);
        return view('particulier.projets.gestion',['projets'=>$projets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'is_Post'=>'required|boolean',
        ]);
        session()->put('projet.is_Post', $validated['is_Post']);
        session()->put('projet.user_id', Auth::id());
        $data = session('projet');
        $projet = Projet::create([
            'titre'=>$data['titre'],
            'description'=>$data['description'],
            'support'=>$data['support'] ?? null,
            'type_emploi'=>$data['type_emploi'],
            'duree'=>$data['duree'],
            'taille_poste'=>$data['taille_poste'],
            'tarif_min'=>$data['tarif_min'] ,
            'tarif_max'=>$data['tarif_max'] ,
            'tarif_type'=>$data['tarif_type'],
            'budget'=>$data['budget'],
            'niveau_experience'=>$data['niveau_experience'],
            'status'=> 1,
            'localisation'=>$data['localisation'] ?? null,
            // 'is_Public'=>true,
            'is_Post'=>$data['is_Post'],
            'user_id'=>$data['user_id'],
        ]);
        $projet->competence()->attach(session('projet.competences'));
        session()->forget('projet');
        // dd($projet);
        return redirect()->route('particulier.dashboard')->with('success','Projet créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        return view('particulier.projets.show',['projet'=>$projet]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projet $projet)
    {
        return view('particulier.projets.form',['projet'=>$projet,'competences'=>Competence::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticulierProjetRequest $request, Projet $projet)
    {
        $data = $request->validated();
        if($request->hasFile('support')) {
            if ($projet->support && Storage::disk('public')->exists($projet->support)) {
                Storage::disk('public')->delete($projet->support);
            }
            $originalName = $request->file('support')->getClientOriginalName();
            $path = $request->file('support')->storeAs('Projets', $originalName, 'public');
            $data['support'] = $path;
        }
        $projet->update($data);
        // dd($data);
        //Mail vers tous les jardinniers ayant postulés pour ce projet pour les informer des modifications
        return redirect()->route('particulier.dashboard')->with('update','Les informations concernant votre projet ont été mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        if ($projet->support && Storage::disk('public')->exists($projet->support)) {
            Storage::disk('public')->delete($projet->support);
        }
        $projet->delete();
        //Mail vers tous les jardinniers ayant postulés pour ce projet pour les informer de la suppression
        return redirect()->route('particulier.dashboard')->with('delete','Votre projet a été supprimé avec succès.');
    }

    public function title()
    {
        $user = Auth::user();
        
        if($user->localisation->isEmpty() || $user->payements->isEmpty()){
            return redirect()->route('particulier.settings.localisation')->with('update','Veuillez remplir votre profile avant de procéder à la publication d\'un job');
        }

        return view('particulier.projets.title',[
            'projet'=>new Projet()
        ]);
    }

    public function setp1(Request $request)
    {
        $validated = $request->validate([
                'titre'=>'required|string|min:10|max:255',
        ]);

        session([
            'projet'=>[
                'titre'=>$validated['titre']
            ] 
        ]);
        return redirect()->route('particulier.projet.skills');
    }

    public function skills()
    {
        return view('particulier.projets.competence',['competences'=>Competence::all()]);
    }

    public function setp2(Request $request)
    {
        $validated = $request->validate([
                'competences'=>'required|array',
                'competences.*'=>'exists:competences,id',
        ]);

        session()->put('projet.competences', $validated['competences']);

        return redirect()->route('particulier.projet.duration');
    }

    public function duration()
    {
        return view('particulier.projets.duration');
    }

    public function setp3(Request $request)
    {
        $validated = $request->validate([
                'taille_poste'=>'required|integer|min:1|max:5',
                'duree'=>'required|integer',
                'niveau_experience'=>'required|integer|min:1|max:5',
                'type_emploi'=>'required|integer|min:0|max:2',
        ]);

        session()->put('projet.taille_poste', $validated['taille_poste']);
        session()->put('projet.duree', $validated['duree']);
        session()->put('projet.niveau_experience', $validated['niveau_experience']);
        session()->put('projet.type_emploi', $validated['type_emploi']);

        return redirect()->route('particulier.projet.budget');
    }

    public function budget()
    {
        return view('particulier.projets.budget');
    }

    public function setp4(Request $request)
    {
        $validated = $request->validate([
            'tarif_type'=>'required|integer|min:0|max:1',
        ]);

        if($validated['tarif_type'] == 0){
            $request->validate([
                'tarif_min'=>'required|integer|min:0',
                'tarif_max'=>'required|integer|min:0|gte:tarif_min',
            ]);
            session()->put('projet.tarif_min', $request->input('tarif_min'));
            session()->put('projet.tarif_max', $request->input('tarif_max'));
            session()->put('projet.budget', 0);
        }else{
            $request->validate([
                'budget'=>'required|integer|min:0',
            ]);
            session()->put('projet.budget', $request->input('budget'));
            session()->put('projet.tarif_min', 0);
            session()->put('projet.tarif_max', 0);
        }

        session()->put('projet.tarif_type', $validated['tarif_type']);

        return redirect()->route('particulier.projet.description');
    }

    public function description()
    {
        return view('particulier.projets.description');
    }

    public function setp5(Request $request)
    {
        $validated = $request->validate([
            'description'=>'required|string|min:50|max:5000',
            'support'=>'nullable|file|mimes:pdf,doc,docx,txt|max:3072',
        ]);
        if ($request->hasFile('support')) {
            $originalName = $request->file('support')->getClientOriginalName();
            $path = $request->file('support')->storeAs('Projets', $originalName, 'public');
            session()->put('projet.support', $path);
        } 

        session()->put('projet.description', $validated['description']);

        return redirect()->route('particulier.projet.review');
    }

    public function review()
    {
        $competences = Competence::whereIn('id', session('projet.competences'))->get();
        return view('particulier.projets.review',compact('competences'));
    }

    /**
     * Fontion pour poster un projet i.e passer le projet du status brouillon au statut public
     */
    public function submit(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'is_Post'=>'required|integer|min:0|max:1',
        ]);
        $projet->update($data);
        // dd($projet);
        return redirect()->route('particulier.dashboard')->with('succes','Votre projet vient d\'être publié avec succès.');
    }

    /**
     * Fontionpour afficher toutes les propositions liées à un projet
     */
    public function projet_propositions(Projet $projet)
    {
        $propositions = $projet->propositions()->paginate(10);
        return view('particulier.proposition',['projet'=>$projet,'propositions'=>$propositions]);
    }

    /**
     * Fonction qui donne une réponse suite à une proposition faite par les utilisateurs sur un projet
     * 2 pour proposition accepté , 3 pour proposition refusé
     */
    public function select_jardinier(Request $request,Projet $projet)
    {
        $validate = $request->validate([
            'jardinier'=>['required','exists:users,id',]
        ]);

        //Vérification de l'utilisateur créateur du projet
        if($projet->user_id != Auth::id()){
            abort(403,'Action non autorisée'); 
        }

        // Vérification du status du projet
        if ($projet->status != 1) {
            return redirect()->back()->with('error', 'Ce projet a déjà été attribué');
        }
        
        $proposition = Proposition::where('projet_id',$projet->id)
                                    ->where('user_id',$validate['jardinier'])
                                    ->firstOrFail();
        //Changement du statut de la proposition , elle passe à accepté
        $proposition->status = 2;
        $proposition->save();
        
        
        // Changement du statut des autres propositions qui passe à refusé
        $valeur = Proposition::where('projet_id', $projet->id)
        ->where('id', '!=', $proposition->id)
        ->update(['status' => 3]);

        // Changement du statut du projet qui passe à attribué
        $projet->status = 4;
        $projet->save();
        // Création de la mission qui comporte le jardinier(jardinier_id) et le particulier(user_id) avec le status 1=> en attente
        $mission = Mission::create([
            'projet_id'=>$projet->id,
            'user_id'=>Auth::id(),
            'jardinier_id'=> Jardinier::where('user_id',$validate['jardinier'])->first()->id,
            'montant'=> $proposition->tarif_propose,
            'status'=> 1,
            'date_debut'=>now()
        ]);
        // dd($mission);

        return redirect()->route('particulier.paiement.show',$mission)->with('succes', 'Projet attribué avec succès à ' . $proposition->user->nom . '. Veuillez procéder au paiement.');
    }

    /**
     * Fonction pour consulter une proposition
     */
    public function show_proposition(Projet $projet,Proposition $proposition)
    {
        return view('particulier.show_proposition',['projet'=>$projet,'proposition'=>$proposition]);
    }

    public function embaucher()
    {
        $jardiniers = Jardinier::paginate(10);
        return view('particulier.embaucher',['jardiniers'=>$jardiniers]);
    }

    public function details(Projet $projet)
    {
        return view('particulier.projets.mission',['projet'=>$projet]);
    }


    /**
     * Fonction pour valider la fin d'un projet
     */
    public function validation(Request $request,Projet $projet)
    {
        $status = $request->validate([
            'status'=>'required|integer'
        ]);

        if($projet->user->id != Auth::id()){
            abort(403,'Action non autorisée');
        }

        if($projet->mission->feda_payement==null || $projet->mission->feda_payement->status !== 'approved'){
            return redirect()->route('particulier.paiement.show',$projet->mission);
        }
        // Fin du projet et de la mission
        $projet->update($status);
        $projet->mission->status = 2;
        $projet->mission->save();
        $user = User::where('role','admin')->first();
        Mail::to($user->email)->send(new MissionValidation($projet->mission));
        // dd($projet->mission); 
        return redirect()->route('particulier.projet.avis',$projet)->with('succes','Fin du projet');
    }


    /**
     * Fonction pour donner son avis sur un jardinier suite à la fin d'un projet
     */
    public function rapport()
    {
        $user = Auth::user();
        $avis = AvisParticulier::where('user_id',$user->id)->paginate(10);
        // dd(AvisParticulier::all());
        return view('particulier.rapport',['avis'=>$avis]);
    }

    /**
     * Affiche uniquement les projets qui ont un statut terminé
     */
    public function historisques()
    {
        $projets = Projet::where('user_id',Auth::id())
                            ->where('status',3)->paginate(10);
        return view('particulier.historique',['projets'=>$projets]);
    }
}
