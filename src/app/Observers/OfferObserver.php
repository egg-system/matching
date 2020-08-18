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
        $storedOffer = $offer->fresh();

        $sendUsers = $storedOffer->getSendMailUsers();
        foreach ($sendUsers as $sendUser) {
            $mail = app(OfferRecieve::class, [
                'offer' => $storedOffer,
                'sendToUser' => $sendUser,
            ]);
            $storedOffer->notify(app(OfferNotify::class, [
                'mail' => $mail,
                'to' => [$sendUser->email]
            ]));
        }
    }
}
