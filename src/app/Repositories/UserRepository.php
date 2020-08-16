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

            $registeredTrainer = Trainer::create($validated);
            $registeredMatchingCondition = $registeredTrainer->matchingCondition()->create($validated);

            // userOccupationsの作成
            $occupationIdsCollection = collect(explode(',', $request->occupation_ids));
            $userOccupationsData = $occupationIdsCollection->map(function ($occupationId) use ($registeredMatchingCondition) {
                return [
                    'occupation_id' => $occupationId,
                    'user_id' => $registeredMatchingCondition->id
                ];
            });
            $registeredMatchingCondition->userOccupations()->createMany($userOccupationsData);
            // トレーナーとログインの紐付けて、カラムの更新
            return $registeredTrainer->associateToLogin(Login::find($request->id), [
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
            $user->matchingCondition->update(
                $request->only(MatchingCondition::make()->getFillable())
            );
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
