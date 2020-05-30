<?php

namespace App\Providers;

use App\Http\View\Composers\OfferStateComposer;
use App\Models\Area;
use App\Models\Login;
use App\Models\Occupation;
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
            ['trainer.edit', 'trainer._commonForm'],
            function ($view) {
                $view->with($this->getMasterData());
            }
        );

        \View::composer(
            'gymowner.trainerList',
            function ($view) {
                $viewData = array_merge($this->getMasterData(), [
                    'offers' => optional(\Auth::user()->fromOffers),
                ]);
                $view->with($viewData);
            }
        );

        // offerstate
        \View::composer(
            'common.offer.index',
            OfferStateComposer::class
        );

        \Blade::if('trainer', function ($user) {
            if (Login::class === get_class($user)) {
                return $user->user_type === Trainer::class;
            }
            return $user === Trainer::class;
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
