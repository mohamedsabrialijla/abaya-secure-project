<?php

namespace App\Http\Controllers;

use App\Events\SendUserNotification;
use App\Models\Customer;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:activate_users|view_users|add_users|edit_users|delete_users,system_admin', ['only' => ['index']]);
        $this->middleware('permission:delete_users,system_admin', ['only' => ['delete']]);
    }
    public function index(Request $request)
    {
        $o = Customer::orderBy('id','DESC');

        if($request->name){
            $o->where('name', 'like' ,'%'.$request->name.'%');
        }

        if($request->mobile){
            $o->where('mobile', 'like' ,'%'.$request->mobile.'%');
        }

        if($request->email){
            $o->where('email', 'like' ,'%'.$request->email.'%');
        }
        if($request->status > -1){
            $o->where('status', $request->status);
        }

        $out = $o->paginate(20);

        return view('system_admin.customers.index', compact('out'));
    }

    public function mostcustomers(Request $request)
    {
        $out = Order::with('customer')->addSelect(DB::raw('SUM(total) as purchase_total, customer_id'))
        ->groupBy('customer_id')->take(20)
        ->orderBy('purchase_total', 'DESC')->get();



        return view('system_admin.customers.most', compact('out'));
    }

    public function show(Request $request, $id)
    {
        $out = Customer::findOrFail($id);
        $orders = Order::where('customer_id',$out->id)->orderBy('id','DESC')->get();
        return view('system_admin.customers.show', compact('out','orders'));
    }

    public function wallet(Request $request)
    {
        $out = Customer::findOrFail($request->id);
        $out->points = $request->points;
        $out->wallet = $request->wallet;
        $out->save();
        return redirect()->back();
    }


    public function activate(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $o = Customer::find($id);
            $o->status = 1;
            $o->save();

        }
        return ['done' => 1];

    }

    public function deactivate(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $o = Customer::find($id);
            $o->status = 0;
            $o->save();

        }
        return ['done' => 1];

    }

    public function ban(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $o = Customer::find($id);
            $o->status = 2;
            $o->save();
        }
        return ['done' => 1];

    }



    public function changeStatus(Request $request)
    {
        $o = Customer::findOrFail($request->id);
        $o->status = $request->status;
        $o->save();
        $message=[
            'title'=>"تم تعطيل حسابك ",
            'msg'=>"تم تعطيل حسابك من إدارة التطبيق",
            'status'=>$o->status,

        ];
        if(  !$o->status){

        SendUserNotification::dispatch($o,$message,$o->fcm_token);
        }elseif( $o->status){
            $message=[
                'title'=>"تم تفعيل حسابك ",
                'msg'=>"تم تفعيل حسابك بامكانك التسوق الآن ",
                'status'=>$o->status,

            ];
            SendUserNotification::dispatch($o,$message,$o->fcm_token);
        }
        return ['done' => 1];
    }

    public function delete(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $s = Customer::find($id);
            $s->delete();
        }
        return ['done' => 1];

    }

}
