<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\OfferRequest;
use App\Http\Requests\Offer\UpdateRequest;
use App\Models\Offer;
use App\Models\OfferState;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        // 絞り込み条件取得
        $stateId = $request->query('offer_state', OfferState::UNREPLY);
        // 自分に関連するオファー取得
        $recieve = $user->toOffers()->with(['fromUser.user', 'toUser.user', 'state'])->whereState($stateId)->get();
        $send = $user->fromOffers()->with(['fromUser.user', 'toUser.user', 'state'])->whereState($stateId)->get();
        // マージ
        $offers = $recieve->merge($send);

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
     * オファー作成処理
     */
    public function store(OfferRequest $request)
    {
        $id = auth()->id();
        Offer::create([
            'offer_from_id' => $id,
            'offer_to_id' => $request->to,
            'offer_state' => OfferState::UNREPLY,
            'message' => $request->message
        ]);

        return back();
    }
}
