<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {        
        if (env('APP_ENV') == 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }
        
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('Finalisez la création de votre compte Green Connect !')
                ->subject('Confirmation d\'adresse email')
                ->line('Continuez la création de votre compte en procédant à la confirmation de votre adresse email.')
                ->action('Confirmer mon adresse mail', $url)
                ->line('Si vous n’avez, toutefois, pas demandé la création d’un compte Green Connect, veuillez ignorer ou supprimer ce message. ');
        });
    }
}
