<?php
declare(strict_types=1);

namespace App\Components;

use App\Repositories\SearchInterface;
use App\Models\MatchingCondition;
use Illuminate\Http\Request;

class TrainerSearch implements SearchInterface
{
    protected $detailSearchParams = [];
    protected $profileSearchParams = [];
    protected $messageSearchParams = [];
    protected $matchingConditionSearch;

    public function __construct(MatchingConditionSearch $matchingConditionSearch)
    {
        $this->matchingConditionSearch = $matchingConditionSearch;

        $this->detailSearchParams = [
            'user_id' => ['operation' => '='],
        ];

        $this->profileSearchParams = [
            'user_id' => ['operation' => '='],
        ];

        $this->messageSearchParams = [
        ];
    }

    /**
     * マッチング条件検索
     * @param Illuminate\Http\Request $request
     */
    public function matchingConditionSearch(Request $request)
    {
        return $this->matchingConditionSearch->search($request);
    }

    /**
     * ジム詳細検索
     * @param Illuminate\Http\Request $request
     */
    public function detailSearch(Request $request)
    {
        $query = MatchingCondition::with(['user', 'area', 'occupation'])->OnlyGym();
        $query = SearchUtil::createSearchCondition($query, $this->detailSearchParams, $request);
        return $query->get();
    }

    /**
     * トレーナープロフィール検索
     * @param Illuminate\Http\Request $request
     */
    public function profileSearch(Request $request)
    {
        $query = MatchingCondition::with(['user', 'area', 'occupation'])->OnlyTrainer();
        $query = SearchUtil::createSearchCondition($query, $this->profileSearchParams, $request);
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