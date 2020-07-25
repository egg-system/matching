<?php

namespace App\Services\Search;

use App\Repositories\SearchInterface;
use App\Models\MatchingCondition;
use Illuminate\Http\Request;

class GymSearch implements SearchInterface
{
    /**
     * トレーナー詳細検索
     * @param Illuminate\Http\Request $request
     */
    public function detailSearch(Request $request)
    {
        $query = MatchingCondition::with(['user', 'area', 'occupation'])->OnlyTrainer();
        $query = SearchGenerator::createSearchCondition($query, $this->detailSearchParams, $request);
        return $query->get();
    }

    /**
     * ジムプロフィール検索
     * @param Illuminate\Http\Request $request
     */
    public function profileSearch(Request $request)
    {
        $query = MatchingCondition::with(['user', 'area', 'occupation'])->OnlyGym();
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