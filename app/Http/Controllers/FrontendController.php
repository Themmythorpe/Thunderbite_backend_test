<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Spin;
use App\Models\Symbol;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Backstage\GameController;

class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign)
    {
        // if( $campaign->starts_at > Carbon::now()){
        //     session()->flash('info', 'The game campaign has not started!');
        //     return redirect('/');
        // }
        // else if(Carbon::now() > $campaign->ends_at){
        //     session()->flash('info', 'The game campaign has ended!');
        //     return redirect('/');
        // }

        return view('frontend.index');
    }

    public function check_game_validity(Request $request)
    {
        $campaign = Campaign::find(session('activeCampaign'));
        if(!$campaign){
            return response()->json(['status' => false, 'message' => 'The game campaign is not Active!']);
        }
        if( $campaign->starts_at > Carbon::now()){
            return response()->json(['status' => false, 'message' => 'The game campaign has not started!']);
        }
        else if(Carbon::now() > $campaign->ends_at){
            return response()->json(['status' => false, 'message' => 'The game campaign has ended!']);
        }

         //Check if user has enough symbols
         $symbols = Symbol::with('user')->whereHas('user', function($q) use ($request){
            $q->where('name', $request->username );
        })->count();

        if($symbols < 6){
            return response()->json(['status' => false, 'message' => 'You have less than 6 symbols,create more symbols!']);
        }
        //Check if user has exceeded games for the campaign
        $game_count = Game::where('account',$request->username )->count();
        if($game_count >= $campaign->games_allowed){
            return response()->json(['status' => false, 'message' => 'You have exceeded number of games for this campaign!']);
        }
        //Check if user has game for that day
        $game = Game::where('account',$request->username )->whereDate('created_at', Carbon::today())->first();
        if(!$game){
            $games_controller = new GameController;
            $game = $games_controller->store($campaign->id, $request->username, $campaign->starts_at);
        }
        //get game spin count
        $spin_count = Spin::where('game_id',$game->id)->count();

        $data['game_id'] = $game->id;
        $data['points'] = $game->points;
        $data['games_allowed'] = $campaign->games_allowed;
        $data['games_frequency'] = $campaign->games_frequency;
        $data['spin_count'] = $spin_count;

        return response()->json(['status' => true, 'data' =>  $data]);

    }

    public function placeholder()
    {
        return view('frontend.placeholder');
    }

    public function spin(Request $request)
    {
        //get active campaign
        $campaign = Campaign::find(session('activeCampaign'));

        //check if user has not exceed spin frequency
        $spin_count = Spin::where('game_id', $request->game_id)->count();

        if( $spin_count >= $campaign->games_frequency){
            return response()->json(['status' => false, 'message' => 'You have exceeded maximum spins for the game!']);
        }

        //generate 5*3 spin array
        $spin_reel = generateSpinArray();

        //Check times of array matches of predefined paylines
        $matches = getReelMatches($spin_reel);

        //get game points from no of matches
        switch ($matches) {
            case 3:
                $points = $campaign->three_matches;
              break;
            case 4:
                $points = $campaign->four_matches;
              break;
            case 5:
                $points = $campaign->five_matches;
              break;
            default:
                $points = 0;
        }

        //get current game points
        $current_game_points = Game::whereId($request->game_id)->first()->points;
        $current_game_points = $current_game_points + $points;

        //save points to games table
        $games_controller = new GameController;
        $game_updated = $games_controller->update($request->game_id,  $current_game_points);

        //save generated spin array
        $spin = Spin::create([
            'game_id'=> $request->game_id,
            'spin_reel'=>  json_encode($spin_reel),
            'point'=>  $points,
        ]);

        $data['reel']= $spin_reel;
        $data['matches']= $matches;
        $data['spin_count']= $spin_count + 1;
        $data['points']= $current_game_points;

        return response()->json(['status' => true, 'data' => $data]);
    }
}
