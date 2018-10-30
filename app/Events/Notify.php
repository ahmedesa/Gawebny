<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notify
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $link;
    public $created_at;
    public $for_user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->message       = $data['message'];
        $this->link          = $data['link'];
        $this->created_at    = $data['created_at'];
        $this->for_user_id   = $data['for_user_id'];


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('send-message'.$this->for_user_id);
    }
}

