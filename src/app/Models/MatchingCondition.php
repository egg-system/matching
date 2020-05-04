<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingCondition extends Model
{
    protected $fillable = [
        'occupation_id',
        'area_id',
        'price',
        'work_time',
    ];

    protected $casts = [
        'price' => 'json',
        'work_time' => 'json',
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
    public function scopeTrainer($query)
    {
        return $query->where('user_type', Trainer::class);
    }
}
