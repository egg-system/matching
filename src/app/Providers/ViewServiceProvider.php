<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Area;
use App\Models\Occupation;
use App\Models\OfferState;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \View::composer(
            ['trainer.edit', 'common._form'],
            function ($view): void {
                $view->with($this->getMasterData());
            }
        );

        \View::composer(
            'gym.trainerList',
            function ($view): void {
                $viewData = array_merge($this->getMasterData(), [
                    'offers' => optional(\Auth::user()->fromOffers),
                ]);
                $view->with($viewData);
            }
        );

        // offerstate
        \View::composer(
            'offer.index',
            function ($view): void {
                $view->with('states', OfferState::all());
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
