<?php

namespace App\Providers;

use App\Http\View\Composers\OfferComposer;
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
    }
}
