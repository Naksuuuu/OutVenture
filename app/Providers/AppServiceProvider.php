<?php

namespace App\Providers;

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
        if (request()->header('X-Forwarded-Proto') === 'https' || request()->header('X-Forwarded-Ssl') === 'on') {
            \URL::forceScheme('https');
            \URL::forceRootUrl(config('app.url'));
            request()->server->set('HTTPS', 'on');
        }
    }
}
