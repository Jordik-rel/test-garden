<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

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

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
