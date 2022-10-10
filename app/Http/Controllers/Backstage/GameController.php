<?php

namespace App\Http\Controllers\Backstage;

use App\Models\Game;
use App\Models\Prize;
use App\Models\Campaign;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backstage\Campaigns\UpdateRequest;

class GameController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backstage.games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backstage.games.filter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($campaign, $account, $reveal_at)
    {
        $game = Game::create([
                    'campaign_id' => $campaign,
                    'account' => $account,
                    'revealed_at' => $reveal_at,
                ]);
        return $game;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($game_id, $points)
    {
        //get active campaign
        $campaign = Campaign::inRandomOrder()->first();

        $game = Game::whereId($game_id)->first();
        $game->points = $points;
        $game->prize_id = Prize::where('campaign_id', $campaign->id)->inRandomOrder()->first()->id;
        $game =  $game->update($game->toArray());

        return $game;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Campaign $campaign)
    {
        //
    }

}
