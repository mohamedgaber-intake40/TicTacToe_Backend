<?php

namespace App\Events;

use App\Http\Resources\MoveResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MovePlayed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $move;
    private $game_id;

    /**
     * Create a new event instance.
     *
     * @param $game_id
     * @param $move
     */
    public function __construct($game_id,$move)
    {
        $this->move = new MoveResource($move);
        $this->game_id = $game_id;
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
        return 'move.played';
    }
}
