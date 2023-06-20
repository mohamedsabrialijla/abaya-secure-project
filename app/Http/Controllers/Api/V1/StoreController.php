<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\ApiResponseStatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\DesignerResource;
use App\Http\Resources\DesignerWithProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SimpleProductResource;
use App\Models\DesignerSearchLog;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductSearchLog;
use App\Models\Slider;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class StoreController extends Controller
{


    /**
     * @OA\Get(
     *      path="/api/v1/designers-list",
     *      operationId="adsf",
     *      tags={"GetData"},
     *      summary="Get Desiners list",
     *      description="get categories list ",
     *
     *      @OA\Parameter(
     *          name="name",
     *          description="name",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *
     *    @OA\Parameter(
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
    public function getDesigners(Request $request){
         $designersList=Store::query()->search($request)->orderBy('ordering','asc');
         $designersListCount=$designersList->count();
         $designersList=$designersList->paginate(9);
        $filtered_products=Store::query()->search($request)->count();
        $collection = collect($designersList->except('meta'));
        $shuffled = $collection->shuffle();

        if ($request->filled('name') && !empty($request->name)) {
            DesignerSearchLog::create(['text'=>$request->name,'results_count'=>$filtered_products]);
        }
        $designers_list=DesignerResource::collection($shuffled->all());
        $products=Product::where('show_in_slider',true)->where('is_active',true)->orderBy('ordering','asc')->get();
        $products_list=ProductResource::collection($products);
        $sliders = Slider::orderBy('created_at','desc')->with('products')->get();

        $data['status']=true;
        $data['response_message']=__('api_texts.default_message');
        $data['has_more_page']=$designersList->hasMorePages();
        $data['designers']=$designers_list;
        $data['result_count']=$designersListCount;
        $data['sliders']=$sliders;
        $data['products']=$products_list;
        return response()->json($data,ApiResponseStatusCodes::OK);

    }


    /**
     * @OA\Get(
     *      path="/api/v1/get-designer-with-products",
     *      operationId="get only designer list ",
     *      tags={"GetData"},
     *      summary="Get designer with products",
     *      description="get categories list ",
     *
     *      @OA\Parameter(
     *          name="designer_id",
     *          description="designer_id",
     *          in="query",
     *           required=true,
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *
     *
     *    @OA\Parameter(
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
    public function getDesignerWithProducts(Request $request){

        $deisgner=Store::find($request->get('designer_id'));
        if($deisgner){
            $designers=DesignerWithProductResource::make($deisgner);

            return $this->responseApiWithDataKey(true,__('api_texts.default_message'),
                ApiResponseStatusCodes::OK,$designers,'designers');
        }
        return $this->responseApiWithDataKey(false,__('api_texts.no_results'),
            ApiResponseStatusCodes::INTERNAL_ERROR);
    }

}
