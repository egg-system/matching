<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ConditionGenerator 
{
    /**
     * where句の生成
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function whereFromArray(Builder $query, array $attributes)
    {
        collect($attributes)->each(function ($value, $column) use ($query) {
            $query->where($column, $value);
        });

        return $query;
    }
}