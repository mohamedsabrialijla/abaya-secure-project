@extends('web.master')
@section('css')
@endsection
@section('title')
    @lang('site.cart')
@endsection
@section('content')
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10" style="background-color: #988a760d;">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="{{ route('home') }}"><i class="fal fa-home"></i></a></li>
                    <li>@lang('site.cart')</li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start cart =============================-->
    <section class="cart_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                        @foreach ($cartItems as $item)
                            <div class="my_products wow fadeInUp">
                                <div class="cart_product">
                                    <div class="info_broduct d-flex">
                                        <a href="{{ route('single_product', $item->attributes->product_id) }}" class="image d-block"><img
                                                src="{{ $item->attributes->image }}" alt=""></a>
                                        <div class="details">
                                            <h6 class="name"><a
                                                    href="{{ route('single_product', $item->attributes->product_id) }}">{{ $item->name }}</a></h6>
                                            <div class="price">
                                                <span class="num bold">{{ $item->price }}</span>
                                                <span class="text">@lang('site.rs')</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="meta mt-20">
                                        <div class="product-form product-size">
                                            <label>@lang('site.size'):</label>
                                            <div class="product-form-group">
                                                <label for="">{{ $item->attributes->size }}</label>
                                                {{-- <input type="text" disabled value="{{ $item['size'] }}" class="form-control"> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="product-form product-size">
                                            <label>@lang('site.color'):</label>
                                            <div class="product-form-group">
                                                <label for="">{{ $item['color'] }}</label>

                                            </div>
                                        </div> --}}
                                        {{-- <div class="product-form product-size">
                                            <label>@lang('site.quantity'):</label>
                                            <div class="product-form-group">
                                                <label for="">{{ $item['quantity'] }}</label>
                                                <input type="text" disabled value="{{ $item['quantity'] }}" class="form-control">
                                            </div>
                                        </div> --}}
                                        <div class="product-form product-qty">
                                            <label>@lang('site.quantity'):</label>
                                            <form action="{{ route('update_cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}" >
                                            <div class="product-form-group">
                                                <div class="input-group mr-2">
                                                    <button class="quantity-minus d-icon-minus update-cart"><i
                                                            class="fal fa-minus"></i></button>
                                                    <input class="quantity form-control" type="number" min="1"
                                                        max="1000000" value="{{ $item->quantity }}" name="quantity">
                                                    <button class="quantity-plus d-icon-plus update-cart"><i
                                                            class="fal fa-plus"></i></button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>


                                    </div>
                                    <div class="more_details">
                                        <button type="button" class="delete_product_btn " data-toggle="modal"
                                            data-target="#delete_product_modal{{ $item->id }}">
                                            <i class="fal fa-times-circle"></i>
                                        </button>
                                    </div>
                                    <!-- ==================== Delete product modal =================== -->

                                    <div class="modal fade custom_modal" data-id="{{ $item->id }}"
                                        id="delete_product_modal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('remove_from_cart') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="m-0">@lang('site.delete_cart')</p>
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="main-btn close animate"
                                                            data-dismiss="modal">@lang('site.no')</button>
                                                        <button type="submit"
                                                            class="main-btn main animate remove-from-cart">@lang('site.yes')</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ==================== Delete product modal =================== -->
                                </div>
                            </div>
                        @endforeach
                </div>
                <div class="col-lg-4">
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
                        <a href="{{ route('checkout') }}" class="main-btn main animate w-100">@lang('site.checkout')</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End cart =============================-->
@endsection

@section('js')
    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("div").attr("data-id"),
                    quantity: ele.parents("div").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        // $(".remove-from-cart").click(function(e) {
        //     e.preventDefault();

        //     var ele = $(this);


        //     $.ajax({
        //         url: '{{ route('remove_from_cart') }}',
        //         method: "DELETE",
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             id: ele.parents("div").attr("data-id")
        //         },
        //         success: function(response) {
        //             window.location.reload();
        //         }
        //     });

        // });
        
        //kfwrjkghjkrehtgjkwre

 <?php 
 $products2 = Session::get('products2'); 
 $products_session = Session::get('products'); 

 ?>
       
@if(isset($products) && count($products) > 0)

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_cart",
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
    
    
   @endif 



         
@if(isset($products_session) && count($products_session) > 0)

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_cart",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        @foreach($products_session as $k=>$product)
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
    
    
   @endif 
    



@if(isset($products2) && count($products2) > 0)
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "remove_from_cart",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        @foreach($products2 as $k=>$product)
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
              quantity: 1
            },
        @endforeach
        ]
        }
    });
     
@endif
    </script>
@endsection
