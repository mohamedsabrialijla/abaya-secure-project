<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Store;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Session;

class SalesExport implements FromView
{
    public function view(): View
    {
        $id = Session()->get('store_id');
        $orders = Order::where('case_id',7);
        if (Session()->get('sales_date_from')) {
            $date_from = Session()->get('sales_date_from');
            $orders->whereDate('created_at', '>=', $date_from);
        }
        if (Session()->get('sales_date_to')) {
            $date_to = Session()->get('sales_date_to');
            $orders->whereDate('created_at', '<=', $date_to);
        }
        $orders = $orders->pluck('id');
        $sales = OrderProduct::where('store_id',$id)->whereIn('order_id',$orders)->with('order','designer','product','coupon','size')->get();
        // dd($request,$date_from,$date_to,$orders);
        // dd($sales);
        $out = $sales;

        $store = Store::find($id);
        $com = $store->commission;
        return view('system_admin.stores.export_sales', [
            'store' => $store,
            'com' =>$com,
            'out'=> $out,
            'date_from'=> $date_from,
            'date_to'=> $date_to,
            'id' => $id
        ]);
    }
}
