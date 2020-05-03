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
}
