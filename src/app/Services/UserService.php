<?php

namespace App\Services;

use App\Http\Requests\Trainer\RegisterRequest;
use App\Models\MatchingCondition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function createTrainer(RegisterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            // トレーナー登録
            $registered_trainer = Trainer::create($validated);
            // matchingConditionと紐付け
            $registered_trainer->matchingCondition()->create($validated);
            // トレーナーとログインの紐付けて、カラムの更新
            $login_id = $request->id;
            return $registered_trainer->associateToLogin($login_id, [
                'name' => $request->name,
                'email_verified_at' => now(),
                'password' => $request->password
            ]);
        });
    }

    public function updateUser(Request $request, Model $user)
    {
        DB::transaction(function () use ($request, $user) {
            // トレーナー更新
            $user->update($request->only($user->getFillable()));
            // matchingCondition更新
            $user->matchingCondition->update($request->only(MatchingCondition::make()->getFillable()));
            // ログインと紐付けて、カラムの更新
            return $user->associateToLogin(Auth::user(), [
                'name' => $request->name
            ]);
        });
    }
}
