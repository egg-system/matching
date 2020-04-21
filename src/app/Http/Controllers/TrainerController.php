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
        $registered_trainer = $this->register($request);
        if (!$registered_trainer) {
            return redirect()->back();
        }
        $login = $this->associateToTrainer($registered_trainer, $request->id);
        auth()->login($login);

        return redirect()->route('top');
    }

    /**
     * トレーナーの登録を行う
     * @param RegisterRequest $request
     * @return \App\Models\Trainer
     */
    private function register(RegisterRequest $request)
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

    /**
     * トレーナーとログインを関連付ける
     * @param \App\Models\Trainer $trainer
     * @param int $id
     * @return \App\Models\Login
     */
    private function associateToTrainer(Trainer $trainer, int $login_id)
    {
        $login = Login::find($login_id);
        $login->email_verified_at = now();
        return $trainer->login()->save($login);
    }
}
