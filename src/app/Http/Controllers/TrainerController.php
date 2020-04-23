<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Models\Area;
use App\Models\Login;
use App\Models\Occupation;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed')
            ->only(['create', 'store']);
    }

    /**
     * トレーナー本登録画面表示
     */
    public function create()
    {
        $occupations = Occupation::all();
        $areas = Area::all();
        return view('trainer.register', compact('occupations', 'areas'));
    }

    /**
     * 本登録する
     */
    public function store(RegisterRequest $request)
    {
        // すでにLoginと紐付いていた場合
        if (Login::find($request->id)->user) {
            return redirect()->route('top');
        }
        $registered_trainer = Trainer::create($request->validated());
        if (!$registered_trainer) {
            return redirect()->back();
        }
        $login = $registered_trainer->associateToTrainer($request->id);
        auth()->login($login);

        return redirect()->route('top');
    }
}
