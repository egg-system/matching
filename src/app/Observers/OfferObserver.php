<?php

namespace App\Observers;

use App\Mail\OfferRecieve;
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
        // 登録後のOfferStateを取得するためにfreshを行う
        $stored_offer = $offer->fresh();
        $send_address = $stored_offer->getSendMailAddress();
        $mail = new OfferRecieve($stored_offer);
        $offer->notify(new OfferNotify($mail, $send_address));
    }
}
