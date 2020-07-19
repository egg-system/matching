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
     * @param int $offerState
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereState(Builder $query, int $offerState = OfferState::ENTRY)
    {
        return $query->where('offer_state', $offerState);
    }

    public function updateState(int $state)
    {
        return $this->update(['offer_state' => $state]);
    }

    /**
     * オファー状態がエントリーかの判定
     * @return bool
     */
    public function isEntry()
    {
        return $this->offer_state === OfferState::ENTRY;
    }

    /**
     * オファー状態が正式依頼中かの判定
     * @return bool
     */
    public function isOffer()
    {
        return $this->offer_state === OfferState::OFFER;
    }

    public function isOfferAccept()
    {
        return $this->offer_state === OfferState::ACCEPT;
    }

    public function isOfferRefuse()
    {
        return $this->offer_state === OfferState::REFUSE;
    }

    /**
     * 現在のオファー状態を元にメール送信先を取得
     * @return string
     */
    public function getSendMailAddress()
    {
        if ($this->isEntry()) {
            return $this->toUser->email;
        }
        
        switch ($this->offer_state) {
            case OfferState::ENTRY:
                return $this->toUser->email;
            case OfferState::OFFER:
                return $this->toUser->user_type === Trainer::class
                    ? $this->toUser->email
                    : $this->fromUser->email;
            case OfferState::ACCEPT:
            case OfferState::REFUSE:
                return $this->toUser->user_type === Gym::class
                    ? $this->toUser->email
                    : $this->fromUser->email;
            default:
                return '';
        }
    }

    /**
     * 遷移可能な状態を取得
     * return array
     */
    public function getTransitionState()
    {
        if ($this->isEntry()) {
            return [OfferState::OFFER];
        } elseif ($this->isOffer()) {
            return [OfferState::ACCEPT, OfferState::REFUSE];
        }
        return [];
    }
}
