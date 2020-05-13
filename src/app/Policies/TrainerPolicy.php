<?php

namespace App\Policies;

use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * ログインユーザーのみ編集を認可
     */
    public function edit(Login $login, Trainer $trainer)
    {
        return $login->user_id == $trainer->id;
    }
}
