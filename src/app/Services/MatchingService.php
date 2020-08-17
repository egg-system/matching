<?php

namespace App\Services;

use App\Http\Requests\Offer\StoreRequest;
use App\Models\Login;
use App\Models\Offer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

/**
 * マッチング関連のサービスクラス
 * Class MatchingService
 * @package App\Services
 */
class MatchingService
{
    /**
     * オファー情報取得
     * @param Request $request
     * @return mixed
     */
    public function searchOffers()
    {
        /** @var Login $user */
        $user = \Auth::user();

        // 各マッチングの最新状態のみを取得
        $targetIds = Offer::whereUser($user)
            ->getMatchingLatestIds()
            ->get()
            ->pluck('id');
        return Offer::whereIn('id', $targetIds)->get();
    }

    /**
     * オファー情報登録
     * @param StoreRequest $request
     */
    public function storeOffer(StoreRequest $request)
    {
        if (!$request->canStoreState()) {
            throw app(AuthorizationException::class);
        }

        Offer::create($request->getStoreParameter());
    }

    /**
     * 指定したマッチングの直近オファー情報を取得
     * @param int $gymLoginId
     * @param int $trainerLoginId
     * @return mixed
     */
    public function getMostRecentOffer(int $gymLoginId, int $trainerLoginId)
    {
        return Offer::getMostRecentOffer($gymLoginId, $trainerLoginId)->first();
    }
}
