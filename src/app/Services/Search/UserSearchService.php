<?php

namespace App\Services\Search;

use App\Services\Search\SearchInterface;
use App\Models\MatchingCondition;

use Illuminate\Support\Facades\Log;

class UserSearchService
{
    /**
     * ユーザ検索処理実行
     *
     * @param App\Services\Search\SearchInterface $request
     */
    public function execute(SearchInterface $request)
    {
        $validated = $request->searchParameters();
        $query = MatchingCondition::query();
        $query = MatchingCondition::whereFromArray($query, $validated);
        return $query->get();
    }
}
