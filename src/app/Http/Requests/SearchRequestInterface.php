<?php

namespace App\Http\Requests;

interface SearchRequestInterface
{
    public function validated();
    public function rules();
}
