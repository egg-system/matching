<?php
namespace App\Services;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login(LoginRequest $request, $userType, $doneUrl){
        $credentials = array_merge($request->only('email', 'password'), ['user_type' => $userType]);

        // 認証失敗
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return redirect()->intended($doneUrl);
    }
}
