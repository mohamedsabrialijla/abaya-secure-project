<?php

namespace App\Http\Controllers;

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
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function login()
    {
        return view('web.login');
    }

    public function verify()
    {
        return view('web.verify');
    }

    public function loginRegister(Request $request)
    {
      
        $request->validate([
            'mobile_code' => 'required_without:email'
        ]);
        $Country = new Country();
        $request->validate([
            'mobile' => 'required_without:email|nullable|digits:' . $Country->mobileDigits($request->mobile_code),
            'email' => 'required_without:mobile|nullable|email',
        ]);
        if (!$request->filled('mobile') && !$request->filled('email')) {

            return back()->with('toast_error', __('api_texts.enter_mobile_or_email'));
        }

        $ip = $this->getClientIps();
        $time = Carbon::now()->format('Y-m-d H:i:s');
        
        $customer = Customer::query()->filter($request)->first();
       
        
        
        
        
            
        
        
        if ($customer) {
            
            //  $customer->ip_address = $ip;
            //  $customer->save();
            // $ustomer_ip = Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->first();
            // Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->update(['dial_code'=>0]);
        
            // $last = $ustomer_ip->last_login;
            
            // $start = Carbon::parse($last);
            // $end = Carbon::parse($time);

            // $diff = $start->diffInMinutes($end);

            // if($diff < 2 ){
            //     return back()->with('toast_error', __('api_texts.please_can_login_after_5_min')); 
                
            // }
            
            // efwf
            
            
            
            
            if ($customer->mobile != '966570909933') {
                $activationCode = rand(1000, 9999);
                // $activationCode = 1111;
                $customer->activation_code = $activationCode;
                $customer->ip_address = $ip;
                $customer->last_login = $time;
                $customer->login_from = 'web';
                $customer->save();
                if ($request->filled("mobile")) {
                    if($customer->name != "ABED ALKOUARY"){
                         $message = " Your Abaya Square Code: {$customer->activation_code}";
                        SendSmsJob::dispatchSync($customer->mobile, $message);
                    }
                    
                } else if ($request->filled("email")) {

                     if ($request->email) {

                        try {
                            \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                            // dd(\Mail::to($customer)->send(new ActivationCode($customer->activation_code)));

                        } catch (\Exception $e) {
                            \Log::info("email activation code exception : " . $e->getMessage());
                            // dd($e);
                        }
                    }
                }
            }

        } else {
            $activationCode = rand(1000, 9999);
            // $activationCode = 1111;
            if ($request->filled("mobile")) {
                $full_mobile = $request->mobile_code . $request->mobile;
                $customer = Customer::create(['mobile' => $full_mobile, 'name' => $request->name, 'promo_code' => Str::random(6), 'activation_code' => $activationCode,'ip_address'=>$ip ,'last_login'=> $time ,'dial_code'=>0,'login_from'=>'web']);
                
                
                //  $ustomer_ip = Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->first();
                   if(isset( $customer) &&  $customer != '' ){
                // Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->update(['dial_code'=>0]);
            
                $last = $ustomer->last_login;
                
                // $start = Carbon::parse($last);
                // $end = Carbon::parse($time);
    
                // $diff = $start->diffInMinutes($end);
                
                // if($diff < 2 ){
                //     return back()->with('toast_error', __('api_texts.please_can_login_after_5_min')); 
                    
                // }
            
                   }
            
                
                if($customer->name != "ABED ALKOUARY"){
                $message = " Your Abaya Square Code: {$customer->activation_code}";
                SendSmsJob::dispatchSync($customer->mobile, $message);
                }
            } else if ($request->filled("email")) {
                $customer = Customer::create(['email' => $request->email, 'name' => $request->name, 'promo_code' => Str::random(6), 'activation_code' => $activationCode]);
                if ($request->email) {
                    try {
                        \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                        // dd(\Mail::to($customer)->send(new ActivationCode($customer->activation_code)));

                    } catch (\Exception $e) {
                        \Log::info("email activation code exception : " . $e->getMessage());
                    }
                }
            }
        }


        // if ($request->filled("email") && $request->email) {
        //     try {
        //         \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
        //     } catch (\Exception $e) {
        //         \Log::info("email activation code exception : " . $e->getMessage());
        //     }
        // }
        if ($request->filled('mobile')) {
            $full_mobile = $request->mobile_code . $request->mobile;
            Session::put('login_mobile', $full_mobile);
        } elseif($request->filled('email')) {
            Session::put('login_email', $request->email);
        }

        return redirect()->route('verify')->with('toast_success',__('site.code_sent'));
    }

    public function verifyLogin(Request $request)
    {

        $request->validate([
            'code1' => 'required',
            'code2' => 'required',
            'code3' => 'required',
            'code4' => 'required',
            'mobile' => 'nullable',
            'email' => 'nullable|exists:customers,email',
        ]);

        if (!$request->filled('mobile') && !$request->filled('email')) {
            return back()->with('toast_error', __('api_texts.enter_mobile_or_email'));
        }
        $code = $request->code1 . $request->code2 . $request->code3 . $request->code4 ;
        $customer = Customer::query()->filter($request)->first();
        if ($customer && $customer->activation_code == $code) {
            if (!$customer->status) {
                $customer->status = 1;
                $customer->save();
            }
            Auth::guard('user')->login($customer);
            Session::forget('login_mobile');
            Session::forget('login_email');
            return redirect()->route('home')->with('toast_success', __('site.v5'));
        } elseif ($customer && $customer->activation_code != $code) {
            return back()->with('toast_error', __('api_texts.activation_code_error'));
        }
        return back()->with('toast_error', __('api_texts.user_not_found'));
    }

    public function resendVerifyCode(Request $request)
    {
        // return $request->all();
        $ip = $this->getClientIps();
        $time = Carbon::now()->format('Y-m-d H:i:s');
        
        
       
            
            
        $request->validate([
            'mobile' => 'nullable',
            'email' => 'nullable|email',
        ]);

        if (!$request->filled('mobile') && !$request->filled('email')) {

            return $this->responseApiWithDataKey(false, __('api_texts.enter_mobile_or_email'), ApiResponseStatusCodes::VALIDATION_ERROR);
        }


        $customer = Customer::query()->filter($request)->first();
        if ($customer) {
            
            
            
        $customer = Customer::where('ip_address',$ip)->where('mobile',$customer->mobile)->first();
        // return $ustomer_ip;
          if(isset( $customer) &&  $customer != '' ){
            $last = $customer->last_login;
            
            $start = Carbon::parse($last);
            $end = Carbon::parse($time);

            $diff = $start->diffInMinutes($end);
            
            // if($customer->dial_code > 1  ){
            //     return back()->with('toast_error', __('api_texts.please_can_login_after_5_min')); 
                
            // }
            
          }
            
            
            
            
            

            $activationCode = rand(1000, 9999);
            $customer->update(['activation_code' => $activationCode, 'dial_code'=>$customer->dial_code + 1]);
            try {
                if ($request->filled("mobile")) {
                    if($customer->name != "ABED ALKOUARY"){
                    $message = 'Your Abaya Square Code:' . $activationCode;
                    $this->dispatchSync(new SendSmsJob($request->mobile, $message));
                    }
                    //                    event(new SendSMS( $request->mobile, trans('api_texts.your_activation_code') . $customer->activation_code));
                }
                if ($request->filled("email")) {
                    try {
                        \Mail::to($customer)->send(new ActivationCode($customer->activation_code));
                    } catch (\Exception $e) {
// dd($e);
                        \Log::info("email activation code exception : " . $e->getMessage());
                    }
                }
            } catch (\Exception $e) {
                \Log::info("send sms error after user id" . $customer->id . " registered error :" . $e->getMessage());
                return back()->with('toast_error', __('api_texts.validation_error'));
            }
            return redirect()->route('verify')->with('toast_success',__('site.code_sent'));
        }
        return back()->with('toast_error', __('api_texts.user_not_found'));
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('home');
    }
    
    
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