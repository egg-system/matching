<?php

namespace App\Providers;

use App\Http\View\Composers\OfferComposer;
use App\Http\View\Composers\OfferStateComposer;
use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        // クラスベースのコンポーザを使用する
        View::composer(
            'gymowner.trainerList',
            OfferComposer::class
        );

        // offerstate
        View::composer(
            'common.offer.index',
            OfferStateComposer::class
        );

        Blade::if('trainer', function ($user) {
            if (Login::class === get_class($user)) {
                return $user->user_type === Trainer::class;
            }
            return $user === Trainer::class;
        });
    }
}
