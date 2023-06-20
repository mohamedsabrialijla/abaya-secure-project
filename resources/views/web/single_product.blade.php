@extends('web.master')
@section('css')
<style>
.hidden{
    display:none;
}
</style>
<script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=6304876ea2413d00197af78c&product=inline-share-buttons"
        async="async"></script>
@endsection
@section('title')
{{ $product->name }}
@endsection
@section('content')
 
    <!--======================== Start single product =============================-->
    <section class="single_product_page">
        <div class="container">
            <div class="content_page">
                <div class="product-navigation">
                    <ul class="breadcrumb breadcrumb-lg">
                        <li><a href="demo1.html"><i class="fal fa-home"></i></a></li>
                        <li><a href="{{ route('store', ['id' => $product->store->id]) }}"
                                class="active">{{ $product->store->name }} </a></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product_iamges">
                            <!--=========================== start thumb ============================-->
                            <div class="thumb">
                                <div id="big_image" class="owl-carousel owl-theme">

                                    @foreach ($product->images as $img)
                                        <div class="item">
                                            <img src="{{ asset('uploads/' . $img->image) }}"
                                                alt="product image" />
                                        </div>
                                    @endforeach
                                </div>
                                <div id="thumbs_gallary" class="owl-carousel owl-theme">
                                    @foreach ($product->images as $img)
                                        <div class="item">
                                            <img src="{{ asset('uploads/' . $img->image) }}" width="130" height="100"
                                                alt="product image" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details mt-md-30">
                            <h1 class="product-name">{{ $product->name }}</h1>
                            <div class="product-meta">
                                @lang('site.category'): <span><a
                                        href="{{ route('cat', ['id' => $product->category->id]) }}">{{ $product->category->name }}</a></span>
                                @lang('site.designer'):
                                <span><a
                                        href="{{ route('store', ['id' => $product->store->id]) }}">{{ $product->store->name }}</a></span>
                                <img src="{{ $product->store->image_url ?? asset('assets/img/logo.webp') }}" width="35"
                                    height="35" alt="">
                            </div>
                            <div class="product-price">
                                @if ($product->discount_ratio > 0)

                                <del class="old-price" style="color: #cac2b3">{{ $product->price }} @lang('site.rs')</del>
                                @endif
                                <span class="price">{{ $product->sale_price }} @lang('site.rs')</span>
                            </div>
                            {{-- <div class="ratings-container">
                                <div class="ratings-full">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <a href="#product-tab-reviews" class="link-to-tab rating-reviews">( 52 تقييم )</a>
                            </div> --}}
                            <div class="product-short-desc">
                                {!! $product->details !!}
                            </div>

                            <form action="{{ route('add_to_cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <!-- <div class="product-form product-variations product-color">
                                                                <label>@lang('site.color'):</label>
                                                                <div class="select-box">
                                                                    <select name="color" class="form-control " id="mySelectBox2">
                                                                        <option>@lang('site.choose_color')</option>
                                                                        @foreach ($product->colors as $color)
    <option value="{{ $color->id }}">{{ $color->name }}</option>
    @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> -->
                                @if($product->category->id != 29)
                                <div class="product-form product-variations product-size">
                                    <label>@lang('site.size'):</label>

                                    <div class="product-form-group">
                                        <div class="select-box">
                                            <select name="size" class="form-control" id="mySelectBox">
                                                <option   disabled selected>@lang('site.choose_size')</option>
                                                @foreach ($product->productSizes as $size)
                                                    <option value="{{ $size->size_id }}"
                                                        @if ($size->qty() <= 0) disabled @endif>
                                                        {{ $size->size->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                    @else
                                    <select name="size" class="form-control hidden" id="mySelectBox">
                                                <!--<option   disabled selected>@lang('site.choose_size')</option>-->
                                                @foreach ($product->productSizes as $size)
                                                    <option value="{{ $size->size_id }}"
                                                        @if ($size->size_id == 28) selected @endif>
                                                        {{ $size->size->name }}</option>
                                                @endforeach

                                            </select>
                                            
                                            
                                    @endif
                                    <!--dfgksgjk-->
                                    <!--jhgjhghjgh-->

                                </div>
                                @if ($stock <= 0)
                                <div>
                                <h1 class="not-found"
                                style="
                                    text-align: rigth;
                                    color: #aaa;
                                    font-weight: bold;
                                    margin: 30px 0;
                                    font-size: 40px;">
                                    @lang('site.o41')
                                </h1>
                                </div>
                                @endif
                                <hr class="product-divider">

                                <div class="product-form product-qty">
                                    <div class="product-form-group">
                                        <div class="input-group mr-2">
                                            <button type="button" class="quantity-minus d-icon-minus"><i
                                                    class="fal fa-minus"></i></button>
                                            <input class="quantity form-control" name="quantity" type="number"
                                                min="1" max="50" value="1">
                                            <button type="button" class="quantity-plus d-icon-plus"><i
                                                    class="fal fa-plus"></i></button>
                                        </div>
                                        <button class="btn-cart" type="submit" @if ($stock <= 0) disabled @endif>
                                            <i class="fal fa-shopping-bag"></i>
                                            <span>@lang('site.add_to_cart')</span>
                                        </button>

 
 
                                    </div>

                                </div>
                            </form> 
                            @if($product->category->id != 29)
                            <a href="{{url(app()->getLocale().'/table_size')}}"><i class="fa  fa-scissors fa-flip-vertical" style="margin-left: 10px;"></i>@lang('site.table_size') </a>
                            @endif
                            <hr class="product-divider d-lg-show mb-3">
                            <div id="TabbyPromo" class="mb-10"></div>
                            <div class="tamara-product-widget" data-lang="{{ app()->getLocale() }}"
                                data-price="{{ $product->sale_price }}" data-currency="SAR" data-country-code="SA"
                                data-color-type="default" data-show-border="true" data-payment-type="installment"
                                data-number-of-installments="3" data-disable-installment="false"
                                data-disable-paylater="true">
                            </div>
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
                            <hr class="product-divider d-lg-show mb-3">
                            <div class="product-footer">
                                <div class="social-links mr-4">
                                    <div class="sharethis-inline-share-buttons"></div>
                                    {{-- <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                    <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                    <a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a> --}}
                                </div>

                                <div class="product-action">
                                    {{-- <a href="#" class="btn-product btn-wishlist gap-5">
                                        <i class="fal fa-heart"></i>
                                        <span>@lang('site.add_to_fav')</span>
                                    </a> --}}
                                    <a href="{{ route('add_to_fav', ['id' => $product->id]) }}"
                                        class="btn-product btn-wishlist gap-5" title="wishlist">
                                        @if (Auth::guard('user')->check())
                                            @php
                                                $prodfav = \App\Models\Favorite::where('content_id', $product->id)
                                                    ->where('customer_id', Auth::guard('user')->user()->id)
                                                    ->first();
                                            @endphp
                                            @if ($prodfav)
                                                <i class="fas fa-heart"></i>
                                                <span>@lang('site.remove_from_fav')</span>
                                    </a>
                                @else
                                    <i class="fal fa-heart"></i>
                                    <span>@lang('site.add_to_fav')</span></a>
                                    @endif
                                @else
                                    <i class="fal fa-heart"></i>
                                    <span>@lang('site.add_to_fav')</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="tab tab-nav-simple product-tabs mt-50">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="mou_tab active" data-content="Description_section">الوصف</li>
                        <li class="mou_tab" data-content="info_section">معلومات اضافية</li>
                        <li class="mou_tab" data-content="rating_section">التقييم (2)</li>
                    </ul>
                    <div class="main_content mt-40">
                        <div class="box_content active" id="Description_section">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="description-title mb-20">مميزات</h5>
                                    <p class="mb-10">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <ul class="mb-40">
                                        <li>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى</li>
                                        <li>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى</li>
                                        <li>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى</li>
                                        <li>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى</li>
                                    </ul>

                                </div>
                                <div class="col-md-6">
                                    <h5 class="description-title mb-20">مواصفات</h5>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="font-weight-semi-bold text-dark pl-0">الماتريال</th>
                                                <td class="pl-4">صناعة تركي</td>
                                            </tr>
                                            <tr>
                                                <th class="font-weight-semi-bold text-dark pl-0">المقاس</th>
                                                <td class="pl-4">xl</td>
                                            </tr>
                                            <tr>
                                                <th class="font-weight-semi-bold text-dark pl-0">الاستخدام الموصى به</th>
                                                <td class="pl-4">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى</td>
                                            </tr>
                                            <tr>
                                                <th class="font-weight-semi-bold text-dark border-no pl-0">
                                                    الصانع</th>
                                                <td class="border-no pl-4">مصنع الزوايدة</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box_content" id="info_section">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-striped mt-20 w-100">
                                        <tbody>
                                            <tr>
                                                <th>الوزن</th>
                                                <td>23 kg</td>
                                            </tr>

                                            <tr>
                                                <th>الابعاد</th>
                                                <td>12 × 24 × 35 cm</td>
                                            </tr>

                                            <tr>
                                                <th>اللون</th>
                                                <td>اسود - اخضر - لبني</td>
                                            </tr>

                                            <tr>
                                                <th>المقاس</th>
                                                <td>Large, Medium, Small</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="box_content " id="rating_section">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="avg-rating-container">
                                        <mark>5.0</mark>
                                        <div class="avg-rating">
                                            <span class="avg-rating-title">متوسط التقييم</span>
                                            <div class="ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="rating-reviews">(2 تقييم)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ratings-list mb-10">
                                        <div class="ratings-item">
                                            <div class="ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="rating-percent">
                                                <span style="width:100%;"></span>
                                            </div>
                                            <div class="progress-value">100%</div>
                                        </div>
                                        <div class="ratings-item">
                                            <div class="ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="rating-percent">
                                                <span style="width:0%;"></span>
                                            </div>
                                            <div class="progress-value">0%</div>
                                        </div>
                                        <div class="ratings-item">
                                            <div class="ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="rating-percent">
                                                <span style="width:0%;"></span>
                                            </div>
                                            <div class="progress-value">0%</div>
                                        </div>
                                        <div class="ratings-item">
                                            <div class="ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="rating-percent">
                                                <span style="width:0%;"></span>
                                            </div>
                                            <div class="progress-value">0%</div>
                                        </div>
                                        <div class="ratings-item">
                                            <div class="ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="rating-percent">
                                                <span style="width:0%;"></span>
                                            </div>
                                            <div class="progress-value">0%</div>
                                        </div>
                                    </div>
                                    <button type="button" class="main-btn main animate br-0 submit-review-toggle mt-10 border-0" href="#">اضف تقييم</button>
                                </div>
                                <div class="col-lg-8 comments pt-2 pb-10 border-no mt-md-30">

                                    <ul class="comments-list">
                                        <li>
                                            <div class="comment">
                                                <figure class="comment-media">
                                                    <a href="#">
                                                        <img src="https://images.pexels.com/photos/91227/pexels-photo-91227.jpeg?auto=compress&cs=tinysrgb&w=600" alt="avatar">
                                                    </a>
                                                </figure>
                                                <div class="comment-body">
                                                    <div class="comment-rating ratings-container mb-10">
                                                        <div class="ratings-full">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="comment-user mb-10">
                                                        <div class="comment-date">
                                                            <span class="font-weight-semi-bold text-uppercase text-dark">منير محمد</span> في
                                                            <span class="font-weight-semi-bold text-dark">Nov 22, 2022</span>
                                                        </div>
                                                    </div>

                                                    <div class="comment-content">
                                                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment">
                                                <figure class="comment-media">
                                                    <a href="#">
                                                        <img src="https://images.pexels.com/photos/91227/pexels-photo-91227.jpeg?auto=compress&cs=tinysrgb&w=600" alt="avatar">
                                                    </a>
                                                </figure>
                                                <div class="comment-body">
                                                    <div class="comment-rating ratings-container mb-10">
                                                        <div class="ratings-full">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="comment-user mb-10">
                                                        <div class="comment-date">
                                                            <span class="font-weight-semi-bold text-uppercase text-dark">منير محمد</span> في
                                                            <span class="font-weight-semi-bold text-dark">Nov 22, 2022</span>
                                                        </div>
                                                    </div>

                                                    <div class="comment-content">
                                                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <!-- End Comments -->
                        </div>
                    </div>
                </div> --}}
            </div>
            <!--====== for no products =====-->

        </div>

    </section>
    <!--======================== End single product =============================-->

    <!--======================== Start similar products section =============================-->
    <section class="products_section">
        <div class="container">
            <h2 class="section-title heading-border wow fadeInUp">@lang('site.you_may_like')</h2>
            <div class="owl-carousel wow fadeInUp">
                @foreach ($sales as $m)
                    <div class="item_carousel">
                        <div class="box_product wow fadeInUp">
                            <figure>
                                <a href="{{ route('single_product', ['id' => $m->id]) }}">
                                    <img data-src="{{ $m->image_url ?? asset('uploads/logo.png') }}" class="lazyload"
                                        width="280" height="280" alt="product">
                                    <img data-src="{{ $m->feature_image_url ?? asset('uploads/logo.png') }}"
                                        class="lazyload" width="280" height="280" alt="product">
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
                                    <a href="{{ route('single_product', ['id' => $m->id]) }}">{{ $m->name }}</a>
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
                                                <a href="{{ route('single_product', ['id' => $m->id]) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
                <a href="{{ route('single_product', ['id' => $m->id]) }}"
                    class="btn-icon btn-add-cart product-type-simple border-0"><i
                        class="fal fa-eye"></i><span>@lang('site.details')</span></a>
                <a href="{{ route('single_product', ['id' => $m->id]) }}" data-toggle="modal" data-target="#shareModal"
                    class="btn-quickview" aria-label="quickview" title="Quick View"><i
                        class="fa-light fa-share-nodes"></i></a>

            </div>
        </div>
        <!-- End .product-details -->
        </div>
        </div>
        @endforeach
        </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal shareModal fade" id="shareModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!--======================== End similar products section =============================-->
@endsection

@section('js')
    <script src="https://cdn.tamara.co/widget/product-widget.min.js"></script>
    <script>
        setTimeout(() => {
            if (window.TamaraProductWidget) {
                window.TamaraProductWidget.init({
                    lang: 'en'
                })
                window.TamaraProductWidget.render()
            }
        }, 2000) // Waiting for 2s - Make sure Tamara's widget is installed
    </script>
    <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
    <script>
        new TabbyPromo({
            selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
            currency: 'SAR', // required, currency of your product. AED|SAR|KWD|BHD|EGP only supported, with NO spaces or lowercase.
            price: {!! json_encode($product->sale_price) !!}, // required, price or your product. 2 decimals max for AED|SAR|EGP and 3 decimals max for KWD|BHD supported.
            installmentsCount: 4, // Optional - custom installments number for tabby promo snippet (if not downpayment + 3 installments)
            lang: {!! json_encode(app()->getLocale()) !!}, // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag
            source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page
            publicKey: 'PUBLIC_API_KEY', // required, public key which identifies your account when communicating with tabby. Test or Production depending on the environment
            merchantCode: 'AbayaSquare' // required
        });
    </script>
    
    
    
    <!-- Google tag (gtag.js) -->
<script>

 



dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_item",
  ecommerce: {
    currency: "SAR",
    value: {{$product->sale_price}},
    items: [
    {
       item_id: "SKU_{{$product->id}}",
      item_name: "{{$product->name}}",
      affiliation: "google merchant store",
      coupon: "",
      discount: {{$product->discount_ratio}},
      index: {{$product->id}},
      item_brand: "{{$product->store->name}}",
      item_category: "{{$product->category->name}}",
      item_list_id: "{{$product->category->id}}",
      item_list_name: "{{$product->category->name}}",
      item_variant: "",
      location_id: "",
      price: {{$product->sale_price}},
      quantity: 1
    }
    ]
  }
});



@if(isset($products) && count($products) > 0  && $check == 1)
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_to_cart",
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


@else
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "select_item",
  ecommerce: {
    currency: "SAR",
    value: {{$product->sale_price}},
    items: [
    {
       item_id: "SKU_{{$product->id}}",
      item_name: "{{$product->name}}",
      affiliation: "google merchant store",
      coupon: "",
      discount: {{$product->discount_ratio}},
      index: {{$product->id}},
      item_brand: "{{$product->store->name}}",
      item_category: "{{$product->category->name}}",
      item_list_id: "{{$product->category->id}}",
      item_list_name: "{{$product->category->name}}",
      item_variant: "",
      location_id: "",
      price: {{$product->sale_price}},
      quantity: 1
    }
    ]
  }
});


@endif 
</script>
@endsection
