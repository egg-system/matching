<?php

namespace App\Mail;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferRecieve extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;
    /**
     * Create a new message instance.
     *
     * @return void
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
            ->markdown('markdown.offers.recieve')
            ->with([
                'url' => route('offers.show', $this->offer->id)
            ]);
    }
}
