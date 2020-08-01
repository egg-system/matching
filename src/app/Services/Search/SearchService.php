<?php

namespace App\Services\Search;

use App\Http\Requests\SearchRequestInterface;
use App\Models\MatchingCondition;

class SearchService
{
    /**
     * マッチング条件検索
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function matchingConditionSearch(SearchRequestInterface $request)
    {
        $query = MatchingCondition::with(['area', 'occupation']);
        $query = SearchUtil::createSearchCondition($query, $this->matchingConditionSearchParams, $request);
        return $query->get();
    }

    /**
     * 詳細検索
     *  - ジムオーナー利用時：トレーナー詳細検索
     *  - トレーナー利用時：ジム詳細検索
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function detailSearch(SearchRequestInterface $request)
    {
        $query = MatchingCondition::OnlyTrainer();
        // $query = SearchGenerator::createSearchCondition($query, $request->detailSearchParams, $request);
        // $query = SearchGenerator::createSearchCondition($query, [], $request);
        return $query->get();
    }

    /**
     * プロフィール検索
     *  - ジムオーナー利用時：ジムプロフィール検索
     *  - トレーナー利用時：トレーナープロフィール検索
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function profileSearch(SearchRequestInterface $request)
    {
        $query = MatchingCondition::OnlyGym();
        // $query = SearchGenerator::createSearchCondition($query, $request->profileSearchParams, $request);
        // $query = SearchGenerator::createSearchCondition($query, [], $request);
        return $query->get();
    }

    /**
     * メッセージ検索
     * @param App\Http\Requests\SearchRequestInterface $request
     */
    public function messageSearch(SearchRequestInterface $request)
    {
    }
}
