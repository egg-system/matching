<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SearchInterface;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('SearchService', function($app) {
            return new \App\Repositories\SearchService($app->make(SearchInterface::class));
        });

        $this->app->bind(
            SearchInterface::class,
            function($app) {
                switch(\Auth::user()->user_type) {
                    case \App\Models\Gym::class:
                        $bindClass = \App\Components\GymSearch::class;
                        break;
                    case \App\Models\Trainer::class:
                        $bindClass = \App\Components\TrainerSearch::class;
                        break;
                }
                // return $app->make(\App\Components\TrainerSearch::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
