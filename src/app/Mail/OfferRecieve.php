<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferRecieve extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;

    /**
     * Create a new message instance.
     *
     * @param Offer $offer
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('オファー受信のお知らせ')
            ->markdown('offer.mail.recieve')
            ->with([
                'url' => route('offer.show', $this->offer->id),
            ]);
    }
}
