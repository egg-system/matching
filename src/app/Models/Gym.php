<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = [
        'name',
        'president_name',
        'tel',
        'occupation_id',
        'area_id',
        'staff_count',
        'customer_count',
        'requirements',
        'price',
        'work_time',
    ];

    protected $casts = [
        'requirements' => 'json',
        'price' => 'json',
        'work_time' => 'json',
    ];

    public function login()
    {
        return $this->morphOne('App\Models\Login', 'user');
    }
}
