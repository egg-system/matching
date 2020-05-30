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
    public function store(OfferRequest $request)
    {
        $offerFromId = auth()->user()->user_id;
        $validated = $request->validated();
        Offer::create([
            'offer_from_id' => $offerFromId,
            'offer_to_id' => $validated['offer_to_id'],
            'offer_state' => 1,
            'message' => $validated['message']
        ]);

        return redirect()->back();
    }
}
