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
        return $this->morphOne('App\Models\Login', 'user');
    }

    public function matchingCondition()
    {
        return $this->morphOne('App\Models\MatchingCondition', 'user');
    }

    /**
     * トレーナーとログインを関連付ける
     * @param int $id
     * @return \App\Models\Login
     */
    public function associateToTrainer(int $login_id, array $update_column = [])
    {
        $login = Login::find($login_id);
        // 更新するカラムとマージ
        $attr = array_merge($login->getAttributes(), $update_column);
        return $this->login()->save($login->fill($attr));
    }
}
