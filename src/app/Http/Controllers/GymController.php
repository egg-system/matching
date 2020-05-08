<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Area;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Models\Occupation;
use Illuminate\Validation\ValidationException;

class GymController extends Controller
{
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
        if ($request->anyFilled(array_keys($validated))) {
            $conditions = MatchingCondition::with(['area', 'occupation'])->search($validated)->onlyTrainer()->get();
        } else {
            $conditions = MatchingCondition::with(['area', 'occupation'])->onlyTrainer()->get();
        }
        $areas = Area::all();
        $occupations = Occupation::all();
        return view('gymowner.trainerList', compact('conditions', 'areas', 'occupations'));
    }

    /**
     * ジムオーナーのログイン
     */
    public function login(LoginRequest $request)
    {
        $credentials = array_merge($request->only('email', 'password'), ['user_type' => Gym::class]);

        // 認証失敗
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return redirect()->intended(route('gymowner.index'));
    }
}
