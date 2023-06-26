<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@php
    $lang = app()->getLocale();
    $settings = new \App\Models\Settings();
    $stores = \App\Models\Store::where('status', 1)->orderBy('ordering','asc')->get();
    $cats = \App\Models\Category::where('status', 1)->get();
    $cartItems = \Cart::getContent();
@endphp
  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="تطبيق عباية سكوير لبيع أحدث موديلات العبايات من خلال أمهر مصممين العبايات ومتاجرا لعبايات في المملكة العربية السعودية , عباية سكوير وجهتك الأفضل لساحة العبايات الخلي">
    <meta name="keywords" content="Clothes, Abaya, Square">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#988a76">
    <meta name="facebook-domain-verification" content="b8pw6g41uo1r0wshe1le02envv5iz2" />
    <title>{{ $settings->valueOf('project_name_' . $lang) }} @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Fontawesome 6 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/all.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <!-- main style -->
    @if ($lang == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style-ltr.css') }}">
    @endif

    <link rel="shortcut icon" type="image/png" href="{{ asset('logos/logo_abaya.png') }}" />

    @yield('css')


    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-58KJXDS');</script>
<!-- End Google Tag Manager -->


</head>

<body >

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58KJXDS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


    <!--============================== Start Nav Top ==============================-->
    <div class="top-bar py-2 d-none d-sm-block">
        <div class="container">
            <div class="row">
                <div class="widget_left col-lg-6 d-flex justify-content-center justify-content-lg-start">
                    <div class="top-right">
                        <ul class="contact-info-two">
                            <li><a href="mailto:{{ $settings->valueOf('email') }}" aria-label="Mail"><i
                                        class="fal fa-envelope"></i>{{ $settings->valueOf('email') }}</a>
                            </li>
                        </ul>
                        <ul class="social-links clearfix">
                            <li><a href="{{ $settings->valueOf('twitter') }}" aria-label="Twitter">
                                <i class="fa-brands fa-twitter"></i></a>
                            </li>
                            <li><a href="{{ $settings->valueOf('snapchat') }}" aria-label="Snapchat"><span
                                        class="fab fa-snapchat"></span></a></li>
                            <li><a href="{{ $settings->valueOf('instagram') }}" aria-label="Instagram"><span
                                        class="fab fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="widget_right col-lg-6 d-none d-lg-flex justify-content-center justify-content-lg-end">
                    @if (app()->getLocale() == 'ar')
                        <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                            class="lang bold flex-h gap-5 text-white" aria-label="English Language">
                            <span>English</span>
                            <i class="fal fa-globe"></i>
                        </a>
                    @else
                        <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                            class="lang bold flex-h gap-5 text-white" aria-label="Arabic Language">
                            <span>العربية</span>
                            <i class="fal fa-globe"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--============================== End Nav Top ==============================-->

    <!--======================== start NavBar =============================-->
    <div class="header-list header-sticky">
        <div class="container">
            <div class="d-flex align-items-center p-relative">
                <div class="nav-mobile d-xl-none flex-1">
                    <div class="toggle-menu"><i class="fal fa-bars"></i>
                    </div>
                </div>
                <div class="header-logo flex-1">
                    <div class="logo">
                        <a href="{{ route('home') }}" title="AbayaSquare" rel="home" target="_parent">
                            <img src="{{ asset('assets/img/logo.webp') }}" alt="" width="70" height="84">
                        </a>
                    </div>
                </div>
                <div class="nav-menus d-none d-xl-block flex-grow-2 text-center">
                    <div class="nav-desktop">
                        <div class="primary-menu-container">
                            <ul id="mega_main_menu_ul" class="nav-menu">
                              
                                <li><a href="{{ route('web.products') }}" target="_parent">@lang('site.all')</a></li>
                                <li class="menu-item menu-item-has-children dropdown"><a href="{{ route('stores') }}"
                                        target="_parent">@lang('site.designers')</a>
                                    <ul class="sub-menu default">
                                        @foreach ($stores as $store)
                                            <li><a href="{{ route('product_based_store', ['slug' => $store->slug]) }}"
                                                    target="_parent">{{ $store->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @foreach ($cats as $cat)
                                    <li><a href="{{ route('product_based_category', ['slug' => $cat->slug]) }}" 
                                            target="_parent">{{ $cat->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-right d-flex align-items-center justify-content-end">
                    <div class="apps-logo d-none d-md-block">
                        <a href="{{ $settings->valueOf('ios') }}">
                            <img src="{{ asset('assets/img/Apple_Store_logo.png') }}" alt="Apple_Store_logo" width="30" height="30">
                        </a>
                        <a href="{{ $settings->valueOf('android') }}">
                            <img src="{{ asset('assets/img/play-store-icon.svg') }}" alt="play-store-icon" width="30" height="30">
                        </a>
                    </div>
                    <div class="search-switcher d-none d-md-block">
                        <span class="search-opener"><i class="fal fa-search"></i></span>
                        <form role="search" method="get" class="search-form-container" action="{{ route('search') }}">

                            <div class="popup-overlay"></div>
                            <div class="search-content-popup">
                                <span class="close-popup pointer" href="" target="_parent"><i
                                        class="fal fa-times"></i></span>
                                <h3>@lang('site.search_text')</h3>
                                <div class="field-container orfarm-autocomplete-search-wrap">
                                    <input type="search" name="search" autocomplete="off" class="search-field"
                                        placeholder="" title="Search for:" required>
                                    <input type="submit" class="btn-search" value="Search"><i
                                        class="fal fa-search"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="header-login-form d-none d-md-block">
                        <div class="acc-form-padding">
                            <div class="acc-link acc-buttons">
                                @if (Auth::guard('user')->check())
                                    <a class="lost-pwlink" href="{{ route('profile') }}" title="@lang('site.profile')"
                                        id="login-inline" target="_parent">
                                        <i class="fal fa-user"></i>
                                    </a>
                                @else
                                    <a class="lost-pwlink" href="{{ route('login') }}" title="@lang('site.login-register')"
                                        id="login-inline" target="_parent">
                                        <i class="fal fa-user"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="wl-icon-wrapper  d-none d-md-block">
                        <a title="View wishlist" href="{{ route('favs') }}" target="_parent">
                            <span class="wl-icon"><span class="fal fa-heart"></span></span>
                            {{-- <span class="wl-count qty-count">0</span> --}}
                        </a>
                    </div>
                    <div class="topcart">
                        <span class="cart-toggler toggle-cartside pointer" target="_parent">
                            <span class="content-cart">
                                <span class="my-cart">
                                    <svg width="16" height="16" viewBox="0 0 14 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.39173 4.12764C4.44388 2.94637 5.40766 2.00487 6.58894 2.00487H7.38873C8.57131 2.00487 9.53591 2.94846 9.5861 4.13155C7.78094 4.36058 6.15509 4.35461 4.39173 4.12764ZM3.18982 5.16767L3.18982
                                        7.73151C3.18982 8.06644 3.45838 8.33795 3.78966 8.33795C4.12095 8.33795 4.38951 8.06644 4.38951 7.73152L4.38951 5.33644C6.14735 5.55157 7.79071 5.55699 9.58815 5.34012V7.86711C9.58815 8.20204 9.85671 8.47355 10.188 8.47355C10.5193
                                        8.47355 10.7878 8.20204 10.7878 7.86711V5.17238C12.0268 5.06423 13.025 6.16508 12.7509 7.30009L12.0455 10.2203C11.9677 10.5424 12.1657 10.8665 12.4877 10.9443C12.8098 11.022 13.1339 10.824 13.2116 10.502L13.917 7.58177C14.4003
                                        5.58093 12.6964 3.86781 10.7784 3.97096C10.6482 2.19332 9.18032 0.791992 7.38873 0.791992H6.58894C4.79881 0.791992 3.33188 2.19103 3.19955 3.96661C1.28928 3.87048 -0.398284 5.57815 0.0829708 7.57053L1.49644 13.4223C1.80462
                                        14.6981 2.9479 15.5959 4.26085 15.5959H9.74186C11.0548 15.5959 12.1981 14.6981 12.5063 13.4223C12.584 13.1003 12.3861 12.7761 12.064 12.6984C11.742 12.6206 11.4179 12.8186 11.3401 13.1406C11.1624 13.8764 10.5022 14.3962
                                        9.74186 14.3962H4.26085C3.50047 14.3962 2.84032 13.8764 2.66259 13.1406L1.24911 7.28885C0.976309 6.15944 1.96169 5.06742 3.18982 5.16767Z"
                                            fill="#2D2A6E"></path>
                                    </svg>
                                </span>
                                <span class="qty qty-count">{{ \Cart::getTotalQuantity()}}</span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================== End NavBar =============================-->

    @yield('content')
    <!--======================= Start footer ==========================-->
    <footer class="footer bg_lazy" data-original="{{ asset('assets/img/5.webp') }}">
        <div class="container">
            <div class="footer-top p-relative">
                <div class="row">
                    <div class="col-lg-3 col-md-6 site_info">
                        <a href="{{ route('home') }}" class="logo" aria-label="Home">
                            <img src="{{ asset('assets/img/logo.webp') }}" alt="" width="60" height="72">
                        </a>
                        <p class="desc">@lang('site.footer_text')</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div>
                            <h4 class="head mb-20">@lang('site.linkes')</h4>
                            <ul class="services_box">
                                <li>
                                    <a href="{{ route('web.products') }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        <span>@lang('site.all')</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home') }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        <span>@lang('site.home')</span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('about') }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        <span>@lang('site.about_us')</span>
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('contact') }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        <span>@lang('site.contact')</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('terms') }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        <span>@lang('site.terms')</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('privacy') }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        <span>@lang('site.privacy')</span>
                                    </a>
                                </li>
                                @foreach ($cats as $item)
                                    <li>
                                        <a href="{{ route('product_based_category', ['slug' => $cat->slug]) }}">
                                            <i class="fal fa-angle-double-left"></i>
                                            <span>{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="head mb-20">@lang('site.download_app')</h4>
                        <div class="apps_box">
                            <a href="{{ $settings->valueOf('android') }}" target="_blank" aria-label="Android App">
                                <img data-src="{{ asset('assets/img/google-btn.svg') }}" class="lazyload" width="165" height="49" alt=""></a>
                            <a href="{{ $settings->valueOf('ios') }}" target="_blank" aria-label="Ios App">
                                <img data-src="{{ asset('assets/img/apple-btn.svg') }}" class="lazyload" width="165" height="49" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div>
                            <h4 class="head mb-20">@lang('site.contact')</h4>
                            <div class="sochial">
                                <a href="{{ $settings->valueOf('twitter') }}" target="_blank" aria-label="Twitter"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="{{ $settings->valueOf('snapchat') }}" target="_blank" aria-label="Snapchat"><i
                                        class="fab fa-snapchat"></i></a>
                                <a href="{{ $settings->valueOf('instagram') }}" target="_blank" aria-label="Instagram"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                            <div class="contact-info mt-30">
                                <a href="tel:{{ $settings->valueOf('mobile') }}" class="flex-h" aria-label="Call">
                                    <i class="fal fa-phone"></i>
                                    <span>{{ $settings->valueOf('mobile') }}</span>
                                </a>
                                <a href="mailto:{{ $settings->valueOf('email') }}" class="flex-h" aria-label="Mail">
                                    <i class="fal fa-envelope"></i>
                                    <span>{{ $settings->valueOf('email') }}</span>
                                </a>
                            </div>
                            <div class="mt-20 text-center">
                                <img data-src="{{ asset('assets/img/pay.webp') }}" class="lazyload" alt="">
                                <p style="font-size: 13px; margin: 7px 0 0; font-weight: 600; color: #d3dee4;">@lang('site.secpay')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--======================= Start copy rights ==========================-->
            <div class="copyrights text-center p-relative">
                <p class="m-0">&copy; @lang('site.rights') <strong><a href="{{ route('home') }}"
                            style="color:#988a76;" aria-label="Site"> {{ $settings->valueOf('project_name_' . $lang) }}</a></strong></p>
            </div>
            <!--======================= End copy rights ==========================-->
        </div>
    </footer>
    <!--======================= End footer ==========================-->




    <!--======================== Start footer sochial =============================-->
    <div class="footer_sochial">
        <a href="https://wa.me/{{ $settings->valueOf('whatsapp') }}" class="whatsapp" data-toggle="tooltip"
            data-placement="right" title="{{ trans('site.send_whatsapp') }}" target="_blank" aria-label="Whatsapp"><i
                class="fab fa-whatsapp"></i></a>
        <a href="tel:{{ $settings->valueOf('mobile') }}" class="mobile" data-toggle="tooltip"
            data-placement="right" title="{{ trans('site.call') }}" aria-label="Call"><i class="fas fa-phone"></i></a>
    </div>
    <!--======================== End footer sochial =============================-->

    <!--======================== Start side card =============================-->
    <div class="cart-side-content">
        <div class="cart-side-backdrop toggle-cartside"></div>
        <div class="cart-widget-content">
            <div class="widget woocommerce widget_shopping_cart">
                <h2 class="widgettitle"><span>@lang('site.cart')</span><span class="toggle-cartside pointer"
                        target="_parent"><i class="fal fa-times"></i></span></h2>
                <div class="widget_shopping_cart_content">
                    <div class="minicart-list">
                        <ul class="woocommerce-mini-cart cart_list product_list_widget">

                            @foreach ($cartItems as $item)
                                    <li class="woocommerce-mini-cart-item mini_cart_item">
                                        
                                        <a href="{{ route('product_page', $item->attributes->slug) }}" target="_parent">
                                            <img width="70" height="100" src="{{ $item->attributes->image }}"
                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                alt="" loading="lazy">
                                            <div class="info-m">
                                                <span class="d-block name">{{ $item->name }}</span>
                                                <span class="quantity">{{ $item->quantity }} ×
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>{{ $item->price }}<span
                                                                class="woocommerce-Price-currencySymbol">@lang('site.rs')</span></bdi>
                                                    </span>
                                                </span>
                                            </div>
                                        </a>

                                    </li>
                                @endforeach

                        </ul>
                    </div>
                    <div class="minicart-bottom">
                        <p class="woocommerce-mini-cart__total total"><strong>@lang('site.cart4'):</strong> <span
                                class="woocommerce-Price-amount amount"><bdi>{{ \Cart::getSubTotal() }} <span
                                        class="woocommerce-Price-currencySymbol">@lang('site.rs')</span></bdi>
                            </span>
                        </p>
                        <p class="woocommerce-mini-cart__buttons buttons">
                            <a href="{{ route('cart') }}" class="button wc-forward"
                                target="_parent">@lang('site.cart5')</a>
                            <a href="{{ route('checkout') }}" class="button checkout wc-forward"
                                target="_parent">@lang('site.cart6')</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--======================== End side card =============================-->

    <!--======================== Start mobile menu =============================-->
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-navigation hidden-md hidden-lg">
        <div id="close-menu-moblie"><a href="#" target="_parent" aria-label="Close">@lang('site.close')<i class="fal fa-times"></i></a></div>
        <form role="search" method="get" class="search-form-container" action="{{ route('search') }}">
            {{-- @csrf --}}
            <div class="popup-overlay"></div>
            <div class="search-content-popup">
                <h3>@lang('site.search_text')</h3>
                <div class="field-container orfarm-autocomplete-search-wrap">
                    <input type="search" autocomplete="off" id="woocommerce-product-search-field-QzBV3"
                        class="search-field" placeholder="" value="" name="search"
                        title="Search for:" required>
                    <input type="submit" class="btn-search" value="Search"><i class="fal fa-search"></i>
                </div>
                <input type="hidden" name="post_type" value="product">
            </div>
        </form>

        <div id="mobile-megamenu" class="tabcontent">
            <div class="mobile-menu-container">
                <ul id="menu-main-menu" class="nav-menu mobile-menu">
                    <li><a href="{{ route('web.products') }}" target="_parent">@lang('site.all')</a></li>
                    <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown">
                        <a href="{{ route('stores') }}" target="_parent">@lang('site.designers')</a>
                        <ul class="sub-menu">
                            @foreach ($stores as $store)
                                <li><a href="{{ route('store', ['id' => $store->id]) }}"
                                        target="_parent">{{ $store->name }}</a></li>
                            @endforeach
                        </ul>
                        <span class="toggle-submenu"><i class="fal fa-chevron-down"></i></span>
                    </li>
                    @foreach ($cats as $cat)
                        <li><a href="{{ route('product_based_category', ['slug' => $cat->slug]) }}"
                                target="_parent">{{ $cat->name }}</a></li>
                    @endforeach
                    {{-- <li><a href="{{ route('about') }}" target="_parent">@lang('site.about_us')</a></li> --}}
                    <li><a href="{{ route('contact') }}" target="_parent">@lang('site.contact')</a></li>
                </ul>
            </div>
        </div>
        <div class="my-account-link">
            @if (Auth::guard('user')->check())
                <a href="{{ route('profile') }}" title="" target="_parent">@lang('site.profile')<i
                        class="fal fa-user"></i></a>
            @else
                <a href="{{ route('login') }}" title="" target="_parent">@lang('site.login-register')<i
                        class="fal fa-user"></i></a>
            @endif
        </div>
        <div class="wishlist-link">
            <a href="{{ route('favs') }}" target="_parent">
                @lang('site.special_products')<i class="fal fa-heart"></i>
            </a>
        </div>
        <div class="flex-h flex-between" style="margin-top: 15px">
            <ul class="social-links clearfix">
                <li><a href="{{ $settings->valueOf('twitter') }}" aria-label="Twitter"><span class="fab fa-twitter"></span></a>
                </li>
                <li><a href="{{ $settings->valueOf('snapchat') }}" aria-label="Snapchat"><span
                            class="fab fa-snapchat"></span></a></li>
                <li><a href="{{ $settings->valueOf('instagram') }}" aria-label="Instagram"><span
                            class="fab fa-instagram"></span></a></li>
            </ul>
            <div class="apps-logo">
                <a href="{{ $settings->valueOf('ios') }}">
                    <img src="{{ asset('assets/img/Apple_Store_logo.png') }}" alt="Apple_Store_logo" width="30" height="30">
                </a>
                <a href="{{ $settings->valueOf('android') }}">
                    <img src="{{ asset('assets/img/play-store-icon.svg') }}" alt="play-store-icon" width="30" height="30">
                </a>
            </div>
        </div>
    </div>

    <!--======================== End mobile menu =============================-->

    <!--======================== Start icons bar bottom =============================-->
    <ul class="side-sticky-icons">
        <li class="quick-compare">
            <a class="home-link" href="{{ route('home') }}" target="_parent"><span
                    class="fal fa-home icons"></span></a>
        </li>
        <li>
            <span class="toggle-menu" target="_parent">
                <svg version="1.1" width="22" height="20" id="Layer_1" fill="#2d2a6e"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                    y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512
        512;"
                    xml:space="preserve">
                    <g>
                        <g>
                            <path
                                d="M185.86,0H42.837C23.18,0,5.953,15.183,5.953,34.846v143.023c0,19.663,17.227,36.456,36.884,36.456H185.86 c19.657,0,34.419-16.794,34.419-36.456V34.846C220.279,15.183,205.517,0,185.86,0z M196.465,177.869 c0,6.523-4.076,12.643-10.605,12.643H42.837c-6.529,0-13.07-6.119-13.07-12.643V34.846c0-6.524,6.541-11.032,13.07-11.032H185.86
        c6.529,0,10.605,4.509,10.605,11.032V177.869z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path
                                d="M185.86,297.674H42.837c-19.657,0-36.884,15.183-36.884,34.846v143.023C5.953,495.206,23.18,512,42.837,512H185.86 c19.657,0,34.419-16.794,34.419-36.456V332.521C220.279,312.858,205.517,297.674,185.86,297.674z M196.465,475.544
        c0,6.523-4.076,12.643-10.605,12.643H42.837c-6.529,0-13.07-6.119-13.07-12.643V332.521c0-6.524,6.541-11.032,13.07-11.032H185.86 c6.529,0,10.605,4.509,10.605,11.032V475.544z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path
                                d="M471.628,0H328.605c-19.657,0-36.884,15.183-36.884,34.846v143.023c0,19.663,17.227,36.456,36.884,36.456h143.023 c19.657,0,34.419-16.794,34.419-36.456V34.846C506.047,15.183,491.285,0,471.628,0z M482.233,177.869 c0,6.523-4.075,12.643-10.605,12.643H328.605c-6.529,0-13.07-6.119-13.07-12.643V34.846c0-6.524,6.541-11.032,13.07-11.032
        h143.023c6.529,0,10.605,4.509,10.605,11.032V177.869z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path
                                d="M471.628,297.674H328.605c-19.657,0-36.884,15.183-36.884,34.846v143.023c0,19.663,17.227,36.456,36.884,36.456h143.023 c19.657,0,34.419-16.794,34.419-36.456V332.521C506.047,312.858,491.285,297.674,471.628,297.674z M482.233,475.544
        c0,6.523-4.075,12.643-10.605,12.643H328.605c-6.529,0-13.07-6.119-13.07-12.643V332.521c0-6.524,6.541-11.032,13.07-11.032 h143.023c6.529,0,10.605,4.509,10.605,11.032V475.544z" />
                        </g>
                    </g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                </svg>
            </span>
        </li>
        <li class="quick-cart">
            <span class="toggle-cartside" target="_parent"><span
                    class="badge">{{ \Cart::getTotalQuantity()}}</span>
                <svg width="22" height="24" viewBox="0 0 22 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.90128 5.24203C6.98308 3.38562 8.49765 1.90595 10.354 1.90595H11.6109C13.4693 1.90595 14.9852 3.38889 15.0639 5.24818C12.2272 5.60809 9.67227 5.5987 6.90128 5.24203ZM5.01258 6.87637L5.01257
        10.905C5.01257 11.4313 5.43459 11.8579 5.95518 11.8579C6.47577 11.8579 6.8978 11.4313 6.8978 10.905L6.8978 7.14158C9.66012 7.47964 12.2425 7.48815 15.0671 7.14736V11.118C15.0671 11.6444 15.4891 12.071 16.0097 12.071C16.5303 12.071 16.9523 11.6444
        16.9523 11.118V6.88377C18.8992 6.71382 20.4679 8.44373 20.0371 10.2273L18.9286 14.8163C18.8064 15.3223 19.1175 15.8316 19.6236 15.9539C20.1296 16.0761 20.6389 15.765 20.7612 15.2589L21.8696 10.67C22.6291 7.52579 19.9515 4.83374 16.9376 4.99582C16.733
        2.20224 14.4263 0 11.6109 0H10.354C7.54088 0 5.23564 2.19865 5.02784 4.989C2.02599 4.83794 -0.625874 7.52141 0.130383 10.6523L2.35155 19.8479C2.83582 21.8528 4.63241 23.2635 6.69562 23.2635H15.3086C17.3718 23.2635 19.1684 21.8528 19.6527 19.8479C19.7749
        19.3419 19.4638 18.8325 18.9578 18.7103C18.4517 18.5881 17.9424 18.8992 17.8202 19.4053C17.5409 20.5615 16.5035 21.3783 15.3086 21.3783H6.69562C5.50073 21.3783 4.46336 20.5615 4.18407 19.4052L1.96289 10.2097C1.5342 8.43487 3.08265 6.71883 5.01258
        6.87637Z"
                        fill="white"></path>
                </svg>
        </span>
        </li>
        <li class="quick-wishlist">
            <a href="{{ route('favs') }}" target="_parent" aria-label="Fav"><span class="fal fa-heart icons"></span></a>
        </li>
        <li>
            @if (Auth::guard('user')->check())
                <a href="{{ route('profile') }}" target="_parent"><span class="fal fa-user icons"></span></a>
            @else
                <a href="{{ route('login') }}" target="_parent"><span class="fal fa-user icons"></span></a>
            @endif
        </li>
    </ul>
    <!--======================== End icons bar bottom =============================-->



    <!-- ==================== button up =================== -->
    <div id="up_btn">
        <i class="fal fa-chevron-up"></i>
    </div>
    <!-- ==================== button up =================== -->

    <!-- vendor scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/lazysizes.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/greensock.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/ScrollMagic.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animation.gsap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/Select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/viewport.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.lazyload.min.js') }}"></script>



    <!-- main.js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    {{-- @include('sweetalert::alert') --}}

    @yield('js')
</body>

</html>
