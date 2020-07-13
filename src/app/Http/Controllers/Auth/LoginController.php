<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /** @var string */
    private $userType;

    /**
     * LoginController constructor.
     * @param string $userType
     * @param string $redirectTo
     */
    public function __construct(string $userType = '', string $redirectTo = '')
    {
        $this->middleware('guest')->except('logout');
        $this->userType = $userType;
        $this->redirectTo = $redirectTo;
    }

    /**
     * {@inheritDoc}
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'), ['user_type' => $this->userType]);
    }
}
