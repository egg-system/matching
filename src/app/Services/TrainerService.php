<?php

namespace App\Services;

use App\Http\Requests\Trainer\RegisterRequest;
use App\Models\Trainer;

class TrainerService
{
    /**
     * トレーナーの登録を行う
     * @param RegisterRequest $request
     * @return \App\Models\Trainer
     */
    public function register(RegisterRequest $request)
    {
        return Trainer::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'pr_comment' => $request->pr_comment,
            'occupation_id' => $request->occupation_id,
            'area_id' => $request->area_id,
            'hope_price' => $request->hope_price,
            'hope_work_time' => $request->hope_work_time,
        ]);
    }
}
