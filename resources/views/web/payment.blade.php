@extends('web.master')
@section('css')
<script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
<style>
    apple-pay-button {
      --apple-pay-button-width: 140px;
      --apple-pay-button-height: 30px;
      --apple-pay-button-border-radius: 5px;
      --apple-pay-button-padding: 5px 0px;
    }
    </style>
@endsection

@section('content')
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10" style="background-color: #988a760d;">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="{{ route('home') }}"><i class="fal fa-home"></i></a></li>
                    <li><a href="{{ route('cart') }}">@lang('site.cart')</a></li>
                    <li>@lang('site.checkout')</li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start cart =============================-->
    <section class="cart_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp">
                    <div id="payment_process">


                        <main class="sections-wrapper">
                            <header class="store-info">
                                <div class="flex-h">
                                    <div class="store-info__logo">
                                        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.webp') }}"
                                                alt="Logo"></a>
                                    </div>
                                    <div class="store-info__detail">
                                        <h1>@lang('site.hello') {{ Auth::guard('user')->user()->name }}</h1>
                                    </div>
                                </div>
                            </header>
                            <div class="section section--payment">
                                <form action="{{ route('payment') }}" method="post" id="shipping_form"
                                    class="form form--options-edit">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="shipping_step" class="payment-step">
                                                <div data-step="1" class="title title--step"><img
                                                        src="{{ asset('assets/img/icons/step-shipping.svg') }}">
                                                    <h3>@lang('site.py1')</h3>
                                                </div>

                                            </div>
                                            <div id="shipping_method_fields">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="title title--small title--smaller">
                                                            <h2>@lang('site.py2')</h2>
                                                        </div>
                                                        <ul id="address_list" class="list list--shipping-address">
                                                            <li class="new-address">
                                                                <input type="radio" id="add_new_address" name="address"
                                                                    class="payment_method_input d-none">
                                                                <label for="add_new_address" class="btn btn--address-new"
                                                                    data-toggle="modal"
                                                                    data-target="#add_new_address_modal">
                                                                    <i class="fal fa-map-marker-alt"></i>
                                                                    <span>@lang('site.pr11')</span>
                                                                </label>
                                                            </li>
                                                            @foreach ($addresses as $address)
                                                                <li>
                                                                    <div class="address-entry">
                                                                        <input type="radio"
                                                                            id="address-entry-{{ $address->id }}"
                                                                            name="address_id" value="{{ $address->id }}"
                                                                            class="payment_method_input d-none"
                                                                            checked="">
                                                                        <label for="address-entry-{{ $address->id }}">

                                                                            <b>{{ $address->name }}</b>
                                                                            <p>{{ $address->address }}</p>

                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-md-12">
                                            <div id="payment_step" class="payment-step mb-0">
                                                <div data-step="2" class="title title--step"><img
                                                        src="{{ asset('assets/img/icons/step-payment.svg') }}">
                                                    <h3>@lang('site.py4')</h3>
                                                </div>
                                                <div id="payment_methods_wrapper">
                                                    <ul id="payment_methods" class="list list--payment-methods">
                                                        @if ($cod > 0)

                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="cash-option"
                                                                value="1" class="d-none payment_method_input"
                                                                data-method="stcpay_method" checked>
                                                            <label for="cash-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img style="height:27px"
                                                                    src="{{ asset('assets/img/icons/handshake.png') }}"
                                                                    alt="Mada">
                                                                <h6 style="margin: 4px 0 0 0; font-size: 13px;">
                                                                    @lang('site.py6')</h6>
                                                            </label>
                                                        </li>
                                                        @else
                                                        
                                                         <li style="opacity: .5;">
                                                            
                                                            <label for="cash-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img style="height:27px"
                                                                    src="{{ asset('assets/img/icons/handshake.png') }}"
                                                                    alt="Mada">
                                                                <h6 style="margin: 4px 0 0 0; font-size: 13px;">
                                                                    @lang('site.py6')</h6>
                                                            </label>
                                                        </li>
                                                        
                                                        @endif
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="mada-option"
                                                                value="3" class="d-none payment_method_input"
                                                                data-method="no_method" checked>
                                                            <label for="mada-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="{{ asset('assets/img/icons/pay-option-mada.svg') }}"
                                                                    alt="Mada">
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="credit-option"
                                                                value="2" class="d-none payment_method_input"
                                                                data-method="no_method">
                                                            <label for="credit-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="{{ asset('assets/img/icons/pay-option-credit-2.svg') }}"
                                                                    alt="Credit card Logo" class="large">
                                                            </label>
                                                        </li>
                                                        <!--<li>-->
                                                        <!--    <input type="radio" name="paymentMethod"-->
                                                        <!--        id="applepay-option" value="5"-->
                                                        <!--        class="d-none payment_method_input"-->
                                                        <!--        data-method="no_method">-->
                                                        <!--    <label for="applepay-option"-->
                                                        <!--        class="btn btn--round btn--payment-option">-->
                                                        <!--        <img src="{{ asset('assets/img/icons/applepay.svg') }}"-->
                                                        <!--            alt="applepay">-->
                                                        <!--    </label>-->
                                                        <!--</li>-->
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="tamara-option"
                                                                value="10" class="d-none payment_method_input"
                                                                data-method="tamara_method">
                                                            <label for="tamara-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="{{ asset('assets/img/icons/ar-label.svg') }}"
                                                                    alt="Tamara">
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="Tabby-option"
                                                                value="6" class="d-none payment_method_input"
                                                                data-method="tabby_method">
                                                            <label for="Tabby-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="{{ asset('assets/img/icons/pay-option-tabby_en.webp') }}"
                                                                    alt="Tabby">
                                                            </label>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="form--payment">
                                                    <div class="all_methods">
                                                        <div class="method-box" id="tamara_method">
                                                            <div class="row row-payment">
                                                                <div class="col-md-12">
                                                                    <div class="tamara-installment-plan-widget"
                                                                        data-lang="{{ app()->getLocale() }}" data-price="{{ \Cart::getTotal()+session()->get('ship') }}"
                                                                        data-currency="SAR" data-color-type="default"
                                                                        data-country-code="SA"
                                                                        data-number-of-installments="3">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="method-box" id="tabby_method">
                                                            <div class="row row-payment">

                                                                    <div id="tabbyCard" style="width: 100%">

                                                                    </div>
                                                                    {{-- <button data-tabby-info="installments|payLater">ⓘ</button> --}}

                                                            </div>
                                                        </div>
                                                        <div class="method-box" id="no_method"></div>
                                                    </div>
                                                    <button id="submit-form-btn"
                                                        class="main-btn main animate w-100 border-0">
                                                        <span>@lang('site.py5')</span>
                                                    </button>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                </form>
                            </div>

                        </main>
                        <ul class="list list--brands">
                            <li>@lang('site.py7')</li>
                            <li><img src="{{ asset('assets/img/icons/secure-payment.svg') }}"></li>
                            <li><img src="{{ asset('assets/img/icons/secure-payment-02.svg') }}"></li>
                            <li><img src="{{ asset('assets/img/icons/secure-payment-03.svg') }}"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    {{-- <div class="cart_cardSide wow fadeInUp sticky mt-md-30">
                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.py8')</span>
                            <span class="num">{{ \Cart::getTotal() }}  @lang('site.rs') </span>
                        </div>
                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.tax') (%0)</span>
                            <span class="num">0 @lang('site.rs')</span>
                        </div>
                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.o36')</span>
                            <span class="num">{{ \Cart::getSubTotal() }}  @lang('site.rs')</span>
                        </div>
                        <div class="coupon_box">
                            <div>
                                <button class="btn btn--link btn--coupon">@lang('site.py10')</button>
                                <form name="coupon_form" action="#" class="form form--payment form--coupon"
                                    style="display: none;">
                                    <div class="form-group">
                                        <i class="fal fa-times clear-input"></i>
                                        <input id="coupon_field" type="text" placeholder="ادخل رمز الكوبون"
                                            class="form-control">
                                        <button id="coupon_form_submit" type="button" class="btn btn--primary"
                                            disabled="">تطبيق</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="#" class="main-btn main animate w-100">@lang('site.py9')</a>

                    </div> --}}
                    <div class="cart_cardSide wow fadeInUp sticky mt-md-30">

                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.py8')</span>
                            @php
                                $ttotal = 0;
                                foreach ($cartItems as $item) {
                                    $ttotal = $ttotal+$item->getPriceSum();
                                }

                            @endphp
                            <span class="num">{{ $ttotal }}  @lang('site.rs') </span>
                        </div>
                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.tax') (%0)</span>
                            <span class="num">0 @lang('site.rs')</span>
                        </div>
                        @if (!is_null(session()->get('ship')))

                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.co9')</span>
                            @if ((!is_null(\Cart::getConditionsByType('ship')->first())))

                            <span class="num" style="color: rgb(25, 192, 25)"> @lang('site.co10')</span>
                            @else
                            <span class="num" > {{ session()->get('ship') }} @lang('site.rs')</span>

                            @endif
                        </div>
                        @endif
                        @if ($ttotal - \Cart::getTotal() > 0)

                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.co11')</span>
                            <span class="num">{{ $ttotal - \Cart::getTotal()}} @lang('site.rs')</span>
                        </div>
                        @endif
                        <div class="head flex-h flex-between">
                            <span class="text">@lang('site.o36')</span>
                            @if ((!is_null(\Cart::getConditionsByType('ship')->first())))

                            <span class="num">{{ \Cart::getTotal() }}  @lang('site.rs')</span>
                            @elseif (!is_null(session()->get('ship')))
                            <span class="num">{{ \Cart::getTotal()+session()->get('ship') }}  @lang('site.rs')</span>

                            @else
                            <span class="num">{{ \Cart::getTotal() }}  @lang('site.rs')</span>


                            @endif
                        </div>
                        <div class="coupon_box">
                        <div>
                            <button class="btn btn--link btn--coupon">@lang('site.co1')</button>
                            <form name="coupon_form" action="{{ route('checkCoupon') }}" method="POST" class="form form--payment form--coupon" style="display: none;">
                                @csrf
                                <fieldset class="form-group">
                                    <i class="fal fa-times clear-input"></i>
                                    <input id="coupon_field" type="text" name="code" placeholder="@lang('site.co2')" class="form-control" required>
                                    <button id="coupon_form_submit" type="submit" class="btn btn--primary" >@lang('site.co3')</button>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                    <apple-pay-button buttonstyle="black" type="buy" locale="el-GR"></apple-pay-button>

                </div>
            </div>
        </div>
    </section>
    <!--======================== End cart =============================-->
    <!-- ==================== Edit product modal =================== -->
    <div class="modal fade" data-id="" id="add_new_address_modal" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('addaddress') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.name')</label>
                                    <div class="input-box">
                                        {{-- <span class="icon"><i class="fal fa-road"></i></span> --}}
                                        <input class="form-control" name="name" type="text"
                                            placeholder="@lang('site.name')" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.phone_number')</label>
                                    <div class="input-box">
                                        <select name="mobile_code" id="">
                                            <option value="966">966</option>
                                            <option value="965">965</option>
                                            <option value="971">971</option>
                                            <option value="974">974</option>
                                            <option value="973">973</option>
                                        </select>
                                        {{-- <span class="icon"><i class="fal fa-phone"></i></span> --}}
                                        <input class="form-control" name="mobile" type="number" value=""
                                            placeholder="56xxxxxxxxxx" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.py11')</label>
                                    <select class="select2" name="country" required>
                                        <option value="">@lang('site.py11')
                                        </option>
                                        @foreach ($govs as $gov)
                                            @if (app()->getLocale() == 'ar')
                                                <option value="{{ $gov->id }}">
                                                    {{ $gov->name_ar }}</option>
                                            @else
                                                <option value="{{ $gov->id }}">
                                                    {{ $gov->name_en }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.py12')</label>
                                    <select name="state" class="select2" required>
                                        <option value=""> @lang('site.py12')
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">@lang('site.address')</label>
                                    <textarea name="address" type="text" id="" class="form-control" required
                                        placeholder="@lang('site.address')" style="height: 100px; resize: none;"></textarea>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="main-btn close border-0"
                            data-dismiss="modal">@lang('site.close')</button>
                        <button type="submit"
                            class="main-btn main animate remove-from-cart border-0">@lang('site.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================== Edit product modal =================== -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="country"]').on('change', function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: '{{ url('findCity') }}/' + countryID,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('#loader').css("visibility", "visible");
                    },

                    success: function(data) {

                        $('select[name="state"]').empty();
                        $('select[name="state"]').append(
                            '<option value="">@lang('site.py12')</option>');


                        $.each(data, function(key, value) {

                            $('select[name="state"]').append('<option value="' +
                                key + '">' + value + '</option>');

                        });
                    },
                    complete: function() {
                        $('#loader').css("visibility", "hidden");
                    }
                });
            } else {
                $('select[name="state"]').empty();
            }
        });

    });
</script>
@section('js')

<script src="https://checkout.tabby.ai/tabby-card.js"></script>
<script src="https://unpkg.com/bowser@2.7.0/es5.js"></script>

<script>
new TabbyCard({
  selector: '#tabbyCard', // empty div for TabbyCard
  currency: 'SAR', // or SAR, BHD, KWD, EGP
  lang: {!! json_encode(app()->getLocale()) !!}, // or ar
  price: {!! json_encode(\Cart::getTotal()+session()->get('ship')) !!},
  size: 'wide', // or wide, depending on the width
  theme: 'default', // or can be black
  header: true // if there is a Payment method name already
});
</script>

<script src="https://cdn.tamara.co/widget/installment-plan.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    var result = bowser.getParser(window.navigator.userAgent);
   // if(result.parsedResult.browser.name != 'Safari' || result.parsedResult.browser.name == 'Safari'){
        $('#applepay-option').parent().hide();
   // }
    
    
    $('#tamara-option').click(function() {
    // alert($(this).attr('id')); qrqtr'
    var price = $('.num:last').html().match(/\d+/)[0];
    if(price < 100 ){
        swal("مرحبا بك , لن تتم عملية الدفع تمارا مجموع الطلب اقل من 100 رس")

    }
    
});

</script>
<script>


    setTimeout(() => {
      if (window.TamaraInstallmentPlan) {
        window.TamaraInstallmentPlan.init({ lang: 'en' })
        window.TamaraInstallmentPlan.render()
      }
    }, 2000) // Waiting for 2s - Make sure Tamara's widget is installed
  </script>
    <script>
        $('#payment_methods .payment_method_input').on('change', function() {

            var id = $(this).attr('data-method')

            $('.method-box[id="' + id + '"]').addClass('active').siblings().removeClass('active')

        })


        $(".payment_method_input[name='address']").on('change', function() {
            if ($("#add_new_address").is(':checked')) {
                $("#new_address_box").slideDown();

            } else {
                $("#new_address_box").slideUp();
            }
        })

        $("#edit_address_btn").on('click', function() {
            $("#new_address_box").slideDown();
        })
        
        
        
        
        
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_payment_info",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        @foreach($products as $k=>$product)
            {
              item_id: "SKU_{{$product->id}}",
              item_name: "{{$product->name}}",
              affiliation: "google merchant store",
              coupon: "",
              discount: {{$product->discount_ratio}},
              index: {{$product->id}},
              item_brand: "@if(isset($product->store) && $product->store->name != '') {{$product->store->name}} @endif",
              item_category: "{{$product->category->name}}",
              item_list_id: "{{$product->category->id}}",
              item_list_name: "{{$product->category->name}}",
              item_variant: "",
              location_id: "",
              price: {{$product->sale_price}},
              quantity: {{$quentites[$k]}}
            },
        @endforeach
        ]
        }
    });
    
    
          
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "begin_checkout",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        @foreach($products as $k=>$product)
            {
              item_id: "SKU_{{$product->id}}",
              item_name: "{{$product->name}}",
              affiliation: "google merchant store",
              coupon: "",
              discount: {{$product->discount_ratio}},
              index: {{$product->id}},
              item_brand: "@if(isset($product->store) && $product->store->name != '') {{$product->store->name}} @endif",
              item_category: "{{$product->category->name}}",
              item_list_id: "{{$product->category->id}}",
              item_list_name: "{{$product->category->name}}",
              item_variant: "",
              location_id: "",
              price: {{$product->sale_price}},
              quantity: {{$quentites[$k]}}
            },
        @endforeach
        ]
        }
    });
    </script>
@endsection
