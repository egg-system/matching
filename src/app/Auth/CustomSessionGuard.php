<?php
namespace App\Auth;

use Illuminate\Auth\SessionGuard;
 
class CustomSessionGuard extends SessionGuard
{
    // user()のalias
    public function login() { 
        return $this->user();
    }
}
