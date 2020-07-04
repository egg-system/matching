<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trainer\RegisterRequest;
use App\Http\Requests\Trainer\UpdateRequest;
use App\Models\Login;
use App\Models\Trainer;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    use AuthenticatesUsers;

    /** @var UserRepository  */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * トレーナー本登録画面表示
     */
    public function create()
    {
        return view('trainer.register');
    }

    /**
     * 本登録する
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

        $login = $this->userRepository->createTrainer($request->validated());

        auth()->login($login);

        return redirect()->route('top');
    }

    /**
     * @param Trainer $trainer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Trainer $trainer)
    {
        $matchingCondition = $trainer->matchingCondition;
        return view('trainer.edit', compact('trainer', 'matchingCondition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $this->userRepository->updateUser($request->validated(), $trainer);

        return redirect()->route('top');
    }

    /**
     * {@inheritDoc}
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'), ['user_type' => Trainer::class]);
    }

    /**
     * {@inheritDoc}
     */
    protected function redirectPath()
    {
        return route('top');
    }
}
