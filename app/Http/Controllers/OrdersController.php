<?php

namespace App\Http\Controllers;

use App\Events\SendAdminNotification;
use App\Events\SendSilentUserNotification;
use App\Events\SendUserNotification;
use App\Http\Resources\OrderStatusLogResource;
use App\Models\CaseGeneral;
use App\Models\Order;
use App\Models\OrderCase;
use App\Models\OrderStatusLog;
use App\Models\ProductSize;
use App\Models\Settings;
use App\Traits\Shipping;
use App\Traits\ShippingLive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\OrderProduct;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Size;
use App\Product as AppProduct;
use Matrix\Exception;


class OrdersController extends Controller
{
    use ShippingLive;
    function __construct()
    {
        $this->middleware('permission:activate_orders|view_orders|add_orders|edit_orders|delete_orders,system_admin', ['only' => ['mainIndex', 'index', 'details']]);
        $this->middleware('permission:edit_orders,system_admin', ['only' => ['change_status', 'change_order_status_to_can', 'edit', 'update', 'deleteproduct', 'editpay', 'addproduct']]);
        $this->middleware('permission:delete_orders,system_admin', ['only' => ['delete']]);
    }

    public function mainIndex(Request $request)
    {

        if ($request->name) {
            $out = Order::where('invoice_number', 'like', '%' . $request->name . '%')->orderBy('id', 'DESC')->paginate(20);
            return view('system_admin.orders.index', compact('out'));
        }

        $orderCases = OrderCase::get();
        return view(
            'system_admin.orders.main-index',
            compact('orderCases')
        );
    }

    public function index(Request $request)
    {
// return $request->all();

        $status = $request->status;
        $case = new OrderCase();
        $case_id = $case->idOf($request->status);
        if ($request->status == 'New') {
            $case_id = 1;
        } elseif ($request->status == 'Canceled') {
            $case_id = 2;
        } elseif ($request->status == 'Confirm order') {
            $case_id = 3;
        } elseif ($request->status == 'Shipping in progress') {
            $case_id = 4;
        } elseif ($request->status == 'Shipped') {
            $case_id = 5;
        } elseif ($request->status == 'Delivery in progress') {
            $case_id = 6;
        } elseif ($request->status == 'Delivered') {
            $case_id = 7;
        } elseif ($request->status == 'Returned') {
            $case_id = 8;
        }
        $o = new Order();
        if ($case_id) {
            $o = $o->where('case_id', $case_id);
            $case_name = OrderCase::where('id', $case_id)->first();
        }
        if ($request->name) {
            $o = $o->where('invoice_number', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o =  $o->where('total', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o =  $o->where('total', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o = $o->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o = $o->whereDate('created_at', '<=', $date_to);
        }
    
    
            $out = $o->orderBy('created_at', 'desc')->paginate(20);
        
        

        // return $out;
        return view('system_admin.orders.index', compact('out', 'status', 'case_name'));
    }

    public function accept(Request $request)
    {

        $o = Order::where('case_id', 2)->orderBy('id', 'DESC');
        if ($request->name) {
            $o->where('invoice_number', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o->where('total', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('total', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o->whereDate('created_at', '<=', $date_to);
        }

        // $out = $o->paginate(20);
        // $out->appends($request->all());
        $out = $o->paginate(20);

        return view('system_admin.orders.index', compact('out'));
    }

    public function onDelivery(Request $request)
    {

        $o = Order::where('case_id', 3)->orderBy('id', 'DESC');
        if ($request->name) {
            $o->where('invoice_number', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o->where('total', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('total', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o->whereDate('created_at', '<=', $date_to);
        }

        $out = $o->paginate(20);
        $out->appends($request->all());

        return view('system_admin.orders.index', compact('out'));
    }

    public function archive(Request $request)
    {
        $o = Order::where('case_id', 4)->orderBy('id', 'DESC');
        if ($request->name) {
            $o->where('invoice_number', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o->where('total', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('total', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o->whereDate('created_at', '<=', $date_to);
        }

        $out = $o->paginate(20);

        return view('system_admin.orders.index', compact('out'));
    }

    public function canceled(Request $request)
    {

        $o = Order::where('case_id', 5)->orderBy('id', 'DESC');
        if ($request->name) {
            $o->where('invoice_number', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o->where('total', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('total', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o->whereDate('created_at', '<=', $date_to);
        }

        $out = $o->paginate(20);

        return view('system_admin.orders.index', compact('out'));
    }

    public function rejected(Request $request)
    {

        // return $request;
        $o = Order::where('case_id', 6)->orderBy('id', 'DESC');

        if ($request->name) {
            $o->where('invoice_number', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o->where('total', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('total', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o->whereDate('created_at', '<=', $date_to);
        }

        $out = $o->paginate(20);

        return view('system_admin.orders.index', compact('out'));
    }

    public function indexO(Request $request)
    {

        $o = Order::orderBy('id', 'DESC');

        if ($request->name) {
            $o->where('name', 'like', '%' . $request->name . '%');;
        }
        if ($request->price_from) {
            $o->where('total_price', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('total_price', '<=', $request->price_to);
        }
        if ($request->date_from) {
            $o->where('date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $o->where('date', '<=', $request->date_to);
        }

        if ($request->case_id > 0) {
            $o->where('case_id', $request->case_id);
        }

        $out = $o->paginate(20);
        $cases = CaseGeneral::all();
        return view('system_admin.orders.index', compact('out', 'cases'));
    }

    public function new_row(Request $request)
    {
        $a = Order::find($request->id);

        $view = \View::make('system_admin.orders.order_row', compact('a'));
        $output = $view->render();
        return ['out' => $output, 'done' => 1];
    }

    public function new_row_2(Request $request)
    {
        $a = Order::find($request->id);

        $view = \View::make('system_admin.orders.order_row_2', compact('a'));
        $output = $view->render();
        return ['out' => $output, 'done' => 1];
    }

    public function details($id)
    {

        $paymentTypes = PaymentType::where('is_active', 1)->get();
        $order = $out = Order::with('address.area')->findOrFail($id);
        // return $order; 
        //jdsfgjk
        
        $settings = new Settings();
        $currency = $settings->valueOf('currency_ar');
        $activityLog = $order->statusLog;
        return view('system_admin.orders.details', compact('order', 'out', 'currency', 'activityLog', 'paymentTypes'));
    }

    public function edit($id)
    {
        $paymentTypes = PaymentType::where('is_active', 1)->get();
        $order = $out = Order::findOrFail($id);
        $settings = new Settings();
        $currency = $settings->valueOf('currency_ar');
        $activityLog = $order->statusLog;
        $products = Product::where('is_active', true)->get();
        $sizes = Size::where('status', 1)->get();
        return view('system_admin.orders.edit', compact('products', 'sizes', 'order', 'out', 'currency', 'activityLog', 'paymentTypes'));
    }

    public function editpay($id, Request $request)
    {

        $order = Order::findOrFail($id);
        $order->payment_type_id = $request->pay;
        $order->save();

        flash('تم التعديل بنجاح');

        return redirect()->back();
    }

    public function addproduct($id, Request $request)
    {
        $product = Product::findOrFail($request->product);
        $data = new OrderProduct();
        $data->qty = $request->qty;
        $data->store_id = $product->store_id;
        $data->order_id = $id;
        $data->product_id = $request->product;
        $data->size_id = $request->size;
        $data->price = $product->price;
        $data->total = $product->price;
        $data->total_before_discount = $product->price;
        $data->save();
        $order = Order::findOrFail($id);
        $order->total = $order->total + $data->total_before_discount +  $request->replace;
        $order->sub_total_1 = $order->sub_total_1 + $data->total_before_discount;
        $order->replaced = 1;
        $order->replacement_fee = $request->replace;
        $order->save();

        flash('تم التعديل بنجاح');

        return redirect()->back();
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

    public function deleteproduct(Request $request)
    {
        $product = OrderProduct::findOrFail($request->id);
        $order = Order::findOrFail($product->order_id);
        $order->total = $order->total - $product->total_before_discount;
        $order->sub_total_1 = $order->sub_total_1 - $product->total_before_discount;
        $order->save();
        $product->delete();
        $bill_file_name = $this->saveInvoice($order);
        $order->update(['bill_file_name' => $bill_file_name]);
        return ['done' => true];
    }


    // public function change_status(Request $request)
    // {
    //     $order = Order::find($request->id);
    //     $customer = Customer::find($order->customer_id);

    //     if ($order->case_id == 1) {

    //         $order->case_id = 3;
    //         $order->save();

    //         OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //         $lang = 'ar';
    //         $message = [
    //             "msg" => trans('notifications.order.confirmed', ["orderInvoice" => $order->invoice_number], $lang),
    //             'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //             'order_id' => $order->id
    //         ];
    //         sendNotificationToCustomer($customer, $message);
    //         return ['done' => true];
    //     }

    //     if ($order->case_id == 3) {


    //         $clientName = "Empty";
    //         if ($order->customer->name) {
    //             $clientName = $order->customer->name;
    //         } else if ($order->customer->email) {
    //             $clientName = $order->customer->email;
    //         } else if ($order->customer->mobile) {
    //             $clientName = $order->customer->mobile;
    //         }
    //         $clientEmail = $order->customer->email;
    //         $sumOrderProductQty = $order->products()->sum('qty');
    //         $clientAddress = @$order->address->address;
    //         $clientMobile = @$order->address->mobile;
    //         $paymentType = "paid";
    //         $COD = $order->cod_amount ? round($order->cod_amount) : 0;
    //         if ($order->payment_type_id == 1 && $order->cod_amount > 0) {
    //             $paymentType = "COD";
    //         }
    //         $ship_error = '';
    //         try {
    //             $shipmentOrder = $this->createSalasa(
    //                 $order->invoice_number,
    //                 $sumOrderProductQty,
    //                 round($sumOrderProductQty * 0.5),
    //                 $COD,
    //                 $order->total,
    //                 $order->address->area->name_en,
    //                 $order->address->area->name_en,
    //                 (string)$clientName,
    //                 (string)$clientEmail,
    //                 (int)$clientMobile,
    //                 $clientAddress,
    //                 '',
    //                 $paymentType
    //             );

    //             $shipmentOrder = json_decode($shipmentOrder, true);
    //             // dd($shipmentOrder,$shipmentOrder['status']["success"],$shipmentOrder['data']['orders'][0]["order_id"],$shipmentOrder['data']['orders'][0]["waybill"]);
    //             // dd($shipmentOrder);


    //         } catch (\Exception $e) {
    //             flash('حدث خطأ في عملية تخزين الشحنة ', 'error');
    //             \Log::alert($e->getMessage());
    //             $ship_error = $e->getMessage();
    //             dd($ship_error);
    //             //                return ['done' => false,'message'=>$e->getMessage()];
    //         }
    //         // dd($shipmentOrder['data']['orders'][0]);
    //         if ($shipmentOrder && $shipmentOrder['status']["success"]== true && isset($shipmentOrder['data']['orders'][0]["order_id"])) {
    //             $order->shipment_id =  $shipmentOrder['data']['orders'][0]["waybill"];
    //             $order->save();
    //             $order->case_id = 4;
    //             $order->save();
    //             OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //             $lang = 'ar';
    //             $message = [
    //                 "locale.text" => 'notifications.order.shipped',
    //                 "msg" => trans('notifications.order.shipping_in_progress', ["orderInvoice" => $order->invoice_number], $lang),
    //                 'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //                 'order_id' => $order->id
    //             ];

    //             sendNotificationToCustomer($customer, $message);
    //             return ['done' => true];
    //         } else {
    //             $order->shipment_id =  0;
    //             $order->save();
    //             $order->case_id = 4;
    //             $order->save();
    //             OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //             $lang = 'ar';
    //             $message = [
    //                 "locale.text" => 'notifications.order.shipped',
    //                 "msg" => trans('notifications.order.shipping_in_progress', ["orderInvoice" => $order->invoice_number], $lang),
    //                 'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //                 'order_id' => $order->id
    //             ];

    //             sendNotificationToCustomer($customer, $message);
    //             return ['done' => true, 'title' => 'فشلت عملية الشحن', 'message' => $ship_error];
    //         }


    //         return ['done' => false];
    //     }
    //     if ($order->case_id == 4) {

    //         $order->case_id = 5;
    //         $order->save();
    //         OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //         $lang = 'ar';
    //         $message = [
    //             "msg" => trans('notifications.order.shipped', ["orderInvoice" => $order->invoice_number], $lang),
    //             'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //             'order_id' => $order->id
    //         ];
    //         sendNotificationToCustomer($customer, $message);
    //         return ['done' => true];
    //     }
    //     if ($order->case_id == 5) {

    //         $order->case_id = 6;
    //         $order->save();
    //         OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //         $lang = 'ar';
    //         $message = [
    //             "msg" => trans('notifications.order.delivery_in_progress', ["orderInvoice" => $order->invoice_number], $lang),
    //             'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //             'order_id' => $order->id
    //         ];
    //         sendNotificationToCustomer($customer, $message);
    //         return ['done' => true];
    //     }

    //     if ($order->case_id == 6) {

    //         $order->case_id = 7;
    //         $order->save();
    //         OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //         $lang = 'ar';
    //         $message = [
    //             "msg" => trans('notifications.order.delivered', ["orderInvoice" => $order->invoice_number], $lang),
    //             'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //             'order_id' => $order->id
    //         ];
    //         sendNotificationToCustomer($customer, $message);
    //         return ['done' => true];
    //     }
    //     if ($order->case_id == 7) {

    //         $order->case_id = 8;
    //         $order->save();
    //         OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    //         $lang = 'ar';
    //         $message = [
    //             "msg" => trans('notifications.order.returned', ["orderInvoice" => $order->invoice_number], $lang),
    //             'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
    //             'order_id' => $order->id
    //         ];
    //         sendNotificationToCustomer($customer, $message);
    //         return ['done' => true];
    //     }




    //     return ['done' => false];
    // }

    //////////////////old shipping
    public function change_status(Request $request)
    {

        $order = Order::find($request->id);
        $customer = Customer::find($order->customer_id);

        if ($order->case_id == 1) {

            $order->case_id = 3;
            $order->save();

            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
            $lang = 'ar';
            $message = [
                "msg" => trans('notifications.order.confirmed', ["orderInvoice" => $order->invoice_number], $lang),
                'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                'order_id' => $order->id
            ];
            sendNotificationToCustomer($customer, $message);
            return ['done' => true];
        }

        if ($order->case_id == 3) {
            $clientName = "Empty";
            if ($order->customer->name) {
                $clientName = $order->customer->name;
            } else if ($order->customer->email) {
                $clientName = $order->customer->email;
            } else if ($order->customer->mobile) {
                $clientName = $order->customer->mobile;
            }

            $sumOrderProductQty = $order->products()->sum('qty');
            $clientAddress = @$order->address->address;
            $clientMobile = @$order->address->mobile;
            $paymentType = "PP";
            $COD = $order->cod_amount ? round($order->cod_amount) : 0;
            if ($order->payment_type_id == 1 && $order->cod_amount > 0) {
                $paymentType = "COD";
            }
            $ship_error = '';
            
            if(!isset($clientAddress) || $clientAddress == ''){
                $clientAddress = 'none';
            }
           
            try {
                $shipmentOrder = $this->createNewShipment(
                    (int)$order->id,
                    (int)$sumOrderProductQty,
                    round($sumOrderProductQty * 0.5),
                    $COD,
                    $order->address->area->city_code,
                    (string)$clientName,
                    (int)$clientMobile,
                    (string)$clientAddress,
                    '',
                    $paymentType
                );
                $shipmentOrder = json_decode($shipmentOrder, true);

            } catch (\Exception $e) {
                flash('حدث خطأ في عملية تخزين الشحنة ', 'error');
                \Log::alert($e->getMessage());
                $ship_error = $e->getMessage();
                //                return ['done' => false,'message'=>$e->getMessage()];
            }
            //dd($shipmentOrder);
            if ($shipmentOrder && $shipmentOrder['success'] && isset($shipmentOrder['order']["id"])) {
                $order->shipment_id =  $shipmentOrder['order']["id"];
                $order->save();
                $order->case_id = 4;
                $order->save();
                OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
                $lang = 'ar';
                $message = [
                    "locale.text" => 'notifications.order.shipped',
                    "msg" => trans('notifications.order.shipping_in_progress', ["orderInvoice" => $order->invoice_number], $lang),
                    'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                    'order_id' => $order->id
                ];

                sendNotificationToCustomer($customer, $message);
                return ['done' => true];
            } else {
                $order->shipment_id =  0;
                $order->save();
                $order->case_id = 4;
                $order->save();
                OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
                $lang = 'ar';
                $message = [
                    "locale.text" => 'notifications.order.shipped',
                    "msg" => trans('notifications.order.shipping_in_progress', ["orderInvoice" => $order->invoice_number], $lang),
                    'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                    'order_id' => $order->id
                ];

                sendNotificationToCustomer($customer, $message);
                return ['done' => true, 'title' => 'فشلت عملية الشحن', 'message' => $ship_error];
            }


            return ['done' => false];
        }
        if ($order->case_id == 4) {

            $order->case_id = 5;
            $order->save();
            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
            $lang = 'ar';
            $message = [
                "msg" => trans('notifications.order.shipped', ["orderInvoice" => $order->invoice_number], $lang),
                'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                'order_id' => $order->id
            ];
            sendNotificationToCustomer($customer, $message);
            return ['done' => true];
        }
        if ($order->case_id == 5) {

            $order->case_id = 6;
            $order->save();
            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
            $lang = 'ar';
            $message = [
                "msg" => trans('notifications.order.delivery_in_progress', ["orderInvoice" => $order->invoice_number], $lang),
                'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                'order_id' => $order->id
            ];
            sendNotificationToCustomer($customer, $message);
            return ['done' => true];
        }

        if ($order->case_id == 6) {

            $order->case_id = 7;
            $order->save();
            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
            $lang = 'ar';
            $message = [
                "msg" => trans('notifications.order.delivered', ["orderInvoice" => $order->invoice_number], $lang),
                'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                'order_id' => $order->id
            ];
            sendNotificationToCustomer($customer, $message);
            return ['done' => true];
        }
        if ($order->case_id == 7) {

            $order->case_id = 8;
            $order->save();
            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
            $lang = 'ar';
            $message = [
                "msg" => trans('notifications.order.returned', ["orderInvoice" => $order->invoice_number], $lang),
                'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
                'order_id' => $order->id
            ];
            sendNotificationToCustomer($customer, $message);
            return ['done' => true];
        }




        return ['done' => false];
    }


    public function change_order_status_to_can(Request $request)
    {

        $order = Order::find($request->id);
        $customer = Customer::find($order->customer_id);
        $order->case_id = 2;
        $order->save();
        OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
    
        if($order->payment_type_id == 10 && $order->order_from !='web' ){
            foreach ($order->products as $product) {
            $productSize = ProductSize::where('size_id', $product->size_id)->where('product_id', $product->product_id)->first();
            // if ($productSize) {
            //     $productSize->stock()->create(
            //         [
            //             "qty" => $product->qty,
            //             "reason" => "مرجع من طلب ملغي رقم الطلب {$order->invoice_number}"
            //         ]
            //     );
            // }
        }
        }else{
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
        }
        
        $lang = 'ar';
        $message = [
            "locale.text" => 'notifications.order.canceled',
            "msg" => trans('notifications.order.canceled', ["orderInvoice" => $order->invoice_number], $lang),
            'title' => trans('notifications.order.number', ["orderInvoice" => $order->invoice_number], $lang),
            'order_id' => $order->id
        ];
        sendNotificationToCustomer($customer, $message);
        return ['done' => true];
    }

    public function delete(Request $request)
    {
        $order = Order::find($request->id);
        // event(new SendUserNotification($order->customer_id, 'DeleteOrder', ['order_id' => $order->id], 0));
        event(new SendAdminNotification('orders', 'delete_order', ['order_id' => $order->id, 'text' => 'تم حذف الطلب رقم ' . $order->id]));


        $order->products()->delete();
        // $order->balances()->delete();
        $order->transaction()->delete();
        $order->delete();
        return ['done' => true];

        // return ['done' => false];
    }
    public static function ReturnAndCancelUnpaidOrders()
    {
        $orders = Order::where('case_id', 9)->where('created_at', '<', now()->subMinutes(10))->get();
        foreach ($orders as $order) {
            $order->case_id = 2;
            $order->save();
            OrderStatusLog::create(['case_id' => $order->case_id, "order_id" => $order->id]);
            //fjkgkdfg

            if (in_array($order->payment_type_id, [5, 6])) {
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
            }
        }
    }
}
