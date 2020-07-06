<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Gym;
use App\Models\Login;
use App\Models\Trainer;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /** @var UserRepository  */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 本登録画面表示
     */
    public function create()
    {
        return view('trainer.register');
    }

    /**
     * 本登録
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $loginId = $request->id;
        // すでにLoginと紐付いていた場合
        if (Login::find($loginId)->user_id) {
            return redirect()->route('top');
        }

        $login = $this->userRepository->create($request);

        auth()->login($login);

        return redirect()->route('top');
    }

    /**
     * 編集
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $view = get_class($user) === Trainer::class ? 'trainer.edit' : 'gym.edit';
        $matchingCondition = $user->matchingCondition;
        return view($view, compact('user', 'matchingCondition'));
    }

    /**
     * @param UpdateRequest $request
     * @param User $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $model)
    {
        $this->userRepository->updateUser($request, $model);
        $redirectHome = get_class($model) === Gym::class ? 'gym.index' : 'top';

        return redirect()->route($redirectHome);
    }
}
