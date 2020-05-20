<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = [
        'offer_from_id',
        'offer_to_id',
        'offer_state',
        'message',
    ];

    public function state()
    {
        return $this->hasOne(OfferState::class, 'id', 'offer_state');
    }
}
