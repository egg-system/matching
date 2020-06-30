<?php

namespace App\Observers;

use App\Mail\OfferRecieve;
use App\Mail\OfferUpdate;
use App\Models\Offer;
use App\Notifications\OfferNotify;

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
        // トレーナーに受信メール送信
        $trainer = $offer->toUser->email;
        $mail = new OfferRecieve($offer);
        $offer->notify(new OfferNotify($mail, $trainer));
    }

    /**
     * Handle the offer "updated" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        // オーナーに返答メール送信
        $owner = $offer->fromUser->email;
        $mail = new OfferUpdate();
        $offer->notify(new OfferNotify($mail, $owner));
    }
}
