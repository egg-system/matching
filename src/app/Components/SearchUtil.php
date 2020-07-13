<?php
declare(strict_types=1);

namespace App\Components;

use Illuminate\Support\Arr;

class SearchUtil
{
    /**
     * 検索条件生成
     */
    public static function createSearchCondition($query, $params, $request)
    {
        foreach($params as $key => $param) {
            $value = $request->only($key) ?? null;
            if (is_null($value) || isset($value) || $request->only($key) == "") {
                continue;
            }
            $query = self::scopeSearch($query, [$key => $value], $param['operation']);
        }
        return $query;
    }

    /**
     * イコール検索するクエリスコープ
     */
    public static function scopeSearch($query, array $attributes, string $operation = '=')
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