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
        
        $this->app->extend(UsersController::class, function ($usersController, $app) {
            if (isset($app['request']['id'])) {
                $usersController->setLoginId($app['request']['id']);
            }
            return $usersController;
        });

        $this->app->extend(LoginController::class, function ($loginController, $app) {
            if (\Route::current()->getName() === 'trainers.login') {
                $loginController->setUserType(Trainer::class);
            } elseif (\Route::current()->getName() === 'gyms.login') {
                $loginController->setUserType(Gym::class);
                $loginController->setRedirectTo(route('gyms.index'));
            }
            return $loginController;
        });
    }
}
