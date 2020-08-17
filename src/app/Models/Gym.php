<?php

namespace App\Models;

use App\Models\Login;
use App\Models\Job;
use App\Models\MatchingCondition;
use App\Models\Prefecture;

class Gym extends User
{
    protected $fillable = [
        'profiles',
        'tel',
        'prefecture_id',
        'gym_url',
        'description',
    ];

    protected $casts = [
        /*
         * 以下のObjectになる
         *  president_name: 代表者氏名
         *  staff_number: スタッフ数
         *  postal_code: 郵便番号
         *  cities: 市町村区 ※ 都道府県はprefecture_idで取得
         *  street_address: 丁番建物などの住所
        */
        'profiles' => 'json',
    ];

    protected $with = ['job', 'login', 'prefecture'];

    public function job()
    {
        return $this->hasOne(Job::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function getFeaturesAttribute()
    {
        $features = [];
        $matchingCondition = $this->matchingCondition;

        if ($matchingCondition->can_work_weekday) {
            $features[] = '平日稼働可';
        }

        if ($matchingCondition->can_work_holiday) {
            $features[] = '休日稼働可';
        }

        if ($matchingCondition->can_adjust) {
            $features[] = 'トレーナーにあわせて、調整可';
        }

        return $features;
    }

    public function getPresidentNameAttribute()
    {
        return $this->profiles['president_name'];
    }

    public function getAddressAttribute()
    {
        $postalCode = $this->profiles['postal_code'];
        $prefecture = $this->prefecture->name;
        $cities = $this->profiles['cities'];
        $street = $this->profiles['street_address'];
        return "$postalCode $prefecture $cities $street";
    }

    public function getStaffNumberAttribute()
    {
        return $this->profiles['staff_number'];
    }
}
