<?php

namespace App\Listeners;

use App\Events\SendSMS;
use App\Traits\Sms;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMSListener implements ShouldQueue
{
    use Sms;
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
     * @param  SendSMS  $event
     * @return void
     */
    public function handle(SendSMS $event)
    {
         $mobile = $event->mobile;
         $message = $event->message;
         $this->sendSMS($message,$mobile);
//        \HELPER::send_sms($mobile, $message);
    }
}
