<?php

namespace App\Http\Controllers;

use App\Models\ProductTranslation;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Store;

class AjaxController extends Controller
{


    public function send_id($id)
    {
        /* session()->put('cart', []);
        session()->put('cart_ids', []);*/
        $product = Product::find($id);
        $product->counter = $product->counter + 1;
        $product->save();


        if (!empty(session('cart')) && !empty(session('cart_ids'))) {


            if (!in_array($id, session('cart_ids'))) {
                session()->push('cart', $product);
                session()->push('cart_ids', $id);
                if (isset($product->discount_ratio)) {
                    session()->put('total', session('total') + $product - ($product->new_price * $product->discount_ratio / 100));
                } else {
                    session()->put('total', session('total') + $product->new_price);

                    //dd(session('total'));
                }
            }
        } else {
            session()->put('cart', []);
            session()->put('cart_ids', []);
            session()->push('cart', $product);
            session()->push('cart_ids', $id);
        }
        return response()->json(['cart' => session()->get('cart'), 'total' => session("total")]);
    }

    public function get_total()
    {


        $money = request()->reserve_price;
        $total = 0;
        $ids = request()->ids;
        if (isset(request()->reserved)) {
            for ($i = 0; $i < count(request()->reserved); $i++) {
                $total = $total + $money[$i];
            }
        }


        for ($i = 0; $i < count($ids); $i++) {
            if (!in_array($ids[$i], request()->reserved)) {
                $product = Product::find($ids[$i]);
                $price = isset($product->after_discount_price) ? $product->after_discount_price : $product->new_price;
                $total = $total + $price;
            }
        }

        return response()->json($total);
    }


    public function get_category_attributes($id)
    {


        $products = product::where("category_id", $id)->get();
        $category = Category::find($id);
        $categoryAttributes = $category->size_attributes;


        return response()->json([$categoryAttributes]);
    }

    // public function search_top_header(Request $request){

    //     $data=[];
    //      //dd(request()->word);

    //     /*$products= ProductTranslatin::whereHas('translations', function ($query) use ($request) {

    //             $query->where('title', 'like', "%{$request->word}%");
    //     })->get();*/


    //     if($request->category=='All')


    //     {/*$data= Product::whereHas('translations',function($q) use($request){
    //         $q->where('title', 'like', "%{$request->word}%");

    //     })->with('files')->get();*/

    //        // $results= ProductTranslation::where('title', 'like', "%{$request->word}%")->get();

    //         $results=Product::where('active',1)->whereHas('translations',function($q) use($request){
    //             $q->where('title', 'like', "%{$request->word}%")->orWhere('description', 'like', "%{$request->word}%");

    //         })->with('files')->get();

    //         if($results->isNotEmpty())
    //             foreach ($results as  $result)
    //             {
    //                 array_push($data,$result);
    //             }



    //     //dd($data);



    //     }




    //     elseif($request->category=='Brands')

    //         $data= Brand::where('name','like', "%{$request->word}%")->get();

    //     else $data= Product::where('category_id',$request->category)->where('active',1)->whereHas('translations',function($q) use($request){
    //         $q->where('title', 'like', "%{$request->word}%");

    //     })->with('files')->get();

    //     return json_encode($data);


    // }

    public function search_top_header(Request $request)
    {

        $data = [];
        //  dd($request->word);

        /*$products= ProductTranslatin::whereHas('translations', function ($query) use ($request) {

                    $query->where('title', 'like', "%{$request->word}%");
            })->get();*/


        if ($request->category == 'All') {/*$data= Product::whereHas('translations',function($q) use($request){
                $q->where('title', 'like', "%{$request->word}%");

            })->with('files')->get();*/

            $results = ProductTranslation::where('title', 'like', "%{$request->word}%")->get();

            if ($results->isNotEmpty())
                foreach ($results as  $result) {
                    array_push($data, $result->product);
                }
            // dd($data);

        } elseif ($request->category == 'Brands')

            $data = Brand::where('name_ar', 'like', "%{$request->word}%")->orWhere('name_en', 'like', "%{$request->word}%")->get();

        else $data = Product::where('category_id', $request->category)->whereHas('translations', function ($q) use ($request) {
            $q->where('title', 'like', "%{$request->word}%");
        })->with('files')->get();



        return json_encode($data);
    }


    public function filter(Request $request)
    {
        $array = [];
        $products = new product();

        if (isset($request->category_id)) {

            $cat = Category::find($request->category_id);
            // if (is_null($cat->parent_id)) {
            //     $cats = Category::where('parent_id', $request->category_id)->pluck('id');
            //     $products = $products->whereIn("category_id", $cats)->orWhere('category_id', $request->category_id);
            //     // dd($word,$cat_id,$cat,is_null($cat->parent_id) ,$cats,$products);
            // } else {
            //     // $products=$query->where("category_id",explode('-',$word)[1])->paginate(4);
                $products = $products->where('category_id', $request->category_id);
            // }
        }

        if (!empty($request->brand)) {
            $products->whereIn('store_id', $request->brand);
        }

        if (!empty($request->type)) {
            $products->where('type', 'male');
        }


        if (!empty($request->color_id)) {
            $products->whereIn('color_id', $request->color_id);
        }


        // if (!empty($request->status)) {
        //     $products->whereIn('status', $request->status);
        // }

        $products->where('new_price', '>', (int)$request->min)
            ->where('new_price', '<', (int)$request->max);




        // if (!empty($request->values)) {
        //     foreach ($products->get()  as $product) {

        //         foreach ($product->size_attributes as $attribute) {
        //             // return response()->json($attribute);+
        //             if (in_array($attribute->pivot->attribute_value_id, $request->values))
        //                 array_push($array, $product->id);
        //         }
        //     }


        //     $products = $products->whereIn('id', $array);
        // }
//

        $products = $products->get();

        if (!empty($products))
            $output = view('load_products', compact('products'))->render();
        else
            $output = "<h1>  للم تنجح نتيجه بحثك ): </h1>";
            dd($output);
        return response()->json(['output' => $output]);
    }



    public function countDown($id)
    {

        $product = Product::find($id);
        $classes = session('cart');
        $ids = session('cart_ids');
        foreach ($classes as $index => $val) {
            if ($classes[$index]['id'] == $product->id) {
                unset($classes[$index]);
                $newClassData = array_values($classes);
                session()->put('cart', $newClassData);
            }
            if ($ids[$index] == $product->id) {

                unset($ids[$index]);

                $newClass = array_values($ids);
                session()->put('cart_ids', $newClass);
                // dd(session('cart_ids'));
            }
        }
        $product->counter = $product->counter - 1;
        $product->save();
        return response()->json(['classes' => session('cart')]);
    }


    public function follow_product($id, $flag)
    {

        $user = auth()->user();
        //dd($user->flagged_products);
        if ($flag == 0)
            $user->flagged_products()->detach($id);
        if ($flag == 1)
            $user->flagged_products()->attach($id);



        return response()->json("success");
    }

    public function checkout()
    {


        return view('checkout');
    }



    public function unreadNotifications()
    {


        foreach (auth()->user()->unreadNotifications  as $not)
            $not->markAsRead();
    }
}
