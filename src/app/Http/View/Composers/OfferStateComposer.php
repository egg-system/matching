<?php

namespace App\Http\View\Composers;

use App\Models\OfferState;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\View\View;

class OfferStateComposer
{

    /**
     * データをビューと結合
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('states', OfferState::all());
    }
}
