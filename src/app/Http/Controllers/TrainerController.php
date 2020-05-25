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
    
    public function __construct(AuthService $auth_service, TrainerService $trainer_service)
    {
        $this->auth_service = $auth_service;
        $this->trainerService = $trainer_service;
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
        $login_id = $request->id;
        // すでにLoginと紐付いていた場合
        if (Login::find($login_id)->user_id) {
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
        return $this->auth_service->login($request, Trainer::class, route('top'));
    }

    public function edit(Trainer $trainer)
    {
        $matching_condition = $trainer->matchingCondition;
        return view('trainer.edit', compact('trainer', 'matching_condition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $this->trainerService->updateModels($request, $trainer);

        return redirect()->route('top');
    }
}
