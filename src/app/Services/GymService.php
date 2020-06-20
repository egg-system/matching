<?php

namespace App\Services;

use App\Http\Requests\Gym\UpdateRequest;
use App\Models\Gym;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GymService
{
    public function updateModels(UpdateRequest $request, Gym $gym)
    {
        DB::transaction(function () use ($request, $gym) {
            $gym->update($request->getGymValues());
            // matchingCondition更新
            $gym->matchingCondition->update($request->getMatchingConditionValues());
            // トレーナーとログインの紐付けて、カラムの更新
            return $gym->associateToLogin(Auth::user(), [
                'name' => $request->name
            ]);
        });
    }
}
