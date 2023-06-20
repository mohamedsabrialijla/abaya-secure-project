@extends('web.master')
@section('css')
@endsection

@section('content')
    <!--======================== Start breadcrumb =============================-->
    {{-- <div class="breadcrumb pt-10 pb-10">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="#"><i class="fal fa-home"></i></a></li>
                    <li><a href="#">الطلبات</a></li>
                    <li>اسم الطلب</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start order =============================-->
    
    
    <!--@if (Session::has('success'))-->
    <!--    <ul style="border: 1px solid #01b070; background-color: white">-->
    <!--        <li style="color: #01b070; margin: 15px">jkhjkhjkhhk</li>-->
    <!--    </ul>-->
    <!--@endif-->
    <section class="order_page"  >
        <div class="container">

            <div class="form-wizard-header">
                <ul class="list-unstyled form-wizard-steps clearfix" id="progressbar">
                    @if (is_null($casenew))
                        <li>
                            <div class="icon">
                                <i class="fal fa-bags-shopping"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o4')</h6>
                            </div>
                        </li>
                    @else
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-bags-shopping"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o4')</h6>
                                <span
                                    class="date">{{ \Carbon\Carbon::parse(@$casenew->created_at)->translatedFormat('D jS M Y g:i a') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (is_null($caseconfirm))
                        <li>
                            <div class="icon">
                                <i class="fal fa-thumbs-up"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o5')</h6>
                            </div>
                        </li>
                    @else
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-thumbs-up"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o5')</h6>
                                <span
                                    class="date">{{ \Carbon\Carbon::parse(@$caseconfirm->created_at)->translatedFormat('D jS M Y g:i a') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (is_null($caseshipping))
                        <li>
                            <div class="icon">
                                <i class="fal fa-truck-loading"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o6')</h6>
                            </div>
                        </li>
                    @else
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-truck-loading"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o6')</h6>
                                <span
                                    class="date">{{ \Carbon\Carbon::parse(@$caseshipping->created_at)->translatedFormat('D jS M Y g:i a') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (is_null($caseshipped))
                        <li>
                            <div class="icon">
                                <i class="fal fa-shipping-timed"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o7')</h6>
                            </div>
                        </li>
                    @else
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-shipping-timed"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o7')</h6>
                                <span
                                    class="date">{{ \Carbon\Carbon::parse(@$caseshipped->created_at)->translatedFormat('D jS M Y g:i a') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (is_null($casedelivery))
                        <li>
                            <div class="icon">
                                <i class="fal fa-shipping-fast"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o8')</h6>
                            </div>
                        </li>
                    @else
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-shipping-fast"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o8')</h6>
                                <span
                                    class="date">{{ \Carbon\Carbon::parse(@$casedelivery->created_at)->translatedFormat('D jS M Y g:i a') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (is_null($casedelivered))
                        <li>
                            <div class="icon">
                                <i class="fal fa-check-double"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o9')</h6>
                            </div>
                        </li>
                    @else
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-check-double"></i>
                            </div>
                            <div class="details">
                                <h6>@lang('site.o9')</h6>
                                <span
                                    class="date">{{ \Carbon\Carbon::parse(@$casedelivered->created_at)->translatedFormat('D jS M Y g:i a') }}</span>
                            </div>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="mt-50">
                <a href="{{ $order->invoice_url }}" target="_blank" class="main-btn main animate">
                    @lang('site.o1')
                </a>
                {{-- <a href="http://www.sls-express.com/api/v1/order/waybill?api_token=IhexECgpAL84uzUb8uYWzdT1iDktRaX7f7nXjSE28t&tracking_number={{ $order->shipment_id }}"
                    target="_blank" class="main-btn main animate">
                    @lang('site.o2')
                </a> --}}
                @if ($order->case_id > 3 && $order->case_id != 9)

                <a href="http://www.sls-express.com/tracking?tracking_number={{ $order->shipment_id }}" target="_blank"
                    class="main-btn main animate">
                    @lang('site.o3')
                </a>
                @endif
            </div>
            <div>
                <div class="box-style">
                    <h4>@lang('site.o11')</h4>
                    <div class="details">
                        <div class="item">
                            <h6>@lang('site.o12'):</h6>
                            <span>#{{ $order->invoice_number }}</span>
                        </div>
                        <div class="item">
                            <h6>@lang('site.o13'):</h6>
                            <span class="calendar">
                                <i class="fa fa-calendar" aria-hidden="true"></i>

                                {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}

                                <i class="fa fa-clock" aria-hidden="true"></i>

                                {{ \Carbon\Carbon::parse($order->created_at)->format('H:i A') }}

                            </span>
                        </div>
                        <div class="item">
                            <h6>@lang('site.o14'):</h6>
                            <span>
                                {{ @$order->paymentType->name }}
                            </span>
                            &nbsp; &nbsp;
                            @if ($order->payment_type_id != 4 && $order->use_wallet)
                                @lang('site.18')({{ $order->wallet_amount }})
                            @endif
                        </div>
                        @if ($order->transaction && $order->transaction->tranid)
                            <div class="item">
                                <h6>@lang('site.o15'):</h6>
                                <span>{{ @$order->transaction->tranid }}</span>
                            </div>
                        @endif
                        <div class="item">
                            <h6>@lang('site.o16'):</h6>
                            <span>{{ @$order->status->name }}</span>
                        </div>
                        @if ($order->shipment_id)
                            <div class="item">
                                <h6>@lang('site.o16'):</h6>
                                <span>{{ @$order->shipment_id }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box-style">
                    <h4>@lang('site.o10')</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('site.o19')</th>
                                    <th scope="col">@lang('site.o20')</th>
                                    <th scope="col">@lang('site.o21')</th>
                                    <th scope="col">@lang('site.o22')</th>
                                    <th scope="col">@lang('site.o23')</th>
                                    <th scope="col">@lang('site.o24')</th>
                                    <th scope="col">@lang('site.o25')</th>
                                    <th scope="col">@lang('site.o26')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset('uploads/' . @$product->product->image) }}" /></td>
                                        <td>{{ @$product->product->store->name }}</td>
                                        <td>{{ @$product->product->name }}</td>
                                        <td>{{ @$product->size->name }}</td>
                                        <td>{{ @$product->qty }}</td>
                                        <td>{{ @$product->price }}</td>
                                        <td>{{ @$product->discount }}</td>
                                        <td>{{ @$product->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="box-style">
                    <h4>@lang('site.o27')</h4>
                    <div class="details">
                        <div class="item">
                            <h6>@lang('site.o28'):</h6>
                            <span>{{ $order->sub_total_1 }} <span>{{ $currency }}</span></span>
                        </div>
                        <div class="item">
                            <h6>@lang('site.o29'):</h6>
                            <span>{{ @$order->tax }} <span>{{ $currency }}</span> </span>
                        </div>
                        <div class="item">
                            <h6>@lang('site.o30'):</h6>
                            <span> {{ @$order->discount }} <span>{{ $currency }}</span></span>
                        </div>
                        <div class="item">
                            <h6>@lang('site.o31'):</h6>
                            <span> {{ $order->delivery_cost }} <span>{{ $currency }}</span></span>
                        </div>
                    </div>
                    <hr>
                    <div class="details">
                        <div class="item">
                            <h6>@lang('site.o32'):</h6>
                            <span>{{ $order->total }} <span>{{ $currency }} </span></span>
                        </div>
                        {{-- <div class="item">
                            <h6>@lang('site.33'):</h6>
                            <span> </span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End order =============================-->
@endsection

@section('js')
<script>
    $( document ).ready(function() {
    $('.swal2-icon-success').attr('id', 'success_payment_in_abayasquare');
});



dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_payment_info",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        
        ]
        }
    });
     

@if($check == 1)

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "purchase",
  ecommerce: {
      transaction_id: "T_{{$order->id}}",
      value: "{{$order->total}}",
      tax: "{{$order->tax}}",
      shipping: "0.0",
      currency: "SAR",
      coupon: "SUMMER_SALE",
      items: [
      @foreach($products as $product)
       {
        item_id: "SKU_{{$product->id}}",
        item_name: "{{$product->name}}",
        affiliation: "Google Merchandise Store",
        coupon: "SUMMER_FUN",
        discount: "0.0",
        index: "{{$product->id}}",
        item_category4: "{{$check}}",
        item_category5: "Short sleeve",
        item_list_id: "related_products",
        item_list_name: "Related Products",
        item_variant: "green",
        location_id: "ChIJIQBpAG2ahYAR_6128GcTUEo",
        price: {{$product->sale_price}},
        quantity: 1
      },
      @endforeach
      ]
      //rwjgrk
  }
});

@endif

</script>
@endsection
