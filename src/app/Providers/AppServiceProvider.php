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
        $this->app->bind('App\Services\TrainerService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['gymowner.trainerList', 'trainer._commonForm'], function($view) {
            $view->with([
                'areas' => Area::all()
            ]);
        });
        view()->composer(['gymowner.trainerList', 'trainer.edit'], function($view) {
            $view->with([
                'occupations' => Occupation::all(),
            ]);
        });
    }
}
