<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $user = $request->user();
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

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
