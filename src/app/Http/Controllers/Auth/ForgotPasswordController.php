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
        return view('passwords.email', [
            'userModel' => "App\\Models\\$userModel"
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

    public function sendResetLinkResponse(Request $request, $response)
    {
        $isGym = $request->user_type === \App\Models\Gym::class;
        $userType = $isGym ? 'gym' : 'trainer';
        return view('passwords.email-sent')->with(compact('userType'));
    }
}
