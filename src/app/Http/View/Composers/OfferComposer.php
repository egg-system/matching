<?php

namespace App\Http\View\Composers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\View\View;

class OfferComposer
{

    protected $user;

    public function __construct(Guard $auth)
    {
        $this->user = $auth->user();
    }

    /**
     * データをビューと結合
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('offers', $this->user->fromOffers()->with('state')->get());
    }
}
