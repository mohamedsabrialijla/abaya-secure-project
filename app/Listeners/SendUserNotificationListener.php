<?php

namespace App\Listeners;

use App\Events\SendUserNotification;
use App\Http\Controllers\ControllersService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\Types\Nullable;

class SendUserNotificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendUserNotification  $event
     * @return void
     */
    public function handle(SendUserNotification $event)
    {
        $user = $event->user ;
        $data = $event->data ;
        $fcm_token = $event->fcm_token ;

        if($user){
        sendFCM($user->fcm_token,$data);
        $user->notify(new \App\Notifications\CustomerNotification($user,$data));
        }elseif($fcm_token){
            sendFCM($fcm_token,$data);
        }
//        ControllersService::NotificationToUser($user_id,$notification_key,$data,$is_saved);
    }
}
