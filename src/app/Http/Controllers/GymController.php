<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Area;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Models\Occupation;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;

class GymController extends Controller
{
    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function index()
    {
        return view('gymowner.index');
    }

    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function trainerList(TrainerSearchRequest $request)
    {
        $validated = $request->validated();
        $matching_condition = MatchingCondition::with(['area', 'occupation'])->onlyTrainer();
        if ($request->anyFilled(array_keys($validated))) {
            $matching_condition = $matching_condition->search($validated);
        }
        $conditions = $matching_condition->get();
        $areas = Area::all();
        $occupations = Occupation::all();
        return view('gymowner.trainerList', compact('conditions', 'areas', 'occupations'));
    }

    /**
     * ジムオーナーのログイン
     */
    public function login(LoginRequest $request)
    {
        return $this->auth_service->login($request, Gym::class, route('gymowner.index'));
    }
}
