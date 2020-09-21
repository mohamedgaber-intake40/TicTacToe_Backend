<?php

namespace App\Http\Controllers\Api;

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
        if($handler->checkMoveAvailable($request->pos_x , $request->pos_y,$request->symbol))
        {
            $game->moves()->create($request->only('pos_x','pos_y','symbol'));
            if($handler->checkForWin())
            {
                $game->update([ 'winner_id' => $user->id ]);
                return response([
                    'winner' => new UserResource($user)
                ],201);
            }
            return response([],201);
        }
        return response(['message'=>'invalid move'],422);

    }
}
