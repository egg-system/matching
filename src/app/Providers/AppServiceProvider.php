<?php

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsersController;
use App\Models\Gym;
use App\Models\Offer;
use App\Models\Trainer;
use App\Observers\OfferObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Offer::observe(OfferObserver::class);

        $this->app->when(UsersController::class)
            ->needs('$loginId')
            ->give(function () {
                if (isset($this->app['request']['id'])) {
                    return $this->app['request']['id'];
                }
                return null;
            });
        $this->app->when(LoginController::class)
            ->needs('$userType')
            ->give(function () {
                if (\Route::current()->getName() === 'trainers.login') {
                    return Trainer::class;
                } elseif (\Route::current()->getName() === 'gyms.login') {
                    return Gym::class;
                }
                return '';
            });
        $this->app->when(LoginController::class)
            ->needs('$redirectTo')
            ->give(function () {
                if (\Route::current()->getName() === 'gyms.login') {
                    return route('gyms.index');
                }
                return '';
            });
    }
}
