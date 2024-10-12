<?php

namespace App\Providers;

use App\Services\UrlShortenerService;
use Illuminate\Support\ServiceProvider;

class UrlShortenerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(UrlShortenerService::class, function ($app) {
            return new UrlShortenerService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
