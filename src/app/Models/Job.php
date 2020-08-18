<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'gym_id',
        'title',
        'main_image_url',
        'job_content',
        'requirements',
        'requirements_number',
        'job_info',
    ];

    protected $casts = [
        /**
         * 以下のObjectの配列が入る
         *  - title: 詳細見出し
         *  - image: 詳細画像
         *  - description: 詳細文章
         */
        'job_info' => 'json',
    ];
}
