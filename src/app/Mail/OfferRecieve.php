<?php

namespace App\Mail;

use App\Models\Login;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferRecieve extends Mailable
{
    use Queueable, SerializesModels;

    public $offer;
    
    private $sendToUser;

    /**
     * OfferRecieve constructor.
     * @param Offer $offer
     * @param Login $sendToUser
     */
    public function __construct(Offer $offer, Login $sendToUser)
    {
        $this->offer = $offer;
        $this->sendToUser = $sendToUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->offer->getMailSubjectByUser($this->sendToUser))
            ->view($this->offer->getMailTemplate())
            ->with([
                'offer' => $this->offer,
                'sendToUser' => $this->sendToUser
            ]);
    }
}
