<?php

namespace App\Services;

use App\Http\Requests\Offer\StoreRequest;
use App\Models\Offer;
use App\Models\OfferState;
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
    public function searchOffers(Request $request)
    {
        $user = auth()->user();
        // 絞り込み条件取得
        $stateId = $request->query('offer_state', OfferState::ENTRY);
        // デフォルトで送信したオファー取得、指定がある場合受信取得
        $type = $request->type;
        $query = !$type ? $user->fromOffers() : $user->toOffers();
        return $query->whereState($stateId)->get();
    }

    /**
     * オファー情報登録
     * @param StoreRequest $request
     */
    public function storeOffer(StoreRequest $request)
    {
        if (!$request->canStore()) {
            throw app(AuthorizationException::class);
        }

        $storeParams = $request->only(['gym', 'trainer', 'state']);
        Offer::create([
            'gym_login_id' => $storeParams['gym'],
            'trainer_login_id' => $storeParams['trainer'],
            'offer_state' => $storeParams['state'],
        ]);
    }

    /**
     * 指定したマッチングの直近オファー情報を取得
     * @param int $gym
     * @param int $trainer
     * @return mixed
     */
    public function getMostRecentOffer(int $gym, int $trainer)
    {
        return Offer::where('gym_login_id', $gym)
            ->where('trainer_login_id', $trainer)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
