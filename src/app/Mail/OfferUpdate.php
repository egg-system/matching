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

        $subject = '';
        if ($this->offer->isOffer()) {
            $subject = '正式依頼のお知らせ';
        } elseif ($this->offer->isOfferAccept()) {
            $subject = '内定受諾のお知らせ';
        } elseif ($this->offer->isOfferRefuse()) {
            $subject = '内定辞退のお知らせ';
        }

        return $this->subject($subject)
            ->markdown('markdown.offers.update')
            ->with([
                'url' => route('offers.index')
            ]);
    }
}
