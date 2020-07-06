<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\Trainer;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (\Route::current()->getName() === 'gym.login') {
            $this->redirectTo =  route('gym.index');
        }
        $this->middleware('guest')->except('logout');
    }

    /**
     * {@inheritDoc}
     */
    protected function credentials(Request $request)
    {
        $userType = \Route::current()->getName() === 'trainer.login' ? Trainer::class : Gym::class;
        return array_merge($request->only('email', 'password'), ['user_type' => $userType]);
    }
}
