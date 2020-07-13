<?php

namespace App\Repositories;

use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * トレーナー登録
     * @param array $params
     * @return mixed
     */
    public function create(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            // トレーナー登録
            $registered_trainer = Trainer::create($validated);
            // matchingConditionと紐付け
            $registered_trainer->matchingCondition()->create($validated);
            // トレーナーとログインの紐付けて、カラムの更新
            return $registered_trainer->associateToLogin(Login::find($request->id), [
                'name' => $request->name,
                'email_verified_at' => now(),
                'password' => $request->password
            ]);
        });
    }

    /**
     * ユーザー更新
     * @param Request $request
     * @param User $user
     */
    public function updateUser(Request $request, User $user)
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
