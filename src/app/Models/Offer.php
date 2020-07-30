<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Offer extends Model
{
    use Notifiable;

    protected $fillable = [
        'gym_login_id',
        'trainer_login_id',
        'offer_state',
    ];

    protected $with = ['gym.user', 'trainer.user', 'state'];

    public function state()
    {
        return $this->hasOne(OfferState::class, 'id', 'offer_state');
    }

    /**
     * ジム側のユーザー情報
     */
    public function gym()
    {
        return $this->belongsTo(Login::class, 'gym_login_id', 'id');
    }

    /**
     * トレーナー側のユーザー情報
     */
    public function trainer()
    {
        return $this->belongsTo(Login::class, 'trainer_login_id', 'id');
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
     * @return array
     */
    public function getSendMailAddress()
    {
        $result = [];
        if ($this->state->trainer_send_mail) {
            $result[] = $this->trainer->email;
        }
        if ($this->state->gym_send_mail) {
            $result[] = $this->gym->email;
        }
        return $result;
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

    /**
     * ステータス変更可能か判定
     * @param int $userId
     * @param string $userType
     * @return bool
     */
    public function canUpdateState(int $userId, string $userType): bool
    {
        if ($this->offer_to_id !== $userId && $this->offer_from_id !== $userId) {
            return false;
        }

        if ($this->isEntry()) {
            return $userType === Gym::class;
        } elseif ($this->isOffer()) {
            return $userType === Trainer::class;
        }
        return false;
    }
}
