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
        \View::composer(
            ['trainer.edit', 'trainer._commonForm'],
            function ($view) {
                $view->with($this->getMasterData());
            }
        );

        \View::composer(
            'gymowner.trainerList',
            function ($view) {
                $viewData = array_merge($this->getMasterData(), [
                    'offers' => optional(\Auth::user()->from_offers),
                ]);
                $view->with($viewData);
            }
        );
    }

    // bootのタイミングで、クエリを走らせないため、別メソッドに切り出し
    protected function getMasterData()
    {
        return [
            'occupations' => Occupation::all(),
            'areas' => Area::all(),
        ];
    }
}
