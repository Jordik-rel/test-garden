<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jardinier;
use App\Models\JardinierPayement;
use App\Models\Mission;
use App\Models\Projet;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjetController extends Controller
{
    public function index()
    {
        return view('admin.project.index',[
            "projets"=> Projet::paginate(10)
        ]);
    }

    public function gerer()
    {
        $jardiniers = Jardinier::whereHas('mission', function ($query) {
                                $query->where('status', 2);
                            })
                            ->whereDoesntHave('jardinier_payement')
                            ->get();
        return view('admin.project.gestion',[
            'missions'=>Mission::where('status',2)->paginate(10),
            'jardiniers'=>$jardiniers
        ]);
    }

    public function show_mission(Mission $mission)
    {
        // dd($mission);
        return view('admin.project.show_mission',['mission'=>$mission]);
    }

    public function achevment(Request $request,Mission $mission)
    {

    }

    public function archive()
    {
        // $payements = JardinierPayement::paginate(10);
        return view('admin.project.archive',['payements'=>JardinierPayement::paginate(10)]);
    }
}
