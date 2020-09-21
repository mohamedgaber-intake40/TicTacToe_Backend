<?php

namespace App\Http\Controllers\Api;

use App\Events\GameDrawn;
use App\Events\GameWon;
use App\Events\MovePlayed;
use App\Handlers\GameHandler;
use App\Handlers\Test;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoveController extends Controller
{
    public function store(Request $request,Game $game)
    {
        //check if move available
        //store the move
        //check for win
        $user = Auth::user();
        $handler = GameHandler::handle($game);
        if(!$handler->playMove($request->pos_x , $request->pos_y,$request->symbol))
        {
            return response(['message'=>'invalid move'],422);
        }
        $move = $game->moves()->create($request->only('pos_x','pos_y','symbol'));

        event(new MovePlayed($game->id,$move));

        if($handler->checkForWin())
        {
            $game->update([ 'winner_id' => $user->id ]);
            event(new GameWon($game->id ));
        }
        else if($handler->checkForDraw())
        {
            event( new GameDrawn($game->id));
        }
        return response([],201);

    }
}
