<?php

namespace App\Http\Controllers;

use App\Http\Requests\JardinierRequest;
use App\Models\Jardinier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterJardinierFinishController extends Controller
{
    public function create()
    {
        return view('auth.register-jardinier-finish');
    }

    public function store(JardinierRequest $request)
    {
        // dd($request->validated());
        $jardinier = Jardinier::create($request->validated());
        
        return redirect()->route('jardinier.dashboard')->with('success', 'Bienvenu sur Green-Connect.Veuillez completer votre profil jardinier.');
    }
}
