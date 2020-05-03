<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Models\Area;
use App\Models\Login;
use App\Models\Occupation;
use App\Models\Trainer;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
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
}
