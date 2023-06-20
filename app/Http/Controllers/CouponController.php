<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\Product;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:activate_coupons|view_coupons|add_coupons|edit_coupons|delete_coupons,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_coupons,system_admin', ['only' => ['create','showCreateView']]);
        $this->middleware('permission:edit_coupons,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_coupons,system_admin', ['only' => ['delete']]);
    }
    public function index(Request $request)
    {
         $stores = Store::all();
        $o = Coupon::with('designer')->orderBy('id', 'DESC');

        if ($request->name) {

            $o=  $o->where('code', 'like', '%' . $request->name . "%");
        }

        if ($request->filled('store_id')) {
            $o=   $o->where("store_id", $request->store_id);
        }
        if ($request->status > -1) {
            $o=   $o->where('is_active', $request->status);
        }
        if ($request->date_from) {
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o= $o->whereDate('start_date', '>=', $date_from);
        }
        if ($request->date_to) {
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o=$o->whereDate('expire_date', '<=', $date_to);
        }
        $out = $o->paginate(20);
        $out->appends($request->all());

        return view('system_admin.coupons.index', compact('out','stores'));

    }


    public function showCreateView()
    {

        $stores = Store::all();
        $cats = Category::where('id', '>', 0)->get();
        $products = Product::where('is_active', true)->get();

        return view('system_admin.coupons.create', compact('stores', 'cats', 'products'));

    }
    public function orders($id)
    {

        $coupon = Coupon::find($id);
        $out =$coupon->orders;

        return view('system_admin.coupons.orders', compact('coupon', 'out'));

    }


    public function create(Request $request)
    {

       // return $request;
        $date = Carbon::now()->toDateString();

        $this->validate($request, [

            'discount_ratio' => 'required|numeric|min:0|max:100',
            'flag' => 'required|numeric',
            'count_of_use' => 'required|numeric',
          //  'count_of_use_per_customer' => 'nullable|numeric',
            'code' => 'required|max:10|unique:coupons,code',
            'start_date' => 'required|date|after_or_equal:'.$date,
            'expire_date' => 'required|date|after_or_equal:start_date',

        ]);

        $object = new Coupon();
        $object->discount_ratio = $request->discount_ratio;
        $object->count_of_use = $request->count_of_use;
       // $object->count_of_use_per_customer = $request->count_of_use_per_customer;
        $object->code = $request->code;
        $object->flag = $request->flag;
        $object->limit = $request->limit;
        $object->start_date = $request->start_date;
        $object->expire_date = $request->expire_date;
        $object->is_active = $request->get('is_active') ? 1 : 0;
        $object->show = $request->get('show') ? 1 : 0;

        $object->save();

        if (!empty($request->products)) {
            # code...

            foreach ($request->products as $product) {
                $d = new CouponProduct();
                $d->coupon_id = $object->id;
                $d->product_id = $product;
                $d->save();
            }
        }
        if (!empty($request->cats)) {
            foreach ($request->cats as $cat) {
                $c = Category::find($cat);
                foreach ($c->products as $value) {
                    $d1 = new CouponProduct();
                    $d1->coupon_id = $object->id;
                    $d1->product_id = $value->id;
                    $d1->save();
                }
            }
        }
        if (!empty($request->stores)) {
            foreach ($request->stores as $store) {
                $s = Store::find($store);
                foreach ($s->products as $value) {
                    $d2 = new CouponProduct();
                    $d2->coupon_id = $object->id;
                    $d2->product_id = $value->id;
                    $d2->save();
                }
            }
        }

        flash('تمت الاضافة بنجاح');

        return redirect(route('system.coupons.index'));
    }

    public function showUpdateView($id)
    {

        $stores = Store::all();
        $cats = Category::where('id', '>', 0)->get();
        $products = Product::where('is_active', true)->get();
        $out = Coupon::find($id);
        return view('system_admin.coupons.update',
            compact('out', 'stores', 'cats', 'products'));
    }


    public function update(Request $request, $id)
    {
        $object = Coupon::find($id);

        $this->validate($request, [

            'discount_ratio' => 'required|numeric|min:0|max:100',
            'flag' => 'required|numeric',
            'count_of_use' => 'required|numeric',
          //  'count_of_use_per_customer' => 'nullable|numeric',
            'code' => 'required|max:10|unique:coupons,code,'.$object->id,
            'start_date' => 'required|date',
            'expire_date' => 'required|date|after_or_equal:start_date',

        ]);

        $object->discount_ratio = $request->discount_ratio;
        $object->count_of_use = $request->count_of_use;
       // $object->count_of_use_per_customer = $request->count_of_use_per_customer;
        $object->code = $request->code;
        $object->flag = $request->flag;
        $object->limit = $request->limit;
        $object->start_date = $request->start_date;
        $object->expire_date = $request->expire_date;
        $object->is_active = $request->get('is_active') ? 1 : 0;
        $object->show = $request->get('show') ? 1 : 0;

        $object->save();
        if (!empty($request->products)) {
            # code...
            $old = CouponProduct::where('coupon_id',$id)->delete();

            foreach ($request->products as $product) {
                $d = new CouponProduct();
                $d->coupon_id = $object->id;
                $d->product_id = $product;
                $d->save();
            }
        }
        if (!empty($request->cats)) {
            foreach ($request->cats as $cat) {
                $c = Category::find($cat);
                foreach ($c->products as $value) {
                    $d1 = new CouponProduct();
                    $d1->coupon_id = $object->id;
                    $d1->product_id = $value->id;
                    $d1->save();
                }
            }
        }
        if (!empty($request->stores)) {
            foreach ($request->stores as $store) {
                $s = Store::find($store);
                foreach ($s->products as $value) {
                    $d2 = new CouponProduct();
                    $d2->coupon_id = $object->id;
                    $d2->product_id = $value->id;
                    $d2->save();
                }
            }
        }
        flash('تم التعديل بنجاح');

        return redirect(route('system.coupons.index'));
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
            $s = Coupon::find($id);
                $s->delete();
        }
        return ['done' => 1];

    }


    public function activate(Request $request)
    {
        $ids=[];
        if (is_array($request->id)) {
            $ids=$request->id;
        } else {
            $ids[]=$request->id;

        }
        foreach ($ids as $id) {
            $o = Coupon::find($id);
            $o->is_active=1;
            $o->save();

        }
        return ['done' => 1];

    }

    public function deactivate(Request $request)
    {
        $ids=[];
        if (is_array($request->id)) {
            $ids=$request->id;
        } else {
            $ids[]=$request->id;

        }
        foreach ($ids as $id) {
            $o = Coupon::find($id);
            $o->is_active=0;
            $o->save();
        }
        return ['done' => 1];

    }


}
