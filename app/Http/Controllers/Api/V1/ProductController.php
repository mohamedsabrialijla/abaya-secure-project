<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\ApiResponseStatusCodes;
use App\Events\SendUsersNotification;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SimpleProductResource;
use App\Models\Favorite;
use App\Models\Offer;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductSearchLog;
use App\Models\Rating;
use App\Models\Slider;
use App\Models\Store;
use App\Rules\ValidString;
use App\Rules\ValidStringArabic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
class ProductController extends Controller
{


    /**
     * @OA\Post(
     *      path="/api/v1/customer/product/add-remove-product-wishlist",
     *      operationId="Customer add remove product wishlist",
     *      tags={"Customer products"},
     *      summary="Add/remove products wishlist/Favorite",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"product_id"},
     *          @OA\Property(
     *                     property="product_id",
     *                     description=" product_id",
     *                     type="string",
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user object"
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="status = false : unauthorized customer"
     *     )
     * )
     **/

    public function addRemoveProductWishlist(Request $request)
    {
//
//        $validator = Validator::make($request->all(), [
//            'product_id' => 'required|exists:products,id',
//        ]);
//        if ($validator->fails()) {
//            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
//
//        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);


        DB::beginTransaction();

        try {
            $customer_id = $request->user('customer')->id;
            $prev = Favorite::where('content_id', $request->product_id)->where('content_type', Product::class)
                ->where('customer_id', $customer_id)->first();
            if ($prev) {
                $prev->delete();
            } else {
                $data = [
                    'content_type' => Product::class,
                    'content_id' => $request->product_id,
                    'customer_id' => $customer_id,
                ];
                Favorite::create($data);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }




    /**
     * @OA\Get(
     *        path="/api/v1/get-product-details",
     *      operationId="get product details ",
     *      tags={"GetData"},
     *      summary="Get product details",
     *      description="Get user wallet details service",

     *     @OA\Parameter(
     *          name="product_id",
     *          description="product_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *          *    @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/

    public function getProductById(Request $request){

        $product=Product::find((int)$request->get('product_id'));
        if($product){
            $product=ProductResource::make($product);
            return $this->responseApiWithDataKey(true,__('api_texts.default_message'),ApiResponseStatusCodes::OK,$product,'product');
        }
        return $this->responseApiWithDataKey(false,__('api_texts.something_error'),ApiResponseStatusCodes::INTERNAL_ERROR);

    }



//
//    public function sliderProductcs(Request $request){
//
//        $products=Product::where('show_in_slider',true)->where('is_active',true)->get();
//        $products=SimpleProductResource::collection($products);
//        return $this->responseApiWithDataKey(true,__('api_texts.default_message'),ApiResponseStatusCodes::OK,$products,'slider_products');
//
//
//
//    }
    /**
     * @OA\Get(
     *        path="/api/v1/home-products",
     *      operationId="get feature products  ",
     *      tags={"GetData"},
     *      summary="Get Home feature and list products ",
     *      description="Get user wallet details service",

     *     @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/

    public function homeProducts(Request $request){

        $products = Product::where('is_active',true)->orderBy('ordering','asc')->paginate(20);
        // $products = Product::where('is_active',true)->orderBy('is_feature','desc')->inRandomOrder()->paginate(20);
       // $products_list = Product::all()->random();
        $products_list=ProductResource::collection($products);
        //$products_list = Product::all()->random();
        $data['status']=true;
        $data['response_message']=__('api_texts.default_message');
        $data['has_more_page']=$products->hasMorePages();
        $data['products']=$products_list;
        return response()->json($data, ApiResponseStatusCodes::OK);

    }
    public function offers(Request $request){

        $offers = Offer::orderBy('created_at','desc')->with('products')->get();
       // $products_list = Product::all()->random();
        // $products_list=ProductResource::collection($products);
        //$products_list = Product::all()->random();
        $data['status']=true;
        $data['response_message']=__('api_texts.default_message');
        // $data['has_more_page']=$products->hasMorePages();
        $data['offers']=$offers;
        return response()->json($data, ApiResponseStatusCodes::OK);

    }
    public function sliders(Request $request){

        $sliders = Slider::orderBy('created_at','desc')->with('products')->get();
       // $products_list = Product::all()->random();
        // $products_list=ProductResource::collection($products);
        //$products_list = Product::all()->random();
        $data['status']=true;
        $data['response_message']=__('api_texts.default_message');
        // $data['has_more_page']=$products->hasMorePages();
        $data['sliders']=$sliders;
        return response()->json($data, ApiResponseStatusCodes::OK);

    }

    public function mostSelling(Request $request){

        // $sales = DB::table('products')->where('is_active',true)
        //     ->leftJoin('order_products','products.id','=','order_products.product_id')
        //     ->selectRaw('products.*, COALESCE(sum(order_products.qty),0) total')
        //     ->groupBy('products.id')
        //     ->orderBy('total','desc')
        //     ->take(10)
        //     ->get();
        $sales = Product::where('is_active',true)->where('show_in_slider','1')->orderBy('ordering','asc')->take(10)->get();
        $data['status']=true;
        $data['response_message']=__('api_texts.default_message');
        // $data['has_more_page']=$sales->hasMorePages();
        $data['products']=$sales;
        return response()->json($data, ApiResponseStatusCodes::OK);

    }
    /**
     * @OA\Get(
     *        path="/api/v1/filter-products",
     *      operationId="get filttered  product  ",
     *      tags={"GetData"},
     *      summary="Get filter products",
     *      description="Get user wallet details service",

     *     @OA\Parameter(
     *          name="name",
     *          description="name",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="category_id",
     *          description="category_id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *
     *
     *       @OA\Parameter(
     *          name="categories_list",
     *          description="categories_list",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     * ),
     *      @OA\Parameter(
     *          name="colors_list",
     *          description="colors_list",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),
     *      @OA\Parameter(
     *          name="sizes_list",
     *          description="sizes_list",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     * ),
     *     @OA\Parameter(
     *          name="designer_id",
     *          description="designer_id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="min_price",
     *          description="min price",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *    @OA\Parameter(
     *          name="max_price",
     *          description="max price",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *
     *      ),
     *
     *         @OA\Parameter(
     *          name="sort_by",
     *          description=" new , low_price,high_price",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *
     *      ),
     *     *    @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/

    public function filterProducts(Request $request){


       $filtered_products=Product::query()->where('is_active',true)->orderBy('ordering','asc')->search($request);
        $filtered_products_count=$filtered_products->count();
        $products=$filtered_products->paginate(14);
        if ($request->filled('name') && !empty($request->name)) {
                    ProductSearchLog::create(['text'=>$request->name,'results_count'=>$filtered_products->count()]);
        }
        if($products){
            $products_list=ProductResource::collection($products);
            $data['status']=true;
            $data['response_message']=__('api_texts.default_message');
            $data['products']=$products_list;
            $data['result_count']=$filtered_products_count;
            $data['has_more_page']=$products->hasMorePages();
            return response()->json($data,ApiResponseStatusCodes::OK);
            return $this->responseApiWithDataKey(true,__('api_texts.default_message'),ApiResponseStatusCodes::OK,$data,'products');
        }
        return $this->responseApiWithDataKey(false,__('api_texts.no_results'),ApiResponseStatusCodes::INTERNAL_ERROR);
    }


    /**
     * @OA\Get(
     *        path="/api/v1/update-products-prices",
     *      operationId="update product list",
     *      tags={"GetData"},
     *      summary="request for update product prices",
     *      description="Get user wallet details service",
     *
     *
     *       @OA\Parameter(
     *          name="products_list",
     *          description="products_list",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     *    @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/

    public function updateProductsPrice(Request $request){
        $filtered_products=Product::where('id',json_decode($request->products_list))->orderBy('ordering','asc')->get();
        $products_list=SimpleProductResource::collection($filtered_products);
        return $this->responseApiWithDataKey(true,__('api_texts.default_message'),ApiResponseStatusCodes::OK,$products_list,'products');
    }
    /**
     * @OA\Get(
     *        path="/api/v1/customer/product/favorite-list",
     *      operationId="get favorite list  ",
     *      tags={"Customer products"},
     *      summary="Get customer favorite products list ",
     *      description="Get user wallet details service",

     *     @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     *
     **/

    public function favoriteList(Request $request){
            $customer =$request->user('customer');
         $products=    $customer->favorites()->with('content')->get()->pluck('content');
          $data=ProductResource::collection($products);
        return $this->responseApiWithDataKey(true,__('api_texts.default_message'),ApiResponseStatusCodes::OK,$data,'products');

    }
}
