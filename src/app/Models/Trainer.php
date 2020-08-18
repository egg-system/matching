<?php

namespace App\Models;

use Carbon\Carbon;

class Trainer extends User
{
    protected $fillable = [
        'display_name',
        'tel',
        'pr_comment',
        'now_work_area_id',
        'now_work_style',
        'careers',
    ];

    protected $casts = [
        /*
         * 以下のObjectの配列になる
         *  - gym_name: ジム名
         *  - start_at: 入社日
         *  - end_at: 退社日
         *  - in_office: 在職中か
         *  - description: 詳細説明
        */
        'careers' => 'json',
    ];

    protected $with = ['login'];

    public function getSortedCareersAttribute()
    {
        // 在職中の場合、end_at(退職年月)は空欄になるため、start_at(入社日)でソートする
        return collect($this->careers)->sort(function ($career) {
            $startAt = Carbon::parse("{$career['start_at']}/00");
            return $startAt->getTimestamp();

        // sortでは、indexの値しか変わらないため、以下のメソッドが必要になる
        })->sortKeys();
    }

    public function getLastCareerNameAttribute()
    {
        if ($this->sortedCareers->isEmpty()) {
            return null;
        }
        return $this->sortedCareers->last()['gym_name'];
    }

    public function getFeaturesAttribute()
    {
        $features = [];

        if ($this->matchingCondition->can_work_weekday) {
            $features[] = '平日稼働可';
        }

        if ($this->matchingCondition->can_work_holiday) {
            $features[] = '休日稼働可';
        }

        if ($this->matchingCondition->can_adjust) {
            $features[] = 'ジムや案件にあわせて調整したい';
        }

        if ($this->is_considering_change_job) {
            $features[] = '転職を検討中';
        }

        return $features;
    }
}
