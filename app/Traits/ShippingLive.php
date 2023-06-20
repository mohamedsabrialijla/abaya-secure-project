<?php

namespace App\Traits;


use League\CommonMark\Util\UrlEncoder;

trait ShippingLive
{

    // public function shippingLiveLogin(){


    //     $fields=["email"=>"Yousef@abayasq.com",
    //         "password"=>"Abaya1"
    //     ];
    //     $data = json_encode($fields);
    //     $ch = curl_init('https://portal.xturbox.com/api/v1/client/login');
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //             'Content-Type: application/json',
    //             'Content-Length: ' . strlen($data))
    //     );
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 500000);
    //     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500000);
    //     //execute post

    //     $response = curl_exec($ch);
    //     //close connection
    //     curl_close($ch);
    //     $result = (json_decode($response, true));
    //     if($result['success']){
    //         return $result['token'];
    //     }
    //     return false;
    // }

    public function createSalasa($ordreId, int $qty, int $weight, int $cashPrice, int $total, $deliveryCity, $deliveryState, $receiverName, $receiverEmail, int $receivermobile, string $receiverAddress, $receiverMap, $payment_type = "paid")
    {
        // $xturboxToken=$this->shippingLiveLogin();
        $fields = [
            "orders" => [
                array(
                    "merchant_id" => "4357",
                    "merchant_key" => "TRV-975",
                    "customer_name" => $receiverName ?? "Empty",
                    "customer_telephone" => $receivermobile ?? "Empty",
                    "customer_email" => $receiverEmail ?? "Empty",
                    "pickup_location_alias" => "abaya-WH",
                    "shipping_country" => "SA",
                    "shipping_city" => $deliveryCity ?? "Riyadh",
                    "shipping_state" => $deliveryState ?? "Riyadh",
                    "shipping_address_1" => $receiverAddress,
                    "shipping_address_2" => "",
                    "shipping_address_3" => "",
                    "payment_type" => $payment_type,
                    "cod_amount" => $cashPrice,
                    "declared_value" => $total,
                    "currency" => "SAR",
                    "weight" => $weight,
                    "preferred_courier" => null,
                    "service_type" => "EXP",
                    "reference_number" => (string)$ordreId,
                    "description" => "1=>Z.27926.15720155045734007 ",
                    "shipping_zip" => "VA",
                    "numberOfBoxes" => $qty,
                    "reference_number_2" => "",
                    "pallet" => 0,
                    "width" => 0,
                    "length" => 0,
                    "height" => 0
                )

            ]


        ];
        $data = json_encode($fields);
        $curl = curl_init();
        // $url = "http://delivery.salasa.co/api/orders/createShipment" . "?" . http_build_query($fields);
        $url = "http://delivery.salasa.co/api/orders/createShipment";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'version: 1.1',
                // 'Authorization: Bearer '.$xturboxToken
                'Authorization: Bearer ' . '$2y$10$Id0zy742jF/ruXA0b9qDLulwcprNAZqVnJ7dSdTexsOoI/tnE9jkq'
            ),
        ));
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);
        if (isset($error_msg)) {
            \Log::error("" . $error_msg);
        }
        \Log::info("" . $response);
        // dd($response);

        return $response;
    }


    public function createNewShipment($ordreId, int $qty, int $weight, int $cashPrice, $deliveryCityId, $receiverName, int $receivermobile, string $receiverAddress, $receiverMap, $payment_type = "PP")
    {
        // $xturboxToken=$this->shippingLiveLogin();
        $fields = array(
            "pickupAddress" => "الرياض ,حي الياسمين,شارع القلعة ,عمارةB ,مكتب 211,الدور الاول, رقم المبنى 6494 ",
            "senderPhone" => $receiverName,
            "receiverName" => $receiverName ?? "Empty",
            "receiverPhone" => $receivermobile,
            "deliverAddress" => $receiverAddress,
            "packaging" => 1,
            "fragile" => 0,
            "weight" => $weight, // max 15 kg
            "length" => 0,
            "width" => 0,
            "height" => 0,
            "comment" => "",
            "clientRef" => (string)$ordreId, // order number
            "quantity" => $qty,
            "pickupCity" => 3,
            "deliverCity" => $deliveryCityId,
            //            "deliverCity"=> 3,
            "cod" => $cashPrice, // price of product to be delivered
            "pickupMap" => "24°48\'25.2'\''N 46°39'\'32.5'\''E'\''", // 24°48'25.2"N 46°39'32.5"E "41°2412.2'\''N 2°10'\''26.5'\''E'\''",
            "deliverMap" => $receiverMap,
            "receiverPhone2" => '',
            "note" => "",
            "payment_type" => $payment_type, // pp  pre-paid or COD Cash on delivery
        );
        $curl = curl_init();
        $url = "https://portal.xturbox.com/api/v1/client/createOrder" . "?" . http_build_query($fields);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            //             CURLOPT_POSTFIELDS=>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                // 'Authorization: Bearer '.$xturboxToken
                'Authorization: Bearer ' . 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3BvcnRhbC54dHVyYm94LmNvbS9hcGkvdjEvY2xpZW50L2xvZ2luIiwiaWF0IjoxNjU2OTkyNTI4LCJuYmYiOjE2NTY5OTI1MjgsImp0aSI6ImxmNDlWMGtiTlBSaDFOWEgiLCJzdWIiOjMwOTAsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.1MqWZjVKew3xTGB5-wERGmVQGgHQ_T97uw8YR9T13Dg'
            ),
        ));
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);
        if (isset($error_msg)) {
            \Log::error("" . $error_msg);
        }
        \Log::info("" . $response);
        return $response;
    }
    public function showSingleShipmentOrder($shipmentOrderId)
    {
        $xturboxToken = $this->shippingLiveLogin();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://portal.xturbox.com/api/v1/client/viewOrder/' . $shipmentOrderId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $xturboxToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function shipmentsCityIdsUpdate()
    {

        //        $xturboxToken=$this->shippingDemoLogin();
        $xturboxToken = $this->shippingLiveLogin();
        $curl = curl_init();
        $url = "https://portal.xturbox.com/api/v1/client/cities";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            //             CURLOPT_POSTFIELDS=>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept-Language: en',
                'Authorization: Bearer ' . $xturboxToken
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }





    public function viewOrder()
    {
        $xturboxToken = $this->shippingLiveLogin();

        //        $data=urlencode($fields);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://portal.xturbox.com/api/v1/client/viewOrders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $xturboxToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
