<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'tel',
        'occupation_id',
        'area_id',
        'pr_comment',
        'hope_price',
        'hope_work_time',
    ];

    protected $casts = [
        'hope_price' => 'json',
        'hope_work_time' => 'json',
    ];

    public function login()
    {
        return $this->morphOne('App\Models\Login', 'user');
    }

    /**
     * トレーナーとログインを関連付ける
     * @param int $id
     * @return \App\Models\Login
     */
    public function associateToTrainer(int $login_id)
    {
        $login = Login::find($login_id);
        $login->email_verified_at = now();
        return $this->login()->save($login);
    }
}
