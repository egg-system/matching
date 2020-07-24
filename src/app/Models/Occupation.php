<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function occupation()
    {
        return $this->belongsToMany(
            Occupation::class,
            'user_occupations',
            'occupation_id',
            'user_id'
        )->withTimestamps();
    }
}
