<?php

namespace App\Models;

use App\Traits\ArrayWherable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MatchingCondition extends Model
{
    use ArrayWherable;
    
    protected $fillable = [
        'area_id',
        'weekly_worktime',
        'can_work_holiday',
        'can_work_weekday',
        'hope_adjust_worktime',
        'is_considering_change_job',
    ];

    protected $with = ['user', 'area', 'occupation'];

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

    public function userOccupations()
    {
        return $this->hasMany(UserOccupation::class, 'user_id');
    }

    /**
     * ユーザ検索のクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProfileSearch(Builder $query, array $attributes)
    {
        return $this->whereFromArray($query, $attributes);
    }
}
