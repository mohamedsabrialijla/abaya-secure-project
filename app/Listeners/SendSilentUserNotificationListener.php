<?php

namespace App\Listeners;

use App\Events\SendSilentUserNotification;
use App\Http\Controllers\ControllersService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSilentUserNotificationListener implements ShouldQueue
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
     * @param  SendSilentUserNotification  $event
     * @return void
     */
    public function handle(SendSilentUserNotification $event)
    {
        $customer = $event->customer ;
        $data = $event->data ;
        try{
            if($customer->fcm_token){
                \Log::info('send fcm notification : --');
                sendFCM($customer->fcm_token,$data);
            }
            sendDBCustomerNotification($customer,$data);
        }catch (\Exception $e){
            \Log::error('send notification error');
        }
    }
}
