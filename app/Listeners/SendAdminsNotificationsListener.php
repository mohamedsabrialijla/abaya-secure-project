<?php

namespace App\Listeners;

use App\Events\SendAdminsNotifications;
use App\SystemAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminsNotificationsListener
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
     * @param  SendAdminsNotifications  $event
     * @return void
     */
    public function handle(SendAdminsNotifications $event)
    {
        $notifications=$event->notification;
        $admins= SystemAdmin::whereNotNull('fcm_token')->where('status',true)->get();
            foreach($admins as $admin){
                try{
                    sendFCM($admin->fcm_token,$notifications);
                    sendDBAdminNotification($admin,$notifications);
                }catch (\Exception $e){
                    \Log::error('send notification error');
                }
            }

    }
}
