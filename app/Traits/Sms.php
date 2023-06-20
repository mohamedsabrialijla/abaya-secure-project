<?php
namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

trait Sms{


    public function sendSMS($messageContent, $mobileNumber)
    {
        $user = "abayasquare";
        $password = "xXhqZWt15rIC3O0Lo2SQ";
        $sendername = "AbayaSquare";
        $text = urlencode( $messageContent);
        $to = $mobileNumber;
        $url="https://api.oursms.com/api-a/msgs?username=$user&token=$password&src=$sendername&dests=$to&body=$text&priority=0&delay=0&validity=0&maxParts=0&dlr=0&prevDups=0";

//            $response = Http::get($url);
//            \Log::info($response->body());
//            return $response->body();

        $client = new Client();
        $response = $client->get($url ,[
            'headers' => [
                "Content-Type" => "text/html; charset=utf-8",
                "Cache-Control" => "no-cache",
                "Accept" => "application/json",
            ]
        ]);

//            \Log::info( $response->getBody()->getContents());
        return  $response->getBody()->getContents();
    }



}
