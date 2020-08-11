<?php

namespace App\Repositories;

use App\Models\Area;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Occupation;
use App\Models\Trainer;
use App\Models\User;
use App\Models\UserOccupation;
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
            $registeredMatchingCongition = $registered_trainer->matchingCondition()->create($validated);
            // userOccupationsの作成
            $occupationIdCollection = collect(explode(',', $request->occupation_ids));
            foreach ($occupationIdCollection as $occupationId) {
                $data = [
                    'occupation_id' => $occupationId,
                    'user_id' => $registeredMatchingCongition->id
                ];
                UserOccupation::create($data);
            };
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

    public function getOccupations()
    {
        return Occupation::all()->map(function ($occupation) {
            $img = '';
            if ($occupation->name === 'フィットネス') {
                $img = '/images/users-register/fitness_icon.jpg';
            } elseif ($occupation->name === 'ジム') {
                $img = '/images/users-register/gym_icon2.jpg';
            } elseif ($occupation->name === 'パーソナル') {
                $img = '/images/users-register/personal_trainer_icon.jpg';
            }
            return collect([ 'name' => $occupation->name, 'value' => $occupation->id, 'img' => $img ]);
        });
    }

    public function getAreas()
    {
        $areas = Area::all()->map(function ($area) {
            return collect([ 'name' => $area->name, 'value' => $area->id ]);
        });
        $areas->prepend(collect([ 'name' => '', 'value' => '' ]));
        return $areas;
    }
}
