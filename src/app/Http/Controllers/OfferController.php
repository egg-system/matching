
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
    public function store(int $login_id, OfferRequest $request)
    {
        $id = auth()->id();
        Offer::create([
            'offer_from_id' => $id,
            'offer_to_id' => $login_id,
            'offer_state' => 1,
            'message' => $request->message
        ]);

        return redirect()->back();
    }
}
