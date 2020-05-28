<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\UpdateRequest;
use App\Models\Offer;
use App\Models\OfferState;
use Illuminate\Http\Request;

class TrainerOfferController extends Controller
{
    public function index(Request $request)
    {
        // ログイン者
        $trainer = auth()->user();
        // 絞り込み
        $stateId = $request->query('offer_state', OfferState::UNREPLY);
        // 階層先までリレーション指定
        $offers = $trainer->toOffers()->with(['fromUser.user', 'toUser.user', 'state'])->whereState($stateId)->get();
        return view('common.offer.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        abort_if($offer->offer_from_id === auth()->id(), 404);
        return view('trainer.offer.show', compact('offer'));
    }

    public function update(Offer $offer, UpdateRequest $request)
    {
        abort_if($offer->offer_from_id === auth()->id(), 404);
        $offer->update(['offer_state' => $request->offer_state]);
        return back();
    }
}
