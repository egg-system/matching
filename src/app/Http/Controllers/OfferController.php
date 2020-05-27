<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\OfferRequest;
use App\Models\Offer;
use App\Models\OfferState;
use App\Models\Trainer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * ジム、トレーナー共通オファー処理
     */
    public function index(Request $request)
    {
        // ログイン者のタイプ
        $user = auth()->user();
        $user_type = $user->user_type;
        // typeで紐付けるオファー元切り替え(自分に来たもの OR 自分が出したもの)
        $query = $user->user_type === Trainer::class ? $user->to_offers() : $user->from_offers();
        // 絞り込み
        $state_id = $request->query('offer_state', OfferState::UNREPLY);
        $offers = $query->throughTrainerAndGym([$state_id])->get();
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
            'offer_state' => 1,
            'message' => $request->message
        ]);

        return redirect()->back();
    }
}
