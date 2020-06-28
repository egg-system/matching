<?php

declare(strict_types=1);

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
     * @param \App\Models\Offer $offer
     */
    public function created(Offer $offer): void
    {
        // トレーナーに受信メール送信
        $trainer = $offer->toUser->email;
        $mail = new OfferRecieve($offer);
        $offer->notify(new OfferNotify($mail, $trainer));
    }

    /**
     * Handle the offer "updated" event.
     *
     * @param \App\Models\Offer $offer
     */
    public function updated(Offer $offer): void
    {
        // オーナーに返答メール送信
        $owner = $offer->fromUser->email;
        $mail = new OfferUpdate();
        $offer->notify(new OfferNotify($mail, $owner));
    }
}
