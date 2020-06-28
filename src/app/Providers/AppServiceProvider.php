<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Offer;
use App\Observers\OfferObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\AuthService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Offer::observe(OfferObserver::class);
    }
}
