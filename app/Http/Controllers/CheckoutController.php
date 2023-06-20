<?php

namespace App\Http\Controllers;

use App\Constants\ApiResponseStatusCodes;
use App\Events\SendAdminsNotifications;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Gov;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatusLog;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Trace;
use App\Models\Settings;
use App\Models\Transaction;
use App\Traits\Payment;
use Auth;
use DB;
use Illuminate\Http\Request;
use Tamara\Configuration;
use Tamara\Client;
use Tamara\Model\Order\Order as tamaraorder;
use Tamara\Model\Money;
use Tamara\Model\Order\Address;
use Tamara\Model\Order\Consumer;
use Tamara\Model\Order\MerchantUrl;
use Tamara\Model\Order\OrderItemCollection;
use Tamara\Model\Order\OrderItem;
use Tamara\Model\Order\Discount;
use Tamara\Request\Checkout\CreateCheckoutRequest;
use Validator;
use Session;


class CheckoutController extends Controller
{
    use Payment;
    public function checkout()
    {
        if (Auth::guard('user')->check()) {
            $govs = Gov::with('cities')->get();
            $customer = Customer::find(Auth::guard('user')->user()->id);
            $addresses = $customer->addresses;
            $cartItems = \Cart::getContent();
            $cod = 0;
            foreach ($cartItems as $product) {
                $p = Product::find((int)$product->attributes->product_id);
                $cod = $cod + $p->cod;
            }
            $firstaddress = $customer->addresses->first();

            if(!is_null($firstaddress)){
                $setting = new Settings();
                if($firstaddress->is_internal == 1){
                    $shipvalue=(int)$setting->valueOf("internal_shipping_cost", 0);
                    session()->put('ship', $shipvalue);
                }else{
                    $shipvalue=(int)$setting->valueOf("external_shipping_cost", 0);
                    session()->put('ship', $shipvalue);
                }

            }
            
            

            $cartItems = \Cart::getContent();
            $products_ides = [];
            $quentites=[];
            foreach($cartItems as $k){
                array_push($products_ides,$k->attributes->product_id );
                array_push($quentites,$k->quantity );
            }
            $products = Product::with('category','store')->whereIn('id',$products_ides)->get();
            //asfesfsfsdfsdgsdgsd
                // dd(session()->get('ship'),$firstaddress);
                return view('web.payment', compact('govs', 'customer', 'addresses', 'cartItems', 'cod','products','quentites'));
        } else {
            return redirect()->route('login')->with('info', __('site.login_msg'));
        }
    }

    public function payment(Request $request)
    {
        // return $request->all();
        ///ksrgjerjgoergioerh
        
        
        
        $customer =  Auth::guard('user')->user();
        $customer_id = $customer->id;
        
        $trace = New Trace();
        $trace->user_id = $customer->id;
        $trace->mobile = $customer->mobile;
        $trace->name = $customer->name;
        $trace->payment_method = $request->paymentMethod;
        $trace->save();

        $validator = Validator::make($request->all(), [
            "promo_code" => 'nullable',
            "discount_amount" => 'nullable',
            'address_id' => 'required|exists:customer_addresses,id',
            'paymentMethod' => 'required|exists:payment_types,id',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $cart = \Cart::getContent();
        
        
        session::put('pp',1);
        
        // return $cart;

        foreach ($cart as $product) {
            
            $productsize = ProductSize::with('stock')->where('product_id', $product->attributes->product_id)->where('size_id', $product->attributes->size_id)->first();
            // return $productsize->;
            if ($productsize->qty() < $product->quantity) {
                return back()->with('toast_error', __('api_texts.qty_exceeded', ['product' => @$productsize->product->name]));
                break;
            }
        }
        if ($request->filled('promo_code')) {
            $reference_customer  = Customer::where('promo_code', $request->promo_code)->where('status', 1)->first();
            if (!$reference_customer) {
                return back()->with('toast_error', __('api_texts.not_exist_promo_coded'));
            }
        }

        try {
            DB::beginTransaction();
            $InvoiceSerial = null;
            $last_invoice = Order::latest()->pluck('invoice_number')->first();

            if ($last_invoice) {
                $InvoiceSerial = $last_invoice + 1;
                $InvoiceSerial = sprintf("%000000009d", $InvoiceSerial);
            } else {
                $InvoiceSerial = 000001;
                $InvoiceSerial = sprintf("%000000009d", $InvoiceSerial);
            }
            $totalPrice1 = 0;
            $totalPrice2 = 0;
            $totalDiscount = 0;
            $promo_code = null;
            $referral_customer_id = null;
            $discount_ratio = null;
            $orderProducts = [];
            $products = $cart;
            $order = Order::create(['invoice_number' => $InvoiceSerial,'order_from' => 'web']);


            $setting = new Settings();
            $address = CustomerAddress::find($request->address_id);
            $tax = $setting->valueOf('tax', 0) ? $setting->valueOf('tax', 0) : 0;
            $tax_value = ($totalPrice2 * ($tax / 100));
            $delivery_cost = 0;
            if ($address) {
                $delivery_cost = $address->is_internal == 1 ? (int)$setting->valueOf("internal_shipping_cost", 0) : (int)$setting->valueOf('external_shipping_cost', 0);
            }

            foreach ($products as $product) {
                $p = Product::find((int)$product->attributes->product_id);
                $total = $total_before_discount = round(($p->sale_price * ((int)$product->quantity)), 2);
                $totalPrice1 += $total;
                $coupon = null;
                $discountRatio = null;
                $discount = null;
                if (count($product->conditions) > 0) {
                    $coupon = Coupon::find((int)$product->conditions[0]->getAttributes()['coupon_id']);
                    if ($coupon) {
                        if ($coupon->flag == 1) {
                            $discountRatio = $coupon->discount_ratio;
                            $discount = round($total * ($discountRatio / 100), 2);
                            $total = round(($total - $discount), 2);
                        } elseif ($coupon->flag == 2) {
                            $discount = $coupon->discount_ratio;
                            $total = round(($total - $discount), 2);
                        } elseif ($coupon->flag == 3) {
                            $delivery_cost = 0;
                        }
                    }
                }
                $orderProducts[] = [
                    'product_id' => (int)$p['id'],
                    'store_id' => (int)$p['store_id'],
                    'coupon_id' => @$coupon->id,
                    'qty' => (int)$product->quantity,
                    'size_id' => (int) $product->attributes->size_id,
                    'price' => $p->sale_price,
                    'discount_ratio' => $discountRatio,
                    'discount' => $discount,
                    'total' => $total,
                    'order_id' => $order->id,
                    'total_before_discount' => $total_before_discount,

                ];
                $totalPrice2 += $total;
                $totalDiscount += $discount;
            }

            $customer =  Auth::guard('user')->user();
            $customer_id = $customer->id;

            $total = round(($totalPrice2 * (1 + ($tax / 100))) + $delivery_cost, 2);

            $appCommissionRatio = (float) $setting->valueOf('app_commission_ratio', 0);
            if ($request->filled('promo_code') && $request->promo_code) {
                $reference_customer  = Customer::where('promo_code', $request->promo_code)->where('status', 1)->first();
                if ($reference_customer) {
                    $disCountRatio = $discount_ratio = $setting->valueOf('promo_code_discount_ratio', 0);
                    $appCommission = round(($totalPrice2 * ($appCommissionRatio / 100)), 2);
                    $totalDiscount = round(($totalPrice2 * ($disCountRatio / 100)), 2);
                    $appCommission -= $totalDiscount;
                    $total -= $totalDiscount;
                    $promo_code = $request->promo_code;
                    $referral_customer_id = $reference_customer->id;
                    // add points to customer
                    $referralRegisterPoints = (int)$setting->valueOf('referral_register_points', 0);
                    $reference_customer->points += $referralRegisterPoints;
                    $reference_customer->save();

                    $message = [
                        'title' => "رصيد نقاط",
                        'msg' => 'تم اضافة نقاط جديدة لحسابك بواسطة تسجيل جديد'
                    ];
                    sendNotificationToCustomer($reference_customer, $message);
                }
            } else {
                $appCommission = round(($totalPrice2 * ($appCommissionRatio / 100)), 2);
            }

            $wallet_amount = 0;
            $amount_to_pay = 0;
            if ($request->paymentMethod == 1) {
                $amount_to_pay = $total;
            }
            if ($request->use_wallet) {
                if ($customer->wallet >= $total) {
                    $wallet_amount = $total;
                    $customer_wallet = round(($customer->wallet - $total), 2);
                    $customer->update(['wallet' => $customer_wallet]);
                }

                if ($customer->wallet < $total) {
                    $wallet_amount = $customer->wallet;
                    $amount_to_pay = round(($total - $wallet_amount), 2);
                    $customer_wallet = 0;
                    $customer->update(['wallet' => $customer_wallet]);
                }
            }

            $order->update([
                "promo_code" => $promo_code,
                "discount_ratio" => $discount_ratio,
                "referral_customer_id" => $referral_customer_id,
                "address_id" => $request->address_id,
                "customer_id" => $customer_id,
                "sub_total_1" => $totalPrice1,
                "discount" => $totalDiscount,
                // "discount" => $request->discount_amount,
                // "sub_total_2" => $totalPrice2 -$request->discount_amount,
                "sub_total_2" => $totalPrice2,
                "tax_ratio" => $tax,
                "tax" => round($tax_value, 2),
                "delivery_cost" => $delivery_cost,
                "total" => $total,
                "case_id" => 1,
                "cod_amount" => $amount_to_pay,
                "payment_type_id" => $request->paymentMethod,
                "use_wallet" => $request->use_wallet ?? 0,
                "wallet_amount" => $wallet_amount,
                "transaction_id" => $request->transaction_id ?? 0,
                "app_commission_ratio" => $appCommissionRatio,
                "app_commission" => $appCommission,
                "order_from" => 'web',

            ]);
            OrderProduct::insert($orderProducts);
            $orderStatusLog = OrderStatusLog::create(['case_id' => 1, "order_id" => $order->id]);

            DB::commit();

            // if ($request->paymentMethod == 1) {
            //     foreach ($cart as $product) {
            //         $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
            //         if ($productSize) {
            //             $productSize->stock()->create([
            //                 'type' => 'withdraw',
            //                 'order_id' => $order->id,
            //                 //                            'order_product_id'=>$product['product_id'],
            //                 'qty' => (int)$product->quantity
            //             ]);
            //         }
            //     }
            // }

            $paymentUrl = null;
            $trasactionID = null;
            if ($request->paymentMethod != 1 && $request->paymentMethod != 4 && $request->paymentMethod != 5  && $request->paymentMethod != 6) {
                $order->update(["case_id" => 9]);
                $orderStatusLog->update(["case_id" => 9]);

                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $transaction = Transaction::create(['order_id' => $order->id, 'amount' => $totalForOnlinePayment, 'user_id' => $customer_id]);
                $transactionUrl = $this->generateTransactionUrl($transaction->id, "info@selsela.net", $totalForOnlinePayment, 'SAR', route('order.success.payment'));

                if ($transactionUrl) {
                    $paymentUrl = $transactionUrl['targetUrl'] . "?paymentid=" . $transactionUrl['payid'];
                }
            }
            if ($request->paymentMethod == 5) {

                $order->update(['case_id' => 9, 'is_paid' => false]);
                if ($order->use_wallet && ($order->paymentMethod != 4 && $order->paymentMethod != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                // foreach ($cart as $product) {
                //     $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                //     if ($productSize) {
                //         $productSize->stock()->create([
                //             'type' => 'withdraw',
                //             'order_id' => $order->id,
                //             //                            'order_product_id'=>$product['product_id'],
                //             'qty' => (int)$product->quantity
                //         ]);
                //     }
                // }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trasactionID  =  time() . rand(100000, 999999);
                $trans = new Transaction();
                $trans->order_id =   $order->id;
                $trans->amount = $totalForOnlinePayment;
                $trans->user_id = $customer_id;
                $trans->payment_id =   $trasactionID;
                $trans->payment_type = 5;
                $trans->result = 'FROMWEB';
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;
                $trans->status = 0;
                $trans->save();
            }

            if ($request->paymentMethod == 6) {

                $order->update(['case_id' => 9, 'is_paid' => false]);
                if ($order->use_wallet && ($order->paymentMethod != 4 && $order->paymentMethod != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                // foreach ($cart as $product) {
                //     $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                //     if ($productSize) {
                //         $productSize->stock()->create([
                //             'type' => 'withdraw',
                //             'order_id' => $order->id,
                //             //                            'order_product_id'=>$product['product_id'],
                //             'qty' => (int)$product->quantity
                //         ]);
                //     }
                // }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trasactionID  =  time() . rand(100000, 999999);

                $trans = new Transaction();
                $trans->order_id =   $order->id;
                $trans->amount = $totalForOnlinePayment;
                $trans->user_id = $customer_id;
                $trans->payment_id =   $trasactionID;
                $trans->payment_type = 6;
                $trans->result = 'FROMWEB';
                $trans->ref = $request->ref;
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;
                $trans->status = 0;
                $trans->save();

                // $trans=Transaction::create(['order_id'=>$order->id,'amount'=>$totalForOnlinePayment,'user_id'=>$customer_id,'payment_id'=>$trasactionID]);
                //    $trans->save();
                /*
                $trans->payment_id = $request->apple_pay_refernce;
                $trans->payment_type =6;
                $trans->result = 'FROMAPP';
                $trans->ref = $request->ref;
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;;
                $trans->status = 1;
                $trans->save();
                */
            }
            if ($request->paymentMethod == 10) {

                $order->update(['case_id' => 9, 'is_paid' => false]);
                if ($order->use_wallet && ($order->paymentMethod != 4 && $order->paymentMethod != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                // foreach ($cart as $product) {
                //     $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                //     if ($productSize) {
                //         $productSize->stock()->create([
                //             'type' => 'withdraw',
                //             'order_id' => $order->id,
                //             // 'order_product_id'=>$product['product_id'],
                //             'qty' => (int)$product->quantity
                //         ]);
                //     }
                // }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trasactionID  =  time() . rand(100000, 999999);

                $trans = new Transaction();
                $trans->order_id =   $order->id;
                $trans->amount = $totalForOnlinePayment;
                $trans->user_id = $customer_id;
                $trans->payment_id =   $trasactionID;
                $trans->payment_type = 6;
                $trans->result = 'FROMWEB';
                $trans->ref = $request->ref;
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;
                $trans->status = 0;
                $trans->save();

                // $trans=Transaction::create(['order_id'=>$order->id,'amount'=>$totalForOnlinePayment,'user_id'=>$customer_id,'payment_id'=>$trasactionID]);
                //    $trans->save();
                /*
                $trans->payment_id = $request->apple_pay_refernce;
                $trans->payment_type =6;
                $trans->result = 'FROMAPP';
                $trans->ref = $request->ref;
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;;
                $trans->status = 1;
                $trans->save();
                */
            }

            $bill_file_name = $this->saveInvoice($order);
            $order->update(['bill_file_name' => $bill_file_name]);
            $lang = 'ar';
            $message = [
                "locale.text" => 'notifications.new.order',
                "msg" => trans('notifications.new.order', [], $lang),
                'title' => "طلب جديد " . $order->invoice_number . "#",
                "web_url" => route('system.orders.details', ["id" => $order->id])
            ];
            event(new SendAdminsNotifications($message));
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('order error :' . $e->getMessage());
            // return back()->with('toast_error', $e->getMessage());
            return back()->with('toast_error', __('api_texts.something_error'));
        }
        if ($request->paymentMethod == 1) {
             foreach ($cart as $product) {
                    $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product->quantity
                        ]);
                    }
                }

            \Cart::clear();
            \Cart::removeConditionsByType('ship');
            return redirect()->route('single_order', $order->id)->with('success', __('api_texts.default_message'));
        }
        if ($request->paymentMethod == 2) {
            $pay = $this->urway($order);
        } elseif ($request->paymentMethod == 3) {
            $pay = $this->urway($order);
        } elseif ($request->paymentMethod == 5) {
            // return $trans->id ;
            return redirect()->action(
                [ApplePaymentController::class, 'startPayment'],
                ['transaction' => $trans->id,]
            );
            // $pay = $this->apple($order,$trans);
        } elseif ($request->paymentMethod == 6) {
            $pay_url = $this->tabby($order);
            if (!is_null($pay_url)) {
                return redirect($pay_url);
            } else {
                return redirect()->back()->with('toast_error', __('api_texts.something_error'));
            }
        } elseif ($request->paymentMethod == 10) {
            if (is_null($order->customer->mobile)) {
                return back()->with('toast_error', __('site.tamaramob'));
            }
            $redirectUrl = $this->tamara($order);
            if (!is_null($redirectUrl)) {
                return redirect()->to($redirectUrl);
            } else {
                return redirect()->back()->with('toast_error', __('api_texts.something_error'));
            }
        }
    }
    public function urway(Order $o)
    { 
        $user_name = 'abayasq';
        $terminal_id = 'abayasqrwb';
        $password = 'ab_6787@URWAY';
        $secret = 'a2ec7e094975aabddf7486aef9fa1c1dd3ad3e43cb913dd24b1172580417002c';
        // $txn_details = "$o->id|$user_name|$password|$secret|$o->total|SAR";
        // $txn_details = "$o->id|abayasqrn|abasya@normal|8d6dd0336b3f603bd5a5e0e64714cb92483d3129f1c420f56b24438ba6512234|$o->total|SAR";
        $txn_details = "$o->id|abayasqr|abayasqr@URWAY_123|a2ec7e094975aabddf7486aef9fa1c1dd3ad3e43cb913dd24b1172580417002c|$o->total|SAR";
        $hash = hash('sha256', $txn_details);
        $host = gethostname();
        $ip = gethostbyname($host);
        // $url = 'https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';
        $url = 'https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest';

        $fields = array(
            'trackid' => $o->id,
            'terminalId' => "abayasqr",
            'customerEmail' => $o->customer->email ?? 'info@abayasquare.com',
            'customerName' => $o->customer->name ?? 'abaya',
            'cardHolderName' => $o->customer->name ?? 'abaya',
            'action' => "1",
            'instrumentType' => "DEFAULT",
            'merchantIp' => $ip,
            'password' => "abayasqr@URWAY_123",
            'currency' => 'SAR',
            'country' => "SA",
            'amount' => $o->total,
            'requestHash' => $hash,
            "udf2" => route('urway_response')
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        // dd($ch,$result,$hash,$data,$txn_details,json_decode($result, true));
        //close connection
        curl_close($ch);
        $urldecode = (json_decode($result, true));
        // dd($urldecode); 
        // dd($urldecode['payid']);
        if ($urldecode['payid'] != NULL) {
            $url = $urldecode['targetUrl'] . "?paymentid=" . $urldecode['payid'];
            echo '
                <html>
                <form name="myform" method="POST" action="' . $url . '">
                <h1> Transaction is processing........</h1>
                </form>
                <script type="text/javascript">document.myform.submit();
                </script>
                </html>';
        } else {
            echo "<b>Something went wrong!!!!</b>";
        }
    }

    public function tabby(Order $o)
    {
        $mob = substr($o->customer->mobile, 3);

        $fields = [
            "payment" =>
            array(
                "amount" => $o->total,
                "currency" => "SAR",
                "description" => $o->invoice_number,
                "buyer" =>
                array(
                    "phone" => $mob ?? '570909933',
                    "email" => $o->customer->email ?? 'info@abayasquare.com',
                    "name" => $o->customer->name ?? 'abaya',
                    "dob" => "2019-08-24"
                ),
                "buyer_history" =>
                array(
                    "registered_since" => "2019-08-24T14:15:22Z",
                    "loyalty_level" => 0,
                    "wishlist_count" => 0,
                    "is_social_networks_connected" => true,
                    "is_phone_number_verified" => true,
                    "is_email_verified" => true
                ),
                "order" =>
                array(
                    "tax_amount" => $o->tax,
                    "shipping_amount" => $o->delivery_cost,
                    "discount_amount" => $o->discount,
                    "updated_at" => $o->updated_at,
                    "reference_id" => (string)$o->id,
                    "items" => [
                        array(
                            "title" => "string",
                            "description" => "string",
                            "quantity" => 1,
                            "unit_price" => "0.00",
                            "discount_amount" => "0.00",
                            "reference_id" => "string",
                            "image_url" => "/",
                            "product_url" => "/",
                            "gender" => "Female",
                            "category" => "string",
                            "color" => "string",
                            "product_material" => "string",
                            "size_type" => "string",
                            "size" => "string",
                            "brand" => "string"
                        )
                    ]


                ),
                "order_history" => [
                    array(
                        "purchased_at" => $o->created_at,
                        "amount" => $o->total,
                        "payment_method" => $o->payment_type,
                        "status" => "new",
                        "buyer" => array(
                            "phone" => $mob ?? '570909933',
                            "email" => $o->customer->email ?? 'info@abayasquare.com',
                            "name" => $o->customer->name ?? 'abaya',
                            "dob" => "2019-08-24"
                        ),
                        "shipping_address" => array(
                            "city" => $o->address->area->name,
                            "address" => $o->address->address,
                            "zip" => "string"
                        ),
                        "items" => [
                            array(
                                "title" => "string",
                                "description" => "string",
                                "quantity" => 1,
                                "unit_price" => "0.00",
                                "discount_amount" => "0.00",
                                "reference_id" => "string",
                                "image_url" => "/",
                                "product_url" => "/",
                                "gender" => "Female",
                                "category" => "string",
                                "color" => "string",
                                "product_material" => "string",
                                "size_type" => "string",
                                "size" => "string",
                                "brand" => "string"
                            )
                        ]
                    )
                ],
                "shipping_address" => array(
                    "city" => $o->address->area->name,
                    "address" => $o->address->address,
                    "zip" => "string"
                ),
                "meta" => array(
                    "order_id" => $o->id,
                    "customer" => $o->customer_id
                ),
                "attachment" => array(
                    "body" => "{\"flight_reservation_details\": {\"pnr\": \"TR9088999\",\"itinerary\": [...],\"insurance\": [...],\"passengers\": [...],\"affiliate_name\": \"some affiliate\"}}",
                    "content_type" => "application/vnd.tabby.v1+json"
                )
            ),
            "lang" => app()->getLocale(),
            "merchant_code" => "AbayaSquare",
            "merchant_urls" => array(
                "success" => route('success_tabby'),
                "cancel" => route('cancel_tabby'),
                "failure" => route('failure_tabby')
            )

        ];
        $data = json_encode($fields);
        $curl = curl_init();
        $url = "https://api.tabby.ai/api/v2/checkout";
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
                'Authorization: Bearer ' . 'pk_c8d9591f-7363-417e-98dc-2002fca0f6be'
            ),
        ));
        $response = curl_exec($curl);
        $res = json_decode($response);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);
        if (isset($error_msg)) {
            \Log::error("" . $error_msg);
        }
        \Log::info("" . $response);

        // dd($response,($res->status == 'created'),$res,$res->id,$res->status,$res->configuration->available_products->installments[0]->web_url, $data);

        if ($res->status == 'created' || $res->status == 'warning') {

            $o->update([
                "tabby" => $res->payment->id,
            ]);
            $pay_url = $res->configuration->available_products->installments[0]->web_url;
            return $pay_url;
            // return redirect($pay_url);
        } else {
            return;
            // return redirect()->back()->with('toast_error', __('api_texts.something_error'));
        }
    }
    public function tamara(Order $o)
    {
        // $url = 'https://api-sandbox.tamara.co/checkout';
        // $token = 'Bearer ' . 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiI5YmZlNzg5Ny1hNTFkLTRhMDktYTM5Zi01ZTBmM2M4M2Y5ZDMiLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiZTQ4NjIzNGYyMjA0YmUwOGYyMDJmNDhhNDg5ZmViZmEiLCJpYXQiOjE2NjA0ODM5MjQsImlzcyI6IlRhbWFyYSJ9.f6LZca2btJWBN-N9sGQ7GdVwsLPevmkrJur4GdCqwZsRrgvEul1oveFMbS7lTDd0lcTJ54RNvZ4T1QnP45gm89x0-FyB4ltHk3zj3K4Q1iIM3Bcx5Q7AWt-f450t7cxOneo9ij2TYL6Iu7LpnOWUWbhA2hUAiu582TGaTgnMwFhds_ykiPOnLh2ty1Ri4_dND0oQcbV_sxnaKZvXXiZh2_yBVb7ECyUTKxvDZ1XlWLh9ITKS7CVViY87YfjxY28xt_tDQQAlQFH76A2lQNXLvIMUbIOdjCJWPz53nK8ie17IEDIphcxSY0bLDBrNk3PfPh592038coCEI1kS1yrNBA';
        // $client = Client::create(Configuration::create($url, $token));
        // $response = $client->getPaymentTypes('SA');

        // if ($response->isSuccess()) {
        //     var_dump($response->getPaymentTypes());
        // }

        $mob = substr($o->customer->mobile, 3);
        $mob1 = substr($o->address->mobile, 3);

        $order = new tamaraorder();
        $order->setorderId($o->id);
        $order->setOrderReferenceId($o->id);
        $order->setOrderNumber($o->invoice_number);
        $order->setLocale('ar_SA');
        $order->setCurrency('SAR');
        $order->setTotalAmount(new Money($o->total, 'SAR'));
        $order->setCountryCode('SA');
        $order->setPaymentType('PAY_BY_INSTALMENTS');
        $order->setPlatform('');
        $order->setDescription($o->invoice_number);
        $order->setTaxAmount(new Money(0.00, 'SAR'));
        $order->setShippingAmount(new Money(0.00, 'SAR'));

        # order items
        $orderItemCollection = new OrderItemCollection();
        foreach ($o->products as $item) {
            $orderItem = new OrderItem();
            $orderItem->setName($item->product->name);
            $orderItem->setQuantity($item->qty);
            $orderItem->setUnitPrice(new Money($item->price, 'SAR'));
            $orderItem->setType('Abaya');
            $orderItem->setSku($item->product_id);
            $orderItem->setTotalAmount(new Money($item->total, 'SAR'));
            $orderItem->setTaxAmount(new Money(0.0, 'SAR'));
            $orderItem->setDiscountAmount(new Money(0.0, 'SAR'));
            $orderItem->setReferenceId($item->id);
            

            $orderItemCollection->append($orderItem);
            $order->setItems($orderItemCollection);
            
            // dd($order);
        }
        # billing address
        $billing = new Address();
        $billing->setFirstName($o->customer->name ?? 'Customer');
        $billing->setLastName('');
        $billing->setLine1($o->address->address);
        $billing->setLine2('');
        $billing->setRegion('');
        $billing->setCity($o->address->area->name ?? 'Riyadh');
        $billing->setPhoneNumber($mob1);
        $billing->setCountryCode('SA');
        $order->setBillingAddress($billing);

        # shipping address
        $shipping = new Address();
        $shipping->setFirstName($o->customer->name ?? 'Customer');
        $shipping->setLastName('');
        $shipping->setLine1($o->address->address);
        $shipping->setLine2('');
        $shipping->setRegion('');
        $shipping->setCity($o->address->area->name ?? 'Riyadh');
        $shipping->setPhoneNumber($mob1);
        $shipping->setCountryCode('SA');
        $order->setShippingAddress($shipping);

        # consumer
        $consumer = new Consumer();
        $consumer->setFirstName($o->customer->name ?? 'Customer');
        $consumer->setLastName('');
        $consumer->setEmail($o->customer->email ?? 'info@abayasquare.com');
        $consumer->setPhoneNumber($mob);
        $order->setConsumer($consumer);

        # merchant urls
        $merchantUrl = new MerchantUrl();
        $merchantUrl->setSuccessUrl(route('web_success_tamara'));
        $merchantUrl->setFailureUrl(route('web_failure_tamara'));
        $merchantUrl->setCancelUrl(route('web_cancel_tamara'));
        $merchantUrl->setNotificationUrl(route('web_notification_tamara'));
        $order->setMerchantUrl($merchantUrl);

        # discount
        $order->setDiscount(new Discount('Coupon', new Money(0.00, 'SAR')));
        // dd($order);
        
        $url = "https://api-sandbox.tamara.co/";
        $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiI5YmZlNzg5Ny1hNTFkLTRhMDktYTM5Zi01ZTBmM2M4M2Y5ZDMiLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiZTQ4NjIzNGYyMjA0YmUwOGYyMDJmNDhhNDg5ZmViZmEiLCJpYXQiOjE2NjA0ODM5MjQsImlzcyI6IlRhbWFyYSJ9.f6LZca2btJWBN-N9sGQ7GdVwsLPevmkrJur4GdCqwZsRrgvEul1oveFMbS7lTDd0lcTJ54RNvZ4T1QnP45gm89x0-FyB4ltHk3zj3K4Q1iIM3Bcx5Q7AWt-f450t7cxOneo9ij2TYL6Iu7LpnOWUWbhA2hUAiu582TGaTgnMwFhds_ykiPOnLh2ty1Ri4_dND0oQcbV_sxnaKZvXXiZh2_yBVb7ECyUTKxvDZ1XlWLh9ITKS7CVViY87YfjxY28xt_tDQQAlQFH76A2lQNXLvIMUbIOdjCJWPz53nK8ie17IEDIphcxSY0bLDBrNk3PfPh592038coCEI1kS1yrNBA';
        // $client = Client::create(Configuration::create('https://api-sandbox.tamara.co', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiI5YmZlNzg5Ny1hNTFkLTRhMDktYTM5Zi01ZTBmM2M4M2Y5ZDMiLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiZTQ4NjIzNGYyMjA0YmUwOGYyMDJmNDhhNDg5ZmViZmEiLCJpYXQiOjE2NjA0ODM5MjQsImlzcyI6IlRhbWFyYSJ9.f6LZca2btJWBN-N9sGQ7GdVwsLPevmkrJur4GdCqwZsRrgvEul1oveFMbS7lTDd0lcTJ54RNvZ4T1QnP45gm89x0-FyB4ltHk3zj3K4Q1iIM3Bcx5Q7AWt-f450t7cxOneo9ij2TYL6Iu7LpnOWUWbhA2hUAiu582TGaTgnMwFhds_ykiPOnLh2ty1Ri4_dND0oQcbV_sxnaKZvXXiZh2_yBVb7ECyUTKxvDZ1XlWLh9ITKS7CVViY87YfjxY28xt_tDQQAlQFH76A2lQNXLvIMUbIOdjCJWPz53nK8ie17IEDIphcxSY0bLDBrNk3PfPh592038coCEI1kS1yrNBA'));
        $client = Client::create(Configuration::create('https://api.tamara.co', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiI2Yjg5ZWQ0Ny1kYzEwLTQ1NzItOTFjZi02NGJjMTRjMzIxZTAiLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiZGY4MjZmZWE5ZTZmOTg4NzBiODBmOGMyNzE3MzgxYjkiLCJpYXQiOjE2NjA2NTgyMjYsImlzcyI6IlRhbWFyYSBQUCJ9.qf0Vo4kcuQRxpevRmyubpZu-f7OM5mk4dKl80g-xyR8qPsll5Mao-MwOT16Kfw20aI2q-Jl_WVeQs_Nn2vROs5zh97QfYR7ip2i6kFGF3NSCQKmsHQKpZ7Ih8RWxnKRnAihyVmcKx-ZsAa8HPHB-6t92IU8LOS2cYG8kVfiP5K10MgYCj2M8EZKHrSvWsASeyx8QyH2Uc7Dp24DSg3u2oxNkCqo_vyLZP4IAh0CVVM8-OHk18OBsMPrXQ8AOga2o1tWnPCzQVYxZ3HtFzY3ifum8bQVls4flIkL1e1tTKFstnlf-ea0r8VVAr5vQf1rRA454r2jguNh4zTu6Fi85ew'));
        $request = new CreateCheckoutRequest($order);
        $response = $client->createCheckout($request);
      
        // dd($client,$request,$response,$response->getErrors());
        if (!$response->isSuccess()) {
            //  return redirect()->back();
            $url = "/checkout";
            echo "<script>window.open('".$url."', '_self')</script>";


            //  $this->log($response->getContent());
            // return redirect()->back()->with('toast_error', __('api_texts.something_error'));
            // return $this->handleError($response->getErrors());
        }

        $checkoutResponse = $response->getCheckoutResponse();
        
        if ($checkoutResponse === null) {

            $this->log($response->getContent());
            return redirect()->back()->with('toast_error', __('api_texts.something_error'));
            // return false;
        }

        $tamaraOrderId = $checkoutResponse->getOrderId();
        
                // dd($tamaraOrderId);

        $o->update([
            "tamara" => $tamaraOrderId,
        ]);
        $redirectUrl = $checkoutResponse->getCheckoutUrl();
        // do redirection to $redirectUrl
        return $redirectUrl;
    }
    public function success_tabby(Request $request)
    {
        $order = Order::where('tabby', $request->payment_id)->first();
        $order->update([
            "is_paid" => 1,
            "case_id" => 1,
        ]);
        OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
        $trans = Transaction::where('payment_type', 6)->where('order_id', $order->id)->first();
        $trans->tranid = $request->payment_id;
        $trans->status = 1;
        $trans->save();

        $cart = \Cart::getContent();
             foreach ($cart as $product) {
                    $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product->quantity
                        ]);
                    }
                }

        session()->forget('cart');
        session()->forget('cart_total');
        return redirect()->route('single_order', $order->id)->with('success', __('api_texts.default_message'));
    }

    public function failure_tabby(Request $request)
    {
        $order = Order::where('tabby', $request->payment_id)->first();
        return redirect()->route('checkout')->with('toast_error', __('api_texts.something_error'));
    }

    public function cancel_tabby(Request $request)
    {
        $order = Order::where('tabby', $request->payment_id)->first();
        return redirect()->route('checkout')->with('toast_error', __('api_texts.something_error'));
    }

    public function success_tamara(Request $request)
    {
        
        
        $order = Order::where('tamara', $request->orderId)->first();
        $order->is_paid = 1 ;
        $order->case_id = 1 ;
        $order->save();
        // $order->update([
        //     "is_paid" => 1,
        //     "case_id" => 1,
        // ]);
        OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);

        $cart = \Cart::getContent();
             foreach ($cart as $product) {
                    $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product->quantity
                        ]);
                    }
                }

                
        session()->forget('cart');
        session()->forget('cart_total');
        if (request()->is('api*')) {
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $order, 'order');
        }
        return redirect()->route('single_order', $order->id)->with('success', __('api_texts.default_message'));
    }
    public function success_tamaraapi(Request $request)
    {

        // $order = Order::where('tamara', $request->orderId)->first();
        // $order->update([
        //     "is_paid" => 1,
        //     "case_id" => 1,
        // ]);
        // OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
        // session()->forget('cart');
        // session()->forget('cart_total');
        if (request()->is('api*')) {
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
        }
        return redirect()->route('checkout')->with('success', __('api_texts.default_message'));
    }

    public function failure_tamara(Request $request)
    {
        // dd($request,$request->orderId);
        // $order = Order::where('tamara', $request->orderId)->first();
        if (request()->is('api*')) {
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        return redirect()->route('checkout')->with('toast_error', __('api_texts.something_error'));
    }

    public function cancel_tamara(Request $request)
    {

        // $order = Order::where('tamara', $request->orderId)->first();
        if (request()->is('api*')) {
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        return redirect()->route('checkout')->with('toast_error', __('api_texts.something_error'));
    }

    public function notification_tamara(Request $request)
    {
        // $order = Order::where('tamara', $request->payment_id)->first();
        if (request()->is('api*')) {
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        return redirect()->route('checkout')->with('toast_error', __('api_texts.something_error'));
    }

    public function urway_response(Request $request)
    {
        // dd($request->Result);
        if ($request->Result == 'Successful') {
            $order = Order::where('id',$request->TrackId)->first();
            $order->is_paid = 1 ;
            $order->case_id = 1 ;
            $order->reference_number = $request->TranId ;
            $order->save();
                
            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);

            $cart = \Cart::getContent();
             foreach ($cart as $product) {
                    $productSize = ProductSize::where('size_id', $product->attributes->size_id)->where('product_id', $product->attributes->product_id)->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product->quantity
                        ]);
                    }
                }
            session()->forget('cart');
            session()->forget('cart_total');
            return redirect()->route('single_order', $order->id)->with('success', __('api_texts.default_message'));
        } else {

            return redirect()->route('checkout')->with('toast_error', __('api_texts.something_error'));
        }
    }

    protected function saveInvoice($order)
    {
        $customer =  Auth::guard('user')->user();
        
        $settings = new Settings();
        $data['app_name'] = app()->getLocale() == 'ar' ? $settings->valueOf('project_name_ar') : $settings->valueOf('project_name_en');
        $data['app_email'] = $customer->email ?? 'info@abayasquare.com';
        $data['app_mobile'] = $customer->mobile ;
        $data['order'] = $order;
        $pdf = \PDF::loadView('system_admin.orders.print', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        $pdf_filename = 'INV-' . $order->invoice_number . '.pdf';
        //        $pdf_path=public_path('invoices/' . $pdf_filename);
        //        $pdf->Output($pdf_path, \Mpdf\Output\Destination::FILE);
        $pdf->save(public_path('invoices/' . $pdf_filename));
        return $pdf_filename;
    }

    public function apple(Order $o ,Transaction $trans)
    {
        // dd($o,$trans);gfdklgkldfjlhjdfkljhkdhdflk
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
        $mount = round($o->total);
        $txn_details = "" . $o->id . "|" . $terminalId . "|" . $password . "|" . $key . "|" . $mount . "|" . $currency . "";
        $hash = hash('sha256', $txn_details);

        $host = gethostname();
        $ip = gethostbyname($host);

        $fields = array(
            'trackid' => $o->id,
            'terminalId' => $terminalId,
            'customerEmail' => $o->customer->email ?? 'info@abayasquare.com',
            'customerName' => $o->customer->name ?? 'abaya',
            'cardHolderName' => $o->customer->name ?? 'abaya',
            'action' => "1",
            'instrumentType' => "DEFAULT",
            'merchantIp' => $ip,
            'password' => $password,
            'currency' => $currency,
            'country' => "SA",
            'amount' => $mount,
            'udf2' => route('order.success.payment'),
            'udf3' => "",
            'udf1' => "",
            // 'udf5' => $request->udf5 ? $request->udf5 : "",
            'udf5' => array(
                'paymentData'=> array(),
                'paymentMethod' => array(
                    'displayName' => "Simulated Instrument",
                    'network' => "AmEx",
                    'type' => "debit"
                ),
                'transactionIdentifier' => "Simulated Identifier"

            ),
            'udf4' => "ApplePay",
            // 'ApplePayId' => "merchant.com.selsela.abayasquare",
            'ApplePayId' => "applepay",
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
    
}
