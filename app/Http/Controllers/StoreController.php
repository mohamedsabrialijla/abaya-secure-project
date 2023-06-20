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
use Session;

class StoreController extends Controller
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

        $o = Store::orderBy('ordering','asc');
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

        return view('system_admin.stores.index', compact('out'));

    }

    public function sales( $id , Request $request )
    {
        Session()->put('store_id',$id);
        $orders = Order::where('case_id',7);
        $returns = Order::where('case_id',8);
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            Session()->put('sales_date_from',$date_from);
            $orders->whereDate('created_at', '>=', $date_from);
            $returns->whereDate('created_at', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            Session()->put('sales_date_to',$date_to);
            $orders->whereDate('created_at', '<=', $date_to);
            $returns->whereDate('created_at', '<=', $date_to);
        }
        $orders = $orders->pluck('id');
        $returns = $returns->pluck('id');
        $sales = OrderProduct::where('store_id',$id)->whereIn('order_id',$orders)->with('order','designer','product','coupon','size')->get();
        $out1 = OrderProduct::where('store_id',$id)->whereIn('order_id',$returns)->with('order','designer','product','coupon','size')->get();
        // dd($request,$date_from,$date_to,$orders);
        // dd($sales);
        $out = $sales;

        $store = Store::find($id);
        $com = $store->commission;
        return view('system_admin.stores.sales', compact('out','out1','id','com','store'));

    }

    public function show(Request $request)
    {
        $out = Store::findOrFail($request->id);
        $details=view('system_admin.stores.details',compact('out'))->render();
        return response()->json(compact('details'));
    }


    public function view(Store $store){
        $out=$store;
        return view('system_admin.stores.view',compact('out'));
    }
    public function showCreateView()
    {
        $categories = Category::where('id', '>', 0)->get();
        return view('system_admin.stores.create', compact('categories'));


    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'name_ar' => ['required', 'max:50', Rule::unique('stores','name_ar')->whereNull('deleted_at')],
            'name_en' => ['required', 'max:50', Rule::unique('stores','name_en')->whereNull('deleted_at')],
            'return_policy_ar' => ['required'],
            'return_policy_en' => ['required'],
            'mobile' => ['nullable', 'digits:9','numeric', Rule::unique('stores','mobile')->whereNull('deleted_at')],
            'logo' => 'required',
            //    'snapchat' =>  ['sometimes','string','max:15','min:1'/*,new SnapchatRule()*/],
            'instagram' => ['nullable', 'string', 'max:30', 'min:1'/*,new InstgramRule()*/],
            'whatsapp' => ['nullable','digits:12','numeric'],
            'snapchat' => ['nullable', 'string', 'max:30', 'min:1'],
            'commission' => ['required','numeric'],
        ]);

        if($request->mobile){
            $request['mobile']='966'.$request->mobile;

            $this->validate($request, [
                'mobile' => ['unique:stores,mobile']
            ]);
        }

        $object = new Store();
        $object->name_en = $request->name_en;
        $object->name_ar = $request->name_ar;
        $object->return_policy_ar = $request->return_policy_ar;
        $object->return_policy_en = $request->return_policy_en;
        $object->mobile = $request['mobile'];
        $object->whatsapp = $request->whatsapp;
        $object->instagram = $request->instagram;
        $object->snapchat = $request->snapchat;
        $object->logo = $request->logo;
        $object->commission = $request->commission;
        $object->status = 1;
        $object->save();
        \HELPER::deleteUnUsedFile([$request->logo]);


        if ($request->send_notification) {
            $title = 'مصمم جديد';
            $message = ' تم إضافة مصمم  ' . $object->name_ar;
            $notification = new GlobalNotification();
            $notification->title = $title;
            $notification->message = $message;
            $notification->system_admin_id = \Auth::guard('system_admin')->user()->id;
            $notification->save();

            event(new SendUsersNotification(null, 'AdminNotification', ['global_notification' => $notification->id], 0, 1));

        }


        flash('تمت الاضافة بنجاح');

        return redirect(route('system.stores.index'));
    }

    public function showUpdateView($id)
    {
        $categories = Category::where('id', '>', 0)->get();

        $out = Store::find($id);
        return view('system_admin.stores.update', compact('out', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $object = Store::find($id);

        $this->validate($request, [
            'name_ar' => ['required', 'max:50',Rule::unique('stores','name_ar')->ignore($object->id)->whereNull('deleted_at')],
            'name_en' => ['required', 'max:50',Rule::unique('stores','name_en')->ignore($object->id)->whereNull('deleted_at')],
            'return_policy_ar' => ['required'],
            'return_policy_en' => ['required'],
            'mobile' => ['nullable','digits:9','numeric',Rule::unique('stores','mobile')->ignore($object->id)->whereNull('deleted_at')],
            'logo' => 'nullable',
            // 'snapchat' =>  ['sometimes','string','max:15','min:1'/*,new SnapchatRule()*/],
            // 'instagram' => ['sometimes','string','max:30','min:1'/*,new InstgramRule()*/],
            'instagram' => ['nullable', 'string', 'max:30', 'min:1'/*,new InstgramRule()*/],
            'whatsapp' => ['nullable', 'digits:12','numeric'],
            'snapchat' => ['nullable', 'string', 'max:30', 'min:1'],
            'commission' => ['required','numeric'],

        ]);
        $request['mobile']='966'.$request->mobile;


        $object->name_en = $request->name_en;
        $object->ordering = $request->ordering;
        $object->name_ar = $request->name_ar;
        $object->return_policy_ar = $request->return_policy_ar;
        $object->return_policy_en = $request->return_policy_en;
        $object->mobile = $request['mobile'];
        $object->whatsapp = $request->whatsapp;
        $object->instagram = $request->instagram;
        $object->snapchat = $request->snapchat;
        $object->logo = $request->logo ?? '';
        $object->commission = $request->commission;
        $object->save();
        \HELPER::deleteUnUsedFile([$request->logo]);

        flash('تم التعديل بنجاح');

        return redirect(route('system.stores.index'));
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
            $o = Store::find($id);
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
            $o = Store::find($id);
            $o->status = 2;
            $o->save();
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
            $s = Store::find($id);
            $j = 0;
            if ($s->can_del) {

                $s->delete();
                $j++;
            }

        }
        return ['done' => $j];


    }


}
