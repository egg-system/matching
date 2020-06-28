<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Http\Requests\Gym\UpdateRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Services\AuthService;
use App\Services\UserService;

class GymController extends Controller
{
    protected $authService;

    protected $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;

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
     * トレーナの一覧表示画面(検索付).
     * @param TrainerSearchRequest $request
     */
    public function trainerList(TrainerSearchRequest $request)
    {
        $validated = $request->validated();
        $matchingCondition = MatchingCondition::with(['user', 'area', 'occupation'])->onlyTrainer();

        if ($request->anyFilled(array_keys($validated))) {
            $matchingCondition = $matchingCondition->search($validated);
        }
        $conditions = $matchingCondition->get();
        return view('gym.trainerList', compact('conditions'));
    }

    /**
     * ジムオーナーのログイン.
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request, Gym::class, route('gym.index'));
    }
}
