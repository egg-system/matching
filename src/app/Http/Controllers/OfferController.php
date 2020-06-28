<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Offer\StoreRequest;
use App\Http\Requests\Offer\UpdateRequest;
use App\Models\Offer;
use App\Models\OfferState;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Offer::class);
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        // 絞り込み条件取得
        $stateId = $request->query('offer_state', OfferState::UNREPLY);
        // デフォルトで送信したオファー取得、指定がある場合受信取得
        $type = $request->type;
        $query = !$type ? $user->fromOffers() : $user->toOffers();
        $offers = $query->whereState($stateId)->get();
        return view('offer.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        return view('offer.show', compact('offer'));
    }

    public function update(Offer $offer, UpdateRequest $request)
    {
        $offer->updateState($request->offer_state);
        return back();
    }

    /**
     * オファー作成処理.
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $id = auth()->id();
        Offer::create([
            'offer_from_id' => $id,
            'offer_to_id' => $request->to,
            'offer_state' => OfferState::UNREPLY,
            'message' => $request->message,
        ]);

        return back();
    }
}
