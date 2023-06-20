@extends('web.master')
@section('css')
<style type="text/css">
    
</style>
@endsection
@section('title')
@lang('site.home')@endsection
@section('content')
    <!--======================== Start slider =============================-->
    <section class="header_section">
        <div class="cd-slider" id="cd-slider">
            <ul>
                @foreach ($offers as $offer)

                <li data-color="#2a2424">
                    <a href="#" class="content d-block text-center" aria-label="Product details" style="background-image:url()">
                        <img src="{{ $offer->image_url }}" alt="banner" width="auto" height="600" class="img-slider">
                    </a>
                </li>
                @endforeach
            </ul>
            <nav>
                <div>
                    <a class="prev" href="#" aria-label="Prev"><i class="fal fa-chevron-left"></i></a>
                </div>
                <div>
                    <a class="next" href="#" aria-label="Next"><i class="fal fa-chevron-right"></i></a>
                </div>
            </nav>
        </div>
    </section>
    <!--======================== End slider =============================-->

    <!--======================== Start icon box wrapper =============================-->
    {{-- <section class="icon-box-wrapper wow fadeInUp">
        <div class="container-fluid">
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box-side">
                            <span class="icon-box-icon icon-shipping">
                                <i class="fal fa-truck"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">إرجاع الشحن المجاني</h4>
                                <p class="text-default">لجميع الطلبات التي تزيد عن 99 دولارًا</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box-side">
                            <span class="icon-box-icon icon-payment">
                                <i class="fal fa-briefcase"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">دفع امن</h4>
                                <p class="text-default">نحن نضمن الدفع الآمن</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box-side">
                            <span class="icon-box-icon icon-money">
                                <i class="fal fa-envelope-open-dollar"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">ضمان استعادة الاموال</h4>
                                <p class="text-default">أي عودة في غضون 30 يومًا</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="icon-box-side">
                            <span class="icon-box-icon icon-chat">
                                <i class="fal fa-headset"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">دعم العملاء</h4>
                                <p class="text-default">اتصل بنا على مدار 24 ساعه</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--======================== End icon box wrapper =============================-->



    <!--======================== Start categories section =============================-->
    <section class="categories_section wow fadeInUp">
        <div class=" container">
            <h2 class="section-title heading-border ls-20 border-0">@lang('site.cats')</h2>
            <div class="row justify-content-center mt-30">
               @if(isset($cats) && $cats != '')
               @foreach ($cats as $cat)

                <div class="col-lg-12 col-12">
                    <a href="{{ route('cat', ['id' => $cat->id]) }}" class="category category-ellipse d-block">
                        <div class="category-media">
                            <img data-src="{{ $cat->image_url }}" class="lazyload" loading="lazy" alt="Categroy" width="190" height="190" style="background-color: #E2E2E2;">
                        </div>
                        <div class="category-content">
                            <h4 class="category-name">
                                {{ $cat->name }}
                            </h4>
                        </div>
                    </a>
                </div>

                @endforeach
                @endif

                @foreach ($categories as $cat)

                <div class="col-lg-4 col-6">
                    <a href="{{ route('cat', ['id' => $cat->id]) }}" class="category category-ellipse d-block">
                        <div class="category-media">
                            <img data-src="{{ $cat->image_url }}" class="lazyload" loading="lazy" alt="Categroy" width="190" height="190" style="background-color: #E2E2E2;">
                        </div>
                        <div class="category-content">
                            <h4 class="category-name">
                                {{ $cat->name }}
                            </h4>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>
    </section>
    <!--======================== End categories section =============================-->

    <!--======================== Start products section =============================-->
    <section class="products_section">
        <div class="container">
            <div class="heading-side mb-30">
                <h2 class="section-title heading-border wow fadeInUp">@lang('site.special_products')</h2>
                <a href="{{ route('special') }}" class="main-btn main">@lang('site.show_all')</a>
            </div>
            <div class="owl-carousel wow fadeInUp">
                @foreach ($features as $f)

                <div class="item_carousel">
                    <div class="box_product wow fadeInUp">
                        <figure>
                            <a href="{{ route('single_product', ['id'=>$f->id]) }}">
                                <img data-src="{{ $f->feature_image_url ?? $f->image_url }}" class="lazyload" width="280" height="280" alt="product">
                                <img data-src="{{ $f->image_url ?? asset('uploads/logo.png') }}" class="lazyload" width="280" height="280" alt="product">
                            </a>
                            {{-- <div class="label-group">
                                <div class="product-label label-new">جديد</div>
                                <div class="product-label label-sale">-40%</div>
                            </div> --}}
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="{{ route('store', ['id'=>$f->store->id]) }}" class="product-category">{{ $f->store->name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('single_product', ['id'=>$f->id]) }}">{{ $f->name }}</a>
                            </h3>
                            {{-- <div class="ratings-container">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div> --}}
                            <!-- End .product-container -->
                            <div class="price-box">
                                <!--@if ($f->discount_ratio > 0)-->
                                <!--    <del class="old-price">{{ $f->price }} @lang('site.rs')</del>-->
                                <!--@endif-->
                                <span class="product-price">{{ $f->sale_price }} @lang('site.rs')</span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="{{ route('add_to_fav', ['id'=>$f->id]) }}" class="btn-icon-wish" title="wishlist">
                                    @if (Auth::guard('user')->check())
                                    @php
                                        $prodfav = \App\Models\Favorite::where('content_id',$f->id)->where('customer_id',Auth::guard('user')->user()->id)->first();
                                    @endphp
                                        @if ($prodfav)
                                        <i class="fas fa-heart"></i></a>
                                        @else
                                        <i class="fal fa-heart"></i></a>
                                        @endif
                                    @else
                                    <i class="fal fa-heart"></i></a>
                                    @endif
                                <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span>@lang('site.add_cart')</span></button> -->

                                <!-- <a href="{{ route('single_product', ['id'=>$f->id]) }}" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
                                <a href="{{ route('single_product', ['id'=>$f->id]) }}" class="btn-icon btn-add-cart product-type-simple border-0">
                                    <i class="fal fa-eye"></i>
                                    <span>@lang('site.details')</span>
                                </a>
                                <a href="{{ route('single_product', ['id'=>$f->id]) }}" data-toggle="modal" data-target="#shareModal" class="btn-quickview" aria-label="Quickview" title="Quick View">
                                    <i class="fa-light fa-share-nodes"></i>
                                </a>
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--======================== End products section =============================-->

    <!--======================== Start promo section =============================-->

    {{-- <section class="promo-section">
        <div class="jarallax" style="background-image: url( 'public/assets/img/banner-5.jpg');">
            <div class="promo-banner banner container text-uppercase">
                <div class="banner-content row align-items-center text-center">
                    <div class="col-md-4 wow fadeInRight">
                        <h2 class="mb-md-0 text-white">أفضل عروض الأزياء</h2>
                    </div>
                    <div class="col-md-4 wow fadeIn">
                        <a href="#" class="main-btn main animate br-0">رؤية العرض</a>
                    </div>
                    <div class="col-md-4 wow fadeInLeft">
                        <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                            <b>كوبون حصري</b></h4>
                        <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">اكثر من</i><b class="text-white bg-secondary ls-n-10">$100</b> خصم</h5>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--======================== End promo section =============================-->

    <!--======================== Start products section =============================-->
    <section class="products_section">
        <div class="container">
            {{-- <h2 class="section-title heading-border wow fadeInUp">@lang('site.most_selling')</h2> --}}
            <div class="heading-side mb-30">
                <h2 class="section-title heading-border wow fadeInUp">@lang('site.most_selling')</h2>
                <a href="{{ route('most_sell') }}" class="main-btn main">@lang('site.show_all')</a>
            </div>
            <div class="owl-carousel wow fadeInUp">
                @foreach ($sales as $m)

                <div class="item_carousel">
                    <div class="box_product wow fadeInUp">
                        <figure>
                            <a href="{{ route('single_product', ['id'=>$m->id]) }}">
                                <img data-src="{{ $m->image_url ?? asset('uploads/logo.png') }}" class="lazyload" width="280" height="280" alt="product">
                                <img data-src="{{ $m->feature_image_url ?? $m->image_url }}" class="lazyload" width="280" height="280" alt="product">
                            </a>
                            {{-- <div class="label-group">
                                <div class="product-label label-new">جديد</div>
                                <div class="product-label label-sale">-40%</div>
                            </div> --}}
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="{{ route('store', ['id'=>$m->store->id]) }}" class="product-category">{{ $m->store->name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('single_product', ['id'=>$m->id]) }}">{{ $m->name }}</a>
                            </h3>
                            {{-- <div class="ratings-container">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div> --}}
                            <!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">{{ $m->price }} @lang('site.rs')</del>
                                <span class="product-price">{{ $m->sale_price }} @lang('site.rs')</span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="{{ route('add_to_fav', ['id'=>$m->id]) }}" class="btn-icon-wish" title="wishlist">
                                    @if (Auth::guard('user')->check())
                                    @php
                                        $prodfav = \App\Models\Favorite::where('content_id',$m->id)->where('customer_id',Auth::guard('user')->user()->id)->first();
                                    @endphp
                                        @if ($prodfav)
                                        <i class="fas fa-heart"></i></a>
                                        @else
                                        <i class="fal fa-heart"></i></a>
                                        @endif
                                    @else
                                    <i class="fal fa-heart"></i></a>
                                    @endif
                                <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span>@lang('site.add_cart')</span></button>
                                <a href="{{ route('single_product', ['id'=>$m->id]) }}" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
                                <a href="{{ route('single_product', ['id'=>$m->id]) }}" class="btn-icon btn-add-cart product-type-simple border-0"><i class="fal fa-eye"></i><span>@lang('site.details')</span></a>
                                <a href="{{ route('single_product', ['id'=>$m->id]) }}" data-toggle="modal" data-target="#shareModal" class="btn-quickview" aria-label="quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a>
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--======================== End products section =============================-->

    <!--======================== Start slider =============================-->
    <section class="header_section stores_header">
        <div class="cd-slider" id="cd-slider-2">
            <ul>
                @foreach ($sliders as $slider)

                <li data-color="#2a2424">
                    <a href="#" class="content d-block text-center" aria-label="Product Details" style="background-image:url()">
                        <img src="{{ $slider->image_url }}" alt="banner" width="auto" height="600" class="img-slider">

                    </a>
                </li>
                @endforeach
            </ul>
            <nav>
                <div>
                    <a class="prev" href="#" aria-label="Prev"><i class="fal fa-chevron-left"></i></a>
                </div>
                <div>
                    <a class="next" href="#" aria-label="Next"><i class="fal fa-chevron-right"></i></a>
                </div>
            </nav>
        </div>
    </section>
    <!--======================== End slider =============================-->

    <!-- ==================== Start our designers =================== -->
    <section class="our_designers_section mt-50">
        <div class="container">
            <div class="row">
                @foreach ($stores as $store)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="designer_box gsap-reveal-hero">
                        <div class="image"><img data-src="{{ asset('uploads/'.$store->logo) }}" width="100" height="100" class="lazyload" alt="img"></div>
                        <div class="info">
                            <h5>{{ $store->name }}</h5>
                            <h6>{{ $store->products_count }} @lang('site.abaya')</h6>
                        </div>
                        <a href="{{ route('store', ['id'=>$store->id]) }}" class="main-btn animate main">@lang('site.show_products')</a>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- <div class="custom_pagination flex-center mt-20">
                <a href="#" aria-label="prev-arrow" class="num arrow"><i class="fal fa-angle-double-right"></i></a>
                <a href="#" class="num active">1</a>
                <a href="#" class="num">2</a>
                <a href="#" class="num">3</a>
                <a href="#" aria-label="next-arrow" class="num arrow"><i class="fal fa-angle-double-left"></i></a>
            </div> --}}
        </div>
    </section>
    <!-- ==================== End our designers =================== -->

    {{-- <!--===================== Start quickview ========================-->
    <div class="quickview_box_overlay"></div>
    <div class="quickview_box">
    <section class="single_product_page">
        <div class="container">
            <div class="content_page">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product_iamges">
                            <!--=========================== start thumb ============================-->
                            <div class="thumb">
                                <div id="big_image" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                </div>
                                <div id="thumbs_gallary" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                    <div class="item">
                                        <img src="https://portotheme.com/html/porto_ecommerce/assets/images/products/zoom/product-1-big.jpg" alt=".." />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details mt-md-30 text-start">
                            <h1 class="product-name">عباية سوداء مطرزة</h1>
                            <div class="product-meta">
                                القسم: <span>العبايات</span> الماركه: <span>تركي</span>
                            </div>
                            <div class="product-price">
                                <span class="price">$270.99</span>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <a href="#product-tab-reviews" class="link-to-tab rating-reviews">( 52 تقييم )</a>
                                <a href="#" class="link-to-tab rating-reviews flex-h gap-5">
                                    <i class="fas fa-eye"></i>
                                    <span>292</span>
                                </a>
                            </div>
                            <p class="product-short-desc">
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                            </p>

                            <hr class="product-divider d-lg-show mb-3">

                            <div class="product-footer">
                                <div class="social-links mr-4">
                                    <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                    <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                    <a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a>
                                </div>

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-wishlist gap-5">
                                        <i class="fal fa-heart"></i>
                                        <span>اضف للمفضلة</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <button title="Close (Esc)" type="button" class="mfp-close">
			×
		</button>
    </section>

    </div>
    <!--===================== End quickview ========================--> --}}

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

@endsection
@section('js')
<script>
    (function() {

        var autoUpdate = true,
            timeTrans = 5000;

        var cdSlider = document.querySelector('#cd-slider'),
            item = cdSlider.querySelectorAll("li"),
            nav = cdSlider.querySelector("nav");

        item[0].className = "current_slide";

        for (var i = 0, len = item.length; i < len; i++) {
            var color = item[i].getAttribute("data-color");
            item[i].style.backgroundColor = color;
        }

        // Detect IE
        // hide ripple effect on IE9
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE");
        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            if (version === 9) {
                cdSlider.className = "cd-slider ie9";
            }
        }

        if (item.length <= 1) {
            nav.style.display = "none";
        }

        function prevSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                prevElement = currentSlide.previousElementSibling,
                prevSlide = (prevElement !== null) ? prevElement : item[item.length - 1],
                prevColor = prevSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            prevSlide.className = "current_slide";

            nav.children[0].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[0].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = prevColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        function nextSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                nextElement = currentSlide.nextElementSibling,
                nextSlide = (nextElement !== null) ? nextElement : item[0],
                nextColor = nextSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            nextSlide.className = "current_slide";

            nav.children[1].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[1].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = nextColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        updateNavColor();

        function updateNavColor() {
            var currentSlide = cdSlider.querySelector("li.current_slide");

            var nextColor = (currentSlide.nextElementSibling !== null) ? currentSlide.nextElementSibling
                .getAttribute("data-color") : item[0].getAttribute("data-color");
            var prevColor = (currentSlide.previousElementSibling !== null) ? currentSlide.previousElementSibling
                .getAttribute("data-color") : item[item.length - 1].getAttribute("data-color");

            if (item.length > 2) {
                nav.querySelector(".prev").style.backgroundColor = prevColor;
                nav.querySelector(".next").style.backgroundColor = nextColor;
            }
        }

        nav.querySelector(".next").addEventListener('click', function(event) {
            event.preventDefault();
            nextSlide();
            updateNavColor();
        });

        nav.querySelector(".prev").addEventListener("click", function(event) {
            event.preventDefault();
            prevSlide();
            updateNavColor();
        });

        //autoUpdate
        setInterval(function() {
            if (autoUpdate) {
                nextSlide();
                updateNavColor();
            };
        }, timeTrans);

    })();
</script>

<script>
    (function() {

        var autoUpdate = true,
            timeTrans = 5000;

        var cdSlider = document.querySelector('#cd-slider-2'),
            item = cdSlider.querySelectorAll("li"),
            nav = cdSlider.querySelector("nav");

        item[0].className = "current_slide";

        for (var i = 0, len = item.length; i < len; i++) {
            var color = item[i].getAttribute("data-color");
            item[i].style.backgroundColor = color;
        }

        // Detect IE
        // hide ripple effect on IE9
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE");
        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            if (version === 9) {
                cdSlider.className = "cd-slider ie9";
            }
        }

        if (item.length <= 1) {
            nav.style.display = "none";
        }

        function prevSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                prevElement = currentSlide.previousElementSibling,
                prevSlide = (prevElement !== null) ? prevElement : item[item.length - 1],
                prevColor = prevSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            prevSlide.className = "current_slide";

            nav.children[0].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[0].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = prevColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        function nextSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                nextElement = currentSlide.nextElementSibling,
                nextSlide = (nextElement !== null) ? nextElement : item[0],
                nextColor = nextSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            nextSlide.className = "current_slide";

            nav.children[1].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[1].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = nextColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        updateNavColor();

        function updateNavColor() {
            var currentSlide = cdSlider.querySelector("li.current_slide");

            var nextColor = (currentSlide.nextElementSibling !== null) ? currentSlide.nextElementSibling
                .getAttribute("data-color") : item[0].getAttribute("data-color");
            var prevColor = (currentSlide.previousElementSibling !== null) ? currentSlide.previousElementSibling
                .getAttribute("data-color") : item[item.length - 1].getAttribute("data-color");

            if (item.length > 2) {
                nav.querySelector(".prev").style.backgroundColor = prevColor;
                nav.querySelector(".next").style.backgroundColor = nextColor;
            }
        }

        nav.querySelector(".next").addEventListener('click', function(event) {
            event.preventDefault();
            nextSlide();
            updateNavColor();
        });

        nav.querySelector(".prev").addEventListener("click", function(event) {
            event.preventDefault();
            prevSlide();
            updateNavColor();
        });

        //autoUpdate
        setInterval(function() {
            if (autoUpdate) {
                nextSlide();
                updateNavColor();
            };
        }, timeTrans);

    })();
</script>

@endsection
