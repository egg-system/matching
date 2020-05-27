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
    public function from_user()
    {
        return $this->belongsTo(Login::class, 'offer_from_id', 'id');
    }

    /**
     * 自分に来たオファー
     */
    public function to_user()
    {
        return $this->belongsTo(Login::class, 'offer_to_id', 'id');
    }

    public function scopeThroughTrainerAndGym(Builder $query, array $offer_states = [OfferState::UNREPLY])
    {
        $query
            ->addSelect([
                'offers.id',
                'offers.message',
                'offers.offer_from_id',
                'offers.offer_to_id',
                'trainers.name as trainer_name',
                'gyms.name as gym_name',
                'offer_states.name as state_name',
                'offers.created_at'
            ])
            ->join('offer_states', 'offers.offer_state', '=', 'offer_states.id')
            ->join('login as t_login', function ($join) {
                $join->on('t_login.id', '=', 'offer_to_id')
                    ->where('t_login.user_type', '=', Trainer::class);
            })
            ->join('login as g_login', function ($join) {
                $join->on('g_login.id', '=', 'offer_from_id')
                    ->where('g_login.user_type', '=', Gym::class);
            })
            ->leftJoin('trainers', 't_login.user_id', '=', 'trainers.id')
            ->leftJoin('gyms', 'g_login.user_id', '=', 'gyms.id')
            ->whereIn('offer_state', $offer_states);
    }
}
