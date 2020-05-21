<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Http\Requests\Trainer\UpdateRequest;
use App\Models\Area;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Occupation;
use App\Models\Trainer;
use App\Services\TrainerService;
use Illuminate\Validation\ValidationException;

class TrainerController extends Controller
{
    protected $trainerService;
    
    public function __construct(TrainerService $trainer_service)
    {
        $this->trainerService = $trainer_service;
    }

    /**
     * トレーナー本登録画面表示
     */
    public function create()
    {
        $occupations = Occupation::all();
        $areas = Area::all();
        return view('trainer.register', compact('occupations', 'areas'));
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
        $credentials = array_merge($request->only('email', 'password'), ['user_type' => Trainer::class]);

        // 認証失敗
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return redirect()->intended(route('top'));
    }

    public function edit(Trainer $trainer)
    {
        $occupations = Occupation::all();
        $areas = Area::all();
        $matching_condition = $trainer->matchingCondition;
        return view('trainer.edit', compact('trainer', 'occupations', 'areas', 'matching_condition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $this->trainerService->updateModels($request, $trainer);

        return redirect()->route('top');
    }
}
