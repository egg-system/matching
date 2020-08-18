<?php

namespace App\Repositories;

use App\Models\Area;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Occupation;
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

            $trainer = Trainer::create($validated);
            $matchingCongition = $trainer->matchingCondition()->create($validated);

            // 職種の作成
            $occupationIds = explode(',', $request->occupation_ids);
            $matchingCongition->occupations()->sync($occupationIds);

            // トレーナーとログインの紐付けて、カラムの更新
            return $trainer->associateToLogin(Login::find($request->id), [
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
            $trainerRequest = $request->only($user->getFillable());
            $user->update(
                array_merge([
                    'is_considering_change_job' => false,
                ], $trainerRequest)
            );

            // matchingCondition更新
            $matchingConditionRequest = $request->only(
                MatchingCondition::make()->getFillable()
            );
            $user->matchingCondition->update(
                array_merge([
                    'can_work_holiday' => false,
                    'can_work_weekday' => false,
                    'can_adjust' => false,
                ], $matchingConditionRequest)
            );

            // 職種の更新
            $user
                ->matchingCondition
                ->occupations()
                ->sync($request->occupation_ids);

            // ログインと紐付けて、カラムの更新
            return $user->associateToLogin(Auth::user(), [
                'name' => $request->name
            ]);
        });
    }

    public function getOccupations()
    {
        return Occupation::all()->map(function ($occupation) {
            return collect([
                'name' => $occupation->name,
                'value' => $occupation->id,
                'img' => $occupation->image
            ]);
        });
    }

    public function getAreas()
    {
        $areas = Area::all()->map(function ($area) {
            return collect([
                'name' => $area->name,
                'value' => $area->id
            ]);
        });
        $areas->prepend(collect(['name' => '', 'value' => '']));
        return $areas;
    }
}
