<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'tel',
        'pr_comment',
    ];

    public function login()
    {
        return $this->morphOne(Login::class, 'user');
    }

    public function matchingCondition()
    {
        return $this->morphOne(MatchingCondition::class, 'user');
    }

    /**
     * トレーナーとログインを関連付ける
     * @param int $id
     * @return \App\Models\Login
     */
    public function associateToTrainer(int $login_id, array $update_columns = [])
    {
        $login = Login::find($login_id);
        // 更新するカラムとマージ
        return $this->login()->save($login->fillUpdateColumns($update_columns));
    }
}
