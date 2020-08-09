<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerSearchRequest;
use App\Models\MatchingCondition;

class TrainersController extends Controller
{
    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function index(TrainerSearchRequest $request)
    {
        $validated = $request->validated();
        $matchingCondition = MatchingCondition::with(['user', 'area'])->onlyTrainer();
        if ($request->anyFilled(array_keys($validated))) {
            $matchingCondition = $matchingCondition->search($validated);
        }
        $conditions = $matchingCondition->get();
        return view('pages.trainers.index', compact('conditions'));
    }
}
