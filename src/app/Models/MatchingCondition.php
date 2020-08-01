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
        'is_considering_change_job',
    ];

    protected $with = ['user', 'area', 'occupation'];

    const SEARCH_GYM_PARAMS = [
        'user_id' => ['operation' => '='],
    ];

    const SEARCH_TRAINER_PARAMS = [
        'user_id' => ['operation' => '='],
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
     * ジム検索のクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchGym(Builder $query, array $attributes)
    {
        $query = $query->where('user_type', Gym::class);

        collect(self::SEARCH_GYM_PARAMS)->each(function ($operation, $param) {
            if (!is_null($operation) && !isset($operation) && !$attributes->only($param) == "") {
                $query = $this->scopeSearch([$param => $attributes[$param]], $param['operation']);
            }
        });

        return $query;
    }

    /**
     * ジム検索のクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchTrainer(Builder $query, array $attributes)
    {
        $query = $query->where('user_type', Trainer::class);

        collect(self::SEARCH_TRAINER_PARAMS)->each(function ($operation, $param) {
            if (!is_null($operation) && !isset($operation) && !$attributes->only($param) == "") {
                $query = $this->scopeSearch([$param => $attributes[$param]], $param['operation']);
            }
        });

        return $query;
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
