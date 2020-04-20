<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trainer\RegisterRequest;
use App\Models\Area;
use App\Models\Login;
use App\Models\Occupation;
use App\Services\LoginService;
use App\Services\TrainerService;

class RegisterController extends Controller
{
    private $trainer_service;
    private $login_service;

    public function __construct(TrainerService $trainer_service, LoginService $login_service)
    {
        $this->trainer_service = $trainer_service;
        $this->login_service = $login_service;
    }

    /**
     * トレーナー本登録画面表示
     */
    public function showForm()
    {
        $occupations = Occupation::all();
        $areas = Area::all();
        return view('trainer.register', compact('occupations', 'areas'));
    }

    /**
     * 本登録する
     */
    public function register(int $id, RegisterRequest $request)
    {
        $registered_trainer = $this->trainer_service->register($request);
        if (!$registered_trainer) {
            return redirect()->back();
        }
        $login = $this->login_service->associateToTrainer($registered_trainer, $id);
        auth()->login($login);

        return redirect()->route('top');
    }
}
