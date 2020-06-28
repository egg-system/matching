<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Http\Requests\Trainer\UpdateRequest;
use App\Models\Login;
use App\Models\Trainer;
use App\Services\AuthService;
use App\Services\UserService;

class TrainerController extends Controller
{
    protected $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * トレーナー本登録画面表示.
     */
    public function create()
    {
        return view('trainer.register');
    }

    /**
     * 本登録する.
     * @param RegisterRequest $request
     */
    public function store(RegisterRequest $request)
    {
        $loginId = $request->id;
        // すでにLoginと紐付いていた場合
        if (Login::find($loginId)->user_id) {
            return redirect()->route('top');
        }

        $login = $this->userService->createTrainer($request);

        auth()->login($login);

        return redirect()->route('top');
    }

    /**
     * トレーナーのログイン.
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request, Trainer::class, route('top'));
    }

    public function edit(Trainer $trainer)
    {
        $matchingCondition = $trainer->matchingCondition;
        return view('trainer.edit', compact('trainer', 'matchingCondition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $this->userService->updateUser($request, $trainer);

        return redirect()->route('top');
    }
}
