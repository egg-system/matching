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
        'offer_state_id',
    ];

    protected $with = ['gym.user', 'trainer.user', 'state'];

    public function state()
    {
        return $this->hasOne(OfferState::class, 'id', 'offer_state_id');
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
        return $this->update(['offer_state_id' => $state]);
    }

    /**
     * 現在のオファー状態を元にメール送信先を取得
     * @return array
     */
    public function getSendMailAddress()
    {
        $result = [];
        if ($this->state->should_notice_trainer) {
            $result[] = $this->trainer->email;
        }
        if ($this->state->should_notice_gym) {
            $result[] = $this->gym->email;
        }
        return $result;
    }
}
