<?php
declare(strict_types=1);

namespace App\Components;

use App\Models\MatchingCondition;
use Illuminate\Support\Facades\Log;

class MatchingConditionSearch
{
    protected $matchingConditionSearchParams = [];

    public function __construct()
    {
        $this->matchingConditionSearchParams = [
            'occupation_id' => ['operation' => '='],
            'area_id' => ['operation' => '='],
            'holiday_work' => ['operation' => '='],
            'weekday_work' => ['operation' => '='],
        ];
    }

    public function search($request)
    {
        $query = MatchingCondition::with(['area', 'occupation']);
        $query = SearchUtil::createSearchCondition($query, $this->matchingConditionSearchParams, $request);
        return $query->get();
    }
}