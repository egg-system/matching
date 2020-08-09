<?php

namespace App\Providers;

use App\Http\View\Composers\OfferStateComposer;
use App\Models\Area;
use App\Models\Login;
use App\Models\Occupation;
use App\Models\OfferState;
use App\Models\Trainer;
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
            'components.layouts.common.composer',
            function ($view) {
                $view->with(['releaseConfigs' => config('release')]);
            }
        );

        // TODO: ViewComposerの整理
        \View::composer(
            ['pages.users.edit', 'components.common._form'],
            function ($view) {
                $view->with($this->getMasterData());
            }
        );

        \View::composer(
            'pages.trainers.index',
            function ($view) {
                $viewData = array_merge($this->getMasterData(), [
                    'offers' => optional(\Auth::user()->trainerOffers),
                ]);
                $view->with($viewData);
            }
        );

        // offerstate
        \View::composer(
            'pages.offers.index',
            function ($view) {
                $view->with('states', OfferState::all());
            }
        );

        \Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
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
