<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\StoreRequest;
use App\Http\Requests\Offer\UpdateRequest;
use App\Models\Offer;
use App\Services\MatchingService;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    private $matchingService;

    public function __construct(MatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
        $this->authorizeResource(Offer::class);
    }

    public function index(Request $request)
    {
        $offers = $this->matchingService->searchOffers($request);
        return view('pages.offers.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        return view('pages.offers.show', compact('offer'));
    }

    public function update(Offer $offer, UpdateRequest $request)
    {
        $this->matchingService->updateState($offer, $request);
        return back();
    }

    /**
     * エントリー(オファー)登録処理
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->matchingService->entry($request);
        return back();
    }
}
