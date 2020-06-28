<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
     * トレーナーだけに限定するクエリスコープ.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyTrainer(Builder $query)
    {
        return $query->where('user_type', Trainer::class);
    }

    /**
     * イコール検索するクエリスコープ.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $attributes
     * @param string                                $operation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $attributes, string $operation = '=')
    {
        $attributes = Arr::dot($attributes);

        foreach ($attributes as $column => $value) {
            $column = str_replace('.', '->', $column);

            if ($value !== null) {
                $query->where($column, $operation, $value);
            }
        }
        return $query;
    }
}
