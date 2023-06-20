<?php

namespace App\Listeners;

use App\Events\SendUserNotification;
use App\Events\SendUsersNotification;
use App\Http\Controllers\ControllersService;
use App\Models\DeviceKey;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUsersNotificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     *
     */


    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendUsersNotification  $event
     * @return void
     */
    public function handle(SendUsersNotification $event)
    {
        $users = $event->users;
        $data = $event->data;

        //        $notification_key = $event->notification_key ;
        //        $is_saved = $event->is_saved ;
        //        $is_public = $event->is_public ;
        //        $image = $event->image ;


        if (isset($users) && $users && !empty($users) && count($users) > 0) {
            foreach ($users as $usr) {
                //                  sendFCM($usr->fcm_token,$data);
                event(new SendUserNotification($usr, $data, null));
            }
        } else {
            $users = DeviceKey::get();
            foreach ($users as $usr) {
                //                  sendFCM($usr->d_key,$data);
                event(new SendUserNotification(null, $data, $usr->d_key));
            }
        }
    }
}
