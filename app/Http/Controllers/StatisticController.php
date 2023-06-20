<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    public function salesList(Request $request){
        $out=Order::whereIn('case_id',[5,6]);
        if ($request->name) {
            $out= $out->where('invoice_number', 'like', '%' . $request->name . '%');;

        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $out= $out->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $out=$out->whereDate('created_at', '<=', $date_to);
        }
        $out=$out->get();
        return view('system_admin.statistics.sales',compact('out'));
    }
}
