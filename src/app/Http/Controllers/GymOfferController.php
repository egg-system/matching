<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\OfferRequest;
use App\Models\Offer;
use App\Models\OfferState;
use Illuminate\Http\Request;

class GymOfferController extends Controller
{
    public function index(Request $request)
    {
        // ログイン者のタイプ
        $owner = auth()->user();
        // 絞り込み
        $stateId = $request->query('offer_state', OfferState::UNREPLY);
        $offers = $owner->fromOffers()->with(['fromUser.user', 'toUser.user', 'state'])->whereState($stateId)->get();
        return view('common.offer.index', compact('offers'));
    }

    /**
     * オファー作成処理
     */
    public function store(int $login_id, OfferRequest $request)
    {
        $id = auth()->user()->user_id;
        Offer::create([
            'offer_from_id' => $id,
            'offer_to_id' => $login_id,
            'offer_state' => OfferState::UNREPLY,
            'message' => $request->message
        ]);

        return back();
    }
}
