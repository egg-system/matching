<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Occupation;
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
        $this->app->bind('App\Services\AuthService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['gymowner.trainerList', 'trainer._form'], function($view) {
            $view->with([
                'areas' => Area::all(),
                'occupations' => Occupation::all(),
            ]);
        });
    }
}
