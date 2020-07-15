<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\Trainer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

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
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->middleware('guest')->except('logout');
        // トレーナー、ジムオーナーで処理を分ける可能性があるためコンストラクタで設定する
        $this->userType = strpos($route->getName(), 'trainers') !== false ? Trainer::class : Gym::class;

        if ($route->getName() === 'gyms.login') {
            $this->redirectTo = route('gyms.index');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'), ['user_type' => $this->userType]);
    }
}
