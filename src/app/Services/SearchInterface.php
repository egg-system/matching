<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

interface SearchInterface
{
    public function userSearch(Request $request): string;
}