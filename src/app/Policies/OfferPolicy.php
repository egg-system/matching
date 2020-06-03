<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\Login;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * showメソッドに対する認可
     *
     * @param  \App\Models\Login  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function view(Login $user, Offer $offer)
    {
        $id = $user->id;
        return $offer->offer_from_id === $id || $offer->offer_to_id === $id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Login  $user
     * @param  \App\Models\Offer  $offer
     * @return mixed
     */
    public function update(Login $user, Offer $offer)
    {
        // 受信者のみ更新可能
        return $offer->offer_to_id === $user->id;
    }
}
