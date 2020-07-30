<?php

namespace App\Services;

use App\Http\Requests\Offer\StoreRequest;
use App\Http\Requests\Offer\UpdateRequest;
use App\Models\Offer;
use App\Models\OfferState;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
        $storeParams = $request->only(['gym', 'trainer', 'state']);
        Offer::create([
            'gym_login_id' => $storeParams['gym'],
            'trainer_login_id' => $storeParams['trainer'],
            'offer_state' => $storeParams['state'],
        ]);
    }
}