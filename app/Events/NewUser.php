<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;

class NewUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $fullname;
    public $workshop_key;
    public $email;
    public $photo_link;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $fullname, $photolink, $email, $workshop_key)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->workshop_key = $workshop_key;
        $this->photo_link=url('images/'.$photolink);
        $this->email=$email;
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
        return 'new-user';
    }

}
