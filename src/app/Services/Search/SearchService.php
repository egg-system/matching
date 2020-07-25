<?php

namespace App\Services\Search;

use Illuminate\Http\Request;
use App\Models\MatchingCondition;

class SearchService
{
    public function matchingConditionSearch(Request $request)
    {
        $query = MatchingCondition::with(['area', 'occupation']);
        $query = SearchUtil::createSearchCondition($query, $this->matchingConditionSearchParams, $request);
        return $query->get();
    }

    public function detailSearch(Request $request)
    {
        /**
         * MEMO
         * ・Facadeで呼び出し
         * TODO
         * ・Requestに検索用パラメータも入れる。
         * ・Facade呼び出すだけなら、Controllerから直接がいい？
         */
        return \Search::detailSearch($request);
    }

    public function profileSearch(Request $request)
    {
        return \Search::profileSearch($request);
    }

    public function messageSearch(Request $request)
    {
        return \Search::messageSearch($request);
    }
}
