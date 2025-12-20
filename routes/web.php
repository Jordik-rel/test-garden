<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminJardinierController;
use App\Http\Controllers\Admin\AdminLocalisationController;
use App\Http\Controllers\Admin\AdminParticulierController;
use App\Http\Controllers\Admin\CategoriePlanteController;
use App\Http\Controllers\Admin\ParticulierController;
use App\Http\Controllers\Admin\PlantController;
use App\Http\Controllers\Admin\ProjetController;
use App\Http\Controllers\Admin\ValeurNutritionnelleController;
use App\Http\Controllers\Admin\VertusMedicinaleController;
use App\Http\Controllers\FedaPayController;
use App\Http\Controllers\Jardinier\BlogController;
use App\Http\Controllers\Jardinier\CertificationController;
use App\Http\Controllers\Jardinier\EducationController;
use App\Http\Controllers\Jardinier\ExperienceController;
use App\Http\Controllers\Jardinier\JardinierCompetenceController;
use App\Http\Controllers\Jardinier\PropositionController;
use App\Http\Controllers\Jardinier\RealisationController;
use App\Http\Controllers\Jardinier\RecapController;
use App\Http\Controllers\Jardinier\ServiceController;
use App\Http\Controllers\JardinierController;
use App\Http\Controllers\LocalisationController;
use App\Http\Controllers\MomoController;
use App\Http\Controllers\Particulier\AvisParticulierController;
use App\Http\Controllers\Particulier\MissionController;
use App\Http\Controllers\Particulier\ParticulierProjetController;
use App\Http\Controllers\Particulier\SetingController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterCompleteController;
use App\Http\Controllers\RegisterFinishController;
use App\Http\Controllers\RegisterJardinierFinishController;
use App\Mail\AdminBlogCreation;
use App\Mail\AdminBlogStatus;
use App\Mail\AdminParticulierCreation;
use App\Mail\JardinierBlogCreation;
use App\Mail\MissionValidation;
use App\Models\AvisParticulier;
use App\Models\Blog;
use App\Models\Competence;
use App\Models\Jardinier;
use App\Models\Localisation;
use App\Models\Mission;
use App\Models\Plant;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',[
        'commentaires'=>AvisParticulier::all(),
        'plants'=>Plant::all()
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    
    $monthly = Mission::where('status', 2)
        ->select([
           DB::raw("strftime('%Y-%m', created_at) as period"),
            DB::raw("COUNT(*) as total_projects"),
            DB::raw("SUM(montant) as total_amount")
        ])
        ->groupBy('period')
        ->orderBy('period')
        ->get();

    $quarterly = Mission::where('status', 2)
        ->select([
            DB::raw("
                strftime('%Y', created_at) || '-T' ||
                ((CAST(strftime('%m', created_at) AS INTEGER) - 1) / 3 + 1)
                as period
            "),
            DB::raw("COUNT(*) as total_projects"),
            DB::raw("SUM(montant) as total_amount")
        ])
        ->groupBy('period')
        ->orderBy('period')
        ->get();

    $stats = Mission::where('status', 2)
        ->selectRaw("strftime('%Y', created_at) AS period,
                    COUNT(*) AS total_projects,
                    SUM(montant) AS total_amount")
        ->groupBy('period')
        ->orderBy('period', 'asc')
        ->get();

    $inscriptions = User::selectRaw("
            strftime('%Y-%m', created_at) as period,
            SUM(CASE WHEN role = 'jardinier' THEN 1 ELSE 0 END) as jardiniers,
            SUM(CASE WHEN role = 'user' THEN 1 ELSE 0 END) as particuliers
        ")
        ->groupBy('period')
        ->orderBy('period', 'asc')
        ->get();
    
    return view('admin.dashboard',[
        'missions'=>Mission::all(),
        'jardiniers'=>Jardinier::all()->count(),
        'projets'=>Projet::count(),
        'monthly' => $monthly,
        'quarterly' => $quarterly,
        'annually' => $stats,
        'inscriptions'=>$inscriptions
    ]);
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('register/complete',[RegisterCompleteController::class, 'create'])
    ->middleware(['auth', 'verified'])        
    ->name('register.complete');

Route::put('register/complete',[RegisterCompleteController::class, 'store'])
    ->middleware(['verified'])
    ->name('register.complete');

Route::get('register/finish',[RegisterFinishController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('register.finish');

Route::put('register/finish',[RegisterFinishController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('register.finish');

Route::get('register-jardinier/finish',[RegisterJardinierFinishController::class,'create'])
    ->middleware(['auth', 'verified'])
    ->name('register-jardinier.finish');

Route::post('register-jardinier/finish',[RegisterJardinierFinishController::class,'store'])
    ->middleware(['auth', 'verified'])
    ->name('register-jardinier.finish');

Route::get('mon-compte',function (){
    return view('jardinier.profile.myprofile',['competences'=>Competence::all()]);
})->middleware(['auth', 'verified'])
->name('jardinier.myaccount');

Route::get('jardinier/dashboard',function(){
    $projet = Projet::where('is_Post',1)
                ->where('status',1)
                ->whereDoesntHave('propositions', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->paginate(10);
    return view('jardinier.dashboard',[
        'projets'=>$projet,
        'user'=>Auth::user()
    ]);
})->middleware(['auth', 'verified'])->name('jardinier.dashboard');


Route::prefix('user/')->name('user.')->middleware(['auth','verified'])->group(function (){
    Route::resource('payement',PayementController::class);
    Route::put('default/{payement}',[PayementController::class, 'changeMethode'])->name('default');
});

Route::prefix('jardinier/')->name('jardinier.')->middleware(['auth','verified'])->group(function (){
    Route::get('{projet}/projet', function (Projet $projet) {
        return view('jardinier.projets.show', [
            'projet' => $projet
        ]);
    })->name('projet.show');

    Route::get('recap/dashboard',function(){
        return view('jardinier.recap.dashboard',['propositions'=>Auth::user()->propositions]);
    })->name('recap.dashboard');

    /**
     * Affiche toutes les soumissions faites
     */
    Route::get('recap/soumission',function(){
        return view('jardinier.recap.soumission',['propositions'=>Auth::user()->propositions]);
    })->name('recap.soumission');

    /**
     * Affiche tous les projets
     */
    Route::get('recap/projets',function(){
        $projets = Projet::whereHas('propositions', function ($query) {
            $query->where('user_id', Auth::id());
        })->paginate(10);
        return view('jardinier.recap.projets',['projets'=>$projets]);
    })->name('recap.projets');

    Route::get('mes-projets',[RecapController::class, 'mes_projets'])->name('projets');
    Route::get('mon-job/{mission}',[RecapController::class, 'show_projet'])->name('projets.consulter');
    Route::put('mon-job/{mission}',[RecapController::class, 'validation_mission'])->name('projets.validation');
    Route::get('mes-soumissions',[RecapController::class, 'mes_propositions'])->name('soumissions');
    Route::get('ma-soumission/{proposition}',[RecapController::class, 'show_proposition'])->name('soumissions.consulter');
    Route::get('historisques',[RecapController::class, 'historiques'])->name('historisques');

    Route::resource('competence',JardinierCompetenceController::class);
    Route::resource('realisation',RealisationController::class);
    Route::resource('certification',CertificationController::class);
    Route::resource('experience',ExperienceController::class);
    Route::resource('education',EducationController::class);
    Route::resource('service',ServiceController::class);
    Route::resource('localisation',LocalisationController::class);
    Route::put('default/{localisation}',[LocalisationController::class, 'changeMethode'])->name('default');
    Route::resource('blog',BlogController::class);
    Route::resource('{projet}/proposition',PropositionController::class);
});

Route::prefix('admin/')->name('admin.')->middleware(['auth', 'verified'])->group(function(){
    Route::get('blogs',[BlogController::class, 'invalidate'])->name('invalidate');
    Route::get('blogs/{blog}',[BlogController::class, 'viewblog'])->name('viewblog');
    Route::put('blogs/{blog}',[BlogController::class, 'analyse'])->name('analyse');
    Route::get('projets',[ProjetController::class, 'index'])->name('projet.index');
    Route::get('archive',[ProjetController::class,'archive'])->name('projet.archive');
    Route::get('mission',[ProjetController::class, 'gerer'])->name('mission.index');
    Route::get('mission/{mission}',[ProjetController::class, 'show_mission'])->name('mission.show');
    Route::resource('jardinier',JardinierController::class);
    Route::resource('plant/categorie',CategoriePlanteController::class);
    Route::resource('plant/valeur',ValeurNutritionnelleController::class);
    Route::resource('plant/vertu',VertusMedicinaleController::class);
    Route::resource('plant',PlantController::class);
    Route::resource('/particulier',AdminParticulierController::class);
    Route::resource('jardinier',AdminJardinierController::class);
    Route::resource('localisation',AdminLocalisationController::class);
    // Route::resource('plant/valeur_nutritionnelle',ValeurNutritionnelleController::class);
    // Route::resource('plant/vertu_medicinale',VertusMedicinaleController::class);
    // Route::get('plant/valeur',[ValeurNutritionnelleController::class, 'index'])->name('valeur');
});

Route::prefix('particulier/')->name('particulier.')->middleware(['auth', 'verified'])->group(function(){
    Route::get('dashboard',function(){
        return view('particulier.dashboard',['projets'=>Projet::where('user_id',Auth::id())
                                                            ->where('status',1)
                                                            ->get(),'user'=>Auth::user()]);
    })->name('dashboard');

    // Facturation Routes
    Route::get('settings/methode-facturation',[SetingController::class,'payement_method'])->name('settings.payement');
    Route::get('settings/methode-facturation/create',[SetingController::class,'create_payement'])->name('settings.payement.create');
    Route::post('settings/methode-facturation/create',[SetingController::class,'store_payement'])->name('settings.payement.store');
    Route::get('settings/methode-facturation/{payement}/edit',[SetingController::class,'edit_payement'])->name('settings.payement.edit');
    Route::put('settings/methode-facturation/{payement}/edit',[SetingController::class,'update_payement'])->name('settings.payement.update');
    Route::delete('settings/methode-facturation/{payement}',[SetingController::class,'destroy_payement'])->name('settings.payement.destroy');
    Route::put('settings/methode-facturation/{payement}/default',[SetingController::class,'changeCarte'])->name('settings.payement.default');
    
    Route::get('settings/profile',[SetingController::class,'profile'])->name('settings.profile');
    Route::patch('settings/profile',[SetingController::class,'update'])->name('settings.profile.update');
    
    // Localisation Routes
    Route::get('settings/localisation',[SetingController::class,'localisation'])->name('settings.localisation');
    Route::get('settings/localisation/create',[SetingController::class, 'create_localisation'])->name('settings.create_localisation');
    Route::post('settings/localisation/create',[SetingController::class, 'store_localisation'])->name('settings.store_localisation');
    Route::get('settings/localisation/{localisation}',[SetingController::class, 'edit_localisation'])->name('settings.localisation.edit');
    Route::put('settings/localisation/{localisation}',[SetingController::class, 'update_localisation'])->name('settings.localisation.update');
    Route::delete('settings/localisation/{localisation}',[SetingController::class, 'destroy_localisation'])->name('settings.localisation.destroy');
    Route::put('settings/localisation/{localisation}/default',[SetingController::class, 'changeMethode'])->name('settings.localisation.default');

    Route::get('projet/title',[ParticulierProjetController::class, 'title'])->name('projet.title');
    Route::post('projet/title',[ParticulierProjetController::class, 'setp1'])->name('projet.setp1');
    Route::get('projet/skills',[ParticulierProjetController::class,'skills'])->name('projet.skills');
    Route::post('projet/skills',[ParticulierProjetController::class,'setp2'])->name('projet.setp2');
    Route::get('projet/duration',[ParticulierProjetController::class, 'duration'])->name('projet.duration');
    Route::post('projet/duration',[ParticulierProjetController::class, 'setp3'])->name('projet.setp3');
    Route::get('projet/budget',[ParticulierProjetController::class, 'budget'])->name('projet.budget');
    Route::post('projet/budget',[ParticulierProjetController::class, 'setp4'])->name('projet.setp4');
    Route::get('projet/description',[ParticulierProjetController::class, 'description'])->name('projet.description');
    Route::post('projet/description',[ParticulierProjetController::class, 'setp5'])->name('projet.setp5');
    Route::get('projet/review',[ParticulierProjetController::class, 'review'])->name('projet.review');
    Route::put('projet/{projet}/submit',[ParticulierProjetController::class, 'submit'])->name('projet.submit');
    Route::get('projet/{projet}/proposition',[ParticulierProjetController::class, 'projet_propositions'])->name('projet.proposition');
    Route::get('proposition/{projet}/show/{proposition}',[ParticulierProjetController::class, 'show_proposition'])->name('projet.proposition.show');
    Route::put('projet/{projet}/proposition',[ParticulierProjetController::class, 'select_jardinier'])->name('projet.select');
    Route::get('paiement/{mission}',[MissionController::class, 'show'])->name('paiement.show');
    
    Route::post('paiement/{mission}',[FedaPayController::class, 'create'])->name('paiement.mission');

    
    Route::get('projet/{projet}/details',[ParticulierProjetController::class, 'details'])->name('projet.details');
    Route::post('projet/{projet}/validation',[ParticulierProjetController::class, 'validation'])->name('projet.validation');

    Route::get('projet/{projet}/notes',[AvisParticulierController::class,'create'])->name('projet.avis');
    Route::post('projet/{projet}/notes',[AvisParticulierController::class,'store'])->name('projet.avis_store');
    
    Route::get('rapport',[ParticulierProjetController::class, 'rapport'])->name('projets.rapport');
    Route::get('embaucher',[ParticulierProjetController::class, 'embaucher'])->name('projets.embaucher');
    Route::get('historisques',[ParticulierProjetController::class, 'historisques'])->name('projets.historisques');
    // Route::post('paiement/{mission}/mobile-money',[MissionController::class, 'initierPaiementMobileMoney'])->name('paiement.mobile-money');
    // Route::get('/paiement/{mission}/callback', [MissionController::class, 'callback'])->name('paiement.callback');
    
    Route::resource('projet',ParticulierProjetController::class);

    
});

Route::get('/fedapay/callback/{mission}', [FedaPayController::class, 'callback'])->name('fedapay.callback')->middleware(['auth','verified']);

// Route::post('/mission/{mission}/pay', [MomoController::class, 'pay'])->name('momo.pay')->middleware('auth');
// Route::get('/mission/{mission}/status', [MomoController::class, 'checkStatus'])->name('momo.status')->middleware('auth');



Route::middleware(['auth'])->group(function () {
    Route::patch('/account',[AccountController::class, 'update'])->name('account.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mailable', function () {
 
    return new AdminBlogCreation();
});

Route::get('/test', function () {
    $blog = Blog::where('id',1)->first();
    return new JardinierBlogCreation($blog);
});


Route::get('/test1', function () {
    $blog = Blog::where('id',1)->first();
    return new AdminBlogStatus($blog);
});

Route::get('/test2', function () {
    $user = User::where('id',3)->first();
    $password = "bonjours122";
    return new AdminParticulierCreation($user,$password);
});

Route::get('/test3', function () {
    $mission = Mission::where('id',1)->first();
    return new MissionValidation($mission);
});


require __DIR__.'/auth.php';
