<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Occupation;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $masterData = [
            'occupations' => Occupation::all(),
            'areas' => Area::all(),
        ];

        \View::composer(
            ['trainer.edit', 'trainer._commonForm'],
            function ($view) use ($masterData) {
                $view->with($masterData);
            }
        );

        \View::composer(
            'gymowner.trainerList',
            function ($view) use ($masterData) {
                $viewData = array_merge($masterData, [
                    'offers' => optional(\Auth::user()->from_offers),
                ]);
                $view->with($viewData);
            }
        );
    }
}
