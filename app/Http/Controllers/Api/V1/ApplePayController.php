<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ApplePayController extends Controller
{

    public function getForm(Request $request, Order $order){

        $data['PRODUCTION_MERCHANTIDENTIFIER']='merchant.com.selsela.abayasquare';
        $data['PRODUCTION_CURRENCYCODE']='SAR';
        $data['PRODUCTION_COUNTRYCODE']='SA';
        $data['PRODUCTION_DISPLAYNAME']='عباية سكوير';
        $data['order']=$order;
        return view('system_admin.applePay.payment_form',$data);
    }

    public function pay(Request $request){

    }
}
