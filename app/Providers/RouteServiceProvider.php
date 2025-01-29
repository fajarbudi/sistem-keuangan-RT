<?php

namespace App\Providers;


use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
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
        //
        URL::forceScheme('https');
    }
}
