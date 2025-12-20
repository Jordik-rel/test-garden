<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterFinishController extends Controller
{
    public function create(){
        return view('auth.register-finish');
    }

    public function store(Request $request){
        $user = Auth::user();
        $user->update($request->validate(['role'=>['required']]));
        switch($user->role){
            case "jardinier":
                return redirect()->route('register-jardinier.finish');
            case "user":
                return redirect()->route('particulier.dashboard');
            default:
                abort(403);
        }
    }
}
