<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OfferState extends Model
{
    protected $fillable = ['name'];

    const UNREPLY = 1;
    const ACCEPT = 2;
    const REFUSE = 3;
}
