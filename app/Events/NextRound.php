<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NextRound implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $workshop_key;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($workshop_key)
    {
        $this->workshop_key = $workshop_key;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      return ['workshop.'.$this->workshop_key];
    }
    public function broadcastAs()
    {
        return 'wait-next-round';
    }
}
