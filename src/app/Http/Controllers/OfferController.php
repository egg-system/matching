<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\OfferRequest;
use App\Models\Login;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * オファー作成処理
     */
    public function store(int $trainer_id, OfferRequest $request)
    {
        DB::transaction(function () use ($trainer_id, $request) {
            $id = auth()->user()->user_id;
            $login_id = optional(Login::onlyTrainer($trainer_id)->first())->id;
            $offer = new Offer();
            return $offer->create([
                'offer_from_id' => $id,
                'offer_to_id' => $login_id,
                'offer_state' => $offer->getDefaultStateId(),
                'message' => $request->message
            ]);
        });

        return redirect()->back();
    }
}
