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
        // ユーザーに受信メール送信
        $user = $offer->toUser->email;
        $mail = new OfferRecieve($offer);
        $offer->notify(new OfferNotify($mail, $user));
    }

    /**
     * Handle the offer "updated" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        $send_to_address = $offer->getSendMailAddress();
        $mail = resolve(OfferUpdate::class, ['offer' => $offer]);
        $offer->notify(new OfferNotify($mail, $send_to_address));
    }
}
