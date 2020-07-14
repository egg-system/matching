<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Gym;
use App\Models\Login;
use App\Models\Trainer;
use App\Models\User;
use App\Repositories\UserRepository;

class UsersController extends Controller
{
    /** @var UserRepository  */
    private $userRepository;

    /** @var int */
    private $loginId;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 本登録画面表示
     */
    public function create()
    {
        return view('pages.trainers.register');
    }

    /**
     * 本登録
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        // すでにLoginと紐付いていた場合
        if (Login::find($this->loginId)->user_id) {
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
        $view = get_class($user) === Trainer::class ? 'pages.trainers.edit' : 'pages.gyms.edit';
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

        if (get_class($model) === Gym::class) {
            return redirect()->route('gyms.edit', $model->id);
        }
        return redirect()->route('top');
    }

    /**
     * @param int $loginId
     */
    public function setLoginId(int $loginId): void
    {
        $this->loginId = $loginId;
    }
}
