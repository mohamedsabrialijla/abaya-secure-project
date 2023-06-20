<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendUserNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $data;
    public $fcm_token;
//    public $notification_key;
//    public $is_saved;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$data,$fcm_token)
    {
        $this->user = $user ;
        $this->data = $data ;
        $this->fcm_token = $fcm_token ;
//        $this->notification_key = $notification_key ;
//        $this->is_saved = $is_saved ;
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
