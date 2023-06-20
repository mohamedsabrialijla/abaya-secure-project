<?php

namespace App\Http\Controllers;

use App\Models\AdminRule;
use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderCase;
use App\Models\Product;
use App\Models\Property;
use App\Models\Size;
use App\Models\Style;
use App\Models\Clothes;
 use App\Models\Area;
use App\Models\Store;
use App\Models\WorkEvent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SystemAdminController extends Controller
{
    //
    private $isApiRequest;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->middleware('auth:system_admin');
        $this->isApiRequest = ControllersService::isApiRoute($request);
    }

    public function home()
    {

        $counts=[];

        $counts[]=[
            'url'=>route('system.orders.mainIndex'),
            'text'=>'جميع الطلبات',
            'count'=>Order::count(),
            'count_text'=>' طلب'
        ];

        $counts[]=[
            'url'=>route('system.orders.index').'?status=new',
            'text'=>'الطلبات الجديدة',
            'count'=>Order::whereIn('case_id',[1])->count(),
            'count_text'=>' طلب'
        ];
        $counts[]=[
            'url'=>route('system.orders.index').'?status=delivery in progress',
            'text'=>'طلبات جاري التوصيل',
            'count'=>Order::whereIn('case_id',[6])->count(),
            'count_text'=>' طلب'
        ];
        $counts[]=[
            'url'=>route('system.orders.index').'?status=delivered',
            'text'=>'طلبات تم التوصيل',
            'count'=>Order::whereIn('case_id',[7])->count(),
            'count_text'=>' طلب'
        ];
        $counts[]=[
            'url'=>route('system.orders.index').'?status=canceled',
            'text'=>'طلبات ملغاه',
            'count'=>Order::whereIn('case_id',[2])->count(),
            'count_text'=>' طلب'
        ];
        $counts[]=[
            'url'=>route('system.products.index'),
            'text'=>'منتجات',
            'count'=>Product::count(),
            'count_text'=>' منتج'
        ];
        $counts[]=[
            'url'=>route('system.stores.index'),
            'text'=>'مصممون',
            'count'=>Store::count(),
            'count_text'=>' مصمم'
        ];
        $counts[]=[
            'url'=>route('system.users.index'),
            'text'=>'مستخدمون',
            'count'=>Customer::count(),
            'count_text'=>' مستخدم'
        ];
        $counts[]=[
            'url'=>'#',
            'text'=>'إجمالي المبيعات',
            'count'=>Order::whereIn('case_id',[7])->sum('total'),
            'count_text'=>' ريال'
        ];
        $newOrders=Order::orderBy('id','desc')->take(6)->get();


        $order_cases = OrderCase::query()->get();
        $orders = Order::query()->get();
        $order_case_statistics = [];

        foreach ($order_cases as $index => $case) {
            $order_case_statistics[$index] = [
                'count' => $orders->where('case_id', $case->id)->count(),
                'name_ar' => $case->name_ar,
                'name_en' =>  $case->name_en,
                'hex_color' => $case->hex_color,
            ];
        }

        $order_case_statistics = collect($order_case_statistics);
        return view('system_admin.dashboard',compact('counts','newOrders','order_case_statistics'));

    }
    public function generalProperties(Request $request){

        $categories = Category::where('full_width',0)->count();
        $categories_s = Category::where('full_width',1)->count();
        $properties = Property::query()->count();
        $sizes = Size::query()->count();
        $areas = Area::query()->count();
        $colors = Color::query()->count();
        $styles = Style::query()->count();
        $clothes = Clothes::query()->count();
        return view('system_admin.general_properties',
           // compact('categories','properties','sizes','colors'));
            compact('categories','properties','sizes','colors','areas','categories_s','styles','clothes'));
    }

}
