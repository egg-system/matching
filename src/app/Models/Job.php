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
        'experience',
    ];
}
