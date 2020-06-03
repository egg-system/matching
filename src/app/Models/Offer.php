<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Offer extends Model
{
    use Notifiable;

    protected $fillable = [
        'offer_from_id',
        'offer_to_id',
        'offer_state',
        'message',
    ];

    protected $with = ['fromUser.user', 'toUser.user', 'state'];

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
     * オファーのステータス絞り込み
     *
     * @param Illuminate\Database\Eloquent\Builder
     * @param int $offer_state
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereState(Builder $query, int $offer_state = OfferState::UNREPLY)
    {
        return $query->where('offer_state', $offer_state);
    }

    public function updateState(int $state)
    {
        return $this->update(['offer_state' => $state]);
    }
}
