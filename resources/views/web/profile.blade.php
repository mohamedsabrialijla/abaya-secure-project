@extends('web.master')
@section('css')
@endsection
@section('title')
    @lang('site.profile')
@endsection

@section('content')
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10" style="background-color: #988a760d;">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="{{ route('home') }}"><i class="fal fa-home"></i></a></li>
                    <li>@lang('site.profile')</li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start profile =============================-->
    <section class="profile_page">
        <div class="container">
            <div class="content_page">
                <div class="profile_card">
                    <ul class="profile_tabs_control">
                        <li class="mou_tab active" data-content="User_info">
                            <span class="icon"><i class="fal fa-user-tie"></i></span>
                            <span class="text">@lang('site.pr1')</span>
                        </li>
                        <li class="mou_tab" data-content="address_section">
                            <span class="icon"><i class="fal fa-map-marker-alt"></i></span>
                            <span class="text">@lang('site.pr2') </span>
                        </li>
                        <li class="mou_tab" data-content="orders_section">
                            <span class="icon"><i class="fal fa-bags-shopping"></i></span>
                            <span class="text">@lang('site.pr3')</span>
                        </li>
                        <li class="mou_tab" data-content="wallet_section">
                            <span class="icon"><i class="fal fa-wallet"></i></span>
                            <span class="text">@lang('site.pr4')</span>
                        </li>
                        <li class="mou_tab" data-content="notifications_section">
                            <span class="icon"><i class="fal fa-bell"></i></span>
                            <span class="text">@lang('site.pr5')</span>
                        </li>
                        <li class="mou_tab" data-content="coupons_section">
                            <span class="icon"><i class="fal fa-badge-percent"></i></span>
                            <span class="text">@lang('site.pr6')</span>
                        </li>
                        <li class="mou_tab">
                            <a class="icon" style="width: auto;"
                                href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> <span class="text" style="padding: 6px;" >@lang('site.logout')</span></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="profile_content">

                    <div class="box_content active" id="User_info">
                        <form class="inforamtion_content" action="{{ route('update_profile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-30">
                                    <div class="form-group">
                                        <div class="image">
                                            <img src="{{ $customer->avatar_url ?? asset('assets/img/person.jpg') }}"
                                                alt="" id="personalImg">
                                            <label for="editPersonalImg">
                                                <input type="file" name="avatar" onchange="readURL(this)" class="d-none"
                                                    id="editPersonalImg">
                                                <i class="fal fa-edit"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">@lang('site.name')</label>
                                        <div class="input-box">
                                            <span class="icon"><i class="fal fa-user"></i></span>
                                            <input class="form-control" name="name" type="text"
                                                value="{{ $customer->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">@lang('site.email')</label>
                                        <div class="input-box">
                                            <span class="icon"><i class="fal fa-envelope"></i></span>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ $customer->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">@lang('site.phone_number')</label>
                                        <div class="input-box">
                                            <span class="icon"><i class="fal fa-phone"></i></span>
                                            <input class="form-control" name="mobile" type="number"
                                                value="{{ $customer->mobile }}">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-30">
                                    <button type="submit"
                                        class="main-btn main animate border-0 w-100">@lang('site.save')</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="box_content" id="address_section">
                        <ul id="address_list" class="list list--shipping-address">
                            <li class="new-address">
                                <input type="radio" id="add_new_address" name="address"
                                    class="payment_method_input d-none">
                                <label for="add_new_address" class="btn btn--address-new">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span>@lang('site.pr11')</span>
                                </label>
                            </li>
                            @foreach ($addresses as $address)
                                <li>
                                    <div class="address-entry">
                                        <input type="radio" id="address-entry-{{ $address->id }}" name="address"
                                            class="payment_method_input d-none" checked="">
                                        <label for="address-entry-{{ $address->id }}">
                                            <button type="button" class="address-delete delete_product_btn "
                                                data-toggle="modal" data-id="{{ $address->id }}"
                                                data-target="#delete_product_modal">
                                                <i class="fal fa-times"></i>
                                            </button>
                                            <b>{{ $address->name }}</b>
                                            <p>{{ $address->address }}</p>
                                            {{-- <button type="button" class="btn btn--link edit_address_btn"
                                                data-toggle="modal" data-id="{{ $address->id }}"
                                                data-target="#edit_product_modal">
                                                <i class="fal fa-pen"></i>
                                                <span>@lang('site.edit')</span>
                                            </button> --}}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div id="new_address_box" style="display: none;">
                            <form action="{{ route('addaddress') }}" method="post" class="w-100">
                                @csrf
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
                                            <select class="select2" name="country">
                                                <option value="">@lang('site.py11')</option>
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
                                            <select name="state" class="select2">
                                                <option value=""> @lang('site.py12')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">@lang('site.address')</label>
                                            <textarea name="address" type="text" id="" class="form-control" required> @lang('site.address')</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="main-btn main animate remove-from-cart border-0">@lang('site.save')</button>
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="col-12">
                                <div class="map_box">
                                    <iframe width="100%" height="400" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="box_content" id="orders_section">
                        <div class="row">
                            @foreach ($customer->orders as $order)
                                <div class="col-md-4 col-sm-6">
                                    <div class="order_box text-center">
                                        <div class="order-details">
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('single_order', $order->id) }}">#{{ $order->invoice_number }}</a>
                                            </h3>
                                            @if ($order->status->id == 1 ||
                                                $order->status->id == 3 ||
                                                $order->status->id == 4 ||
                                                $order->status->id == 5 ||
                                                $order->status->id == 6)
                                                <span class="status yellow">{{ $order->status->name }}</span>
                                            @elseif ($order->status->id == 2 || $order->status->id == 8 || $order->status->id == 9)
                                                <span class="status red">{{ $order->status->name }}</span>
                                            @elseif ($order->status->id == 7)
                                                <span class="status green">{{ $order->status->name }}</span>
                                            @endif
                                            <div class="price">
                                                <span class="product-price">{{ $order->total }}
                                                    <span>{{ $currency }}
                                                    </span></span>
                                            </div>
                                        </div>
                                        <a href="{{ route('single_order', $order->id) }}" class="main-btn main animate">
                                            <i class="fal fa-eye"></i>
                                            <span>@lang('site.o37')</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box_content" id="wallet_section">
                        <div class="row">
                            <div class="col-sm-6 box text-center">
                                <span class="icon"><img src="{{ asset('assets/img/icons/salary.png') }}"
                                        alt="" width="70" height="70"></span>
                                <h6>@lang('site.pr8')</h6>
                                <div class="balance">{{ $customer->wallet }} @lang('site.rs')</div>
                            </div>
                            <div class="col-sm-6 box text-center">
                                <span class="icon"><img src="{{ asset('assets/img/icons/box.png') }}" alt=""
                                        width="70" height="70"></span>
                                <h6>@lang('site.pr9')</h6>
                                <div class="balance">{{ $customer->points }}</div>
                            </div>
                            <div class="col-12 mt-30">
                                <div class="share_box">
                                    <img src="{{ asset('assets/img/icons/collaboration.png') }}" alt=""
                                        width="100" height="100">
                                    <h5>@lang('site.pr10')</h5>
                                    <span class="word">{{ $customer->promo_code }}</span>
                                    <button type="button" class="main-btn dark-btn border-0 w-50"
                                        id="share-btn">@lang('site.share')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_content" id="notifications_section">
                        @foreach ($notifications as $not)
                            <a href="#" class="noti_box">
                                <h6 class="head"> @json($not->data['title'], JSON_UNESCAPED_UNICODE)</h6>
                                <p class="desc m-0">@json($not->data['msg'], JSON_UNESCAPED_UNICODE)</p>
                            </a>
                        @endforeach
                    </div>
                    <div class="box_content" id="coupons_section">
                        @if (!empty($coupons[0]))
                        @foreach ($coupons as $coupon)
                                @if ($coupon->show == 1)
                                    <hr class="product-divider d-lg-show mb-3">

                                    <div class="discount-box">
                                        <i class="fa-regular fa-badge-percent"></i>
                                        <div>
                                            <h6>@lang('site.o34')<span>
                                                    @if ($coupon->flag == 1)
                                                        {{ $coupon->discount_ratio }} %
                                                    @elseif($coupon->flag == 2)
                                                        {{ $coupon->discount_ratio }} @lang('site.sar')
                                                    @elseif ($coupon->flag == 3)
                                                        @lang('site.o38')
                                                    @endif
                                                </span></h6>
                                            <p>@lang('site.o35') {{ $coupon->code }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="no-found text-center">
                                <h2>@lang('site.pr7')</h2>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--======================== End profile =============================-->

    <!-- ==================== Edit product modal =================== -->
    <div class="modal fade" data-id="" id="edit_product_modal" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('editaddress') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.name')</label>
                                    <div class="input-box">
                                        {{-- <span class="icon"><i class="fal fa-road"></i></span> --}}
                                        <input type="hidden" value="" id="address_id">
                                        <input class="form-control" name="name" type="text"
                                            placeholder="@lang('site.name')" id="address_name" value=""
                                            required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.phone_number')</label>
                                    <div class="input-box">

                                        {{-- <span class="icon"><i class="fal fa-phone"></i></span> --}}
                                        <input class="form-control" name="mobile" type="number" id="address_mobile"
                                            value="" placeholder="56xxxxxxxxxx" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">@lang('site.py11')</label>
                                    <select class="select2" name="country">
                                        <option value="">@lang('site.py11')</option>
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
                                    <select name="state" class="select2">
                                        <option value=""> @lang('site.py12')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">@lang('site.address')</label>
                                    <div class="input-box">
                                        {{-- <span class="icon"><i class="fal fa-road"></i></span> --}}
                                        {{-- <input class="form-control" name="name" type="text"
                                        placeholder="@lang('site.name')" required=""> --}}
                                        <textarea name="address" type="text" id="address_address" class="form-control" required> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="main-btn close animate border-0"
                            data-dismiss="modal">@lang('site.close')</button>
                        <button type="submit"
                            class="main-btn main animate remove-from-cart border-0">@lang('site.edit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================== Edit product modal =================== -->

    <!-- ==================== Delete product modal =================== -->
    <div class="modal fade custom_modal" data-id="" id="delete_product_modal" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('deleteaddress') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-body">
                        <input type="hidden" name="address_id" id="address_id" value="">
                        <p class="m-0">@lang('site.delete_address')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="main-btn close animate"
                            data-dismiss="modal">@lang('site.no')</button>
                        <button type="submit" class="main-btn main animate remove-from-cart">@lang('site.yes')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ==================== Delete product modal =================== -->
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
    <script>
        $(document).on("click", ".delete_product_btn", function() {
            var id = $(this).data('id');
            $(".modal-body #address_id").val(id);
        });
        $(document).on("click", ".edit_product_btn", function() {
            var id = $(this).data('id');
            $(".modal-body #address_id").val(id);
        });

        $(".payment_method_input[name='address']").on('change', function() {
            if ($("#add_new_address").is(':checked')) {
                $("#new_address_box").slideDown();

            } else {
                $("#new_address_box").slideUp();
            }
        })



        // $(".remove-from-cart").click(function(e) {
        //     e.preventDefault();

        //     var ele = $(this);


        //     $.ajax({
        //         url: '{{ route('deleteaddress') }}',
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
    </script>
@endsection
