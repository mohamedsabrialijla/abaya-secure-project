<?php

namespace App\Http\Controllers;

use App\Jobs\SendSmsJob;
use App\Mail\ActivationCode;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Gov;
use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use DB;
use Validator;

class ProfileController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function profile()
    {
        $settings = new Settings();
        $currency = $settings->valueOf('currency_ar');
        $customer = Customer::find(Auth::guard('user')->user()->id);
        $notifications = $customer->notifications;
        $addresses = $customer->addresses;
        $dateNow = Carbon::now();
        $govs = Gov::with('cities')->get();
        $coupons = Coupon::query()->AbleToUse(null)->where('show', 1)->orderBy('created_at', 'desc')->get();

        return view('web.profile', compact('customer', 'coupons', 'notifications', 'addresses', 'currency', 'govs'));
    }

    public function updateProfile(Request $request)
    {
        $customer = Customer::find(Auth::guard('user')->user()->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|unique:customers,mobile,' . $customer->id,
            'email' => 'nullable|email|max:255|unique:customers,email,' . $customer->id,
            'avatar' => 'image|nullable'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        try {
            $dialCode = substr($request->mobile, 0, 3);
            $country = Country::where('phone', $dialCode)->first();
            if ($country) {
                if ($country->mobile_digits != strlen(substr($request->mobile, 3))) {
                    return back()->with('toast_error', __('validation.attributes.mobile'));
                }
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
                $this->dispatchNow(new SendSmsJob($request->mobile, $message));
            }
            return back()->with('success', __('api_texts.default_message'));
        } catch (\Exception $e) {
            return back()->with('toast_error', __('api_texts.something_error'));
        }


        return back()->with('success', __('api_texts.default_message'));
    }

    public function addaddress(Request $request)
    {

        $customer = Customer::find(Auth::guard('user')->user()->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'mobile_code' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        if ($request->country == 1) {
            $is_internal = 1;
        } else {
            $is_internal = 0;
        }
        DB::beginTransaction();
        try {

            $data = [
                'name' => $request->name,
                'mobile' => $request->mobile_code . $request->mobile,
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'customer_id' => $customer->id,
                'type' => 'home',
                'is_internal' => $is_internal,
                'area_id' => $request->state
            ];
            CustomerAddress::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('toast_error', __('api_texts.something_error'));
        }
        return back()->with('success', __('api_texts.default_message'));
    }

    public function editaddress(Request $request)
    {

        $customer = Customer::find(Auth::guard('user')->user()->id);
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'state' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        if ($request->country == 1) {
            $is_internal = 1;
        } else {
            $is_internal = 0;
        }
        DB::beginTransaction();
        try {

            $data = [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'customer_id' => $customer->id,
                'type' => 'home',
                'is_internal' => $is_internal,
                'area_id' => $request->state
            ];
            $address = CustomerAddress::find($request->id);

            $address->Update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('toast_error', __('api_texts.something_error'));
        }
        return back()->with('success', __('api_texts.default_message'));
    }

    public function deleteaddress(Request $request)
    {
        if ($request->address_id) {
            $address = CustomerAddress::where('customer_id', Auth::guard('user')->user()->id)->find($request->address_id);
            if ($address) {
                $address->delete();
            } else {
                return back()->with('toast_error', __('api_texts.something_error'));
            }
            return back()->with('toast_success', __('api_texts.default_message'));
        }
    }
}
