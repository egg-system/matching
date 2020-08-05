<?php

namespace App\Services\Search;

use App\Http\Requests\SearchRequestInterface;
use App\Models\MatchingCondition;

use Illuminate\Support\Facades\Log;

class UserSearchService
{
    /** @var MatchingCondition  */
    protected $matchingCondition;

    public function __construct(MatchingCondition $matchingCondition)
    {
        $this->matchingCondition = $matchingCondition;
    }

    /**
     * プロフィール検索
     * 
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function profileSearch(SearchRequestInterface $request)
    {
        $validated = $request->validated();

        if ($request->anyFilled(array_keys($validated))) {
            $query = $this->matchingCondition->profileSearch($validated);
            return $query->get();
        }
    }
}
