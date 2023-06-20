<?php
namespace App\Traits;


use League\CommonMark\Util\UrlEncoder;

trait Shipping
{


    public function shippingDemoLogin(){
        return "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vdGVzdGluZy54dHVyYm94LmNvbS9hcGkvdjEvY2xpZW50L2xvZ2luIiwiaWF0IjoxNjI4Nzc2MjgwLCJuYmYiOjE2Mjg3NzYyODAsImp0aSI6IjRTeXNYVXNiQ0tpOHFQOEkiLCJzdWIiOjQzOTUsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.lJNb9AtMw48V245vfvZB17YymTyrnYuYxN_9u-q1VI";
        // $fields=["email"=>"dev@gmail.com",
        //         "password"=>"123456"
        //     ];
        $data = json_encode($fields);
        $ch = curl_init('http://testing.xturbox.com/api/v1/client/login');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 500000);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500000);
        //execute post

        $response = curl_exec($ch);
        //close connection
        curl_close($ch);
        $result = (json_decode($response, true));
        if($result['success']){
            return $result['token'];
        }
        return false;
    }
    public function createNewShipment($ordreId, int $qty,int $weight,int $cashPrice, $deliveryCityId, $receiverName, int $receivermobile,string $receiverAddress,$receiverMap,$payment_type="PP"){
        $xturboxToken=$this->shippingDemoLogin();
        $fields = array(
            "pickupAddress"=> "الرياض ,حي الياسمين,شارع القلعة ,عمارةB ,مكتب 211,الدور الاول, رقم المبنى 6494 ",
            "senderPhone"=> $receiverName,
            "receiverName"=> $receiverName,
            "receiverPhone"=> $receivermobile,
            "deliverAddress"=> $receiverAddress,
            "packaging"=> 2,
            "fragile"=> 0,
            "weight"=> $weight,// max 15 kg
            "length"=>0,
            "width"=> 0,
            "height"=> 0,
            "comment"=> "",
            "clientRef"=> (string)$ordreId, // order number
            "quantity"=> $qty,
            "pickupCity"=> 3,
            "deliverCity"=> $deliveryCityId,
            "cod"=> $cashPrice,// price of product to be delivered
            "pickupMap"=> "24°48\'25.2'\''N 46°39'\'32.5'\''E'\''", // 24°48'25.2"N 46°39'32.5"E "41°2412.2'\''N 2°10'\''26.5'\''E'\''",
            "deliverMap"=>$receiverMap,
            "receiverPhone2"=> '',
            "note"=> "",
            "payment_type"=>$payment_type// pp  pre-paid or COD Cash on delivery
        );
        $curl = curl_init();
          $url="http://testing.xturbox.com/api/v1/client/createOrder"."?".http_build_query($fields);
         curl_setopt_array($curl, array(
            CURLOPT_URL =>$url ,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>300,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//             CURLOPT_POSTFIELDS=>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$xturboxToken
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }
    public function showSingleShipmentOrder($shipmentOrderId){
        $xturboxToken=$this->shippingDemoLogin();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://testing.xturbox.com/api/v1/client/viewOrder/'.$shipmentOrderId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$xturboxToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function shipmentsCityIdsUpdate(){

//        $xturboxToken=$this->shippingDemoLogin();
        $xturboxToken=$this->shippingLiveLogin();
        $curl = curl_init();
        $url="http://testing.xturbox.com/api/v1/client/cities";
        curl_setopt_array($curl, array(
            CURLOPT_URL =>$url ,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>300,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//             CURLOPT_POSTFIELDS=>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept-Language: en',
                'Authorization: Bearer '.$xturboxToken
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }





    public function viewOrder(){
        $xturboxToken=$this->shippingDemoLogin();

//        $data=urlencode($fields);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://testing.xturbox.com/api/v1/client/viewOrders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$xturboxToken
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

}
