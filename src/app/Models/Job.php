<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'gym_id',
        'bussiness_description',
        'requirements_number',
        'pay_min',
        'pay_max',
        'experience_years',
    ];

    protected $casts = [
        /** 
         * job_title       : タイトル
         * job_headline    : 詳細見出し
         * job_image       : 詳細画像
         * job_description : 詳細文章
         * desired_person  : 求める人物像
         */
        'job_content' => 'json',
    ];
}
