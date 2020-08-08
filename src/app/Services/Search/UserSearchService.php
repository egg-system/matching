<?php

namespace App\Services\Search;

use App\Services\Search\SearchInterface;
use App\Models\MatchingCondition;

use Illuminate\Support\Facades\Log;

class UserSearchService
{
    /**
     * プロフィール検索
     * 
     * @param App\Services\Search\SearchInterface $request
     */
    public function profileSearch(SearchInterface $request)
    {
        $validated = $request->validated();
        $query = MatchingCondition::profileSearch($validated);
        return $query->get();
    }
}
