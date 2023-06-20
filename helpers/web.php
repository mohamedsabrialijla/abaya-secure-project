<?php

use App\Models\Customer;
use App\User;

function sendNotificationToCustomer($customer, $message)
{
//    if (\request()->getClientIp() != "127.0.180.1") {
    $customer->notify(new \App\Notifications\CustomerNotification($customer,$message));
    if($customer->fcm_token){
        sendFCM($customer->fcm_token,$message);
    }

}

function sendDBCustomerNotification($customer,$message){
    \Log::info('send FCM notification : --');
    $customer->notify(new \App\Notifications\CustomerNotification($customer,$message));
}
function sendDBAdminNotification($admin,$message){
    $admin->notify(new \App\Notifications\AdminNotification($message));
}

function sendFCM($token, $message)
{

    $fcm_server_key = "AAAAKdUgCZ4:APA91bHIYfvADD3_aAygEdDC_oj-lBGu-59EKVoOQwDX6O2698UOvtUzY_HEyJuHuKsQh03GrlRtesV7xMklGdC43Ca_RZHmAehwr50nF3CVHsKhIF4gJ2wD6jfdWvGIVAFpPBPoNO8X";
    $fcm_server_id = "179669305758";
    $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

    $user = Customer::where('fcm_token',$token)->first();
    if (isset($message['name']) && $message['name'] == 1 && $user) {
        if ($user->name) {
            $notification = [
                'title' => $message['title'] .' '. $user->name,
                'body' => getTranslatedNotificationMessage($message),
                "data" => $message,
                'icon' => 'myIcon',
                'sound' => 'mySound',
               // "click_action" => isset($message['web_url'])?$message['web_url']:isset($message['action'])?$message['action']:'',
                "click_action" => isset($message['web_url'])?$message['web_url']:'',
            ];
        } else {
            $notification = [
                'title' => $message['title'] . ' عزيزتي',
                'body' => getTranslatedNotificationMessage($message),
                "data" => $message,
                'icon' => 'myIcon',
                'sound' => 'mySound',
               // "click_action" => isset($message['web_url'])?$message['web_url']:isset($message['action'])?$message['action']:'',
                "click_action" => isset($message['web_url'])?$message['web_url']:'',
            ];
        }

    } else {
        $notification = [
            'title' => $message['title'],
            'body' => getTranslatedNotificationMessage($message),
            "data" => $message,
            'icon' => 'myIcon',
            'sound' => 'mySound',
           // "click_action" => isset($message['web_url'])?$message['web_url']:isset($message['action'])?$message['action']:'',
            "click_action" => isset($message['web_url'])?$message['web_url']:'',
        ];
    }

    $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];
    $fcmNotification = [
//            'registration_ids' => $this->tokens, //multple token array
        'to' => $token,
        'notification' => $notification,
        'data' => $extraNotificationData
    ];
    $fields = array(
//            'registration_ids' => $token,
        'priority' => 1,
        'notification' => array('title' => 'Abaya Square ', 'body' => $message, 'sound' => 'Default'),
    );
    $headers = array(
        'Authorization:key=' . $fcm_server_key,
        'sender:id=' . $fcm_server_id,
        'Content-Type:application/json'
    );
    // Open connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    // Execute post
    $result = curl_exec($ch);
    // Close connection
    curl_close($ch);
    return $result;
}

function getTranslatedNotificationMessage($data)
{
    $locale = app()->getLocale();
    $type = @$data['locale.text'];
    $text = '';
    switch ($type) {
        case 'notifications.new.order':
            $text = trans($type, [], $locale);
            break;

        default:
            $text = $data['msg'];
            break;
    }
    return $text;
}
