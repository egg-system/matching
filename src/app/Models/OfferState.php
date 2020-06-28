<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferState extends Model
{
    const UNREPLY = 1;

    const ACCEPT = 2;

    const REFUSE = 3;

    protected $fillable = ['name'];
}
