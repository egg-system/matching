<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = [
        'president_name',
        'tel',
        'staff_count',
        'prefecture_id',
        'cities',
        'street_address',
        'gym_url',
        'comment',
        'charge',
        'requirements_number',
        'pay',
        'experience',
    ];

    protected $casts = [
        'pay' => 'json',
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
