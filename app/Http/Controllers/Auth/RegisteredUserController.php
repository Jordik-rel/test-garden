<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user = User::create([
            'email' => $request->email,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // dd($user->email_verified_at);

        if($request->user()->role === 'user'){
            return redirect()->route('particulier.dashboard')->with('succes','Bienvenue sur Green Connect !');
        }elseif($request->user()->role === 'jardinier'){
            return redirect()->route('jardinier.dashboard')->with('succes','Bienvenue votre espace jardinier Green Connect !');
        }elseif($request->user()->role === 'admin'){
            return redirect()->route('admin.dashboard')->with('succes','Bienvenue votre espace administrateur Green Connect !');
        }else{
            return redirect()->route('login')
                ->with('error', 'Accès non autorisé.');
        }
    }
}
