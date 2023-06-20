<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\ApiResponseStatusCodes;
use App\Events\SendAdminNotification;
use App\Events\SendAdminsNotifications;
use App\Events\SendSilentUserNotification;
use App\Http\Controllers\Controller;

use App\Http\Resources\OrderResource;
use App\Models\CategoriesContent;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatusLog;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\Transaction;
use App\Notifications\SignupActivate;
use App\Traits\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    use Payment;
    /**
     * @OA\Post(
     *      path="/api/v1/customer/order/place",
     *      operationId="apiplaceOrder",
     *      tags={"CustomerOrder"},
     *      summary="Place new Order",
     *      description="send order service",
     *     security={{ "api_key": {}}},
     *
     *    @OA\RequestBody(
     *         description="search_trip",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user and transaction objects"
     *       ),
     *      @OA\Response(response=422, description="user not found or one of the fields is missing or token is invalid"),
     * )
     */


    public function placeOrder(Request $request)
    {

        $request->validate([
            "promo_code" => 'nullable',
            'products' => "array|min:1",
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.store_id' => 'required|exists:stores,id',
            //            'products.*.coupon_id' => 'exists:coupons,id',
            'products.*.size_id' => 'required|exists:sizes,id',
            'products.*.qty' => 'required',
            'address_id' => 'required|exists:customer_addresses,id',
            'payment_type_id' => 'required|exists:payment_types,id',
        ]);


        foreach ($request->products as $product) {
            $productsize = ProductSize::where('product_id', $product['product_id'])->where('size_id', $product['size_id'])->first();
            if ($productsize->qty() < $product['qty']) {
                return $this->responseApiWithDataKey(false, __('api_texts.qty_exceeded', ['product' => @$productsize->product->name]), 422);
                break;
            }
        }
        if ($request->filled('promo_code')) {
            $reference_customer  = Customer::where('promo_code', $request->promo_code)->where('status', 1)->first();
            if (!$reference_customer) {
                return $this->responseApiWithDataKey(false, __('api_texts.not_exist_promo_code'), 422);
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
            $products = $request->products;
            $order = Order::create(['invoice_number' => $InvoiceSerial]);
            foreach ($products as $product) {
                $p = Product::find((int)$product['product_id']);
                $total = $total_before_discount = round(($p->sale_price * ((int)$product['qty'])), 2);
                $totalPrice1 += $total;
                $coupon = null;
                $discountRatio = null;
                $discount = null;
                if ($product['coupon_id']) {
                    $coupon = Coupon::find((int)$product['coupon_id']);
                    if ($coupon) {
                        $discountRatio = $coupon->discount_ratio;
                        $discount = round($total * ($discountRatio / 100), 2);
                        $total = round(($total - $discount), 2);
                    }
                }
                $orderProducts[] = [
                    'product_id' => (int)$product['product_id'],
                    'store_id' => (int)$product['store_id'],
                    'coupon_id' => @$coupon->id,
                    'qty' => (int)$product['qty'],
                    'size_id' => (int)$product['size_id'],
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

            $customer = auth('customer')->user();
            $customer_id = $customer->id;
            $setting = new Settings();
            $address = CustomerAddress::find($request->address_id);
            $tax = $setting->valueOf('tax', 0) ? $setting->valueOf('tax', 0) : 0;
            $tax_value = ($totalPrice2 * ($tax / 100));
            $delivery_cost = 0;
            if ($address) {
                $delivery_cost = $address->is_internal == 1 ? (int)$setting->valueOf("internal_shipping_cost", 0) : (int)$setting->valueOf('external_shipping_cost', 0);
            }
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
            if ($request->payment_type_id == 1) {
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
                "sub_total_2" => $totalPrice2,
                "tax_ratio" => $tax,
                "tax" => round($tax_value, 2),
                "delivery_cost" => $delivery_cost,
                "total" => $total,
                "case_id" => 1,
                "cod_amount" => $amount_to_pay,
                "payment_type_id" => $request->payment_type_id,
                "use_wallet" => $request->use_wallet,
                "wallet_amount" => $wallet_amount,
                "transaction_id" => $request->transaction_id,
                "app_commission_ratio" => $appCommissionRatio,
                "app_commission" => $appCommission,

            ]);
            OrderProduct::insert($orderProducts);
            $orderStatusLog = OrderStatusLog::create(['case_id' => 1, "order_id" => $order->id]);

            DB::commit();

            if ($order->payment_type_id == 1) {
                foreach ($products as $product) {
                    $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product['qty']
                        ]);
                    }
                }
            }


            $paymentUrl = null;
            if ($request->payment_type_id != 1 && $request->payment_type_id != 4 && $request->payment_type_id != 5  && $request->payment_type_id != 6) {
                $order->update(["case_id" => 9]);
                $orderStatusLog->update(["case_id" => 9]);

                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $transaction = Transaction::create(['order_id' => $order->id, 'amount' => $totalForOnlinePayment, 'user_id' => $customer_id]);
                $transactionUrl = $this->generateTransactionUrl($transaction->id, "info@selsela.net", $totalForOnlinePayment, 'SAR', route('order.success.payment'));

                if ($transactionUrl) {
                    $paymentUrl = $transactionUrl['targetUrl'] . "?paymentid=" . $transactionUrl['payid'];
                }
            }
            if ($request->payment_type_id == 5) {

                //                $order->update([ "case_id" => 9]);
                //                $orderStatusLog->update([ "case_id" => 7]);

                $order->update(['case_id' => 1, 'is_paid' => true]);
                if ($order->use_wallet && ($order->payment_type_id != 4 && $order->payment_type_id != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                foreach ($products as $product) {
                    $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product['qty']
                        ]);
                    }
                }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trans = Transaction::create(['order_id' => $order->id, 'amount' => $totalForOnlinePayment, 'user_id' => $customer_id]);
                $trans->payment_id = $request->apple_pay_refernce;
                $trans->payment_type = 5;
                $trans->result = 'FROMAPP';
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;;
                $trans->status = 1;
                $trans->save();
            }

            if ($request->payment_type_id == 6) {

                //                $order->update([ "case_id" => 9]);
                //                $orderStatusLog->update([ "case_id" => 7]);

                $order->update(['case_id' => 1, 'is_paid' => true]);
                if ($order->use_wallet && ($order->payment_type_id != 4 && $order->payment_type_id != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                foreach ($products as $product) {
                    $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product['qty']
                        ]);
                    }
                }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trans = Transaction::create(['order_id' => $order->id, 'amount' => $totalForOnlinePayment, 'user_id' => $customer_id]);
                $trans->payment_id = $request->apple_pay_refernce;
                $trans->payment_type = 6;
                $trans->result = 'FROMAPP';
                $trans->ref = $request->ref;
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;;
                $trans->status = 1;
                $trans->save();
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
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        $orderData = OrderResource::make($order);
        $data = [
            "payment_transaction_url" => $paymentUrl,
            "order" => $orderData,
        ];
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $data, 'order');
    }


    /**
     * @OA\Post(
     *      path="/api/v1/customer/order/place-new",
     *      operationId="apiplaceOrderNew",
     *      tags={"CustomerOrder"},
     *      summary="Place new Order",
     *      description="send order service",
     *     security={{ "api_key": {}}},
     *
     *    @OA\RequestBody(
     *         description="new order v2",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user and transaction objects"
     *       ),
     *      @OA\Response(response=422, description="user not found or one of the fields is missing or token is invalid"),
     * )
     */

    public function placeOrderNew(Request $request)
    {

        $request->validate([
            "promo_code" => 'nullable',
            "discount_amount" => 'nullable',
            'products' => "array|min:1",
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.store_id' => 'required|exists:stores,id',
            'products.*.size_id' => 'required|exists:sizes,id',
            'products.*.qty' => 'required',
            'address_id' => 'required|exists:customer_addresses,id',
            'payment_type_id' => 'required|exists:payment_types,id',
        ]);


        foreach ($request->products as $product) {
            $productsize = ProductSize::where('product_id', $product['product_id'])->where('size_id', $product['size_id'])->first();
            if ($productsize->qty() < $product['qty']) {
                return $this->responseApiWithDataKey(false, __('api_texts.qty_exceeded', ['product' => @$productsize->product->name]), 422);
                break;
            }
        }
        if ($request->filled('promo_code')) {
            $reference_customer  = Customer::where('promo_code', $request->promo_code)->where('status', 1)->first();
            if (!$reference_customer) {
                return $this->responseApiWithDataKey(false, __('api_texts.not_exist_promo_code'), 422);
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
            $products = $request->products;
            $order = Order::create(['invoice_number' => $InvoiceSerial]);
            foreach ($products as $product) {
                $p = Product::find((int)$product['product_id']);
                $total = $total_before_discount = round(($p->sale_price * ((int)$product['qty'])), 2);
                $totalPrice1 += $total;
                $coupon = null;
                $discountRatio = null;
                $discount = null;
                if ($product['coupon_id']) {
                    $coupon = Coupon::find((int)$product['coupon_id']);
                    if ($coupon) {
                        if ($coupon->flag == 1) {
                            $discountRatio = $coupon->discount_ratio;
                            $discount = round($total * ($discountRatio / 100), 2);
                            $total = round(($total - $discount), 2);
                        } elseif ($coupon->flag == 2) {
                            $discount = $coupon->discount_ratio;
                            $total = round(($total - $discount), 2);
                        } elseif ($coupon->flag == 3) {
                            $address = CustomerAddress::find($request->address_id);
                            $setting = new Settings();

                            $delivery_cost = 0;
                            if ($address) {
                                $delivery_cost = $address->is_internal == 1 ? (int)$setting->valueOf("internal_shipping_cost", 0) : (int)$setting->valueOf('external_shipping_cost', 0);
                            }
                            $discount = $delivery_cost;
                            $total = round(($total - $discount), 2);
                        }
                    }
                }
                $orderProducts[] = [
                    'product_id' => (int)$product['product_id'],
                    'store_id' => (int)$product['store_id'],
                    'coupon_id' => @$coupon->id,
                    'qty' => (int)$product['qty'],
                    'size_id' => (int)$product['size_id'],
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

            $customer = auth('customer')->user();
            $customer_id = $customer->id;
            $setting = new Settings();
            $address = CustomerAddress::find($request->address_id);
            $tax = $setting->valueOf('tax', 0) ? $setting->valueOf('tax', 0) : 0;
            $tax_value = ($totalPrice2 * ($tax / 100));
            $delivery_cost = 0;
            if ($address) {
                $delivery_cost = $address->is_internal == 1 ? (int)$setting->valueOf("internal_shipping_cost", 0) : (int)$setting->valueOf('external_shipping_cost', 0);
            }
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
            if ($request->payment_type_id == 1) {
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
                "payment_type_id" => $request->payment_type_id,
                "use_wallet" => $request->use_wallet,
                "wallet_amount" => $wallet_amount,
                "transaction_id" => $request->transaction_id,
                "app_commission_ratio" => $appCommissionRatio,
                "app_commission" => $appCommission,

            ]);
            OrderProduct::insert($orderProducts);
            $orderStatusLog = OrderStatusLog::create(['case_id' => 1, "order_id" => $order->id]);

            DB::commit();

            if ($order->payment_type_id == 1) {
                foreach ($products as $product) {
                    $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            //                            'order_product_id'=>$product['product_id'],
                            'qty' => (int)$product['qty']
                        ]);
                    }
                }
            }


            $paymentUrl = null;
            $trasactionID = null;
            if ($request->payment_type_id != 1 && $request->payment_type_id != 4 && $request->payment_type_id != 5  && $request->payment_type_id != 6 && $request->payment_type_id != 10) {
                $order->update(["case_id" => 9]);
                $orderStatusLog->update(["case_id" => 9]);
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $transaction = Transaction::create(['order_id' => $order->id, 'amount' => $totalForOnlinePayment, 'user_id' => $customer_id]);
                $transactionUrl = $this->generateTransactionUrl($transaction->id, "info@selsela.net", $totalForOnlinePayment, 'SAR', route('order.success.payment'));

                if ($transactionUrl) {
                    $paymentUrl = $transactionUrl['targetUrl'] . "?paymentid=" . $transactionUrl['payid'];
                }
            }
            if ($request->payment_type_id == 5) {

                $order->update(['case_id' => 9, 'is_paid' => false]);
                if ($order->use_wallet && ($order->payment_type_id != 4 && $order->payment_type_id != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                foreach ($products as $product) {
                    $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            'qty' => (int)$product['qty']
                        ]);
                    }
                }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trasactionID  =  time() . rand(100000, 999999);
                $trans = new Transaction();
                $trans->order_id =   $order->id;
                $trans->amount = $totalForOnlinePayment;
                $trans->user_id = $customer_id;
                $trans->payment_id =   $trasactionID;
                $trans->payment_type = 5;
                $trans->result = 'FROMAPP';
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;;
                $trans->status = 0;
                $trans->save();
            }

            if ($request->payment_type_id == 6) {

                $order->update(['case_id' => 9, 'is_paid' => false]);
                if ($order->use_wallet && ($order->payment_type_id != 4 && $order->payment_type_id != 1)) {
                    $customer = $order->customer;
                    if ($order->total >= $customer->wallet) {
                        $customer->update(['wallet' => 0]);
                    }
                }
                foreach ($products as $product) {
                    $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                    if ($productSize) {
                        $productSize->stock()->create([
                            'type' => 'withdraw',
                            'order_id' => $order->id,
                            'qty' => (int)$product['qty']
                        ]);
                    }
                }
                $totalForOnlinePayment = round(((float)$order->total - (float)$order->wallet_amount), 2);
                $trasactionID  =  time() . rand(100000, 999999);

                $trans = new Transaction();
                $trans->order_id =   $order->id;
                $trans->amount = $totalForOnlinePayment;
                $trans->user_id = $customer_id;
                $trans->payment_id =   $trasactionID;
                $trans->payment_type = 6;
                $trans->result = 'FROMAPP';
                $trans->ref = $request->ref;
                $trans->postdate = date('Y-m-d');
                $trans->tranid = $request->apple_pay_refernce;;
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
                // foreach ($products as $product) {
                //     $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
                //     if ($productSize) {
                //         $productSize->stock()->create([
                //             'type' => 'withdraw',
                //             'order_id' => $order->id,
                //             'qty' => (int)$product['qty']
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
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        $orderData = OrderResource::make($order);
        $data = [
            "payment_id" => $trasactionID,
            "payment_transaction_url" => $paymentUrl,
            "order" => $orderData,
        ];
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $data, 'order');
    }



    /**
     * @OA\Get(
     *      path="/api/v1/customer/order/list",
     *      operationId="Get customer orders list ",
     *      tags={"CustomerOrder"},
     *      summary="Get customer orders list ",
     *      description="Get app settings",
     *           @OA\Parameter(
     *          name="language",
     *          description="language ar|en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/

    public function myOrders(Request $request)
    {
        $customer_id = auth('customer')->user()->id;
        if ($customer_id) {
            $orders = Order::where('customer_id', $customer_id)
                ->orderBy('created_at', 'desc')
                ->get();
            $ordersResource = OrderResource::collection($orders);
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $orders, 'orders');
        } else {
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/customer/order/get-order-details",
     *      operationId="Get customer order details ",
     *      tags={"CustomerOrder"},
     *      summary="Get customer order details ",
     *      description="Get app settings",
     *     @OA\Parameter(
     *          name="order_id",
     *          description="order_id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *
     *    @OA\Parameter(
     *          name="language",
     *          description="language ar|en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/

    public function getOrderDetails(Request $request)
    {
        $customer_id = auth('customer')->user()->id;
        $order = Order::where('customer_id', $customer_id)->where('id', $request->order_id)->first();
        if ($order) {
            $order = OrderResource::make($order);
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $order, 'order');
        } else {
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/customer/order/cancel-order",
     *      operationId="apiAddOrder",
     *      tags={"CustomerOrder"},
     *      summary="Cancel Order",
     *      description="change order status",
     *     security={{ "api_key": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"order_id"},
     *                     @OA\Property(
     *                     property="order_id",
     *                     description="Order ",
     *                     type="number",
     *                 ),
     *             )
     *         )
     *     ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user and transaction objects"
     *       ),
     *      @OA\Response(response=422, description="user not found or one of the fields is missing or token is invalid"),
     * )
     */
    public function cancelOrder(Request $request)
    {

        //        $validator = Validator::make($request->all(), [
        //            'order_id' => 'required|exists:orders,id'
        //        ]);
        //
        //        if ($validator->fails()) { uihyuiyuiyi
        //            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
        //        }

        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);
        $order = Order::findOrFail($request->order_id);
        $order->case_id = 2;
        if ($order->save()) {
            foreach ($order->products as $product) {
                $productSize = ProductSize::where('size_id', $product->size_id)->where('product_id', $product->product_id)->first();
                if ($productSize) {
                    $productSize->stock()->create(
                        [
                            "qty" => $product->qty,
                            "reason" => "مرجع من طلب ملغي رقم الطلب {$order->invoice_number}"
                        ]
                    );
                }
            }
            $customer = Customer::find($order->customer_id);
            $lang = 'ar';
            $message = [
                "locale.text" => 'notifications.order.canceled',
                "msg" => '',
                'title' => trans('notifications.order.canceled', ["orderInvoice" => $order->invoice_number], $lang),
                "order_id" => $order->id
            ];
            if ($order->use_wallet && $order->payment_type_id == 1 && $order->wallet_amount) {

                $customer->update(['wallet' => round(($customer->wallet + $order->wallet_amount), 2)]);
                $messageW = ['title' => "تم ارجاع مبلغ الطلب # {$order->invoice_number}", 'msg' => "قيمة المبلغ المرجع {$order->wallet_amount}"];
                event(new SendSilentUserNotification($customer, $messageW));
            } elseif ($order->payment_type_id != 1 && $order->payment_type_id != 6 && $order->is_paid == 1) {
                $customer->update(['wallet' => round(($customer->wallet + $order->total), 2)]);
                $messageW = ['title' => "تم ارجاع مبلغ الطلب # {$order->invoice_number}", 'msg' => "قيمة المبلغ المرجع {$order->total}"];
                event(new SendSilentUserNotification($customer, $messageW));
            }

            event(new SendSilentUserNotification($customer, $message));
            event(new SendAdminsNotifications($message));

            OrderStatusLog::create(['case_id' => 2, "order_id" => $order->id]);
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
        }
        return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
    }


    /**
     * @OA\Post(
     *      path="/api/v1/customer/order/confirm-payment",
     *      operationId="confirm-payment",
     *      tags={"ConfirmOrder"},
     *      summary="Confirm Order",
     *      description="change order status",
     *     security={{ "api_key": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"order_id"},
     *                     @OA\Property(
     *                     property="order_id",
     *                     description="Order ",
     *                     type="number",
     *                 ),
     *  required={"payment_id"},
     *                     @OA\Property(
     *                     property="payment_id",
     *                     description="Order Trsaction from  apple pay or taby  ",
     *                     type="number",
     *                 ),
     *  required={"payment_type_id"},
     *                     @OA\Property(
     *                     property="payment_type_id",
     *                     description="Order Payment ID ",
     *                     type="number",
     *                 ),
     *      *  required={"apple_pay_refernce"},
     *                     @OA\Property(
     *                     property="apple_pay_refernce",
     *                     description="Order Reference ",
     *                     type="number",
     *                 ),
     *             )
     *         )
     *     ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user and transaction objects"
     *       ),
     *      @OA\Response(response=422, description="user not found or one of the fields is missing or token is invalid"),
     * )
     */
    public function confirmOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_id' => 'required',
            'payment_type_id' => 'required',
            'apple_pay_refernce' => 'required',
        ]);
        $order = Order::findOrFail($request->order_id);
        $trans = Transaction::where('payment_id', $request->payment_id)->firstOrFail();
        $customer = auth('customer')->user();
        $customer_id = $customer->id;

        try {
            DB::beginTransaction();

            $order->update(['case_id' => 1, 'is_paid' => true]);

            $trans->payment_id = $request->payment_id;
            $trans->payment_type = $request->payment_type_id;
            $trans->result = 'FROMAPP';
            //$trans->ref = $request->ref;
            $trans->postdate = date('Y-m-d');
            $trans->tranid = $request->apple_pay_refernce;;
            $trans->status = 1;
            $trans->save();

            DB::commit();
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('order error :' . $e->getMessage());
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
    }


    /**
     * @OA\Post(
     *      path="/api/v1/customer/order/return-product",
     *      operationId="return-product",
     *      tags={"CustomerOrder"},
     *      summary="return order product  (order_id,order_product_id)",
     *      description="change order status",
     *     security={{ "api_key": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"order_id","order_product_id"},
     *                     @OA\Property(
     *                     property="order_id",
     *                     description="Order ",
     *                     type="number",
     *                 ),
     *                    @OA\Property(
     *                     property="order_product_id",
     *                     description="order product id ",
     *                     type="number",
     *                 ),
     *
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user and transaction objects"
     *       ),
     *      @OA\Response(response=422, description="user not found or one of the fields is missing or token is invalid"),
     * )
     */
    public function returnProduct(Request $request)
    {

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_product_id' => 'required|exists:order_products,id'
        ]);
        $order = Order::findOrFail($request->order_id);
        if ($order) {
            $order->case_id = 6;

            if ($order->save()) {
                OrderStatusLog::create(['case_id' => 6, "order_id" => $order->id]);
                \DB::table('order_products')->where('id', $request->order_product_id)->update(['is_returned' => true]);

                return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
            }
        }

        return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
    }

    protected function saveInvoice($order)
    {
        $settings = new Settings();
        $data['app_name'] = app()->getLocale() == 'ar' ? $settings->valueOf('project_name_ar') : $settings->valueOf('project_name_en');
        $data['app_email'] = $settings->valueOf('email');
        $data['app_mobile'] = $settings->valueOf('mobile');
        $data['order'] = $order;
        $pdf = \PDF::loadView('system_admin.orders.print', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        $pdf_filename = 'INV-' . $order->invoice_number . '.pdf';
        //        $pdf_path=public_path('invoices/' . $pdf_filename);
        //        $pdf->Output($pdf_path, \Mpdf\Output\Destination::FILE);
        $pdf->save(public_path('invoices/' . $pdf_filename));
        return $pdf_filename;
    }

    public function applePay(Request $request)
    {
    }

    public function updatetamara(Request $request)
    {
        // dd($request);
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'tamaraOrderId' => 'required'
        ]);
        $order = Order::findOrFail($request->order_id);
        $order->update([
            "tamara" => $request->tamaraOrderId,
            "is_paid" => 1,
            "case_id" => 1,
        ]);
        OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
        foreach ($order->products as $product) {
            $productSize = ProductSize::where('size_id', $product['size_id'])->where('product_id', $product['product_id'])->first();
            if ($productSize) {
                $productSize->stock()->create([
                    'type' => 'withdraw',
                    'order_id' => $order->id,
                    'qty' => (int)$product['qty']
                ]);
            }
        }
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);

    }
}
