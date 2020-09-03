<?php

namespace App\Mail;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferSystemNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function build()
    {
        return $this
            ->subject('【ボーダーレスジム】マッチング成立の通知')
            ->view('mails.offers.system-notify')
            ->with(['offer' => $this->offer]);
    }
}
