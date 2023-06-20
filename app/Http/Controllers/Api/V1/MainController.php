<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\ApiResponseStatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppContentResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryTwoLevel;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\CouponResource;
use App\Http\Resources\DesignerResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Resources\SizeResource;
use App\Jobs\SendSmsJob;
use App\Models\AppContent;
use App\Models\Category;
use App\Models\Client;
use App\Models\Color;
use App\Models\Complaint;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\Customer;
use App\Models\DeviceKey;
use App\Models\Favorite;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductSearchLog;
use App\Models\Rating;
use App\Models\Settings;
use App\Models\Size;
use App\Models\SplashImage;
use App\Models\Store;
use App\Notifications\CustomerNotification;
use App\Traits\Shipping;
use App\Traits\ShippingLive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use phpDocumentor\Reflection\Types\Collection;

class MainController extends Controller
{
    use ShippingLive;

    public function testShipping()
    {

        // $shipmentOrder = $this->createNewShipment(12, 2, 3, 0, "adsfadsfadsfasf", "AbdallahALkhalout ", 966597773989, "abosadflkajdsf", '');
        // $shipmentOrder = json_decode($shipmentOrder, true);
        // if ($shipmentOrder['success']) {
        //     return  $shipmentOrder['order']["id"];
        // }
        return $this->showSingleShipmentOrder(100037886);
        return $this->viewOrder();
        return $this->showSingleShipmentOrder();
        return $this->shipmentsCityIdsUpdate();
        return $this->shippingLiveLogin();
        return $this->createNewShipment();
    }
    /**
     * @OA\Post(
     *      path="/api/v1/contact-us",
     *      operationId=" Contact us ",
     *      tags={"PostData"},
     *      summary="Contact us",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"email","mobile","name","title","message"},
     *          @OA\Property(
     *                     property="name",
     *                     description=" name",
     *                     type="string",
     *                 ),
     *                   @OA\Property(
     *                     property="email",
     *                     description=" email",
     *                     type="string",
     *                 ),
     *
     *                  @OA\Property(
     *                     property="mobile",
     *                     description=" mobile",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     description=" title",
     *                     type="string",
     *                 ),
     *                @OA\Property(
     *                     property="message",
     *                     description=" message",
     *                     type="string",
     *                 ),
     *
     *
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
    public function contactUs(Request $request)
    {

        //        $validator = \Validator::make($request->all(), [
        //            'email' => 'required|email',
        //            'mobile' => 'required',
        //            'name' => 'required',
        //            'title' => 'required',
        //            'message' => 'required',
        //        ]);
        //
        //        if ($validator->fails()) {
        //            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
        //        }

        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required',
            'name' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);


        try {
            $user_id = '';
            $user_type = '';
            if (isset($request->user('customer')->id)) {
                $user_id = $request->user('customer')->id;
                $user_type = Customer::class;
            }
            DB::beginTransaction();
            $contact = new Contact();
            $data = [
                "name" =>  $request->name,
                "email" =>  $request->email,
                "mobile" =>  $request->mobile,
                "title" =>  $request->title,
                "message" =>  $request->message,
                "user_id" =>  $user_id,
                "user_type" => $user_type,
            ];
            Contact::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/categories-list",
     *      operationId="get all categories list ",
     *      tags={"GetData"},
     *      summary="Get categories list",
     *      description="get categories list ",
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
    public function categoriesList(Request $request)
    {
        $categories = Category::query()->search($request)->get();
        $categories = CategoryResource::collection($categories);

        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $categories, 'categories');
    }
    
    
   
    

    /**
     * @OA\Get(
     *      path="/api/v1/app-content",
     *      operationId="get about-us , terms and conditions ",
     *      tags={"GetData"},
     *      summary="App content ",
     *      description="get categories list ",
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
    public function appContent()
    {
        $appContent = AppContentResource::make(new Request());
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $appContent, 'app_contents');
    }
    /**
     * @OA\Get(
     *      path="/api/v1/app-settings",
     *      operationId="Get App settings",
     *      tags={"GetData"},
     *      summary="Get App settings ",
     *      description="Get app settings",

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/
    public function appSettings()
    {
        $settings = new Settings();
        $data['settings']  = Settings::pluck('value', 'name')->toArray();
        $data['sizes_image']  = $settings->valueOf('sizes_image') ? url('public/uploads/' . $settings->valueOf('sizes_image')) : null;
        $data['countries_phone_list']  = Country::pluck('phone')->toArray();
        $data['splash_images'] = ImageResource::collection(SplashImage::where('is_active', true)->get());
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $data, 'data');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/check-coupon",
     *      operationId="Check Coupon code",
     *      tags={"PostData"},
     *      summary="Check coupon code",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"code"},
     *          @OA\Property(
     *                     property="code",
     *                     description="code",
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

    public function checkCoupon(Request $request)
    {

        $request->validate([
            'code' => 'required|exists:coupons,code',
            'products' => 'required|array',
            'total' => 'required',
        ]);
        $coupon = Coupon::query()->AbleToUse()->where('code', $request->code)->first();
        if ($coupon) {
            if ($coupon->limit > $request->total) {
                return $this->responseApiWithDataKey(false, __('api_texts.coupon_limit').$coupon->limit, ApiResponseStatusCodes::INTERNAL_ERROR);
            }
            foreach ($request->products as $product) {
                $product = CouponProduct::where('coupon_id', $coupon->id)->where('product_id', $product)->first();
                if ($product) {
                } else {
                    return $this->responseApiWithDataKey(false, __('api_texts.coupon_product'), ApiResponseStatusCodes::INTERNAL_ERROR);
                }
            }
            return $this->responseApiWithDataKey(true, __('api_texts.coupon_able_to_use'), ApiResponseStatusCodes::OK, $coupon, 'coupon');
        } else {
            return $this->responseApiWithDataKey(false, __('api_texts.coupon_not_available'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/check-promo",
     *      operationId="Check promo code",
     *      tags={"PostData"},
     *      summary="Check promo code",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"code"},
     *          @OA\Property(
     *                     property="code",
     *                     description="code",
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

    public function checkPromoCode(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:customers,promo_code',
        ]);
        $reference_customer  = Customer::where('promo_code', $request->code)->where('status', 1)->first();


        if ($reference_customer) {
            $customer = $request->user('customer');
            if ($customer) {
                if ($reference_customer->id == $customer->id) {
                    return $this->responseApiWithDataKey(false, __('api_texts.not_exist_promo_code_customer'), ApiResponseStatusCodes::INTERNAL_ERROR);
                }
            }

            $setting = new Settings();
            $data['promo_code'] = $request->code;
            $data['promo_discount_ratio'] = $setting->valueOf('promo_code_discount_ratio', 0);
            $data['app_commission_ratio'] = $setting->valueOf('app_commission_ratio', 0);
            return $this->responseApiWithDataKey(true, __('api_texts.promo_able_to_use'), ApiResponseStatusCodes::OK, $data, 'promo_settings');
        } else {
            return $this->responseApiWithDataKey(false, __('api_texts.not_exist_promo_code'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/test-sms",
     *      operationId="test-sms ",
     *      tags={"PostData"},
     *      summary="test sms",
     *      description="",
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"mobileCode","mobileNumber","message"},
     *          @OA\Property(
     *                     property="mobileCode",
     *                     description=" mobileCode",
     *                     type="string",
     *                 ),
     *                   @OA\Property(
     *                     property="mobileNumber",
     *                     description=" mobileNumber",
     *                     type="string",
     *                 ),
     *
     *                  @OA\Property(
     *                     property="message",
     *                     description=" message",
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

    public function testSms(Request $request)
    {


        $request->validate([
            'mobileCode' => 'required',
            'message' => 'required',
            'mobileNumber' => 'required',
        ]);

        $mobile = "" . $request->mobileCode . $request->mobileNumber;
        $message = $request->message;
        $this->dispatchNow(new SendSmsJob($mobile, $message));
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/coupons-list",
     *      operationId="Coupons list",
     *      tags={"GetData"},
     *      summary="Coupons list ",
     *      description="get categories list ",
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
    public function couponsList()
    {
        $dateNow = Carbon::now();
        //        $condition = "(SELECT COUNT(id) FROM  order_products  WHERE order_products.coupon_id=coupons.id)";
        //        $coupons= Coupon::select(DB::raw("*, $condition AS number_of_use"))
        //            ->whereRaw("count_of_use > $condition ")->where('is_active','=',1)->where('start_date','<=',$dateNow)->where('expire_date','>=',$dateNow)->orderBy('created_at','desc')->get();
        $coupons = Coupon::query()->AbleToUse(null)->where('show',1)->orderBy('created_at', 'desc')->get();
        $appContent = CouponResource::collection($coupons);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $appContent, 'app_contents');
    }
    /**
     * @OA\Get(
     *      path="/api/v1/send-test-notification",
     *      operationId="send notification test",
     *      tags={"GetData"},
     *      summary="Send test FCM notification ",
     *      description="get categories list ",
     *     @OA\Parameter(
     *          name="customer_id",
     *          description="customer_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/
    public function sendTestNotification(Request  $request)
    {
        $customer = Customer::find($request->get('customer_id'));
        $lang = app()->getLocale();
        $message = [
            "locale.text" => 'notifications.new.order',
            "msg" => trans('notifications.new.order', [], $lang),
            'title' => "abayasquareweb",
        ];
        sendNotificationToCustomer($customer, $message);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }
    /**
     * @OA\Get(
     *      path="/api/v1/customer/get-customer-notification",
     *      operationId="get customer notfications",
     *      tags={"GetData"},
     *      summary="Get customer notifications ",
     *      description="get categories list ",
     *      security={{ "api_key": {}}},

     *      @OA\Parameter(
     *          name="language",
     *          description="language ar OR en",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/
    public function getCustomerNotfications(Request  $request)
    {
        $customer = $request->user('customer');

        if ($customer) {
            $notifcations = NotificationResource::collection($customer->notifications);

            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $notifcations, 'notifcations');
        }

        return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/trending-search",
     *      operationId="Get trending search",
     *      tags={"GetData"},
     *      summary="Get tranding search ",
     *      description="Get app settings",

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/
    public function trendingSearch()
    {
        $trendingSearch =     \DB::table('product_search_logs')
            ->select('product_search_logs.*', DB::raw('COUNT(text) as count'))
            ->groupBy('text')
            ->orderBy('count', 'desc')
            ->where('results_count', '>', 0)
            ->get();

        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $trendingSearch, 'trending_search');
    }


    /**
     * @OA\Get(
     *      path="/api/v1/trending-designer-search",
     *      operationId=" trending designer search",
     *      tags={"GetData"},
     *      summary="Get tranding designer search ",
     *      description="Get app settings",

     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and balances array of objects and user balance"
     *       ),
     * )
     * **/
    public function trendingDesignerSearch()
    {
        $trendingSearch =     \DB::table('designer_search_logs')
            ->select('designer_search_logs.*', DB::raw('COUNT(text) as count'))
            ->groupBy('text')
            ->orderBy('count', 'desc')
            ->where('results_count', '>', 0)
            ->get();

        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $trendingSearch, 'trending_designers_list');
    }

    /**
     * @OA\Get(
     *      path="/api/v1/filter-settings",
     *      operationId="Get filter settings",
     *      tags={"GetData"},
     *      summary="Get fillter settings ",
     *      description="Get app settings",
     *      @OA\Parameter(
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
    public function filterSettings()
    {
        $data['status'] = true;
        $data['response_message'] = __('api_texts.default_message');
        $data['categories'] = CategoryResource::collection(Category::get());
        $data['sizes'] = SizeResource::collection(Size::get());
        $data['colors'] = ColorResource::collection(Color::get());
        $data['products_count'] = Product::where('is_active', true)->count();
        $data['max_price'] = Product::where('is_active', true)->orderBy('sale_price', 'desc')->first()->sale_price ?? 0;
        $data['min_price'] = Product::where('is_active', true)->orderBy('sale_price', 'asc')->first()->sale_price ?? 0;
        return response()->json($data, ApiResponseStatusCodes::OK);
    }


    /**
     * @OA\Get(
     *      path="/api/v1/payment-types",
     *      operationId="get all categories list ",
     *      tags={"GetData"},
     *      summary="get App Payments types ",
     *      description="get categories list ",

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
    public function paymentTypeList(Request $request)
    {

        $paymentTypesList = PaymentTypeResource::collection(PaymentType::where('is_active', 1)->get());

        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $paymentTypesList, 'payment_types');
    }
    /**
     * @OA\Post(
     *      path="/api/v1/update-fcm-token",
     *      operationId="Update customer fcm token",
     *      tags={"Customer Authantication"},
     *      summary="Update customer fcm token without customer auth",
     *      description="User login service returns user object",
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"token"},
     *          @OA\Property(
     *                     property="token",
     *                     description="FCM token",
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
    public function updateFcmToken(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'token' => 'required',
        ]);
        $customer = $request->user('customer');
        if ($customer) {
            $customer->fcm_token = $request->token;
            $customer->save();
            //DeviceKey::where('d_key',$request->token)->where('user_id','<>',$customer->id)->delete();
            DeviceKey::where('d_key', $request->token)->delete();
            DeviceKey::where('user_id', $customer->id)->delete();
            DeviceKey::create(['d_key' => $request->token, 'user_id' => $customer->id]);

            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
        } else {
            $deviceKey =   DeviceKey::updateOrCreate(['d_key' => $request->token], ['d_key' => $request->token]);
            if ($deviceKey) {
                return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
            }
        }

        return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
    }
}
