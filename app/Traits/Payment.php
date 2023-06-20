<?php
namespace App\Traits;

use App\Constants\ApiResponseStatusCodes;
use App\Models\Order;
use App\Models\OrderStatusLog;
use App\Models\ProductSize;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

trait Payment
{

    public function generateApplePayUrl($trackIdd, $customerEmail, $amount, $currencyCode, $responseUrl,$customerIP=null,$mobile=null){

        $url='https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';
//        $data=$data;
        $timeout=5000;
        $terminalId = "abayasq";
        $password = "abayasq@123";
        $secret_key = "8d6dd0336b3f603bd5a5e0e64714cb92483d3129f1c420f56b24438ba6512234";
        $fields = array(
            "trackid" => (string)$trackIdd,
            "tranid" => "",
            "terminalId"  => (string)$terminalId,
            "password"  => $password,
            "customerEmail"  =>$customerEmail,
            "action" => "1",
            "tokenOperation"=>"A",// A Add , U Update D delete
            "tokenizationType" => "1",
            "merchantIp"  =>"127.0.0.1",
            "currency" => "SAR",
            "country" => "SA",
            "amount" => (string)$amount,
            "address"=>"",
            "city"=>"",
            "zipCode"=>"",
            "state"=>"",
            "customerIp"=>$customerIP,
            "phone_number"=>$mobile,

            "udf1" =>"Test",
            "udf2"  => $responseUrl,
            "udf3"=>"",
            "udf4"=>"",
            "udf5"=>"",

        );

        try {
        $data = json_encode($fields);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);


        }catch (\Exception $e){
            \Log::info('payment url request'.$e->getMessage());
        }

    }

    public function generateTransactionUrl($trackIdd, $customerEmail, $amount, $currencyCode, $responseUrl)
    {
        // $amount1= number_format($amount,2);
        // dd($amount,$amount1,(string)$amount);
        // $amount= number_format($amount,2);
        $trackId = $trackIdd;
        $terminalId = "abayasqr";
        $password = "abayasqr@URWAY_123";
        $secret_key = "a2ec7e094975aabddf7486aef9fa1c1dd3ad3e43cb913dd24b1172580417002c";
        $txn_details = $trackId.'|'.$terminalId.'|'.$password.'|'.$secret_key.'|'.$amount.'|'.$currencyCode;
        // $txn_details = $trackId.'|'.$terminalId.'|'.$password.'|'.$secret_key.'|2000|'.$currencyCode;
        $hash = hash('sha256', $txn_details);
        $fields = array(
            "trackid" => (string)$trackId,
            "terminalId"  => (string)$terminalId,
            "password"  => $password,
            "customerEmail"  =>$customerEmail,
            "action" => "1",
            "merchantIp"  =>"127.0.0.1",
            "currency" => "SAR",
            "country" => "SA",
            // "amount" => (string)2000,
            "amount" => (string)$amount,
            "address"=>"",
            "city"=>"",
            "zipCode"=>"",
            "state"=>"",
            "customerIp"=>"10.10.11.89",
            "requestHash" => $hash,
            "udf1" =>"Test",
            "udf2"  => $responseUrl,
            "udf3"=>"",
            "udf4"=>"",
            "udf5"=>""
        );
        try {
            $data = json_encode($fields);
            $ch = curl_init('https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest');
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

            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            $urldecode = (json_decode($result, true));
            return $urldecode;
        }catch (\Exception $e){
            \Log::info('payment url request'.$e->getMessage());
        }



    }
    public function successPayment(Request $request)
    {


        $PaymentID = $request->PaymentId;
        $pResult = $request->Result;
        $orderID = $request->OrderID;
        $postDate = $request->PostDate;
        $tranID = $request->TranId;
        $responseHash = $request->responseHash;
        $responseCode = $request->ResponseCode;
        $trackID = $request->TrackId;
        $auth = $request->Auth??null;
        $amount = $request->amount;
        $requestHash ="".$tranID."|8d6dd0336b3f603bd5a5e0e64714cb92483d3129f1c420f56b24438ba6512234|".$responseCode."|".$amount."";
        $hash=hash('sha256', $requestHash);
        $result_url = route('payment.fail');
        $result_params = "?PaymentID=" . $PaymentID.'&trackID='.$trackID ;
        if($trans=Transaction::where('id',$trackID)->first()) {

            $trans->payment_id = $PaymentID;
            $trans->payment_type =$request->CardBrand;
            $trans->result = $pResult;
            $trans->postdate = $postDate ?? date('Y-m-d');
            $trans->tranid = $tranID;
            $trans->auth = $auth;
            $trans->ref = $responseHash;
            $trans->responce_json = json_encode($request->all());
            $trans->status = $request->Result=="Successful"?1:0;
            $trans->save();
        }
        if($request->Result=="Successful"){
            $order=Order::find($trans->order_id);
            $order->update(['case_id'=>1,'is_paid'=>true]);
            if($order->use_wallet && ($order->payment_type_id!=4 && $order->payment_type_id!=1)){
                $customer=$order->customer;
                if($order->total>=$customer->wallet){
                    $customer->update(['wallet'=>0]);
                }
            }
            OrderStatusLog::create(['case_id'=>1,"order_id"=>$order->id]);
            if($order->payment_type_id !=1){
                foreach ($order->products as $product) {
                    $productSize=ProductSize::where('size_id',$product->size_id)->where('product_id',$product->product_id)->first();
                    if($productSize){
                        $productSize->stock()->create([
                            'type'=>'withdraw',
                            'order_id'=>$order->id,
                            'order_product_id'=>$product->product_id,
                            'qty'=>(int)$product->qty
                        ]);
                    }
                }
            }

//            return view('payment.success');
            return response('<h1 style="text-align: center;padding-top: 100px;color: #05b41a;">تم الدفع بنجاح</h1>', 200)
                ->header('Content-Type', 'text/plain');

        }else{

            return response('<h1 style="text-align: center;padding-top: 100px;color: #b41500;">فشلت عملية الدفع</h1>', 422)
                ->header('Content-Type', 'text/plain');

        }
    }


    public function applePaySuccessPayment(Request $request)
    {


        $PaymentID = $request->PaymentId;
        $pResult = $request->Result;
        $orderID = $request->OrderID;
        $postDate = $request->PostDate;
        $tranID = $request->TranId;
        $responseHash = $request->responseHash;
        $responseCode = $request->ResponseCode;
        $trackID = $request->TrackId;
        $auth = $request->Auth??null;
        $amount = $request->amount;
        $requestHash ="".$tranID."|8d6dd0336b3f603bd5a5e0e64714cb92483d3129f1c420f56b24438ba6512234|".$responseCode."|".$amount."";

        if($trans=Transaction::where('id',$trackID)->first()) {

            $trans->payment_id = $PaymentID;
            $trans->payment_type =$request->CardBrand;
            $trans->result = $pResult;
            $trans->postdate = $postDate ?? date('Y-m-d');
            $trans->tranid = $tranID;
            $trans->auth = $auth;
            $trans->ref = $responseHash;
            $trans->responce_json = json_encode($request->all());
            $trans->status = $request->Result=="Successful"?1:0;
            $trans->save();
        }
        if($request->Result=="Successful"){
            $order=Order::find($trans->order_id);
            $order->update(['case_id'=>1,'is_paid'=>true]);
            if($order->use_wallet && ($order->payment_type_id!=4 && $order->payment_type_id!=1)){
                $customer=$order->customer;
                if($order->total>=$customer->wallet){
                    $customer->update(['wallet'=>0]);
                }
            }
            OrderStatusLog::create(['case_id'=>1,"order_id"=>$order->id]);
            if($order->payment_type_id !=1){
                foreach ($order->products as $product) {
                    $productSize=ProductSize::where('size_id',$product->size_id)->where('product_id',$product->product_id)->first();
                    if($productSize){
                        $productSize->stock()->create([
                            'type'=>'withdraw',
                            'order_id'=>$order->id,
                            'order_product_id'=>$product->product_id,
                            'qty'=>(int)$product->qty
                        ]);
                    }
                }
            }

//            return view('payment.success');
            return response('<h1 style="text-align: center;padding-top: 100px;color: #05b41a;">تم الدفع بنجاح</h1>', 200)
                ->header('Content-Type', 'text/plain');

        }else{

            return response('<h1 style="text-align: center;padding-top: 100px;color: #b41500;">فشلت عملية الدفع</h1>', 422)
                ->header('Content-Type', 'text/plain');

        }
    }



}
