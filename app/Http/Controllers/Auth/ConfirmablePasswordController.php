<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        switch ($request->user()->role) {
            case 'user':
                return redirect()->route('particulier.dashboard')
                    ->with('succes', 'Bienvenue sur Green Connect !');

            case 'jardinier':
                return redirect()->route('jardinier.dashboard')
                    ->with('succes', 'Bienvenue votre espace jardinier Green Connect !');

            case 'admin':
                return redirect()->route('admin.dashboard')
                    ->with('succes', 'Bienvenue votre espace administrateur Green Connect !');

            default:
                return redirect()->route('login')
                    ->with('error', 'Accès non autorisé.');
        }
    }
}
