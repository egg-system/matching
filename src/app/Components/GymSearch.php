<?php
declare(strict_types=1);

namespace App\Components;

use App\Services\SearchInterface;

class GymSearch implements SearchInterface
{
    public function userSearch(Request $request): string
    {
        return
        MatchingCondition::with(['user', 'area', 'occupation'])
            ->onlyGym()
            ->scopeSearch(array("occupation_id" => $request->only('occupation_id')))
            ->scopeSearch(array("price" => $request->only('price')))
            ->scopeSearch(array("price" => $request->only('price.min')), '>=')
            ->scopeSearch(array("price" => $request->only('price.min')), '<=')
            ->scopeSearch(array("work_time" => $request->only('work_time')))
            ->scopeSearch(array("work_time.week" => $request->only('work_time.week')))
            ->scopeSearch(array("work_time.time" => $request->only('work_time.time')))
            ->get()
            ;
    }
}