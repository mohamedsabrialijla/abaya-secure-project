<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    // 'payment_urway_api' => [
    //     'terminalId' => 'abayasq',
    //     'password' => 'abayasq@123',
    //     'merchant_key' => '8d6dd0336b3f603bd5a5e0e64714cb92483d3129f1c420f56b24438ba6512234',
    // ],
    // 'payment_urway_api' => [
    //     'terminalId' => 'abayasqr',
    //     'password' => 'abayasqr@URWAY_123',
    //     'merchant_key' => 'a2ec7e094975aabddf7486aef9fa1c1dd3ad3e43cb913dd24b1172580417002c',
    // ],

    
    'payment_urway_api' => [
        'terminalId' => 'abayasqrwb',
        'password' => 'ab_6787@URWAY',
        'merchant_key' => 'a2ec7e094975aabddf7486aef9fa1c1dd3ad3e43cb913dd24b1172580417002c',
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
