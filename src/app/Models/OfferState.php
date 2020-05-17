<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OfferState extends Model
{
    protected $fillable = ['name'];

    /**
     * 名称検索クエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName(Builder $query, string $name)
    {
        return $query->where('name', $name);
    }
}
