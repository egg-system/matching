<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    // ジム、トレイナーでメールアドレスをわけるため、２つの種類が必要になる
    public function showLinkRequestForm($userType)
    {
        $userModel = \Str::studly($userType);
        return view('auth.passwords.email', [
            'userType' => "App\\Models\\$userModel",
        ]);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_type' => 'required',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only(['email', 'user_type']);
    }

    public function sendResetLinkResponse()
    {
        return view('auth.passwords.email-sent');
    }
}
