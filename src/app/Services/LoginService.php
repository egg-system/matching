<?php

namespace App\Services;

use App\Models\Login;
use App\Models\Trainer;

class LoginService
{
    /**
     * トレーナーとログインを関連付ける
     * @param \App\Models\Trainer $trainer
     * @param int $id
     * @return \App\Models\Login
     */
    public function associateToTrainer(Trainer $trainer, int $login_id)
    {
        $login = Login::find($login_id);
        $login->email_verified_at = now();
        return $trainer->login()->save($login);
    }
}
