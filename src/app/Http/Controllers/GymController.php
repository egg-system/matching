<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Http\Requests\Gym\UpdateRequest;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class GymController extends Controller
{
    use AuthenticatesUsers;

    /** @var UserRepository  */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->authorizeResource(Gym::class);
    }

    public function index()
    {
        return view('gym.index');
    }

    public function edit(Gym $gym)
    {
        $matchingCondition = $gym->matchingCondition;
        return view('gym.edit', compact('gym', 'matchingCondition'));
    }

    public function update(UpdateRequest $request, Gym $gym)
    {
        $this->userRepository->updateUser($request->validated(), $gym);

        return redirect()->route('gym.edit', $gym->id);
    }

    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function trainerList(TrainerSearchRequest $request)
    {
        $validated = $request->validated();
        $matchingCondition = MatchingCondition::with(['user', 'area', 'occupation'])->onlyTrainer();
        if ($request->anyFilled(array_keys($validated))) {
            $matchingCondition = $matchingCondition->search($validated);
        }
        $conditions = $matchingCondition->get();
        return view('gym.trainerList', compact('conditions'));
    }

    /**
     * {@inheritDoc}
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'), ['user_type' => Gym::class]);
    }

    /**
     * {@inheritDoc}
     */
    protected function redirectPath()
    {
        return route('gym.index');
    }
}
