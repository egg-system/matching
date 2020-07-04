<?php

namespace App\Repositories;

use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * トレーナー登録
     * @param array $params
     * @return mixed
     */
    public function createTrainer(array $params)
    {
        return DB::transaction(function () use ($params) {
            // トレーナー登録
            $registered_trainer = Trainer::create($params);
            // matchingConditionと紐付け
            $registered_trainer->matchingCondition()->create($params);
            // トレーナーとログインの紐付けて、カラムの更新
            return $registered_trainer->associateToLogin(Login::find($params['id']), [
                'name' => $params['name'],
                'email_verified_at' => now(),
                'password' => $params['password']
            ]);
        });
    }

    /**
     * ユーザー更新
     * @param array $params
     * @param Model $user
     */
    public function updateUser(array $params, Model $user)
    {
        DB::transaction(function () use ($params, $user) {
            // トレーナー更新
            $user->update(Arr::only($params, $user->getFillable()));
            // matchingCondition更新
            $user->matchingCondition->update(Arr::only($params, MatchingCondition::make()->getFillable()));
            // ログインと紐付けて、カラムの更新
            return $user->associateToLogin(Auth::user(), [
                'name' => $params['name']
            ]);
        });
    }
}