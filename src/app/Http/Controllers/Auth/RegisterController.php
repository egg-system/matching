<?php

namespace App\Http\Controllers\Auth;

use App\Events\TrainerRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return route('sentEmail');
    }

    /**
     * Handle a registration request for the application.
     * メールアドレス登録でログインしないようにオーバーライド
     */
    public function register(RegisterRequest $request)
    {
        // 同じメールアドレスのログインが複数できないように、firstOrCreateを実行
        $user = $this->firstOrCreate($request->all());;
        event(new TrainerRegistered($user));

        $response = $this->registered($request, $user);
        if (isset($response)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Login
     */
    protected function firstOrCreate(array $data)
    {
        // trainerの登録時は、emailとuser_typeで一意にする
        return Login::firstOrCreate([
            'user_type' => Trainer::class,
            'email' => $data['email'],
        ], [
            'password' => Str::random(50),
        ]);
    }
}
