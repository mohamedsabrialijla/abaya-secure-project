<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\ApiResponseStatusCodes;
use App\Http\Controllers\Controller;

use App\Http\Resources\CustomerResource;
use App\Models\Area;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Gov;
use App\Traits\ShippingLive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class CustomerAddressController extends Controller
{
    use ShippingLive;
    /**
     * @OA\Post(
     *      path="/api/v1/customer/address/add",
     *      operationId="Customer add new Address  ",
     *      tags={"Customer Address"},
     *      summary="User login API",
     *      description="Customer create new address ",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"lat","lng","mobile","name","address"},
     *          @OA\Property(
     *                     property="lat",
     *                     description="lat",
     *                     type="string",
     *                 ),
     *              @OA\Property(
     *                     property="lng",
     *                     description="lng",
     *                     type="string",
     *                 ),
     *
     *              @OA\Property(
     *                     property="area_id",
     *                     description="area_id",
     *                     type="number",
     *                 ),
     *              @OA\Property(
     *                     property="mobile",
     *                     description="mobile",
     *                     type="string",
     *                 ),
     *             @OA\Property(
     *                     property="name",
     *                     description="name",
     *                     type="string",
     *                 ),
     *
     *               @OA\Property(
     *                     property="type",
     *                     description="Office or home",
     *                     type="string",
     *                 ),
     *
     *             @OA\Property(
     *                     property="address",
     *                     description="address",
     *                     type="string",
     *                 ),
     *
     *            @OA\Property(
     *                     property="is_internal",
     *                     description="True or False  0 or 1",
     *                     type="number",
     *                 ),
     *             )
     *             )
     *
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user object"
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="status = true : User not activated || status = false : User not found or password is not correct"
     *     )
     * )
     **/

    public function store (Request $request) {

        $request['mobile']=$request->mobile;
        // another way to skip modify unique value in
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'mobile' => 'required',
//            'address' => 'required',
//            'lat' => 'required',
//            'lng' => 'required',
//            'type' => 'required',
//        ]);
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'mobile' => 'required',
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'type' => 'required',
                'is_internal' => 'required',
            ]
        );
        $customer=$request->user('customer');
        if($request->filled('mobile') && $request->mobile !=$customer->mobile){
            $dialCode=substr($request->mobile,0,3);
            $country=Country::where('phone',$dialCode)->first();
            if($country->mobile_digits != strlen(substr($request->mobile, 3))){
                return $this->responseApiWithDataKey(false,__('validation.digits',['attribute'=>__('validation.attributes.mobile'),'digits'=>$country->mobile_digits]) , ApiResponseStatusCodes::INTERNAL_ERROR);

            }
        }
//        if ($validator->fails())
//        {
//
//            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
//        }

            DB::beginTransaction();
            try{


                $data=[
                    'name'=>$request->name,
                    'mobile'=>$request->mobile,
                    'address'=>$request->address,
                    'lat'=>$request->lat,
                    'lng'=>$request->lng,
                    'customer_id'=>$customer->id,
                    'type'=>$request->type,
                    'is_internal'=>$request->is_internal,
                    'area_id'=>$request->area_id
                ];
                CustomerAddress::create($data);

                DB::commit();
            }catch (\Exception $e){
                DB::rollback();
                return   $this->responseApiWithDataKey(false,__('api_texts.something_error'),ApiResponseStatusCodes::INTERNAL_ERROR);
            }
            $customer=CustomerResource::make($customer);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'),ApiResponseStatusCodes::OK,$customer,'customer');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/customer/address/delete",
     *      operationId="Customer delete an address ",
     *      tags={"Customer Address"},
     *      summary="Customer delete Address",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"address_id"},
     *          @OA\Property(
     *                     property="address_id",
     *                     description=" address id",
     *                     type="string",
     *                 ),
     *


     *
     *             )
     *         )
     *     ),
     *    @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),

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
    public function delete(Request $request){

        $validator = Validator::make($request->all(), [
            'address_id' => 'required|exists:customer_addresses,id',


        ]);
        if($validator->fails())
        {
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );

        }
        DB::beginTransaction();
        try{
            $customer=$request->user('customer');
            $address=CustomerAddress::where('customer_id',$customer->id)->find($request->address_id);
            if($address){
                $address->delete();
            }else{
                return $this->responseApiWithDataKey(false, __('api_texts.something_error'),ApiResponseStatusCodes::INTERNAL_ERROR);
            }
            DB::commit();

        }catch (\Exception $e){
            DB::rollback();
            return   $this->responseApiWithDataKey(false, __('api_texts.something_error'),ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        $customer=CustomerResource::make($customer);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'),ApiResponseStatusCodes::OK,$customer,'customer');
    }


    /**
     * @OA\Get(
     *      path="/api/v1/cities-list",
     *      operationId="cities-list ",
     *      tags={"GetData"},
     *      summary="Get cities list",
     *      description="get cities list ",
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
    public function citiesList(){

//        $this->add_city_code();
        $govs=Gov::with('cities')->get();

        $citiesNoGov=Area::whereNull('gov_id')->get();
        return $this->responseApiWithDataKey(true,__('api_texts.default_message'),ApiResponseStatusCodes::OK,$govs,'govs');
    }

    public function add_city_code()
    {
        $cities=Area::all();
        $cc=collect(json_decode($this->shipmentsCityIdsUpdate()));
        foreach ($cc as $city_cc){
            $out=$cities->first(function ($e)use ($city_cc){
                return $e->name_ar == $city_cc->name_ar;
            });
            if(!$out){
                $city=new Area();
                $city->name_ar=$city_cc->name_ar;
                $city->city_code=$city_cc->id;
                $city->save();
            }

        }
        $cities=Area::all();
        dd($cities);

    }

}
