<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\StoreRequest;
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
        $user = $request->user();
        $offers = $this->matchingService->searchOffers($request);
        return view('pages.offers.index', compact('offers', 'user'));
    }

    public function show(Offer $offer)
    {
        return view('pages.offers.show', compact('offer'));
    }

    /**
     * オファー情報登録
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->matchingService->storeOffer($request);
        return back();
    }
}
