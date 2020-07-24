<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MatchingCondition extends Model
{
    protected $fillable = [
        'area_id',
        'worktime_week',
        'holiday_work_is_possible',
        'weekday_work_is_possible',
        'adjust_by_project',
        'changing_jobs_is_considering',
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
        return $this->belongsToMany(
            Occupation::class,
            'user_occupations',
            'user_id',
            'occupation_id'
        )->withTimestamps();
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
     * イコール検索するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $attributes, string $operation = '=')
    {
        $attributes = Arr::dot($attributes);
        foreach ($attributes as $column => $value) {
            $column = str_replace('.', '->', $column);
            if (!is_null($value)) {
                $query->where($column, $operation, $value);
            }
        }
        return $query;
    }
}
