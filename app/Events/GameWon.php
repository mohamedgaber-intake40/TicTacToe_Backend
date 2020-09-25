<?php

namespace App\Events;

use App\Http\Resources\UserResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class GameWon implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $game_id;
    public $winner;
    public $win_pos;

    /**
     * Create a new event instance.
     *
     * @param $game_id
     * @param array $win_pos
     */
    public function __construct($game_id, array $win_pos)
    {
        $this->game_id = $game_id;
        $this->winner = new UserResource(Auth::user());
        $this->win_pos = $win_pos;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel("game." . $this->game_id);
    }

    public function broadCastAs()
    {
        return 'game.won';
    }
}
