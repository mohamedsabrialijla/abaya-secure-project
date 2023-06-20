<?php

namespace App\Listeners;

use App\Events\SendAdminGeneralNotification;
use App\Events\SendAdminNotification;
use App\Events\SendUserNotification;
use App\Http\Controllers\ControllersService;
use App\Models\AdminNotification;
use App\Models\Settings;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pusher\Pusher;

class SendAdminNotificationGeneralListener implements ShouldQueue
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
     * @param  SendAdminGeneralNotification  $event
     * @return void
     */
    public function handle(SendAdminGeneralNotification $event)
    {

        try{
            $pusher_auth_key=Settings::where('name','pusher_auth_key')->first();
            $pusher_secret=Settings::where('name','pusher_secret')->first();
            $pusher_app_id=Settings::where('name','pusher_app_id')->first();
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
            );
            $pusher = new Pusher(
                $pusher_auth_key->value,
                $pusher_secret->value,
                $pusher_app_id->value,
                $options
            );


            $data=[
                'title'=>$event->title,
                'body'=>$event->body,
                'url'=>$event->url,
            ];
            $pusher->trigger("Notifications", "ShowNotification", $data);
            $n=new AdminNotification();
            $n->text=$data['body']??'';
            $n->channel="Notifications";
            $n->event="ShowNotification";
            $n->not_data=$data;
            $n->save();
        }catch (\Exception $e){

        }
    }
}
