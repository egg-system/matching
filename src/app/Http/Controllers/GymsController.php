<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Repositories\UserRepository;

class GymsController extends Controller
{
    /** @var UserRepository  */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->authorizeResource(Gym::class);
    }

    public function index()
    {
        return view('pages.gyms.index');
    }
}
