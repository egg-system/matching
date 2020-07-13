<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MatchingCondition extends Model
{
    protected $fillable = [
        'occupation_id',
        'area_id',
        'worktime_week',
        'holiday_work',
        'weekday_work',
    ];

    protected $casts = [
    ];

    public function user()
    {
        return $this->morphTo('user');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    /**
     * トレーナーだけに限定するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyTrainer(Builder $query)
    {
        return $query->where('user_type', Trainer::class);
    }

    /**
     * ジムだけに限定するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyGym(Builder $query)
    {
        return $query->where('user_type', Gym::class);
    }
}
