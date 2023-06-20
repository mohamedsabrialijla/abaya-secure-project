<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductSizeResource;
use App\Models\Area;
use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\Favorite;
use App\Models\Gov;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderStatusLog;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ProductSize;
use App\Models\Settings;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Store;
use Auth;
use Illuminate\Http\Request;
use Request as GlobalRequest;
use Session;
use Validator;
use Illuminate\Support\Str;


class WebController extends Controller
{
    public function home()
    {
        $stores = Store::where('status', 1)->orderBy('ordering','asc')->get();
        $sliders = Slider::all();
        $offers = Offer::all();
        $categories = Category::where('full_width',0)->where('status', 1)->get();
        $cats = Category::where('full_width',1)->where('status', 1)->get();
        
        $features = Product::where('is_active', true)->where('is_feature', 1)->orderBy('ordering','asc')->take(10)->get();
        $sales = Product::where('is_active', true)->where('show_in_slider', '1')->orderBy('ordering','asc')->take(10)->get();
       
        return view('web.home', compact('categories', 'offers', 'features', 'sales', 'stores', 'sliders','cats'));
    }
    
    
    
    
    public function most_sell()
    {
        $products = Product::where('is_active', true)->where('show_in_slider', '1')->orderBy('ordering','asc')->take(10)->get();
        return view('web.most_sell', compact('products'));
    }

    public function special()
    {
        $products = Product::where('is_active', true)->where('is_feature', 1)->inRandomOrder()->take(10)->get();
        return view('web.favs_products', compact('products'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function terms()
    {
        $lang = app()->getLocale();
        $settings = new Settings();
        $content = $settings->valueOf('terms_and_conditions_' . $lang);
        return view('web.terms', compact('content'));
    }

    public function privacy()
    {
        $lang = app()->getLocale();
        $settings = new Settings();
        $content = $settings->valueOf('privacy_and_policy_' . $lang);
        return view('web.privacy', compact('content'));
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function send_msg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'msg' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile = $request->phone_number;
        $contact->message = $request->msg;

        $contact->save();

        $settings = new Settings();
        \Mail::send(
            'web.contact_email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone_number' => $request->get('phone_number'),
                'user_message' => $request->get('msg'),
            ),
            function ($message) use ($request, $settings) {
                $message->subject('رسائل تواصل معنا');
                $message->from($request->email);
                $message->to($settings->valueOf('email'));
                //   $message->to('info@abayasquare.com');
            }
        );

        return back()->with('success', __('site.msg_success'));
    }

    public function single_product($id)
    {
        $check = 0;
        if(session::get('p') != ''){
            $check = 1 ;
            session::put('p','');
        }
        $product = Product::with('category','coupons')->find($id);
        // return $product;
        $stock = 0;
        // dd($product->productSizes[0]->qty(),ProductSizeResource::collection($product->productSizes));
        if ($product && $product->is_active == 1) {
            foreach ($product->productSizes as $size) {
                $stock = $stock + $size->qty();
            }
            $coupons = $product->coupons;
            $sales = Product::whereNotIn('id', [$product->id])->where('category_id', $product->category_id)->where('is_active', 1)->inRandomOrder()->take(5)->get();

            $cartItems = \Cart::getContent(); 
            $products_ides = [];
            $quentites=[];
            foreach($cartItems as $k){
                array_push($products_ides,$k->attributes->product_id );
                array_push($quentites,$k->quantity );
            }
            $products = Product::with('category','store')->whereIn('id',$products_ides)->get();

            // return $product; 

            return view('web.single_product', compact('product', 'sales', 'coupons', 'stock','products','quentites','check'));
        } else {
            return redirect()->route('home');
        }
    }

    public function cat($id)
    {
        $cat = Category::find($id);
        // return $cat;
        if ($cat) {
            // $products = $cat->products;
            $products = Product::where('category_id', $id)->where('is_active', true)->orderBy('ordering','asc')->paginate(8);
            $products_without_paginate = Product::where('category_id', $id)->where('is_active', true)->get();
            return view('web.single_cat', compact('cat', 'products','products_without_paginate'));
        } else {
            return redirect()->route('home');
        }
    }

    public function store($id)
    {
        $store = Store::find($id);
        if ($store) {
            $products = $store->products;
            // dd($store->products);
            return view('web.single_store', compact('store', 'products'));
        } else {
            return redirect()->route('home');
        }
    }

    public function stores()
    {
        $stores = Store::where('status', 1)->orderBy('created_at','desc')->get();
        $sliders = Slider::all();
        return view('web.stores', compact('stores', 'sliders'));
    }

    public function favs()
    {
        if (Auth::guard('user')->check()) {
            $products = Auth::guard('user')->user()->favorites()->with('content')->get()->pluck('content');
            return view('web.fav', compact('products'));
        } else {
            return redirect()->route('home');
        }
    }

    public function add_to_fav($id)
    {
        if (Auth::guard('user')->check()) {
            $prodfav = Favorite::where('content_id', $id)->where('customer_id', Auth::guard('user')->user()->id)->first();
            if ($prodfav) {
                $prodfav->delete();
            } else {
                $data = [
                    'content_type' => Product::class,
                    'content_id' => $id,
                    'customer_id' => Auth::guard('user')->user()->id,
                ];
                Favorite::create($data);
            }

            return back()->with('success', __('api_texts.default_message'));
        } else {
            return redirect()->route('login')->with('info', __('site.login_msg'));
        }
    }

    public function cart()
    {
        //sjdfksdghjkd
        $cartItems = \Cart::getContent();
        $products_ides = [];
        $quentites=[];
        foreach($cartItems as $k){
            array_push($products_ides,$k->attributes->product_id );
            array_push($quentites,$k->quantity );
        }
        $products = Product::with('category','store')->whereIn('id',$products_ides)->get();

        return view('web.cart', compact('cartItems','products','quentites'));
    }




   public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'size' => 'required',
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $id = $request->id;
        $product = Product::findOrFail($id);
        session::put('p',$product->id);
        //jksfgkfgfk
        // $color = Color::findOrFail($request->color);
        $size = Size::findOrFail($request->size);
        $cart = session()->get('cart', []);
        $row_id = $product->id.$size->name;
        if (!is_null(\Cart::get($row_id))) {
            \Cart::update(
                $row_id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $request->quantity
                    ],
                ]
            );

        } else {
            \Cart::add(array(
                'id' => $row_id,
                'name' => $product->name,
                'price' => $product->sale_price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'product_id' => $product->id,
                    'size' => $size->name,
                    "size_id" => $size->id,
                    "image" => $product->image_url
                )
            ));
        }
        // $ship = new \Darryldecode\Cart\CartCondition(array(
        //     'name' => 'Shipping',
        //     'type' => 'shipping',
        //     'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
        //     'value' => '-25',
        //     'order' => 1
        // ));
        // \Cart::condition($ship);
        // \Cart::clear();

        // dd(\Cart::getContent());
        // if (isset($cart[$id])) {
        //     $cart[$id]['quantity'] + $request->quantity;
        //     $total = session()->get('cart_total') + ($product->sale_price * $request->quantity);
        // } else {
        //     $cart[$id] = [
        //         "name" => $product->name,
        //         "product_id" => $product->id,
        //         "quantity" => $request->quantity,
        //         // "color" => $color->name,
        //         "size_id" => $size->id,
        //         "size" => $size->name,
        //         "sale_price" => $product->sale_price,
        //         "price" => $product->sale_price * $request->quantity,
        //         "image" => $product->image_url
        //     ];
        //     $total = session()->get('cart_total') + ($product->sale_price * $request->quantity);
        // }
        // $total = 0;
        // foreach ($cart as $item) {
        //     $total = $total +($item['sale_price'] * $item['quantity']);
        // }
        // session()->put('cart_total', $total);
        // session()->put('cart', $cart);
        // dd($total,session()->get('cart_total'),session()->get('cart'));
        return redirect()->back()->with('success', trans('site.cart1'));
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            \Cart::update(
                $request->id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $request->quantity
                    ],
                ]
            );
            return redirect()->back()->with('success', trans('site.cart2'));
        }else{
            return back()->with('toast_error', 'حدث خطأ ما');

        }
    }


   public function remove(Request $request)
    {
        if ($request->id) {
            $products2= Product::with('category','store')->where('id',\Cart::get($request->id)->attributes->product_id)->get();
            \Cart::remove($request->id);

            $cartItems = \Cart::getContent();
            $products_ides = [];
            $quentites=[];
            foreach($cartItems as $k){
                array_push($products_ides,$k->attributes->product_id );
                array_push($quentites,$k->quantity );
            }
           $products_session = Product::with('category','store')->whereIn('id',$products_ides)->get();



            return back()->with('products2',$products2)->with('products_session',$products_session)->with('quentites',$quentites)->with('success', __('api_texts.default_message'));
        }else{
            return back()->with('toast_error', 'حدث خطأ ما');

        }
    }

    public function checkCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:coupons,code',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error',  __('site.co5'))->withInput();
        }

        $coupon = Coupon::query()->AbleToUse()->where('code', $request->code)->first();

        $cart = \Cart::getContent();
        if ($coupon) {
            if ($coupon->limit > \Cart::getSubTotal()) {
                return redirect()->back()->with('warning', __('api_texts.coupon_limit').$coupon->limit);
            }
            foreach ($cart as $product) {
                $pc = CouponProduct::where('coupon_id', $coupon->id)->where('product_id', (int)$product->attributes->product_id)->first();
                if ($pc) {
                    if ($coupon->flag == 1) {
                        $coupon_type = 'ratio';
                        $value = '-'.$coupon->discount_ratio.'%';
                        $desc = trans('site.co6');
                    } elseif ($coupon->flag == 2) {
                        $coupon_type = 'fixed';
                        $value = '-'.$coupon->discount_ratio;
                        $desc = trans('site.co7');
                    } elseif ($coupon->flag == 3) {
                        $coupon_type = 'ship';
                        $value = '0';
                        $desc = trans('site.co8');
                    }
                    $couponcon = new \Darryldecode\Cart\CartCondition(array(
                        'name' => $coupon->code,
                        'type' => $coupon_type,
                        'value' => $value,
                        'attributes' => array(
                            'description' => $desc,
                            'coupon_id' => $coupon->id
                        )
                    ));
                    \Cart::removeConditionsByType('ship');
                    if ($coupon->flag == 3) {
                        \Cart::condition($couponcon);
                    }
                    \Cart::clearItemConditions($product->id);
                    \Cart::addItemCondition($product->id, $couponcon);
                    // dd(\Cart::getConditionsByType('ratio')->first());
                } else {
                    return redirect()->back()->with('warning', __('api_texts.coupon_product'));
                }
            }
            return redirect()->back()->with('success', __('site.co4'));
        } else {
            return redirect()->back()->with('warning', __('api_texts.coupon_not_available'));
        }
    }

    // public function remove(Request $request)
    // {
    //     if ($request->id) {
    //         $cart = session()->get('cart');
    //         if (isset($cart[$request->id])) {
    //             $total = session()->get('cart_total') - ($cart[$request->id]['price']);
    //             unset($cart[$request->id]);
    //             session()->put('cart_total', $total);
    //             session()->put('cart', $cart);
    //         }
    //         return back()->with('success', __('api_texts.default_message'));
    //     }
    // }

    public function findCity($id)
    {
        if (app()->getLocale() == 'ar') {
            $states = Area::where("gov_id", $id)->pluck("name_ar", "id");
        } else {
            $states = Area::where("gov_id", $id)->pluck("name_en", "id");
        }

        return json_encode($states);
    }

    public function single_order($id)
    { 
        $order = Order::find($id);
        $order = $out = Order::findOrFail($id);
        
        $check = 0;
        //rjkgkerg
        //rjterjg
        //jfgerjhgr

        if(session::get('pp') !== '' && session::get('pp') == 1 ){
            $check = 1;
            session::put('pp',0);
        }else{
            $check = 0;
        }


        $product_ides = OrderProduct::where('order_id',$id)->pluck('product_id')->toArray();
        $products = Product::with('category','store')->whereIn('id',$product_ides)->get();
        $settings = new Settings();
        $currency = $settings->valueOf('currency_ar');
        $activityLog = $order->statusLog;
        $casenew = OrderStatusLog::where('order_id', $id)->where('case_id', 1)->first();
        $caseconfirm = OrderStatusLog::where('order_id', $id)->where('case_id', 3)->first();
        $caseshipping = OrderStatusLog::where('order_id', $id)->where('case_id', 4)->first();
        $caseshipped = OrderStatusLog::where('order_id', $id)->where('case_id', 5)->first();
        $casedelivery = OrderStatusLog::where('order_id', $id)->where('case_id', 6)->first();
        $casedelivered = OrderStatusLog::where('order_id', $id)->where('case_id', 7)->first();
        $pre_request = url()->previous();

 
        return view('web.single_order', compact('check','order', 'out', 'currency', 'activityLog', 'casenew', 'caseconfirm', 'caseshipping', 'caseshipped', 'casedelivery', 'casedelivered','check','products'))->with('success', __('api_texts.default_message'));
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'search'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $search = $request->search;
        $words = explode(' ', $request->search);

        foreach ($words as $word) {
            $products = Product::query()->where('is_active', true)
                ->where(function($qq) use($word){
                    $qq->where('name_ar','LIKE','%'.$word.'%')
                        ->orWhere('name_en','LIKE','%'.$word.'%')
                        ->orWhere('details_ar','LIKE','%'.$word.'%')
                        ->orWhere('details_en','LIKE','%'.$word.'%');
                });
        }
        $products = $products->latest()->get();
        return view('web.search', compact('products','search'));
    }
 

    public function table_size(){

        return view('web.table_size');
    }
}
