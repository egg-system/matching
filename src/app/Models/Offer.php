<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * 自分が送ったオファー
     */
    public function fromUser()
    {
        return $this->belongsTo(Login::class, 'offer_from_id', 'id');
    }

    /**
     * 自分に来たオファー
     */
    public function toUser()
    {
        return $this->belongsTo(Login::class, 'offer_to_id', 'id');
    }

    /**
     * Loginを経由してTrainerとジムを結合する
     */
    public function scopeWhereState(Builder $query, int $offer_state = OfferState::UNREPLY)
    {
        return $query->where('offer_state', $offer_state);
    }
}
