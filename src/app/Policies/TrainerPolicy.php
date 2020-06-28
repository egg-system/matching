<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    /**
     * ログインユーザーのみ編集を認可.
     * @param Login   $login
     * @param Trainer $trainer
     */
    public function update(Login $login, Trainer $trainer)
    {
        return $login->user_id == $trainer->id;
    }
}
