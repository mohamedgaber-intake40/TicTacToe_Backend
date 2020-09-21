<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameDrawn implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $game_id;

    /**
     * Create a new event instance.
     *
     * @param $game_id
     */
    public function __construct($game_id)
    {
        //
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
        return 'game.drawn';
    }
}
