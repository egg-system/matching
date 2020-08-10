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
    public function scopeWhereState(Builder $query, int $offerState)
    {
        return $query->where('offer_state_id', $offerState);
    }

    /**
     * @param Builder $query
     * @param Login $user
     * @return Builder
     */
    public function scopeWhereUser(Builder $query, Login $user)
    {
        $searchColumn = $user->isGym() ? 'gym_login_id' : 'trainer_login_id';
        return $query->where($searchColumn, $user->id);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeGetMatchingLatestIds(Builder $query)
    {
        return $query->selectRaw('max(id) as id')
            ->groupBy('gym_login_id', 'trainer_login_id');
    }

    /**
     * @param Builder $query
     * @param int $gymLoginId
     * @param int $trainerLoginId
     * @return Builder
     */
    public function scopeGetMostRecentOffer(Builder $query, int $gymLoginId, int $trainerLoginId)
    {
        return $query->where('gym_login_id', $gymLoginId)
            ->where('trainer_login_id', $trainerLoginId)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function updateState(int $state)
    {
        return $this->update(['offer_state' => $state]);
    }
}
