<?php

namespace App\Policies;

use App\Models\Gym;
use App\Models\Offer;
use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * indexメソッドに対する認可
     *
     * @param  \App\Models\Login  $user
     * @return mixed
     */
    public function viewAny(Login $user)
    {
        return true;
    }

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
        return $offer->canUpdateState($user->id, $user->user_type);
    }

    /**
     * Determine whether the user can create the model.
     *
     * @param  \App\Models\Login  $user
     * @return mixed
     */
    public function create(Login $user)
    {
        return true;
    }
}
