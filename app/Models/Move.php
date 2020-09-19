<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $fillable = [
      'pos_x' ,'pos_y','symbol','game_id'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
