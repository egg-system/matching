<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MatchingCondition extends Model
{
    protected $fillable = [
        'area_id',
        'weekly_worktime',
        'can_work_holiday',
        'can_work_weekday',
        'can_adjust',
    ];

    protected $with = ['user', 'area', 'occupations'];
    
    public function user()
    {
        return $this->morphTo('user');
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function occupations()
    {
        return $this->belongsToMany(
            Occupation::class,
            'matching_condition_occupations',
            'matching_condition_id',
            'occupation_id'
        );
    }
}
