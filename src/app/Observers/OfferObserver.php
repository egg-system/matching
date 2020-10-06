<?php

namespace App\Observers;

use App\Models\Offer;

use App\Mail\OfferRecieve;
use App\Mail\OfferSystemNotification;

use App\Notifications\OfferNotify;
use App\Notifications\SystemNotify;

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
                'to' => [$sendUser->email],
            ]));
        }

        // システム管理者に通知する
        $systemMail = app(OfferSystemNotification::class, [
            'offer' => $storedOffer,
        ]);
        $storedOffer->notify(app(SystemNotify::class, [
            'mail' => $systemMail,
        ]));
    }
}
