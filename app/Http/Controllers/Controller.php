<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {

    }

    function responseApiWithDataKey($status, $message, $statusCode, $items = null,$datakey='item')
    {
        $response = ['status' => $status, 'response_message' => $message];
        if ($status && isset($items)) {

            $response[$datakey] = $items;

        } else {

            $errors = [];
            if($items){
                foreach ($items as $key => $value) {
                    if($key == 'email')
                        $key = 'message';
                    $errors[$key] = is_array($value) ? implode(',', $value) : $value;
                    //implode is for when you have multiple errors for a same key
                    //like email should valid as well as unique
                }
            }

            $response['errors'] = $errors;
        }
        return response()->json($response, $statusCode);
    }
}
