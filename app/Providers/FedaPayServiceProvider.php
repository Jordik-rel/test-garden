<?php

namespace App\Providers;

use FedaPay\FedaPay;
use Illuminate\Support\ServiceProvider;

class FedaPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FedaPay::setApiKey(config('fedapay.secret_key'));
        FedaPay::setEnvironment(config('fedapay.mode')); // sandbox ou live
    }
}
