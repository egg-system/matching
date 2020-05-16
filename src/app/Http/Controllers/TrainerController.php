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
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TrainerController extends Controller
{
    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
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
        // トレーナー作成処理
        $login = DB::transaction(function () use ($request, $login_id) {
            $validated = $request->validated();
            // トレーナー登録
            $registered_trainer = Trainer::create($validated);
            // matchingConditionと紐付け
            $registered_trainer->matchingCondition()->create($validated);
            // トレーナーとログインの紐付けて、カラムの更新
            return $registered_trainer->associateToTrainer($login_id, [
                'email_verified_at' => now(),
                'password' => $request->password
            ]);
        });

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
        $occupations = Occupation::all();
        $areas = Area::all();
        $matching_condition = MatchingCondition::where('user_id', $trainer->id)->first();
        return view('trainer.edit', compact('trainer', 'occupations', 'areas', 'matching_condition'));
    }

    public function update(UpdateRequest $request, Trainer $trainer)
    {
        $login = DB::transaction(function () use ($request, $trainer) {
            $validated = $request->validated();
            // トレーナー更新
            Trainer::find($trainer->id)->update($validated);
            // matchingCondition更新
            MatchingCondition::where('user_id', $trainer->id)->first()->update($validated);
        });

        return redirect()->route('top');
    }
}
