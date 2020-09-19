<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Notifications\GameNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $second_player = User::find($request->second_player);
        $game = $user->games()->create([
            'second_player_id' => $second_player->id
        ]);
        $second_player->notify(new GameNotification($game));
        return response([
            'data'=>[
                'game'=>[
                    'id' => $game->id
                ]
            ]
        ],201);
    }
}
