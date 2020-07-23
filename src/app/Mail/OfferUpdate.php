<?php

namespace App\Mail;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferUpdate extends Mailable
{
    use Queueable, SerializesModels;

    private $offer;

    /**
     * OfferUpdate constructor.
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
        // TODO ルートだけ切っておいて詳細決まりメール内容実装

        return $this->subject($this->offer->state->name . 'のお知らせ')
            ->markdown('markdown.offers.update')
            ->with([
                'url' => route('offers.index')
            ]);
    }
}
