<?php
namespace App\Services;

use App\Http\Requests\Trainer\RegisterRequest;
use App\Http\Requests\Trainer\UpdateRequest;
use App\Models\Trainer;
use Illuminate\Support\Facades\DB;

class TrainerService
{
    public function createModels(RegisterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            // トレーナー登録
            $registered_trainer = Trainer::create($validated);
            // matchingConditionと紐付け
            $registered_trainer->matchingCondition()->create($validated);
            // トレーナーとログインの紐付けて、カラムの更新
            $login_id = $request->id;
            return $registered_trainer->associateToTrainer($login_id, [
                'email_verified_at' => now(),
                'password' => $request->password
            ]);
        });
    }

    public function updateModels(UpdateRequest $request, Trainer $trainer)
    {
        DB::transaction(function () use ($request, $trainer) {
            // トレーナー更新
            Trainer::find($trainer->id)->update($request->getTrainerValues());
            // matchingCondition更新
            $trainer->matchingCondition->update($request->getMatchingConditionValues());
        });
    }
}
