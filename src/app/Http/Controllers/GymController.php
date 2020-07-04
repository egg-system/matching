<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Http\Requests\Gym\UpdateRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Services\AuthService;
use App\Services\UserService;
use App\Components\TrainerSearch;

class GymController extends Controller
{
    protected AuthService $authService;
    protected UserService $userService;
    protected TrainerSearch $trainerSearch;

    public function __construct(AuthService $authService, UserService $userService, TrainerSearch $trainerSearch)
    {
        $this->authService = $authService;
        $this->userService = $userService;
        $this->trainerSearch = $trainerSearch;

        $this->authorizeResource(Gym::class);
    }

    public function index()
    {
        return view('gym.index');
    }

    public function edit(Gym $gym)
    {
        $matchingCondition = $gym->matchingCondition;
        return view('gym.edit', compact('gym', 'matchingCondition'));
    }

    public function update(UpdateRequest $request, Gym $gym)
    {
        $this->userService->updateUser($request, $gym);

        return redirect()->route('gym.edit', $gym->id);
    }

    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function trainerList(TrainerSearchRequest $request)
    {
        $validated = $request->validated();

        if ($request->anyFilled(array_keys($validated))) {
            $conditions = $this->trainerSearch->userSearch($request);
        }
        
        return view('gym.trainerList', compact('conditions'));
    }

    /**
     * ジムオーナーのログイン
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request, Gym::class, route('gym.index'));
    }
}
