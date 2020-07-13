<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Services\SearchInterface;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Http\Requests\Trainer\UpdateRequest;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Trainer;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Log;

class TrainersController extends Controller
{
    protected $userService;
    protected $searchService;

    public function __construct(AuthService $authService, UserService $userService, SearchInterface $searchService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
        $this->searchService = $searchService;
    }

    /**
     * トレーナー本登録画面表示
     */
    public function create()
    {
        return view('pages.trainers.register');
    }

    /**
     * 本登録する
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
     * ジムの一覧表示画面(検索付)
     */
    public function gymList(TrainerSearchRequest $request)
    {
        //$validated = $request->validated();

        //if ($request->anyFilled(array_keys($validated))) {
            $conditions = $this->searchService->profileSearch($request);
        //}
        Log::debug($conditions);
        return view('pages.gyms.trainerList', compact('conditions'));
    }

    /**
     * トレーナーのログイン
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request, Trainer::class, route('top'));
    }

    public function edit(Trainer $trainer)
    {
        $matchingCondition = $trainer->matchingCondition;
        return view('pages.trainers.edit', compact('trainer', 'matchingCondition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $this->userService->updateUser($request, $trainer);

        return redirect()->route('top');
    }
}
