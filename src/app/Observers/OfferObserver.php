<?php

namespace App\Observers;

use App\Models\Offer;
use App\Notifications\OfferRecieveNotify;
use App\Notifications\OfferUpdateNotify;

class OfferObserver
{
    /**
     * Handle the offer "created" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function created(Offer $offer)
    {
        $offer->notify(new OfferRecieveNotify($offer));
    }

    /**
     * Handle the offer "updated" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        $offer->notify(new OfferUpdateNotify($offer));
    }
}
