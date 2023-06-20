<?php

namespace App\Http\Controllers;

use App\Events\SendUsersNotification;
use App\Models\Category;
use App\Models\GlobalNotification;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Store;
use App\Models\Product;
use App\Rules\ValidMobile;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PayoutController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_stores|view_stores|add_stores|edit_stores|delete_stores,system_admin', ['only' => ['index', 'create']]);
        $this->middleware('permission:add_stores,system_admin', ['only' => ['create', 'showCreateView']]);
        $this->middleware('permission:edit_stores,system_admin', ['only' => ['showUpdateView', 'update']]);
        $this->middleware('permission:delete_stores,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {

        $o = Store::orderBy('id','DESC');
        if ($request->name) {
            $o->where('name_ar', 'like', '%' . $request->name . '%')
            ->orWhere('name_en', 'like', '%' . $request->name . '%');
        }
        if ($request->status > -1) {
            $o->where('status', $request->status);
        }

        if ($request->mobile) {
            $o->where('mobile', 'like', '%' . $request->mobile . '%');
        }


        $out = $o->paginate(20);

        return view('system_admin.payouts.index', compact('out'));

    }

    public function show(Request $request)
    {
        $out = Store::findOrFail($request->id);
        $details=view('system_admin.stores.details',compact('out'))->render();
        return response()->json(compact('details'));
    }

    public function orders($id)
    {
        $orders = Order::where('case_id',7)->pluck('id');
        $sales = OrderProduct::where('store_id',$id)->whereIn('order_id',$orders)->get();
        dd($sales);
        // $out = $orders->paginate(20);

        return view('system_admin.orders.index', compact('out'));
    }
}
