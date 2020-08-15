<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOccupation extends Model
{
    protected $primaryKey = ['occupation_id', 'user_id'];
    public $incrementing = false;
    
    protected $fillable = [
        'occupation_id',
        'user_id'
    ];

    public function matchingCondition()
    {
        return $this->belongsTo(MatchingCondition::class, 'user_id');
    }
}
