@extends('web.master')
@section('css')
@endsection

@section('title')
    {{ $store->name }}
@endsection
@section('content')
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="{{ route('home') }}"><i class="fal fa-home"></i></a></li>
                    <li>{{ $store->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->


    <!--======================== Start contact =============================-->
    <section class="contact_page single_designer_page">
        <div class="container">
            <div class="designer_header">
                <div class="designer_box">
                    <div class="image"><img src="{{ $store->image }}" width="100" height="100" class=" lazyloaded"
                            alt="img"></div>
                    <div class="info mb-0">
                        <h1 class="m-0">{{ $store->name }}</h1>
                    </div>
                </div>
            </div>
            {{-- <h2 class="section-title heading-border wow fadeInUp">@lang('site.contact_data')</h2>
        <div class="row wow fadeInUp">

            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="tel:{{ $store->mobile }}" class="icon-box text-center d-block">
                    <span class="icon-box-icon">
                        <i class="fal fa-phone"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">@lang('site.phone')</h4>
                        <p>{{ $store->mobile }}</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="icon-box text-center d-block">
                    <span class="icon-box-icon">
                        <i class="fab fa-instagram"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">انستاجرام</h4>
                        <p>{{ $store->instagram }}</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="icon-box text-center d-block">
                    <span class="icon-box-icon">
                        <i class="fab fa-snapchat"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">سناب شات</h4>
                        <p>{{ $store->snapchat }}</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="https://wa.me/{{ $store->whatsapp }}" class="icon-box text-center d-block">
                    <span class="icon-box-icon">
                        <i class="fab fa-whatsapp"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">واتساب</h4>
                        <p>{{ $store->whatsapp }}</p>
                    </div>
                </a>
            </div>
        </div> --}}
            <hr class="divider mb-50 mt-30 ">
            <!-- products -->
            <div class="products_section_2">
                <div class="row">
                    @foreach ($products as $m)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="box_product wow fadeInUp">
                                <figure>
                                    <a href="{{ route('product_page', ['slug' => $m->slug]) }}">
                                        <img data-src="{{ $m->image_url ?? asset('uploads/logo.png') }}" class="lazyload"
                                            width="280" height="280" alt="product">
                                        <img data-src="{{ $m->feature_image_url ?? $m->image_url }}" class="lazyload"
                                            width="280" height="280" alt="product">
                                    </a>
                                    {{-- <div class="label-group">
                                <div class="product-label label-new">جديد</div>
                                <div class="product-label label-sale">-40%</div>
                            </div> --}}
                                </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('store', ['id' => $m->store->id]) }}"
                                            class="product-category">{{ $m->store->name }}</a>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('product_page', ['slug' => $m->slug]) }}">{{ $m->name }}</a>
                                    </h2>
                                    {{-- <div class="ratings-container">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div> --}}
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        @if ($m->discount_ratio > 0)
                                            <del class="old-price">{{ $m->price }} @lang('site.rs')</del>
                                        @endif
                                        <span class="product-price">{{ $m->sale_price }} @lang('site.rs')</span>
                                    </div>
                                    <!-- End .price-box -->
                                    <div class="product-action">
                                        <a href="{{ route('add_to_fav', ['id' => $m->id]) }}" class="btn-icon-wish"
                                            title="wishlist">
                                            @if (Auth::guard('user')->check())
                                                @php
                                                    $prodfav = \App\Models\Favorite::where('content_id', $m->id)
                                                        ->where('customer_id', Auth::guard('user')->user()->id)
                                                        ->first();
                                                @endphp
                                                @if ($prodfav)
                                                    <i class="fas fa-heart"></i>
                                        </a>
                                    @else
                                        <i class="fal fa-heart"></i></a>
                    @endif
                @else
                    <i class="fal fa-heart"></i></a>
                    @endif
                    <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span>@lang('site.add_cart')</span></button>
                                    <a href="{{ route('product_page', ['slug' => $m->slug]) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
                    <a href="{{ route('product_page', ['slug' => $m->slug]) }}"
                        class="btn-icon btn-add-cart product-type-simple border-0"><i
                            class="fal fa-eye"></i><span>@lang('site.details')</span></a>
                    <a href="{{ route('product_page', ['slug' => $m->slug]) }}" data-toggle="modal" data-target="#shareModal"
                        class="btn-quickview" aria-label="quickview" title="Quick View"><i
                            class="fa-light fa-share-nodes"></i></a>
                </div>
            </div>
            <!-- End .product-details -->
        </div>

        </div>
        @endforeach
        @if (empty($products->first()))
            <div class="notFound">
                {{-- <img src="{{ asset('images/not-found.jpg') }}" /> --}}
                <p>@lang('site.o42')</p>
            </div>
        @endif
        </div>
        </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal shareModal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModelLabel">@lang('site.o39')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <p>Share this link via</p>
                <div class="d-flex align-items-center icons">
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center face-link">
                        <span class="fab fa-facebook-f"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center twi-link">
                        <span class="fab fa-twitter"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center insta-link">
                        <span class="fab fa-instagram"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center whats-link">
                        <span class="fab fa-whatsapp"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center tele-link">
                        <span class="fab fa-telegram-plane"></span>
                    </a>
                </div>
                <p>Or copy link</p> --}}
                    <div class="field-share d-flex align-items-center justify-content-between">
                        <span class="fas fa-link text-center"></span>
                        <input type="text" class="field-input" value="some.com/share">
                        <button>Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--======================== End contact =============================-->
@endsection

@section('js')
    <script>
        $(`[data-index=1]`).focus();

        $('.verify-input-field').keypress(function(e) {
            var ew = e.which;
            if (48 <= ew && ew <= 57)
                return true;
            return false;

            let inputBoxIndex = $(e.target).attr('data-index');
            let inputBox = $(e.target);

            if (inputBox.val().length > 0) {
                e.preventDefault();
            }
        })




        $('.verify-input-field').keyup(function(e) {

            let inputBoxIndex = $(e.target).attr('data-index');
            let pressedKeyCode = e.keyCode | e.which;
            let nextInputBox = $(`[data-index=${Number(inputBoxIndex) + 1}]`);
            let prevInputBox = $(`[data-index=${Number(inputBoxIndex) - 1}]`);

            if (48 <= pressedKeyCode && pressedKeyCode <= 57) {
                nextInputBox.focus();
            } else if (pressedKeyCode === 8 || pressedKeyCode === 37) {
                prevInputBox.focus();
            }

        })
    </script>
@endsection
