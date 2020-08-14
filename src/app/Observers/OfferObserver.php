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

        $sendUsers = $stored_offer->getSendMailUsers();
        foreach ($sendUsers as $sendUser) {
            $mail = app(OfferRecieve::class, ['offer' => $stored_offer, 'sendToUser' => $sendUser]);
            $stored_offer->notify(app(OfferNotify::class, ['mail' => $mail, 'to' => [$sendUser->email]]));
        }
    }
}
