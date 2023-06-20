<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendAdminGeneralNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $title;
    public $body;
    public $url;


    /**
     * Create a new event instance.
     *
     * @param $channel
     * @param $event
     * @param $OBdata
     */
    public function __construct($title,$body,$url)
    {
        $this->title = $title ;
        $this->body = $body ;
        $this->url = $url ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }
}
