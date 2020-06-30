<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'tel',
        'pr_comment',
    ];

    protected $with = ['login'];

    public function login()
    {
        return $this->morphOne(Login::class, 'user');
    }

    public function matchingCondition()
    {
        return $this->morphOne(MatchingCondition::class, 'user');
    }

    /**
     * ログインと関連付ける
     * @param int $id
     * @return \App\Models\Login
     */
    public function associateToLogin(Login $login, array $updateColumns = [])
    {
        // 更新するカラムとマージ
        return $this->login()->save($login->fillUpdateColumns($updateColumns));
    }
}
