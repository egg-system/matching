<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * jsonキャストするカラム名のみを取得する
     * @return array
     */
    private function getJsonColumns()
    {
        return array_keys($this->casts, 'json');
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
        return $this->belongsTo(Occupation::class);
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
    public function scopeStrictSearch(Builder $query, array $attributes = [])
    {
        $json_columns = $this->getJsonColumns();
        // 非jsonでnull以外のみ抽出
        $no_json_attributes = array_filter($attributes, function ($value, $key) use ($json_columns) {
            return !in_array($key, $json_columns) && !is_null($value);
        }, ARRAY_FILTER_USE_BOTH);

        $query->where($no_json_attributes);
        // jsonが含まれている場合json検索
        $query = $this->scopeJsonStrictSearch($query, $attributes);

        return $query;
    }

    /**
     * jsonカラムを検索するクエリスコープ
     * attributesにjsonの連想配列を渡す
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $attributes
     * @param  string $operation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJsonStrictSearch(Builder $query, array $attributes, string $operation = '=')
    {
        $json_columns = $this->getJsonColumns();
        // jsonのみ抽出
        $json_attributes = array_filter($attributes, function ($value, $key) use ($json_columns) {
            return in_array($key, $json_columns) && !is_null($value);
        }, ARRAY_FILTER_USE_BOTH);

        if (!$json_attributes) {
            return $query;
        }

        foreach ($json_attributes as $column => $arr) {
            foreach ($arr as $key => $value) {
                if (is_null($value)) {
                    continue;
                }
                $query->where("${column}->${key}", $operation, $value);
            }
        }
        return $query;
    }
}
