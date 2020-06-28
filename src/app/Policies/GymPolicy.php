<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Gym;
use App\Models\Login;
use Illuminate\Auth\Access\HandlesAuthorization;

class GymPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    /**
     * indexメソッドに対する認可.
     *
     * @param \App\Models\Login $user
     * @return mixed
     */
    public function viewAny(Login $user)
    {
        return true;
    }

    /**
     * ログインユーザーのみ編集を認可.
     * @param Login $login
     * @param Gym   $gym
     */
    public function update(Login $login, Gym $gym)
    {
        return $login->user_id == $gym->id;
    }
}
