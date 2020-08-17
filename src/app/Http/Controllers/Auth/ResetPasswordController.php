<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function showResetForm(Request $request, $userType, $token = null)
    {
        $userModel = \Str::studly($userType);
        return view('passwords.reset')->with(
            [
                'token' => $token,
                'email' => $request->email,
                'userType' => "App\\Models\\$userModel",
            ]
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'user_type' => 'required'
        ];
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'email',
            'password',
            'password_confirmation',
            'token',
            'user_type'
        );
    }

    // ログインさせないようにする
    protected function resetPassword($login, $password)
    {
        $this->setUserPassword($login, $password);

        $login->setRememberToken(\Str::random(60));
        $login->save();

        event(new PasswordReset($login));
    }

    protected function sendResetResponse(Request $request, $response)
    {
        $baseName = class_basename($request->user_type);
        $userType = \Str::camel($baseName);
        return redirect(route('login.view', compact('userType')))
            ->with('status', trans($response));
    }
}
