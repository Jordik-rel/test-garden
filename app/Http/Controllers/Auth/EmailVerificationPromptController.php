<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function PHPUnit\Framework\isEmpty;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if($request->user()->hasVerifiedEmail()){
            if($request->user()->password){
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
            return redirect()->route('register.complete');
        }
        return view('auth.verify-email');
    }
}
