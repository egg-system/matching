<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Area;
use App\Models\Gym;
use App\Models\Occupation;
use App\Models\User;
use App\Repositories\UserRepository;

class UsersController extends Controller
{
    /** @var UserRepository  */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * 本登録画面表示
     */
    public function create()
    {
        $occupations = Occupation::all()->map(function ($occupation) {
            $img = '';
            if ($occupation->name === 'フィットネス') {
                $img = '/images/users-register/fitness_icon.jpg';
            } elseif ($occupation->name === 'ジム') {
                $img = '/images/users-register/gym_icon2.jpg';
            } elseif ($occupation->name === 'パーソナル') {
                $img = '/images/users-register/personal_trainer_icon.jpg';
            }
            return collect([ 'name' => $occupation->name, 'value' => $occupation->id, 'img' => $img ]);
        });
        $areas = Area::all()->map(function ($area) {
            return collect([ 'name' => $area->name, 'value' => $area->id ]);
        });
        $areas->prepend(collect([ 'name' => '', 'value' => '' ]));

        return view('pages.users.register', compact('occupations', 'areas'));
    }

    /**
     * 本登録
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        // すでにLoginと紐付いていた場合
        if ($request->existsRegisteredUser()) {
            return redirect()->route('trainers.login');
        }

        $login = $this->userRepository->create($request);

        auth()->login($login);

        return redirect()->route('top');
    }

    /**
     * 編集
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $matchingCondition = $user->matchingCondition;
        return view('pages.users.edit', compact('user', 'matchingCondition'));
    }

    /**
     * @param UpdateRequest $request
     * @param User $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $model)
    {
        $this->userRepository->updateUser($request, $model);

        if (get_class($model) === Gym::class) {
            return redirect()->route('gyms.edit', $model->id);
        }
        return redirect()->route('top');
    }
}
