<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

//fjkgnkdfjgjkdfkg
// update these with the real location of your two .pem files. keep them above/outside your webroot folder
// define('PRODUCTION_CERTIFICATE_KEY', asset('apple_pay/apple-pay-cert.pem'));
// define('PRODUCTION_CERTIFICATE_PATH', asset('apple_pay/aps-5.cer'));


define('PRODUCTION_CERTIFICATE_KEY', asset('apple_pay/ApplePay.key.pem'));
define('PRODUCTION_CERTIFICATE_PATH', asset('apple_pay/ApplePay.crt.pem'));

// This is the password you were asked to create in terminal when you extracted ApplePay.key.pem
define('PRODUCTION_CERTIFICATE_KEY_PASS', '123456');

// define('PRODUCTION_MERCHANTIDENTIFIER', openssl_x509_parse( file_get_contents( PRODUCTION_CERTIFICATE_PATH ))['subject']['UID'] ); //if you have a recent version of PHP, you can leave this line as-is. http://uk.php.net/openssl_x509_parse will parse your certificate and retrieve the relevant line of text from it e.g. merchant.com.name, merchant.com.mydomain or merchant.com.mydomain.shop
// if the above line isn't working for you for some reason, comment it out and uncomment the next line instead, entering in your merchant identifier you created in your apple developer account
define('PRODUCTION_MERCHANTIDENTIFIER', 'merchant.com.abaya.sequare');
define('PRODUCTION_DOMAINNAME', env('app_url')); //you can leave this line as-is too, it will take the domain from the server you run it on e.g. shop.mydomain.com or mydomain.com
// if the line above isn't working for you, replace it with the one below, updating it for your own domain name


define('PRODUCTION_CURRENCYCODE', 'SAR');    // https://en.wikipedia.org/wiki/ISO_4217
define('PRODUCTION_COUNTRYCODE', 'SA');        // https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
define('PRODUCTION_DISPLAYNAME', 'Abaya Square');

class ApplePaymentController extends Controller

{
    public function startPayment(Request $request, $transaction)
    {
        

        
        $out = Transaction::find($transaction);
        // return $out;
        $PRODUCTION_MERCHANTIDENTIFIER = PRODUCTION_MERCHANTIDENTIFIER;
        $PRODUCTION_CURRENCYCODE = PRODUCTION_CURRENCYCODE;
        $PRODUCTION_COUNTRYCODE = PRODUCTION_COUNTRYCODE;
        $PRODUCTION_DISPLAYNAME = PRODUCTION_DISPLAYNAME;
        // dd($PRODUCTION_MERCHANTIDENTIFIER,$PRODUCTION_CURRENCYCODE,$PRODUCTION_COUNTRYCODE,$PRODUCTION_DISPLAYNAME);
        if (!$out) {
            return view('apple_payment.fail', ['message_ar' => 'الطلب غير موجود', 'message_en' => 'order not found']);
        }
        return view('apple_payment.index', compact('out', 'PRODUCTION_MERCHANTIDENTIFIER', 'PRODUCTION_CURRENCYCODE', 'PRODUCTION_COUNTRYCODE', 'PRODUCTION_DISPLAYNAME'));
    }

    public function validateMarchent(Request $request)
    {
  
        $validation_url = $request->u;
        if ("https" == parse_url($validation_url, PHP_URL_SCHEME) && substr(parse_url($validation_url, PHP_URL_HOST), -10)  == ".apple.com") {



            // create a new cURL resource
            $ch = curl_init();

            //           $data =  [
            //                'url'=> 'https://apple-pay-gateway-cert.apple.com/paymentservices/startSession/paymentSession',
            //                                    'cert'=> public_path('uploads/apple_pay/'.'ApplePay1.crt.pem'),
            //                                    'key'=> public_path('uploads/apple_pay/'.'alreemCertificates.pem'),
            //                                    'method'=> 'post',
            //                                    'body'=>[
            //                                         'merchantIdentifier'=> "merchant.com.selsela.alreem",
            //                                        'displayName'=> "Alreem",
            //                                        'initiative'=> "web",
            //                                        'domainName'=> "alreemboutique.com",
            //                                        'initiativeContext'=> "alreemboutique.com"
            //                                    ],
            //                                    'json'=> true,
            //                                ];
            $data = '{"merchantIdentifier":"' . PRODUCTION_MERCHANTIDENTIFIER . '", "domainName":"' . PRODUCTION_DOMAINNAME . '", "displayName":"' . PRODUCTION_DISPLAYNAME . '","initiative":"web","initiativeContext":"' . PRODUCTION_DOMAINNAME . '"}';

            curl_setopt($ch, CURLOPT_URL, $validation_url);
            curl_setopt($ch, CURLOPT_SSLCERT, PRODUCTION_CERTIFICATE_PATH);
            curl_setopt($ch, CURLOPT_SSLKEY, PRODUCTION_CERTIFICATE_KEY);
            curl_setopt($ch, CURLOPT_SSLKEYPASSWD, PRODUCTION_CERTIFICATE_KEY_PASS);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Access-Control-Allow-Origin: *',
            ));
            //curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
            //curl_setopt($ch, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
            //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'rsa_aes_128_gcm_sha_256,ecdhe_rsa_aes_128_gcm_sha_256');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $server_output = curl_exec($ch);
            if ($server_output === false) {
                echo '{"curlError":"' . curl_error($ch) . '"}';
            }

            // close cURL resource, and free up system resources
            curl_close($ch);
        }
        return $server_output;
    }

    public function index(Request $request)
    {
        
        return 'dfd';
        
        $configs = [

            //'terminalId' => 'testterm',
            'terminalId' => config('services.payment_urway_api.terminalId'),
            'password' => config('services.payment_urway_api.password'),
            'key' => config('services.payment_urway_api.merchant_key'),
            'url' => 'https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest',
            'currency' => 'SAR',
            'timeout' => '300',

        ];
        $arr = include('./helpers/responsecode.php');
        $terminalId = $configs['terminalId'];
        $password = $configs['password'];
        $key = $configs['key'];
        $timeout = $configs['timeout'];
        $url = $configs['url'];
        $currency = $configs['currency'];
        // $mount = round($request->amount);
        $mount = "200";
        $txn_details = "" . $request->trackid . "|" . $terminalId . "|" . $password . "|a2ec7e094975aabddf7486aef9fa1c1dd3ad3e43cb913dd24b1172580417002c|" . $mount . "|" . $currency . "";
        $hash = hash('sha256', $txn_details);

        $host = gethostname();
        $ip = gethostbyname($host);
        $transaction = Transaction::where('transaction_id', $request->trackid)->first();
        $order = $transaction->order;
        $address = $order->address;
        $user = \App\User::find($transaction->user_id);
        $email = 'info@abayasquare.com';
        if ($user && filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $email =  $user->email;
        }
        $fields = array(
            'trackid' => $request->trackid,
            'terminalId' => "abayasqrwb",
            'customerEmail' => $email ?? 'info@abayasquare.com',
            'customerName' => $user->name ?? 'Abaya',
            'cardHolderName' => $user->name ?? 'Abaya',
            'action' => "1",
            'instrumentType' => "DEFAULT",
            'merchantIp' => $ip,
            'password' => "ab_6787@URWAY",
            'currency' => $currency,
            'country' => "SA",
            'amount' => $mount,
            'udf2' => route('order.success.payment'),
            'udf3' => "",
            'udf1' => "",
            'udf5' => $request->udf5 ? $request->udf5 : "",
            'udf4' => "ApplePay",
            'ApplePayId' => "merchant.com.abaya.sequare",
            'requestHash' => $hash
        );
        $data = json_encode($fields);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        dd($data,$result);
        if ($result != NULL) {

            $urldecode = (json_decode($result, true));

            if (isset($urldecode['payid'])) {

                if (strpos($urldecode['targetUrl'], '?') !== false) {
                    $url = $urldecode['targetUrl'] . "paymentid=" . $urldecode['payid'];
                } else {
                    $url = $urldecode['targetUrl'] . "?paymentid=" . $urldecode['payid'];
                }
                echo '
                                    <html>

                                     <form name="myform" method="POST" action="' . $url . '">
                                    <h1> Transaction is processing........</h1>

                                    </form>
                                    <script type="text/javascript">document.myform.submit();</script>
                                    </html>';
            } else {
                if (isset($urldecode['result'])) {

                    $trackID = $urldecode['trackId'];
                    if ($trans = Transaction::where('transaction_id', $trackID)->first()) {

                        $trans->payment_id = $urldecode['PaymentId'];
                        $trans->result = $urldecode['result'];
                        $trans->postdate = $postDate ?? date('Y-m-d');
                        $trans->trackid = $trackID;
                        $trans->responce_json = json_encode($request->all());
                        $trans->status = 1;
                        $trans->save();
                        if ($urldecode['result'] == "Successful") {
                            if ($trans->type == 'AddToBalance') {
                                if ($order = UserBalanceAdd::where('transaction_id', $trans->id)->first()) {
                                    $user_balance = new UserBalance();
                                    $user_balance->user_id = $order->user_id;
                                    $user_balance->order_id = 0;
                                    $user_balance->amount = $order->amount;
                                    $user_balance->type_id = 2;
                                    $user_balance->transaction_id = $trans->id;
                                    $user_balance->save();
                                    $user = \App\User::find($order->user_id);
                                    $order->status = 1;
                                    $order->save();
                                    event(new SendUserNotification($order->user_id,  'AddToBalance',  ['new_balance' => $user->balance, 'amount' => $order->amount], 1));
                                }
                            } elseif ($trans->type == 'PayToOrder') {
                                if ($trans->order) {
                                    $order = $trans->order;

                                    $trans->status = 1;
                                    $trans->save();
                                    $order->is_paid = 1;
                                    $order->case_id = 1;
                                    $order->save();

                                    //                                    $oc=new OrderCase();
                                    //                                    $oc->case_id=$order->case_id;
                                    //                                    $oc->order_id=$order->id;
                                    //                                    $oc->text_ar='تم دفع تكلفة الطلب';
                                    //                                    $oc->text_en='Order was paid';
                                    //                                    $oc->save();
                                    event(new SendAdminNotification('alreem_orders', 'add_order', ['order_id' => $order->id, "order_status" => $order->case_id, 'text' => 'تم اضافة طلب جديد']));
                                }
                            }
                            $result_url = route('payment.success.done');
                        } else {
                            if ($trans->type == 'PayToOrder') {
                                if ($trans->order) {
                                    $order = Order::find($trans->order->id);
                                    $order->products()->delete();
                                    $order->delete();
                                    $trans->delete();
                                }
                            }
                            $result_url = route('payment.fail');
                        }
                    }
                    //        echo "REDIRECT=".$result_url.$result_params;
                    // echo "REDIRECT=".$result_url;
                    header("location:" . $result_url);


                    return;
                }
            }
        } else {
            return view('apple_payment.fail', ['message_ar' => 'فشل الدفع', 'message_en' => 'payment failed']);
        }
    }

    public function successdone()
    {
        echo '<h1 style="text-align: center;padding-top: 100px;color: #05b41a;">تم الدفع بنجاح</h1>';
    }
    public function fail(Request $request)
    {


        echo '<h1 style="text-align: center;padding-top: 100px;color: #b41500;">فشلت عملية الدفع</h1>';
    }
}
