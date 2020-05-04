<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Models\Trainer;
use Illuminate\Validation\ValidationException;

class GymController extends Controller
{
    public function index()
    {
        return view('gymowner.index');
    }

    public function trainerList()
    {
        $conditions = MatchingCondition::with(['area', 'occupation'])->trainer()->get();
        return view('gymowner.trainerList', compact('conditions'));
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
