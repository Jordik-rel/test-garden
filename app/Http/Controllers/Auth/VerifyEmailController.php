<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

use function PHPUnit\Framework\isEmpty;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        if ($request->user()->hasVerifiedEmail()) {
            if($user->password){
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

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if($user->password){
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
}
