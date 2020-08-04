<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        AuthenticatesUsers::login as doLogin;
    }

    public function login(LoginRequest $request)
    {
        return $this->doLogin($request);
    }

    /**
     * {@inheritDoc}
     */
    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only('email', 'password'),
            ['user_type' => $request->user_type]
        );
    }

    protected function redirectTo()
    {
        // TODO: #59 ホーム画面を実装する
        // $login = auth()->user();
        // if ($login->user_type === App\Models\Gym::class) {
        //     return route('gyms.index');
        // }

        return route('top');
    }
}
