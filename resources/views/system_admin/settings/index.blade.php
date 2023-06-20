@extends('layouts.admin')

@php
    $Disname='الاعدادات';
    $Disinfo='الاعدادات الخاصة بالتطبيق ';
@endphp
@section('title',  $Disname)
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.settings.index'),'title'=>'الاعدادات']
        ]"/>
@endsection
@section('head')

@endsection
@section("styles")
    <style>
        #sizes_image img {
            width:50% !important;
            height: 200px !important;
        }
    </style>
@endsection
@section('page_content')


    <div class="card card-custom">
        <div class="card-header  card-header-tabs-line">
            <div class="card-title">
                <h3 class="card-label">{{$Disname}}
                    <div class="text-muted pt-2 font-size-sm">{{$Disinfo}}</div>
                </h3>
            </div>
            <div class="card-toolbar">


                <ul class="nav nav-tabs nav-bold nav-tabs-line">

{{--                    <li class="nav-item ">--}}
{{--                        <a class="nav-link  {{ (isset($active_tab) && $active_tab == 'tab11')?'active':''}}"--}}
{{--                           data-toggle="tab" href="#tab11">--}}
{{--                            اعدادات الموقع--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item tabs__item">
                        <a class="nav-link  {{count($errors)==0||$errors->has('currency_ar')||$errors->has('currency_en')||$errors->has('ios')||$errors->has('android')||$errors->has('bank_name')||$errors->has('iban') || (isset($active_tab) && $active_tab == 'tab1')?'active':''}}"
                           data-toggle="tab" href="#tab1">
                            اعدادات التطبيق
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link {{$errors->has('mobile')||$errors->has('email')||$errors->has('whatsapp')||$errors->has('instagram')||$errors->has('facebook')||$errors->has('twitter') || (isset($active_tab) && $active_tab == 'tab2')?'active':''}}"
                           data-toggle="tab" href="#tab2">
                            اعدادات التواصل
                        </a>

                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link {{$errors->has('internal_shipping_cost')||$errors->has('external_shipping_cost')|| (isset($active_tab) && $active_tab == 'tab6')?'active':''}}"
                           data-toggle="tab" href="#tab6">
                            اعدادات الشحن
                        </a>

                    </li>


                    <li class="nav-item m-tabs__item">
                        <a class="nav-link {{$errors->has('referral_register_points')||$errors->has('points_to_cash_one_sar')|| (isset($active_tab) && $active_tab == 'tab7')?'active':''}}"
                           data-toggle="tab" href="#tab7">
                            اعدادات النقاط
                        </a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link {{ (isset($active_tab) && $active_tab == 'tab10')?'active':''}}"
                           data-toggle="tab" href="#tab10">
                         صورة المقاسات
                        </a>
                    </li>





<!--                    @if(Auth::guard('system_admin')->user()->id == 1)
                        <li class="nav-item m-tabs__item ">
                            <a class="nav-link " href="{{route('system.settings.system_settings')}}">
                                اعدادات النظام
                            </a>

                        </li>
                    @endif-->
                </ul>
            </div>

        </div>

        <div class="card-body">

            <div class="m-content">
                <div class="row">
                    <div class="col-lg-12">



                        <div class="tab-content">
                            <!--begin::Portlet-->
{{--                            <div--}}
{{--                                class="tab-pane {{$errors->has('website_about_us')|| (isset($active_tab) && $active_tab == 'tab11')?'active':''}}"--}}
{{--                                id="tab11" role="tabpanel">--}}

{{--                                <form action="{{route('system.settings.settingAboutUs')}}" method="post" id="form">--}}

{{--                                    @csrf--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            @component('components.area_editor',['name'=>'website_about_us','data'=>HELPER::set_if($page['website_about_us']),'text'=>'عن التطبيق باللغة العربية ','placeholder'=>'عن التطبيق باللغة العربية','icon'=>''])--}}
{{--                                            @endcomponent--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col">--}}
{{--                                        <button type="submit" class="{{config('layout.classes.submit')}}">--}}
{{--                                            <i class="fa fa-check"></i>--}}
{{--                                            <span>تعديل</span>--}}
{{--                                        </button>--}}
{{--                                        <a href="{{route('system_admin.dashboard')}}"--}}
{{--                                           class="{{config('layout.classes.cancel')}}">--}}
{{--                                            <i class="la la-times"></i>--}}
{{--                                            <span>الغاء</span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}

{{--                                </form>--}}
{{--                            </div>--}}
                            <div
                                class="tab-pane {{(isset($active_tab) && $active_tab == 'tab10')?'active':''}}"
                                id="tab10" role="tabpanel">
                                <form action="{{route('system.settings.updateImage')}}" method="post" id="form">

                                    @csrf

                                <div class="col-md-12">

                                    @component('components.uploadModalImage',['name'=>'sizes_image','data'=>HELPER::set_if($page['sizes_image']),'text'=>'صورة المقاسات ','hint'=>'اضغط على الصورة لرفع صورة جديدة','id'=>'sizes_image','imgStyle'=>"width:50%!important"])
                                    @endcomponent
                                    <span class="text-danger" id="slider_image_error"></span>

                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="col">
                                            <button type="submit" class="{{config('layout.classes.submit')}}">
                                                <i class="fa fa-check"></i>
                                                <span>تعديل</span>
                                            </button>
                                            <a href="{{route('system_admin.dashboard')}}"
                                               class="{{config('layout.classes.cancel')}}">
                                                <i class="la la-times"></i>
                                                <span>الغاء</span>
                                            </a>
                                        </div>

                                        <div class="clearfix"></div>
                                        </form>
                                </div>
                            </div>


                                <div
                                class="tab-pane {{count($errors)==0||$errors->has('currency_ar')||$errors->has('currency_en')||$errors->has('ios')||$errors->has('android')||$errors->has('bank_name')||$errors->has('iban')|| (isset($active_tab) && $active_tab == 'tab1')?'active':''}}"
                                id="tab1" role="tabpanel">

                                <form action="{{route('system.settings.add')}}" method="post" id="form">

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'project_name_ar','data'=>HELPER::set_if($page['project_name_ar']),'text'=>'اسم التطبيق باللغة العربية ','placeholder'=>'اسم التطبيق باللغة العربية','icon'=>''])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'project_name_en','data'=>HELPER::set_if($page['project_name_en']),'text'=>'اسم التطبيق باللغة الانجليزية','placeholder'=>'اسم التطبيق باللغة العربية','icon'=>''])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'currency_ar','data'=>HELPER::set_if($page['currency_ar']),'text'=>'العملة باللغة العربية ','placeholder'=>'ادخل العملة باللغة العربية','icon'=>'fa-dollar-sign'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'currency_en','data'=>HELPER::set_if($page['currency_en']),'text'=>'العملة باللغة الانجليزية','placeholder'=>'ادخل العملة باللغة الانجليزية','icon'=>'fa-dollar-sign'])
                                            @endcomponent
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'ios','data'=>HELPER::set_if($page['ios']),'text'=>'رابط التطبيق ايفون ','icon'=>'fa-globe'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'android','data'=>HELPER::set_if($page['android']),'text'=>'رابط التطبيق اندرويد','icon'=>'fa-globe'])
                                            @endcomponent
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'app_commission_ratio','data'=>HELPER::set_if($page['app_commission_ratio']),'text'=>" نسبة التطبيق من الطلبات %",'icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'return_max_day','data'=>HELPER::set_if($page['return_max_day']),'text'=>"عدد ايام ارجاع المنتج بعد الاستلام",'icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'random_from','data'=>HELPER::set_if($page['random_from']),'text'=>"الحد الادني للمشاهدات",'icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'random_to','data'=>HELPER::set_if($page['random_to']),'text'=>"الحد الاعلي للمشاهدات",'icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'tax','data'=>HELPER::set_if($page['tax']),'text'=>"نسبة الضريبة %",'icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>




                                        {{--                                        <div class="w-100"></div>--}}
                                        {{--                                        <div class="col-md-6">--}}
                                        {{--                                            @component('components.input',['name'=>'bank_name','data'=>HELPER::set_if($page['bank_name']),'text'=>'اسم البنك','icon'=>'fa-dollar-sign'])--}}
                                        {{--                                            @endcomponent--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="col-md-6">--}}
                                        {{--                                            @component('components.input',['name'=>'iban','data'=>HELPER::set_if($page['iban']),'text'=>'اي بان','icon'=>'fa-dollar-sign'])--}}
                                        {{--                                            @endcomponent--}}
                                        {{--                                        </div>--}}


                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="{{config('layout.classes.submit')}}">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="{{route('system_admin.dashboard')}}"
                                           class="{{config('layout.classes.cancel')}}">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>

                            <div
                                class="tab-pane {{$errors->has('mobile')||$errors->has('email')||$errors->has('whatsapp')||$errors->has('address')||$errors->has('facebook')||$errors->has('twitter')||$errors->has('snapchat')||$errors->has('instagram') || (isset($active_tab) && $active_tab == 'tab2')?'active':''}}"
                                id="tab2" role="tabpanel">

                                <form action="{{route('system.settings.addMedia')}}" method="post" id="form">

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'mobile','data'=>HELPER::set_if($page['mobile']),'text'=>'جوال','placeholder'=>'ادخل الجوال بصيغة: 966595341355','icon'=>'fa-phone','hint'=>'966595341355'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'email','data'=>HELPER::set_if($page['email']),'text'=>'ايميل','placeholder'=>'ادخل الايميل','icon'=>'fa-envelope'])
                                            @endcomponent
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'whatsapp','data'=>HELPER::set_if($page['whatsapp']),'text'=>'واتساب','placeholder'=>'ادخل الواتساب بصيغة: 966595341355','icon'=>'fa-phone','hint'=>'966595341355'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'address','data'=>HELPER::set_if($page['address']),'text'=>'العنوان','placeholder'=>'ادخل العنوان','icon'=>'fa-map'])
                                            @endcomponent
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'facebook','data'=>HELPER::set_if($page['facebook']),'text'=>'فيس بوك','icon_pre'=>'fab ','icon'=>'fa-facebook','not_req'=>true])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'twitter','data'=>HELPER::set_if($page['twitter']),'text'=>'رابط تويتر','placeholder'=>'ادخل رابط تويتر','icon_pre'=>'fab ','icon'=>'fa-twitter','not_req'=>true])
                                            @endcomponent
                                        </div>

                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'snapchat','data'=>HELPER::set_if($page['snapchat']),'text'=>'رابط سناب','placeholder'=>'ادخل رابط سناب شات','icon_pre'=>'fab ','icon'=>'fa-snapchat','not_req'=>true])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'instagram','data'=>HELPER::set_if($page['instagram']),'text'=>'رابط انيستجرام','placeholder'=>'ادخل رابط انيستجرام ','icon_pre'=>'fab ','icon'=>'fa-instagram','not_req'=>true])
                                            @endcomponent
                                        </div>
                                        <div class="w-100"></div>

                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="{{config('layout.classes.submit')}}">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="{{route('system_admin.dashboard')}}"
                                           class="{{config('layout.classes.cancel')}}">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>

                            <div
                                class="tab-pane disabled {{$errors->has('internal_shipping_cost') || $errors->has('external_shipping_cost') || (isset($active_tab) && $active_tab == 'tab6')?'active':''}}"
                                id="tab6" role="tabpanel">

                                <form action="{{route('system.settings.addShippingCost')}}" method="post" id="form">

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'internal_shipping_cost','data'=>HELPER::set_if($page['internal_shipping_cost']),'text'=>'تكلفة الشحن الداخلية','placeholder'=>'تكلفة الشحن الداخلية','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'external_shipping_cost','data'=>HELPER::set_if($page['external_shipping_cost']),'text'=>'تكلفة الشحن الخارجية','placeholder'=>'تكلفة الشخن الخارجية','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                    </div>
                                    {{--                                    <div class="row">--}}
                                    {{--                                        <div class="col-md-12">--}}
                                    {{--                                            @component('components.area',['name'=>'about_text','data'=>HELPER::set_if($page['about_text']),'text'=>'نص تعرف معنا علي شركة ساري'])--}}
                                    {{--                                            @endcomponent--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="w-100"></div>--}}
                                    {{--                                    </div>--}}

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="{{config('layout.classes.submit')}}">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="{{route('system_admin.dashboard')}}"
                                           class="{{config('layout.classes.cancel')}}">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>

                            <div
                                class="tab-pane disabled {{$errors->has('referral_register_points') || $errors->has('points_to_cash_one_sar') || (isset($active_tab) && $active_tab == 'tab7')?'active':''}}"
                                id="tab7" role="tabpanel">

                                <form action="{{route('system.settings.addPoints')}}" method="post" id="form">

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'referral_register_points','data'=>HELPER::set_if($page['referral_register_points']),'text'=>' عدد النقاط لكل طلب جديد','placeholder'=>' عدد النقاط لكل طلب جديد','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'points_to_cash_one_sar','data'=>HELPER::set_if($page['points_to_cash_one_sar']),'text'=>'عدد النقاط مقابل الريال الواحد','placeholder'=>'عدد النقاط مقابل الريال الواحد','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            @component('components.input',['name'=>'promo_code_discount_ratio','data'=>HELPER::set_if($page['promo_code_discount_ratio']),'text'=>'نسبة الخصم من خصم عمولة التطبيق','placeholder'=>'نسبة الخصم من عمولة التطبيق','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber'])
                                            @endcomponent
                                        </div>
                                    </div>


                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="{{config('layout.classes.submit')}}">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="{{route('system_admin.dashboard')}}"
                                           class="{{config('layout.classes.cancel')}}">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



@section('custom_scripts')
    <script>
        $(function () {
            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',

            }).init();


        })

    </script>

@endsection
