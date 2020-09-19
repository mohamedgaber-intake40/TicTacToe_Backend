<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable =[
      'first_player_id' ,'second_player_id' , 'winner_id'
    ];

    public function firstPlayer()
    {
        return $this->belongsTo(User::class,'first_player_id');
    }

    public function secondPlayer()
    {
        return $this->belongsTo(User::class,'second_player_id');
    }

    public function winner()
    {
        return $this->belongsTo(User::class,'winner_id');
    }

    public function moves()
    {
        return $this->hasMany(Move::class);
    }

}
