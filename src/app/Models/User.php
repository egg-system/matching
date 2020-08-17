<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class User extends Model
{
    public function login()
    {
        return $this->morphOne(Login::class, 'user');
    }

    public function matchingCondition()
    {
        return $this->morphOne(MatchingCondition::class, 'user');
    }

    public function isSameArea(User $toUser)
    {
        $toAreaId = $toUser->matchingCondition->area_id;
        return $this->matchingCondition->area_id === $toAreaId;
    }

    /**
     * ログインと関連付ける
     * @param Login $login
     * @param array $updateColumns
     * @return bool|false|Model
     */
    public function associateToLogin(Login $login, array $updateColumns = [])
    {
        // 更新するカラムとマージ
        return $this->login()->save($login->fillUpdateColumns($updateColumns));
    }
}
