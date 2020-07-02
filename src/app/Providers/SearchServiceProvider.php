<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SearchInterface;

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
            return new \App\Services\SearchService($app->make(SearchInterface::class));
        });

        $this->app->bind(
            SearchInterface::class,
            // TODO:bindの条件は要検討
            function($app, $terms) {
                switch($terms) {
                    case "":
                        $bindClass = \App\Components\GymSearch::class;
                        break;
                    case "":
                        $bindClass = \App\Components\TrainerSearch::class;
                        break;
                }
                return $app->make($bindClass);
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
