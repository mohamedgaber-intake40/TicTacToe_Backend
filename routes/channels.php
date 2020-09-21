<?php

use Illuminate\Support\Facades\Broadcast;
use \App\Models\Game;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{id}',function ($user,$id){
    return (int) $user->id === (int) $id;
});

Broadcast::channel('online-channel',function($user){
    return $user;
});

Broadcast::channel('game.{id}',function ($user,$id){
   $game = Game::find($id);
//   $game->loadMissing('firstPlayer','secondPlayer');
//   dd($game);
   if(in_array($user->id,[ $game->first_player_id  ,$game->second_player_id ]))
   {
       return $user;
   }
   return false;
});
