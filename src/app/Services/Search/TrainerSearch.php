<?php

namespace App\Services\Search;

use App\Models\MatchingCondition;
use Illuminate\Http\Request;

class TrainerSearch implements SearchInterface
{
    /**
     * ジム詳細検索
     * @param Illuminate\Http\Request $request
     */
    public function detailSearch(Request $request)
    {
        $query = MatchingCondition::with(['user', 'area', 'occupation'])->OnlyGym();
        $query = SearchGenerator::createSearchCondition($query, $this->detailSearchParams, $request);
        return $query->get();
    }

    /**
     * トレーナープロフィール検索
     * @param Illuminate\Http\Request $request
     */
    public function profileSearch(Request $request)
    {
        $query = MatchingCondition::with(['user', 'area', 'occupation'])->OnlyTrainer();
        $query = SearchGenerator::createSearchCondition($query, $this->profileSearchParams, $request);
        return $query->get();
    }

    /**
     * メッセージ検索
     * @param Illuminate\Http\Request $request
     */
    public function messageSearch(Request $request)
    {
    }
}