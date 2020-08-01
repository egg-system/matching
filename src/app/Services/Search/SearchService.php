<?php

namespace App\Services\Search;

use App\Http\Requests\SearchRequestInterface;
use App\Models\MatchingCondition;

use Illuminate\Support\Facades\Log;

class SearchService
{
    /** @var MatchingCondition  */
    protected $matchingCondition;

    public function __construct(MatchingCondition $matchingCondition)
    {
        $this->matchingCondition = $matchingCondition;
    }

    /**
     * 詳細検索
     *  - ジムオーナー利用時：トレーナー詳細検索
     *  - トレーナー利用時：ジム詳細検索
     * 
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function detailSearch(SearchRequestInterface $request)
    {
        $validated = $request->validated();

        if ($request->anyFilled(array_keys($validated))) {
            if ($request->user_type == \App\Models\Gym::class) {
                $query = $this->matchingCondition->searchTrainer($validated);
                return $query->get();
            } else {
                $query = $this->matchingCondition->searchGym($validated);
                return $query->get();
            }
        }
    }

    /**
     * プロフィール検索
     *  - ジムオーナー利用時：ジムプロフィール検索
     *  - トレーナー利用時：トレーナープロフィール検索
     * 
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function profileSearch(SearchRequestInterface $request)
    {
        $validated = $request->validated();

        if ($request->anyFilled(array_keys($validated))) {
            if ($request->user_type == \App\Models\Gym::class) {
                $query = $this->matchingCondition->searchGym($validated);
                return $query->get();
            } else {
                $query = $this->matchingCondition->searchTrainer($validated);
                return $query->get();
            }
        }
    }

    /**
     * メッセージ検索
     * 
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function messageSearch(SearchRequestInterface $request)
    {
    }
}
