<?php

namespace App\Http\Controllers;

use App\Events\SendUsersNotification;
use App\Models\Category;
use App\Models\Color;
use App\Models\GlobalNotification;
use App\Models\ImageType;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductProperty;
use App\Models\ProductSize;
use App\Models\Property;
use App\Models\Size;
use App\Models\Clothes;
use App\Models\Style;
use App\Models\Stock;
use App\Models\OrderProduct;
use App\Models\Store;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:slider_products|feature_products|activate_products|view_products|add_products|edit_products|delete_products,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_products,system_admin', ['only' => ['create','showCreateView']]);
        $this->middleware('permission:edit_products,system_admin', ['only' => ['showUpdateView','Update']]);
        $this->middleware('permission:delete_products,system_admin', ['only' => ['delete']]);
        $this->middleware('permission:feature_products,system_admin', ['only' => ['getFeatureProducts','postFeatureProducts']]);
        $this->middleware('permission:slider_products,system_admin', ['only' => ['getProductsInSlider','change_show_in_slider']]);
    }

    public function index(Request $request,$storeId=null)
    {
        
        $o = Product::withCount('orders')->with('category')->orderBy('ordering','asc');
        // return $o->get();
        if ($request->name) {
            $name = $request->name;
            $o=  $o->where(function ($q) use ($name) {
                $q->where('name_ar', 'like', '%' . $name . "%")
                    ->orWhere('name_en', 'like', '%' . $name . "%");
            });

        }
        // if ($request->category_id > 0) {
        //     $o=  $o->where("category_id", $request->category_id);
        // }
        // if ($request->category_id > 0) {
        //     $o=   $o->where("category_id", $request->category_id);
        // }
        if ($request->filled('store_id')) {
            $o=   $o->where("store_id", $request->store_id);
        }
        if ($storeId) {
            $o=   $o->where("store_id", $storeId);
        }
        if ($request->status > -1) {
            $o=   $o->where('is_active', $request->status);
        }
        if ($request->price_from) {
            $o=   $o->where('price', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o= $o->where('price', '<=', $request->price_to);
        }
        $out = $o->paginate(20);
        $out->appends($request->all());
        $categories = Category::query()->get();
        
        // return $out;
        
        
        return view('system_admin.products.index', compact('out', 'categories','storeId'));

    }
    public function index2(Request $request,$storeId=null)
    {

        $o = Product::withCount('orders')->with('category')->orderBy('ordering', 'asc');
        if ($request->name) {
            $name = $request->name;
            $o=  $o->where(function ($q) use ($name) {
                $q->where('name_ar', 'like', '%' . $name . "%")
                    ->orWhere('name_en', 'like', '%' . $name . "%");
            });

        }
        // if ($request->category_id > 0) {
        //     $o=  $o->where("category_id", $request->category_id);
        // }
        // if ($request->category_id > 0) {
        //     $o=   $o->where("category_id", $request->category_id);
        // }
        if ($request->filled('store_id')) {
            $o=   $o->where("store_id", $request->store_id);
            Session()->put('store_id',$request->store_id);
        }
        if ($storeId) {
            $o=   $o->where("store_id", $storeId);
            Session()->put('store_id',$storeId);
        }
        if ($request->status > -1) {
            $o=   $o->where('is_active', $request->status);
        }
        if ($request->price_from) {
            $o=   $o->where('price', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o= $o->where('price', '<=', $request->price_to);
        }
        $out = $o->paginate(20);
        $out->appends($request->all());
        $categories = Category::query()->get();
        return view('system_admin.stores.products', compact('out', 'categories','storeId'));

    }


    public function showCreateView($storeId=null)
    {
        $categories = Category::all();
        $stores = Store::all();
        $colors = Color::all();
        $sizeslist = Size::all();
        $clothes_list = Clothes::all();
        $style_list = Style::all();
        $properties = Property::all();
        $max = Product::max('ordering');
      
        $store_name=null;
        if($storeId){
            $store_name=Store::find($storeId);
        }
        return view('system_admin.products.create',
            compact('categories', 'properties','stores','colors','sizeslist','storeId','store_name','max','clothes_list','style_list'));

    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'name_ar' => ['required'],
            'name_en' => ['required', new ValidString()],
            'ratio' => 'required|numeric|min:0|max:100',
            'price' => 'required|numeric|min:1|max:99999',
            // 'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'details_ar' => 'required',
            'details_en' => 'required',
            'images' => 'required',
            'def_image' => 'required',
            'colors'=>'nullable',
            'clothes'=>'nullable',
            'style'=>'nullable',
            'sizes'=> ["required","array","min:1"],
            'categories'=> ["required","array","min:1"],
            'annotation_ar'=>['nullable', new ValidStringArabic()],
            'annotation_en'=>['nullable', new ValidString()],
            'feature_image' => 'nullable',

        ]);

        if ( $request->get('is_feature')){
           $products = Product::where('is_feature',1)->count();
           if ($products >= 18){
               flash('لا يمكن إضافة المنتج كمنتج مميز ، وصل عدد المنتجات المميزة للحد الأقصى');

               return redirect()->back();
           }
        }

        $object = new Product();
        $object->ordering = $request->ordering;
        $object->name_en = $request->name_en;
        $object->name_ar = $request->name_ar;
        $object->details_ar = $request->details_ar;
        $object->details_en = $request->details_en;
        $object->discount_ratio = $request->ratio;
        $object->sale_price =$request->ratio?round(($request->price - (($request->price * ($request->ratio / 100)))),2):$request->price;
        $object->price = $request->price;
        // $object->category_id = $request->category_id;
        $object->store_id = $request->store_id;
        $object->is_offer = $request->get('is_banner', 0) ? 1 : 0;

        $object->show_in_slider = $request->get('show_in_slider') ? 1 : 0;
        $object->is_feature = $request->get('is_feature') ? 1 : 0;
        $object->cod = $request->get('cod') ? 1 : 0;
        $object->is_active = $request->get('is_active') ? 1 : 0;
        $object->annotation_ar = $request->annotation_ar;
        $object->annotation_en = $request->annotation_en;
        $object->feature_image = $request->feature_image;
        $object->slider_image = $request->slider_image;
        \HELPER::deleteUnUsedFile([$request->feature_image]);
        // $object->status = 1;
        $object->save();
        if ($request->images) {
            $p_images = json_decode(trim($request->images));
            \HELPER::deleteUnUsedFiles($p_images);
            foreach ($p_images as $m) {
                $pImage = new ProductImage();
                $pImage->product_id = $object->id;
                $pImage->image = $m;
                $pImage->is_main = $m == $request->def_image ? 1 : 0;
                $pImage->save();
            }
        }


        if ($object) {

            foreach ($request->sizes as $v) {
                if (isset($v['id'])) {
                    $productSizes=new ProductSize();
                    $productSizes->product_id=$object->id;
                    $productSizes->size_id=$v['id'];
                    $productSizes->save();

                    $productSizes->stock()->create([
                        'qty'=>$productSizes->qty=$v['qty']
                    ]);
                }
            }
//            $object->sizes()->sync($request->sizes);



            $object->colors()->sync($request->colors);
            $object->clothes()->sync($request->clothes);
             $object->style()->sync($request->style);
             $object->categories()->sync($request->categories);
        }
        
        
        if ($object) {

            foreach ($request->clothes as $v) {
                if (isset($v['id'])) {
                    $productSizes=new ProductClothes();
                    $productSizes->product_id=$object->id;
                    $productSizes->clothes_id=$v['id'];
                    $productSizes->save();

                    $productSizes->stock()->create([
                        'qty'=>$productSizes->qty=$v['qty']
                    ]);
                }
            }
//            $object->sizes()->sync($request->sizes);



            $object->colors()->sync($request->colors);
            $object->clothes()->sync((array)$request->clothes);
             $object->style()->sync((array)$request->style);
        }

        flash('تمت الاضافة بنجاح');

        if ($request->get('has_notification')) {
            $notification = new GlobalNotification();
            $notification->title = 'تم اضافة منتج جديد ' . $object->name;
            $notification->message = 'تم اضافة منتج جديد ' . $object->name;
            $notification->system_admin_id = Auth::guard('system_admin')->user()->id;
            $notification->save();
            $notification->fresh();
            event(new SendUsersNotification(null, 'AdminNotification', ['global_notification' => $notification->id], 1, 1, $object->image_url));

        }
        return redirect(route('system.products.index'));
    }

    public function showUpdateView($id)
    {
        $categories = Category::all();
        $properties = Property::all();
        $stores = Store::all();
        $colors_list = Color::all();
        $clothes_list = Clothes::all();
        $style_list = Style::all();
        $sizeslist = Size::all();
        $out = Product::find($id);
        $product_sizes=$out->productSizes()->get()->pluck('size_id')->toArray();
        $product_colors=$out->colors()->get()->pluck('id')->toArray();
         $product_clothes=$out->clothes()->get()->pluck('id')->toArray();
          $product_style=$out->style()->get()->pluck('id')->toArray();
          $product_categories=$out->categories()->get()->pluck('id')->toArray();
        //   return $product_categories;
        return view('system_admin.products.update',
            compact('out', 'stores','categories', 'properties','colors_list','sizeslist','product_sizes','product_colors','clothes_list','style_list','product_clothes','product_style','product_categories'));
    }


    public function update(Request $request, $id)
    {

        // return $request->all();

        $this->validate($request, [
            'name_ar' => ['required' ],
            'name_en' => ['required', new ValidString()],
            'ratio' => 'required|numeric|min:0|max:100',
            'price' => 'required|numeric|min:1|max:99999',
            // 'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'details_ar' => 'required',
            'details_en' => 'required',
             'clothes'=>'nullable',
            'style'=>'nullable',

           // 'colors'=>'required',
            'sizes'=> ["required","array","min:1"],
            'categories'=> ["required","array","min:1"],
            'annotation_ar'=>['nullable', new ValidStringArabic()],
            'annotation_en'=>['nullable', new ValidString()],
            'feature_image' => 'nullable',
            // 'slider_image' => "required_if:show_in_slider,==,on",
        ]);

        if ( $request->get('is_feature')){
            $products = Product::where('is_feature',1)->count();
            if ($products >= 18){
                flash('لا يمكن إضافة المنتج كمنتج مميز ، وصل عدد المنتجات المميزة للحد الأقصى');

                 return redirect()->back()->withInput();
            }
        }

        $object = Product::find($id);
        $object->ordering = $request->ordering;
        $object->name_en = $request->name_en;
        $object->name_ar = $request->name_ar;
        $object->details_ar = $request->details_ar;
        $object->details_en = $request->details_en;
        $object->discount_ratio = $request->ratio;
        $object->price = $request->price;
        // $object->category_id = $request->category_id;
        $object->sale_price =$request->ratio?round(($request->price - (($request->price * ($request->ratio / 100)))),2):$request->price;
        $object->store_id = $request->store_id;
        $object->is_offer = $request->get('is_banner', 0) ? 1 : 0;
            if($request->get('show_in_slider')){
                $object->slider_image=$request->slider_image;
            }
        $object->show_in_slider = $request->get('show_in_slider') ? 1 : 0;
        $object->is_feature = $request->get('is_feature') ? 1 : 0;
        $object->cod = $request->get('cod') ? 1 : 0;
        $object->is_active = $request->get('is_active') ? 1 : 0;
        $object->annotation_ar = $request->annotation_ar;
        $object->annotation_en = $request->annotation_en;
        $object->feature_image = $request->feature_image;
        \HELPER::deleteUnUsedFile([$request->feature_image]);

        $object->save();

        if ($object) {


            if ($request->sizes) {
                // delete previous size not exist in updated sizes
                    $newSizes= collect($request->sizes)->pluck('id')->toArray();
                    $newSizes = array_map('intval', $newSizes);
                    $previousSizes=$object->productSizes()->pluck('size_id')->toArray();
                    foreach($previousSizes as $prevSize){
                        if(!in_array($prevSize,$newSizes)){
                             $productSize= ProductSize::where('product_id',$object->id)->where('size_id',$prevSize)->first();
                            if($productSize){
                                $productSize->stock()->delete();
                                $productSize->delete();
                            }
                        }
                    }
                foreach ($request->sizes as $v) {

                    if (isset($v['id']) && !in_array((int)$v['id'],$previousSizes)) {
                        $productSizes=new ProductSize();
                        $productSizes->product_id=$object->id;
                        $productSizes->size_id=$v['id'];
                        $productSizes->save();
                        if(isset($v['qty'])){
                            $productSizes->stock()->create([
                                'qty'=>$productSizes->qty=$v['qty']
                            ]);
                        }

                    }
                }

        //            $object->sizes()->sync((array)$request->sizes);
        }
            $object->colors()->sync((array)$request->colors);
            $object->clothes()->sync((array)$request->clothes);
             $object->style()->sync((array)$request->style);
             $object->categories()->sync((array)$request->categories);
        }

        flash('تم التعديل بنجاح');
        return redirect(route('system.products.index'));
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
            $o = Product::find($id);
            $o->is_active = 1;
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
            $o = Product::find($id);
            $o->is_active = 0;
            $o->save();
        }
        return ['done' => 1];

    }

    public function change_offer_status(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $o = Product::find($id);
            $o->is_offer = $o->is_offer == 1 ? 0 : 1;
            $o->save();
        }
        return ['done' => 1];

    }

    public function deleteStock(Request $request)
    {
        $id = $request->id;
        $s = Stock::find($id);
        $product_size_id=$s->product_size_id;

        if($s->delete()){
            $qty=ProductSize::find($product_size_id);
            $qty=$qty->qty();
            return ['done' => 1,
                    "qty"=>$qty];
        }
        return ['done' => 0];
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
            $s = Product::find($id);
                foreach ($s->images as $i) {
                    try {
                        unlink("./uploads/" . $i->image);

                    } catch (\Exception $e) {
                    }
                    $i->delete();
                }
                $s->delete();
        }
        return ['done' => 1];


    }


    public function delete_image(Request $request)
    {
        $image = ProductImage::find($request->image);
        $place = $image->product_id;
        try {
            unlink("./uploads/" . $image->image);

        } catch (\Exception $e) {
        }
        $image->delete();
        $out = Product::find($place);
        $view = \View::make('system_admin.products.images', compact('out'));
        $output = $view->render();
        return ['out' => $output, 'status' => 1];

    }

    public function saveMultiFileJson(Request $request)
    {
        $this->validate($request, ['uploaded_files.*' => 'image']);
        $place = $request->place;
        if (is_array($request->uploaded_files)) {
            foreach ($request->uploaded_files as $file) {
                if ($name = MediaController::SaveFileM($file)) {

                    $pImage = new ProductImage();
                    $pImage->product_id = $place;
                    $pImage->image = $name;
                    $pImage->save();

                } else {
                    return ['status' => 0, 'errors' => 'ERROR'];
                }
            }

            $out = Product::find($place);
            $view = \View::make('system_admin.products.images', compact('out'));
            $output = $view->render();
            return ['out' => $output, 'status' => 1];
        }

        return ['status' => 0, 'errors' => 'ERROR'];

    }

    public function defaultIMG(Request $request)
    {
        $image = ProductImage::find($request->image);
        $place = $image->product_id;
        $oldDef = ProductImage::where('product_id', $place)->where('is_main', 1)->get();
        foreach ($oldDef as $o) {
            $o->is_main = 0;
            $o->save();
        }

        $image->is_main = 1;
        $image->save();

        $out = Product::find($place);
        $view = \View::make('system_admin.products.images', compact('out'));
        $output = $view->render();
        return ['out' => $output, 'status' => 1, 'default' => url('uploads/' . $image->image)];

    }



    /********************************************************/
    //   Feature Products
    /********************************************************/

    public function getFeatureProducts(Request $request)
    {
        $categories = Category::query()->get();

        $o = Product::where('is_feature',1);
        
        if ($request->name) {
            $name = $request->name;
            $o->where(function ($q) use ($name) {
                $q->where('name_ar', 'like', '%' . $name . "%")
                    ->orWhere('name_en', 'like', '%' . $name . "%");
            });

        }
        // if ($request->category_id > 0) {
        //     $o->where("category_id", $request->category_id);
        // }
        if ($request->status > -1) {
            $o->where('is_active', $request->status);
        }
        if ($request->price_from) {
            $o->where('price', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('price', '<=', $request->price_to);
        }

        $out = $o->orderBy('created_at','desc')->get();
        // return $out;
        
        return view('system_admin.products.features', compact('out','categories'));

    }

    public function postFeatureProducts(Request $request)
    {

        $this->validate($request, [
            'annotation_ar'=>['required'],
            'annotation_en'=>['required'],
            'feature_image'=>['nullable'],

        ]);
        $out = Product::findOrFail($request->id);
        $out->annotation_ar = $request->annotation_ar;
        $out->annotation_en = $request->annotation_en;
        if($request->filled('feature_image')){
            $out->feature_image = $request->feature_image;
             \HELPER::deleteUnUsedFile([$request->feature_image]);
        }


        $out->is_feature  = 1;
        $out->save();

        if ($out){
            $product = Product::where('id',$out->id)->get()->toArray();
        }
        return response()->json($product);
    }
    public function updateSliderImage(Request $request)
    {

        $this->validate($request, [

            'slider_image'=>['required'],

        ]);
        $out = Product::findOrFail($request->id);

        if($request->filled('slider_image')){
            $out->slider_image = $request->slider_image;
            \HELPER::deleteUnUsedFile([$request->feature_image]);
        }
        $out->show_in_slider  = 1;
        $out->save();

        if ($out){
            $product = Product::where('id',$out->id)->get()->toArray();
        }
        return response()->json($product);
    }
    public function change_show_feature_product(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $o = Product::find($id);
            $o->is_feature = $o->is_feature == 1 ? 0 : 1;
            $o->save();
        }
        return ['done' => 1];

    }


    public function getProductsInSlider(Request $request)
    {
        $categories = Category::query()->get();
        $o=Product::orderBy('id','DESC')->where('show_in_slider',1);
        if ($request->name) {
            $name = $request->name;
            $o->where(function ($q) use ($name) {
                $q->where('name_ar', 'like', '%' . $name . "%")
                    ->orWhere('name_en', 'like', '%' . $name . "%");
            });

        }
        // if ($request->category_id > 0) {
        //     $o->where("category_id", $request->category_id);
        // }
        if ($request->status > -1) {
            $o->where('is_active', $request->status);
        }
        if ($request->price_from) {
            $o->where('price', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $o->where('price', '<=', $request->price_to);
        }

        $out = $o->paginate(20);
        $out->appends($request->all());
        return view('system_admin.products.sliders', compact('out','categories'));

    }

    public function change_show_in_slider(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;

        }
        foreach ($ids as $id) {
            $o = Product::find($id);
            $o->show_in_slider = $o->show_in_slider == 1 ? 0 : 1;
            $o->save();
        }
        return ['done' => 1];

    }


    public function changeIsActive(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $product->is_active = $request->get('is_active') ? 1 : 0;
        $product->save();

        return ['done' => 1];
    }
    public function productSizes(Product $product){
        $data['product']=$product;
        $data['title']='مقاسات منتج '.$product->name;
        return view('system_admin.products.sizes',$data);
    }
    
    public function productOrders(Request $request, Product $product){
        $data['product']=$product;
        $out = OrderProduct::where('product_id',$product->id)->with('order.status','order.customer','size','color')->doesntHave('order2')->orderBy('id', 'desc')->paginate(20);
        
        //jkffjkwer
        //gererh
        
        // if ($request->date_from) {
        //     $date_from = Carbon::parse($request->date_from)->toDateString();
            
        //     $out->whereHas('order', function (Builder $query)use($date_from) {
        //             $query->where('created_at', '>=', $date_from);
        //         });
        //     // $out = $out->whereDate('created_at', '>=', $date_from);
        // }
        // if ($request->date_to) {
        //     $date_to = Carbon::parse($request->date_to)->toDateString();
        //      $out = $out->whereHas('order', function (Builder $query)use($date_from) {
        //             $query->where('created_at', '<=', $date_from);
        //         });
        //     // $out = $out->whereDate('created_at', '<=', $date_to);
        // }
        
        // $out = $out->orderBy('id', 'desc')->paginate(20);
        
        
        $data['title']='طلبات '.$product->name;
        return view('system_admin.products.orders',compact('out'));
    }
    
    
    public function addProductSizeQuantity(Request $request)
    {

        $this->validate($request, [
            'product_size_id'=>['required'],
            'qty'=>['required'],
            'activeTab'=>['nullable'],


        ]);
        $productSize=ProductSize::find($request->product_size_id);
        if($productSize){
            $product=$productSize->product;
            $productSize->stock()->create([
                'qty'=>$request->qty
            ]);
            return redirect()->route('system.products.sizes',$product->id)->with('active_tab',$request->activeTab);
        }

    }


    public function withdrawProductSizeQuantity(Request $request)
    {

        $this->validate($request, [
            'product_size_id'=>['required'],
            'withdraw_qty'=>['required'],
            'reason'=>['required'],
            'activeTab'=>['nullable'],
        ]);

        $productSize=ProductSize::find($request->product_size_id);
        if($productSize){
            $product=$productSize->product;
            $productSize->stock()->create([
                'qty'=>$request->withdraw_qty,
                'type'=>'withdraw',
                'reason'=>$request->reason,
            ]);

            return redirect()->route('system.products.sizes',$product->id)->with('active_tab',$request->activeTab);
        }

    }
    public function ProductSizeQuantityUpdate(Request $request)
    {

        $this->validate($request, [
            'product_size_id'=>['required'],
            'stock_id'=>['required'],
            'new_qty'=>['required'],

        ]);

        $stock=Stock::find($request->stock_id);
        $productSize=ProductSize::find($request->product_size_id);
        if($stock){
            $product=$productSize->product;
            $stock->update([
                'qty'=>$request->new_qty
            ]);


            return redirect()->route('system.products.sizes',$product->id)->with('active_tab',$request->activeTab);
        }

    }

}
