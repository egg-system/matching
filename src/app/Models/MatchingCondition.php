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
        'hope_adjust_worktime',
    ];

    protected $with = ['user', 'area', 'occupation'];

    public static function query()
    {
        return (new static)->newQuery();
    }
    
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
        return $this->belongsToMany(
            Occupation::class,
            'user_occupations',
            'user_id',
            'occupation_id'
        )->withTimestamps();
    }
}
