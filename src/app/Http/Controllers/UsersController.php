<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Models\Gym;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\SearchService;

class UsersController extends Controller
{
    /** @var UserRepository  */
    private $userRepository;

    private $searchService;

    public function __construct(UserRepository $userRepository, SearchService $searchService)
    {
        $this->userRepository = $userRepository;
        $this->searchService = $searchService;
    }

    /**
     * 本登録画面表示
     */
    public function create()
    {
        return view('pages.users.register');
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

    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function trainerList(TrainerSearchRequest $request)
    {
        // $validated = $request->validated();

        // if ($request->anyFilled(array_keys($validated))) {
            $conditions = $this->searchService->profileSearch($request);
        // }

        return view('pages.gyms.trainerList', compact('conditions'));
    }
}
