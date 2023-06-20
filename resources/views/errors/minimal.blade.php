@extends('web.master')
@section('css')
    <meta name="robots" content="noindex">
    <title>@yield('title')</title>
@endsection
@php

    $features = \App\Models\Product::where('is_active', true)
        ->where('is_feature', 1)
        ->inRandomOrder()
        ->take(10)
        ->get();
    $sales = \App\Models\Product::where('is_active', true)
        ->where('show_in_slider', '1')
        ->inRandomOrder()
        ->take(10)
        ->get();
@endphp
@section('content')
    <section class="error_page">
        <div id="particles-js"></div>
        <div class="content">
            <div class="content-box text-center">
                <div class="big-content">
                    <div class="list-square"> <span class="square"></span> <span class="square"></span> <span
                            class="square"></span> </div>
                    <div class="list-line"> <span class="line"></span> <span class="line"></span> <span
                            class="line"></span> <span class="line"></span> <span class="line"></span> <span
                            class="line"></span> </div>
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <div class="clear"></div>
                </div>
                <h1>@yield('code')</h1>
                <p>@yield('message')</p>
            </div>
        </div>

    </section>

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
                                <a href="{{ route('single_product', ['id' => $f->id]) }}">
                                    <img data-src="{{ $f->feature_image_url ?? $f->image_url }}" class="lazyload"
                                        width="280" height="280" alt="product">
                                    <img data-src="{{ $f->image_url ?? asset('uploads/logo.png') }}" class="lazyload"
                                        width="280" height="280" alt="product">
                                </a>
                                {{-- <div class="label-group">
                            <div class="product-label label-new">جديد</div>
                            <div class="product-label label-sale">-40%</div>
                        </div> --}}
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="{{ route('store', ['id' => $f->store->id]) }}"
                                        class="product-category">{{ $f->store->name }}</a>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('single_product', ['id' => $f->id]) }}">{{ $f->name }}</a>
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
                                    @if ($f->discount_ratio > 0)
                                    <del class="old-price">{{ $f->price }} @lang('site.rs')</del>
                                    @endif
                                    <span class="product-price">{{ $f->sale_price }} @lang('site.rs')</span>
                                </div>
                                <!-- End .price-box -->
                                <div class="product-action">
                                    <a href="{{ route('add_to_fav', ['id' => $f->id]) }}" class="btn-icon-wish"
                                        title="wishlist">
                                        @if (Auth::guard('user')->check())
                                            @php
                                                $prodfav = \App\Models\Favorite::where('content_id', $f->id)
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
                <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span>@lang('site.add_cart')</span></button> -->

                <!-- <a href="{{ route('single_product', ['id' => $f->id]) }}" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
                <a href="{{ route('single_product', ['id' => $f->id]) }}"
                    class="btn-icon btn-add-cart product-type-simple border-0">
                    <i class="fal fa-eye"></i>
                    <span>@lang('site.details')</span>
                </a>
                <a href="{{ route('single_product', ['id' => $f->id]) }}" data-toggle="modal" data-target="#shareModal"
                    class="btn-quickview" aria-label="Quickview" title="Quick View">
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
                                <a href="{{ route('single_product', ['id' => $m->id]) }}">
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
                                <h3 class="product-title">
                                    <a href="{{ route('single_product', ['id' => $m->id]) }}">{{ $m->name }}</a>
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
                                <a href="{{ route('single_product', ['id' => $m->id]) }}" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
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
    <!--======================== End products section =============================-->
@endsection

@section('js')
@endsection
