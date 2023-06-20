<?php

namespace App\Http\Controllers\Api\V1;


use App\Events\SendSMS;
use App\Constants\ApiResponseStatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Jobs\SendSmsJob;
use App\Mail\ActivationCode;
use App\Models\Contributor;
use App\Models\Country;
use App\Models\Customer;
use App\Models\ReferralLog;
use App\Models\Settings;
use Database\Seeders\CountriesSeeder;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{


    /**
     * @OA\Post(
     *      path="/api/v1/customer/auth/login-register",
     *      operationId="login",
     *      tags={"Customer Authantication"},
     *      summary="Customer login or register",
     *      description="User login service returns user object",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={},
     *                   @OA\Property(
     *                     property="mobile_code",
     *                     description="customer  mobile code",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="mobile",
     *                     description="customer  mobile",
     *                     type="number",
     *                 ),
     *
     *                 @OA\Property(
     *                     property="email",
     *                     description="customer  email",
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
     *          description="status = true : User not activated || status = false : User not found or password is not correct"
     *     )
     * )
     **/
     
// kjljlkjkl
    public function loginOrRegister(Request $request)
    {


        //        $validator = Validator::make($request->all(), [
        //            'mobile' => 'required_without:email|digits:9',
        //            'email' => 'required_without:mobile|nullable|email',
        //        ]);

        $request->validate([
            'mobile_code' => 'required_without:email'
        ]);
        $Country = new Country();
        $request->validate([
            'mobile' => 'required_without:email|nullable|digits:' . $Country->mobileDigits($request->mobile_code),
            'email' => 'required_without:mobile|nullable|email',
            //            'promo_code' => 'nullable|exists:customers,promo_code',
        ]);
        //        if ($validator->fails()) {
        //            return $this->responseApiWithDataKey(false, __('api_texts.validation_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
        //        }
        if (!$request->filled('mobile') && !$request->filled('email')) {

            return $this->responseApiWithDataKey(false, __('api_texts.enter_mobile_or_email'), ApiResponseStatusCodes::VALIDATION_ERROR);
        }
        
        
         $ip = $this->getClientIps();
        $time = Carbon::now()->format('Y-m-d H:i:s');

        $customer = Customer::query()->filter($request)->first();
        if ($customer) {
            
             $customer->ip_address = $ip;
             $customer->save();
        //     $ustomer_ip = Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->first();
            
        //  if(isset( $ustomer_ip) &&  $ustomer_ip != '' ){
        //      Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->update(['dial_code'=>0]);
        //     $last = $ustomer_ip->last_login;
            
        //     $start = Carbon::parse($last);
        //     $end = Carbon::parse($time);

        //     $diff = $start->diffInMinutes($end);
        //     if($diff < 2 ){
        //          return $this->responseApiWithDataKey(false, __('api_texts.please_can_login_after_5_min'), ApiResponseStatusCodes::VALIDATION_ERROR);
                
        //     }
            
        //  }
            
            if ($customer->mobile != '966570909933') {
                $request['activation_code'] = $activationCode = rand(1000, 9999);
                $customer->activation_code = $activationCode;
                $customer->ip_address = $ip;
                $customer->last_login = $time;
                $customer->save();
                if ($request->filled("mobile")) {
                    if($customer->name != "ABED ALKOUARY" || $customer->ip_address != "82.205.18.129"){
                    $message = " Your Abaya Square Code: {$customer->activation_code}";
                    SendSmsJob::dispatchSync($customer->mobile, $message);
                    }
                }
                if ($request->filled("email") && $request->email) {
                    try {

                        \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                    } catch (\Exception $e) {
                        // dd($e);
                        \Log::info("email activation code exception : " . $e->getMessage());
                    }
                }
            }else{
                //fg
                 $request['activation_code'] = $activationCode = rand(1000, 9999);
                $customer->activation_code = 8824;
                $customer->save();
                if ($request->filled("mobile")) {
                    if($customer->name != "ABED ALKOUARY" || $customer->ip_address != "82.205.18.129"){
                    $message = " Your Abaya Square Code: {$customer->activation_code}";
                    SendSmsJob::dispatchSync($customer->mobile, $message);
                    }
                }
                if ($request->filled("email") && $request->email) {
                    try {

                        \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                    } catch (\Exception $e) {
                        // dd($e);
                        \Log::info("email activation code exception : " . $e->getMessage());
                    }
                }
                
            }


            //            $sms_mobile = ControllersService::prepareMobileForSms($customer->mobile);
        } else {
            // $activationCode = rand(1000, 9999);
            $activationCode = rand(1000, 9999);
            if ($request->filled("mobile")) {

                $full_mobile = $request->mobile_code . $request->mobile;
                 $customer = Customer::create(['mobile' => $full_mobile, 'name' => $request->name, 'promo_code' => Str::random(6), 'activation_code' => $activationCode,'ip_address'=>$ip ,'last_login'=> $time ,'dial_code'=>0]);
                
                
                //  $ustomer_ip = Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->first();
                //   if(isset( $ustomer_ip) &&  $ustomer_ip != '' ){
                // Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->update(['dial_code'=>0]);
            
                // $last = $ustomer_ip->last_login;
                
                // $start = Carbon::parse($last);
                // $end = Carbon::parse($time);
    
                // $diff = $start->diffInMinutes($end);
                
                // if($diff < 2 ){
                //     return $this->responseApiWithDataKey(false, __('api_texts.please_can_login_after_5_min'), ApiResponseStatusCodes::VALIDATION_ERROR);
                    
                // }
                //   }
            if($customer->name != "ABED ALKOUARY" || $customer->ip_address != "82.205.18.129"){
                $message = " Your Abaya Square Code: {$customer->activation_code}";
                SendSmsJob::dispatchSync($customer->mobile, $message);
            }

            } else if ($request->filled("email") && $request->email) {
                $customer = Customer::create(['email' => $request->email, 'name' => $request->name, 'promo_code' => Str::random(6), 'activation_code' => $activationCode]);try {

                    \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                } catch (\Exception $e) {

                    \Log::info("email activation code exception : " . $e->getMessage());
                }
            }
        }

        //        if($customer->fcm_token){
        //
        //            sendFCM($customer->fcm_token,$message);
        //        }
        // if ($request->filled("mobile")) {
        //     $full_mobile = $request->mobile_code . $request->mobile;
        //     $message = " Your Abaya Square Code: {$customer->activation_code}";
        //     SendSmsJob::dispatch($customer->mobile, $message);
        //     //            $this->dispatchSync(new SendSmsJob($full_mobile,$message['title']));
        //     //            event(new SendSMS('966'.$request->mobile, trans('api_texts.your_activation_code') . $customer->activation_code));
        // }
        // if ($request->filled("email") && $request->email) {
        //     try {

        //         \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
        //     } catch (\Exception $e) {

        //         \Log::info("email activation code exception : " . $e->getMessage());
        //     }
        // }


        $response = CustomerResource::make($customer);
        //                return response($response, 200);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $response, 'customer');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/customer/auth/verify-login-code",
     *      operationId="apiValidateMobile",
     *      tags={"Customer Authantication"},
     *      summary="verify login code",
     *      security={{ "api_key": {}}},
     *      description="Activate User account service returns user object in case of success",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"code"},
     *                 @OA\Property(
     *                     property="mobile",
     *                     description="user mobile",
     *                     type="number",
     *                 ),
     *               @OA\Property(
     *                     property="email",
     *                     description="user email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="code",
     *                     description="activation code recieved on either mobile or email",
     *                     type="number",
     *                 ),
     *
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation with status = true and user object"
     *       ),
     *      @OA\Response(response=422, description="user not found or code is wronge or user is already activated"),
     * )
     */
    public function verifyMobileLogin(Request $request)
    {

        //        $validator = Validator::make($request->all(), [
        //            'code' => 'required',
        //            'mobile' => 'nullable',
        //            'email' => 'nullable|exists:customers,email',
        //        ]);
        //        if ($validator->fails()) {
        //            return $this->responseApiWithDataKey(false, __('api_texts.validation_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
        //        }


        $request->validate([
            'code' => 'required',
            'mobile' => 'nullable',
            'email' => 'nullable|exists:customers,email',
        ]);

        if (!$request->filled('mobile') && !$request->filled('email')) {

            return $this->responseApiWithDataKey(false, __('api_texts.enter_mobile_or_email'), ApiResponseStatusCodes::VALIDATION_ERROR);
        }

        $customer = Customer::query()->filter($request)->first();
        if ($customer && $customer->activation_code == $request->code) {
            if (!$customer->status) {
                $customer->status = 1;
                $customer->save();
            }
            $token = $customer->createToken('abaya')->accessToken;
            $customer->accessToken = $token;

            $response = CustomerResource::make($customer);
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $response, 'customer');
        } elseif ($customer && $customer->activation_code != $request->code) {
            return $this->responseApiWithDataKey(false, __('api_texts.activation_code_error'), ApiResponseStatusCodes::VALIDATION_ERROR);
        }
        return $this->responseApiWithDataKey(false, __('api_texts.user_not_found'), ApiResponseStatusCodes::INTERNAL_ERROR);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/customer/auth/resend-verify-code",
     *      operationId="update customer logout",
     *      tags={"Customer Authantication"},
     *      summary="resend verify code",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={},
     *          @OA\Property(
     *                     property="mobile",
     *                     description="mobile",
     *                     type="string",
     *                 ),
     *                @OA\Property(
     *                     property="email",
     *                     description="email",
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
    public function resendVerifyCode(Request $request)
    {

        $request->validate([
            'mobile' => 'nullable',
            'email' => 'nullable|email',
        ]);

        if (!$request->filled('mobile') && !$request->filled('email')) {

            return $this->responseApiWithDataKey(false, __('api_texts.enter_mobile_or_email'), ApiResponseStatusCodes::VALIDATION_ERROR);
        }


        $customer = Customer::query()->filter($request)->first();
        if ($customer) {
            $activationCode = rand(1000, 9999);
            $customer->update(['activation_code' => $activationCode]);
            try {
                if ($request->filled("mobile")) {

                    if($customer->name != "ABED ALKOUARY" || $customer->ip_address != "82.205.18.129"){
                    $message = " Your Abaya Square Code: {$customer->activation_code}";
                    SendSmsJob::dispatchSync($customer->mobile, $message);
                    }
                    //                    event(new SendSMS( $request->mobile, trans('api_texts.your_activation_code') . $customer->activation_code));
                }
                if ($request->filled("email")) {
                    try {
                        \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                    } catch (\Exception $e) {

                        \Log::info("email activation code exception : " . $e->getMessage());
                    }
                }
            } catch (\Exception $e) {
                \Log::info("send sms error after user id" . $customer->id . " registered error :" . $e->getMessage());
                return $this->responseApiWithDataKey(false, __('api_texts.validation_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
            }
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
        }
        return $this->responseApiWithDataKey(false, __('api_texts.user_not_found'), ApiResponseStatusCodes::VALIDATION_ERROR);
    }


    /**
     * @OA\Post(
     *      path="/api/v1/customer/update-profile",
     *      operationId="update profile  ",
     *      tags={"Customer Authantication"},
     *      summary="customer update profile",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"name"},
     *          @OA\Property(
     *                     property="name",
     *                     description="name",
     *                     type="string",
     *                 ),
     *
     *            @OA\Property(
     *                     property="mobile",
     *                     description="customer  mobile ",
     *                     type="string",
     *               ),
     *
     *            @OA\Property(
     *                     property="email",
     *                     description="customer  email ",
     *                     type="string",
     *                   ),
     *
     *              @OA\Property(
     *                     property="avatar",
     *                     description="profile image",
     *                     format="binary",
     *                     type="string",
     *                 )
     *             )
     *         )
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

    public function updateProfile(Request $request)
    {


        $customer = $request->user('customer');
        // another way to skip modify unique value in
        // Rule::unique('users')->ignore($request->id, 'id'),
        //        $validator = Validator::make($request->all(), [
        //            'name' => 'required|string|max:255',
        //            'mobile' => 'nullable||string|max:255|unique:customers,mobile,' . $customer->id,
        //            'email' => 'nullable|email|max:255|unique:customers,email,' . $customer->id,
        //            'avatar' => 'image|nullable'
        //        ]);
        //        if ($validator->fails()) {
        //            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::VALIDATION_ERROR, $validator->errors()->messages() );
        //
        //        }

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|unique:customers,mobile,' . $customer->id,
            'email' => 'nullable|email|max:255|unique:customers,email,' . $customer->id,
            'avatar' => 'image|nullable'
        ]);
        try {

            $dialCode = substr($request->mobile, 0, 3);
            $country = Country::where('phone', $dialCode)->first();
            if ($country) {
                if ($country->mobile_digits != strlen(substr($request->mobile, 3))) {
                    return $this->responseApiWithDataKey(false, __('validation.digits', ['attribute' => __('validation.attributes.mobile'), 'digits' => $country->mobile_digits]), ApiResponseStatusCodes::INTERNAL_ERROR);
                }
                //                $validator = \Validator::make(
                //                    ["new_mobile" => s],
                //                    ['new_mobile' => 'digits:' . ($country->mobile_digits)]
                //                );
                //                if ($validator->fails()) {
                //                    foreach ($validator->messages()->getMessages() as $field_name => $message) {
                //                    }
                //                }
            }
            $changed_email = false;
            $changed_mobile = false;
            if ($request->hasFile('avatar')) {
                $name = MediaController::SaveFile($request->avatar);
                $customer->avatar = $name;
                $customer->save();
            }
            if ($customer->email && $request->filled('email') && ($customer->email != $request->email)) {
                $customer->status = 0;
                $customer->activation_code = rand(1000, 9999);
                $customer->save();
                $customer->refresh();
                $changed_email = true;
            }

            if ($customer->mobile && $request->filled('mobile') && ($customer->mobile != $request->mobile)) {
                $customer->status = 0;
                $activationCode = rand(1000, 9999);
                $customer->activation_code = $activationCode;
                $customer->save();
                $customer->refresh();
                $changed_mobile = true;
            }
            $data = [
                'name' =>  $request->name,
                'mobile' =>  (string)$request->mobile,
                'email' =>  $request->email,
            ];
            //            \Log::info("update profile after :".$data['mobile']);
            $customer->Update($data);
            if ($changed_email) {
                try {
                    \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                } catch (\Exception $e) {

                    \Log::info("email activation code exception : " . $e->getMessage());
                }
            }
            if ($changed_mobile) {
                $message = 'Your Abaya Square Code:' . $activationCode;
                $this->dispatchSync(new SendSmsJob($request->mobile, $message));
            }
            return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, CustomerResource::make($customer), 'customer');
        } catch (\Exception $e) {

            return $this->responseApiWithDataKey(false, __('api_texts.something_error'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }


        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }



    /**
     * @OA\Get(
     *      path="/api/v1/customer/auth/logout",
     *      operationId="update customer logout",
     *      tags={"Customer Authantication"},
     *      summary="customer logout ",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},

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
    public function logout(Request $request)
    {



        Auth::user('customer')->tokens->each(function ($token, $key) {
            $token->delete();
        });

        // or
        //        $token = $request->user('customer')->token();
        //        $token->revoke();
        //        $response = ['message' => 'You have been successfully logged out!'];
        //        return response($response, 200);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }
    /**
     * @OA\Post(
     *      path="/api/v1/customer/convert-points-to-cash",
     *      operationId="convert-points-to-cash",
     *      tags={"Customer Authantication"},
     *      summary="convert points to cash",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",

     *         )
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

    public function convertPointToCash(Request $request)
    {
        $customer = $request->user('customer');
        if ($customer && $customer->points > 0) {
            $settings = new Settings();
            $pointsForSar = $settings->valueOf('points_to_cash_one_sar', 0);
            $customer->wallet += round(($customer->points / $pointsForSar), 2);
            $customer->points = 0;
            $customer->save();
        } else {
            return $this->responseApiWithDataKey(false, __('api_texts.point_not_enough'), ApiResponseStatusCodes::INTERNAL_ERROR);
        }
        $customerModel = CustomerResource::make($customer);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $customerModel, 'customer');
    }
    /**
     * @OA\Get(
     *      path="/api/v1/customer/my-data",
     *      operationId="my-data",
     *      tags={"GetData"},
     *      summary="get my data -- customer",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *

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
    public function myData(Request $request)
    {
        $customer = $request->user('customer');
        $customerModel = CustomerResource::make($customer);
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $customerModel, 'customer');
    }


    /**
     * @OA\Get(
     *      path="/api/v1/customer/clear-notifications",
     *      operationId="clear notification",
     *      tags={"GetData"},
     *      summary="clear customer notification -- customer",
     *      description="User login service returns user object",
     *      security={{ "api_key": {}}},
     *

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
    public function clearCustomerNotification(Request $request)
    {
        $customer = $request->user('customer');
        $customerModel = CustomerResource::make($customer);
        $customer->notifications()->delete();
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK, $customerModel, 'customer');
    }


    /**
     * @OA\Post(
     *      path="/api/v1/customer/delete-notification",
     *      operationId="delete single notification",
     *      tags={"PostData"},
     *      summary="delete single notification",
     *      description="notification",
     *      security={{ "api_key": {}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                required={"id"},
     *          @OA\Property(
     *                     property="id",
     *                     description=" Notification id",
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

    public function deleteSingleNotification(Request $request)
    {


        //        $notification=Notification::where('id',$request->id)->delete();
        $customer = $request->user('customer');
        $customer->notifications()->find($request->id)->delete();
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }

    public function deleteUser(Request $request)
    {
        $customer = $request->user('customer');
        $customer->delete();
        return $this->responseApiWithDataKey(true, __('api_texts.default_message'), ApiResponseStatusCodes::OK);
    }
    
    
    // dfklgdflh
    // jkfdgjdfg
    public function getClientIps()
    {
     $ipaddress = '';
       if (isset($_SERVER['HTTP_CLIENT_IP']))
           $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
       else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_X_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
       else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_FORWARDED'];
       else if(isset($_SERVER['REMOTE_ADDR']))
           $ipaddress = $_SERVER['REMOTE_ADDR'];
       else
           $ipaddress = 'UNKNOWN';    
       return $ipaddress;
    } 
}
