<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Http\Requests\Trainer\UpdateRequest;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Trainer;
use App\Services\AuthService;
use App\Services\TrainerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TrainerController extends Controller
{
    protected $trainerService;
    
    public function __construct(AuthService $authService, TrainerService $trainerService)
    {
        $this->authService = $authService;
        $this->trainerService = $trainerService;
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
     */
    public function store(RegisterRequest $request)
    {
        $loginId = $request->id;
        // すでにLoginと紐付いていた場合
        if (Login::find($loginId)->user_id) {
            return redirect()->route('top');
        }
        
        $login = $this->trainerService->createModels($request);

        auth()->login($login);

        return redirect()->route('top');
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
        return view('trainer.edit', compact('trainer', 'matchingCondition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $this->trainerService->updateModels($request, $trainer);

        return redirect()->route('top');
    }
}
