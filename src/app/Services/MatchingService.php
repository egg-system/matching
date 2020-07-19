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
     * エントリー
     * @param StoreRequest $request
     */
    public function entry(StoreRequest $request)
    {
        $storeParams = $request->only(['to', 'message']);
        Offer::create([
            'offer_from_id' => auth()->id(),
            'offer_to_id' => $storeParams['to'],
            'offer_state' => OfferState::ENTRY,
            'message' => $storeParams['message']
        ]);
    }

    /**
     * マッチング状態更新
     * @param Offer $offer
     * @param UpdateRequest $request
     */
    public function updateState(Offer $offer, UpdateRequest $request)
    {
        if (!in_array($request->offerState, $offer->getTransitionState())) {
            throw new BadRequestHttpException();
        }
        $offer->updateState($request->offerState);
    }
}