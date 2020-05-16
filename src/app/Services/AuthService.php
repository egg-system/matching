<?php
namespace App\Services;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login(LoginRequest $request, $user_type, $done_url){
        $credentials = array_merge($request->only('email', 'password'), ['user_type' => $user_type]);

        // 認証失敗
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return redirect()->intended($done_url);
    }
}
