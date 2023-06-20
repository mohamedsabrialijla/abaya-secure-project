<!DOCTYPE html>
<html class="no-js">

<head>
    <meta name="description" content="">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_token" content="">
    <meta charset="utf-8">
    <meta name="author" content="Mustafa Fathi Ibrahim [Fornt End Devleoper]">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    {{-- <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fbccd866c4b620012e3b048&product=inline-share-buttons" async="async"></script> --}}


    <link rel="shortcut icon" type="image/x-icon"
        href="https://trello-attachments.s3.amazonaws.com/56b8bc896bcfecd15e92ab87/5f54fd4290e0ac52a8ed417a/x/12fed00b34b8ef9a1de0d1a8fce350b5/Favicon.png" />


    <link rel="stylesheet" href="{{ asset('filter/fonts/neo-font.css') }}">

    <link href="{{ asset('filter/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('filter/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('filter/css/nice-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('filter/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('filter/css/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('filter/css/breakingNews.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('filter/css/lity.min.css') }}" rel="stylesheet">
    <link href="{{ asset('filter/css/licon.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('filter/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('filter/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('filter/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('filter/css/slick-theme.css') }}">
    <link href="{{ asset('filter/css/style.css') }}" rel="stylesheet" type="text/css" />
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('filter/css/style-rtl.css') }}" rel="stylesheet" type="text/css" />

    @else


    @endif

    <!-- Resonsive File -->
    <link href="{{ asset('filter/css/mobile.css') }}" rel="stylesheet" type="text/css" />


    @yield('style')

</head>

<body>

    <div class="fullbg"></div>

    <!-- Start Website Loader -->
    <div class="loader">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;" width="200px"
            height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <defs>
                <clipPath id="ldio-8asl9z7pq8k-cp" x="0" y="0" width="100" height="100">
                    <rect x="0" y="5" width="100" height="46">
                    </rect>
                </clipPath>
            </defs>
            <path
                d="M70 75.2H34.1l-4.1-18.4l-0.7-3l-1-4.7c0 0 0 0 0-0.1c0-0.1 0-0.1-0.1-0.2c0 0 0-0.1-0.1-0.1c0 0 0-0.1-0.1-0.1 c0 0-0.1-0.1-0.1-0.1c0 0-0.1-0.1-0.1-0.1c0 0-0.1-0.1-0.1-0.1c0 0 0 0-0.1-0.1L22.3 44c0-0.1 0-0.2 0-0.3c0-1.9-1.6-3.5-3.5-3.5 s-3.5 1.6-3.5 3.5c0 1.9 1.6 3.5 3.5 3.5c0.7 0 1.4-0.2 2-0.6l4.8 3.7L31.5 77c0 0 0 0 0 0l-5.6 7.7c-0.3 0.5-0.4 1.1-0.1 1.6 c0.3 0.5 0.8 0.8 1.3 0.8h4c-0.8 0.8-1.3 1.9-1.3 3.2c0 2.6 2.1 4.7 4.7 4.7c2.6 0 4.7-2.1 4.7-4.7c0-1.2-0.5-2.3-1.3-3.2h29 c-0.8 0.8-1.3 1.9-1.3 3.2c0 2.6 2.1 4.7 4.7 4.7c2.6 0 4.7-2.1 4.7-4.7c0-1.2-0.5-2.3-1.3-3.2H77c0.8 0 1.5-0.7 1.5-1.5 s-0.7-1.5-1.5-1.5H30l4.3-6h36.8c0.7 0 1.3-0.5 1.4-1.1l7.5-27.3c0.2-0.8-0.2-1.6-1-1.8c-0.8-0.2-1.6 0.2-1.8 1l-1.3 4.7l-0.8 3"
                fill="#dddddd"></path>
            <polygon points="31.3 53.1 35.7 73.2 68.5 73.2 74 53.1" fill="#dddddd"></polygon>
            <g clip-path="url(#ldio-8asl9z7pq8k-cp)">
                <g>
                    <g transform="translate(50 41)">
                        <path
                            d="M6.5-6.7C6.1-6.9 5.7-7.2 5.3-7.4C5-7.5 4.6-7.7 4.3-7.8C3.1-2.2-4-3.7-2.9-9.3c-0.4 0-0.7 0-1.1 0 c-0.5 0-1 0.1-1.4 0.2c-1.8 0.3-3.6 0.9-5.3 1.8l1.1 4.2l3.1-0.8L-8.7 6.9L3.2 9.3L5.4-1.5l2.5 2l2.7-3.4C9.5-4.4 8.1-5.7 6.5-6.7z"
                            fill="#e15b64">
                            <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                    <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                        dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                </g>
                <g>
                    <g transform="translate(35 17)">
                        <path
                            d="M3.4-5.3L2.5-5l0.8-2.3L1.1-6.3l-1.2-2.2l-1.6 4.6l-4.6-1.6l0.9 2.3l-2.2 1.2l2.3 0.8L-6-0.9 c-0.6 0.3-0.8 0.9-0.5 1.5l1 2.1C-5.2 3.4-4.6 3.6-4 3.3l0.1-0.1l2.1 4.5C-1.4 8.4-0.7 8.7 0 8.3l1.7-0.8l1.7-0.8L5 5.9l1.7-0.8 C7.4 4.8 7.7 4 7.4 3.3L5.2-1.1l0.1-0.1c0.6-0.3 0.8-0.9 0.5-1.5l-1-2.1C4.6-5.4 3.9-5.6 3.4-5.3z"
                            fill="#f47e60">
                            <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                    <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                        dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                </g>
                <g>
                    <g transform="translate(66 26)">
                        <path
                            d="M-4.5-3.7L1.9-6l0.5-0.2L2-7.2l-6.9 2.5C-5.7-4.4-6.1-3.5-6-2.7c0 0.1 0 0.2 0.1 0.3l3 8.2 C-2.5 6.9-1.3 7.4-0.2 7l5.6-2C5.9 4.8 6.2 4.2 6 3.7L3.2-3.9l-0.4-1L2.4-4.7L1.9-4.5l-3.2 1.2l-2.7 1c-0.3 0.1-0.6 0-0.8-0.2 c-0.1-0.1-0.1-0.1-0.1-0.2C-5.1-3.1-4.9-3.6-4.5-3.7z"
                            fill="#f8b26a">
                            <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                    <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                        dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                </g>
                <g>
                    <g transform="translate(55 6)">
                        <polygon
                            points="0 -4.9 1.6 -1.7 5.1 -1.1 2.6 1.3 3.2 4.9 0 3.2 -3.2 4.9 -2.6 1.3 -5.1 -1.1 -1.6 -1.7"
                            fill="#abbd81">
                            <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                        </polygon>
                    </g>
                    <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                        dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                </g>
            </g>
            <g clip-path="url(#ldio-8asl9z7pq8k-cp)">
                <g transform="translate(0 -75)">
                    <g>
                        <g transform="translate(50 41)">
                            <path
                                d="M6.5-6.7C6.1-6.9 5.7-7.2 5.3-7.4C5-7.5 4.6-7.7 4.3-7.8C3.1-2.2-4-3.7-2.9-9.3c-0.4 0-0.7 0-1.1 0 c-0.5 0-1 0.1-1.4 0.2c-1.8 0.3-3.6 0.9-5.3 1.8l1.1 4.2l3.1-0.8L-8.7 6.9L3.2 9.3L5.4-1.5l2.5 2l2.7-3.4C9.5-4.4 8.1-5.7 6.5-6.7z"
                                fill="#e15b64">
                                <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                    dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                            </path>
                        </g>
                        <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                            dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                    </g>
                    <g>
                        <g transform="translate(35 17)">
                            <path
                                d="M3.4-5.3L2.5-5l0.8-2.3L1.1-6.3l-1.2-2.2l-1.6 4.6l-4.6-1.6l0.9 2.3l-2.2 1.2l2.3 0.8L-6-0.9 c-0.6 0.3-0.8 0.9-0.5 1.5l1 2.1C-5.2 3.4-4.6 3.6-4 3.3l0.1-0.1l2.1 4.5C-1.4 8.4-0.7 8.7 0 8.3l1.7-0.8l1.7-0.8L5 5.9l1.7-0.8 C7.4 4.8 7.7 4 7.4 3.3L5.2-1.1l0.1-0.1c0.6-0.3 0.8-0.9 0.5-1.5l-1-2.1C4.6-5.4 3.9-5.6 3.4-5.3z"
                                fill="#f47e60">
                                <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                    dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                            </path>
                        </g>
                        <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                            dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                    </g>
                    <g>
                        <g transform="translate(66 26)">
                            <path
                                d="M-4.5-3.7L1.9-6l0.5-0.2L2-7.2l-6.9 2.5C-5.7-4.4-6.1-3.5-6-2.7c0 0.1 0 0.2 0.1 0.3l3 8.2 C-2.5 6.9-1.3 7.4-0.2 7l5.6-2C5.9 4.8 6.2 4.2 6 3.7L3.2-3.9l-0.4-1L2.4-4.7L1.9-4.5l-3.2 1.2l-2.7 1c-0.3 0.1-0.6 0-0.8-0.2 c-0.1-0.1-0.1-0.1-0.1-0.2C-5.1-3.1-4.9-3.6-4.5-3.7z"
                                fill="#f8b26a">
                                <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                    dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                            </path>
                        </g>
                        <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                            dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                    </g>
                    <g>
                        <g transform="translate(55 6)">
                            <polygon
                                points="0 -4.9 1.6 -1.7 5.1 -1.1 2.6 1.3 3.2 4.9 0 3.2 -3.2 4.9 -2.6 1.3 -5.1 -1.1 -1.6 -1.7"
                                fill="#abbd81">
                                <animateTransform attributeName="transform" type="rotate" keyTimes="0;1" values="0;360"
                                    dur="0.7462686567164178s" repeatCount="indefinite"></animateTransform>
                            </polygon>
                        </g>
                        <animateTransform attributeName="transform" type="translate" keyTimes="0;1" values="0 0;0 75"
                            dur="1.4925373134328357s" repeatCount="indefinite"></animateTransform>
                    </g>
                </g>
            </g>
        </svg>
    </div>

    <!--start header mobile -->
    <div class="header_mobile">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-4">
                    <div class="list">
                        <div class="mobile-menu">
                            <img src="{{ asset('filter/images/menu.svg') }}" alt="menu_icon" class="open-mobile-menu"
                                style="width:20px">
                            <!--<div class="dropdown-mobile-menu">-->
                            <!--<ul>-->
                            <!--    <li  @if (request()->url() == url('/')) class="alaa-menu-item active"  @else class="alaa-menu-item" @endif >-->
                            <!--        <a href="{{ url('/') }}">Home</a>-->
                            <!--    </li>-->
                            <!--    <li       @if (request()->url() == url('/about')) class="alaa-menu-item active"  @else class="alaa-menu-item" @endif >-->
                            <!--        <a href="{{ url('static-page/1') }}">@lang('website.about us')</a>-->
                            <!--    </li>-->
                            <!--    @foreach (\App\Models\Category::all() as $category) -->

                            <!--        <li class="alaa-menu-item">-->
                            <!--            <a href="{{ url('/products?type=category&id='.$category->id) }}">{{ $category->name }}</a>-->
                            <!--        </li>-->


                            <!-- @endforeach-->

                            <!--    <li class="alaa-menu-item  {{ request()->url() == url('/brands') ? 'active' : '' }}">-->
                            <!--        <a href="{{ url('/brands') }}">{{ __('website.brands') }}</a>-->
                            <!--    </li>-->

                            <!--</ul>-->
                            <!--</div>-->
                        </div>
                        <div class="icon-search"><img src="{{ asset('filter/images/search.svg') }}" alt="search_icon"
                                style="width:20px">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <a href="{{ url('/') }}" class="mobile_logo"><img
                            src="" alt=""></a>
                </div>
                <div class="col-4 left_icons">

                    <div class="nav-left-group">
                        <div class="favorite-icon-box">
                            <a href="{{ url('/followed-Products') }}">
                                <i class="lnr lnr-heart active"></i>
                            </a>
                        </div>
                        <div class="some-items">
                            <div class="shopping-cart-box">
                                <i class="lnr lnr-cart"></i>
                                <span>@lang('site.cart')</span>
                                <div class="shopping-cart-icon">
                                    <span class="shopping-cart-num">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End header mobile -->

    <div class="shopping-cart-box">
        <div class="dropdown-shopping-cart">
            {{-- @if (!empty(session('cart'))) --}}
            <div id="cart-div" @if (empty(session('cart'))) style="display: none" @endif>
                <div class="cart-total-price">
                    <span>@lang('site.cart')</span>
                </div>
                <ul id="ul-cart">
                    @if (!empty(session('cart')))
                        @foreach (session('cart') as $item)
                            <li class="cart-ul">
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <a href="#">
                                    <img src="{{ Operation::get_img(App\Models\Product::find($item->id)->files->offsetGet(0)->path) }}"
                                        class="img-fluid" alt="">
                                    <div class="item-in">
                                        <span
                                            class="item-price">{{ $item->discount_ratio ? $item->after_discount_price : $item->new_price }}
                                            @lang('site.sar')</span>
                                        <h5>{{ $item->title }}</h5>
                                        <i data-id="{{ $item->id }}" class="fa fa-times"></i>
                                    </div>
                                </a>
                            </li>
                        @endforeach


                    @endif
                </ul>

                <div class="cart-buttons">
                    <a href="{{ url('checkout') }}" class="btn">@lang('site.continue_checkout')</a>
                    {{-- <span>taxes and shopping will be calculated at checkout</span> --}}
                </div>
            </div>
            {{-- @else --}}
            @if (empty(session('cart')))
                <span id="empty-card"> @lang('site.cart_empty')</span>
            @endif
            {{-- @endif --}}
        </div>
    </div>

    <!-- start mobile list -->
    <div class="mobile-sideList">
        <div class="sid-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('filter/images/logo.png') }}" alt="logo">
            </a>
        </div>

        <div class="user_lang">
            @if (!auth()->check())
                <a href="{{ url('test') }}" class="show-register btn-register">
                    <i class="fa fa-user"></i>
                    <span>حسابي</span>
                </a>
            @else

                <div class="user-box">
                    <a class="user-name"><i class="fa fa-user"></i></a>
                    <div class="user-dropdown-b">
                        <ul>

                            @if (auth()->user()->type == 1)

                                <li>
                                    <a href="{{ url('/admin') }}"> <i
                                            class="lnr lnr-home"></i>@lang('website.admin')</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ url('/profile') }}"> <i class="lnr lnr-home"></i>@lang('website.my account')</a>
                            </li>

                            <li>
                                <a href="https://esraa.azq1.com/alaa/logout"> <i class="lnr lnr-exit"></i>
                                    @lang('website.logout')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            @if (app()->getLocale() == 'en')
                <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="lang_icon"> <i class="fa fa-globe"
                        aria-hidden="true"></i>العربية</a>

            @else
                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="lang_icon"> <i class="fa fa-globe"
                        aria-hidden="true"></i>English</a>
            @endif
        </div>

        <ul>
            <li @if (request()->url() == url('/')) class="alaa-menu-item active"  @else class="alaa-menu-item" @endif>
                <a href="{{ url('/') }}">@lang('site.home')</a>
            </li>

            <li class="sale-link">
                <a href="{{ url('add-product') }}"><i class="fa fa-tag"></i> @lang('website.selling now')</a>
            </li>

            <li @if (request()->url() == url('/about')) class="alaa-menu-item active"  @else class="alaa-menu-item" @endif>
                <a href="{{ url('static-page/1') }}">@lang('website.about us')</a>
            </li>
            @foreach (\App\Models\Category::where('status', 1)->get() as $category)

                {{-- <li class="alaa-menu-item  {{ $category->subs->isNotEmpty() ? 'drop-link' : '' }}">
                    <a href="{{ url('/products?type=category&id='.$category->id) }}">
                        {{ $category->name }}
                        @if ($category->subs->isNotEmpty())
                            <i class="fas fa-chevron-down"></i>
                        @endif
                    </a>
                    @if ($category->subs->isNotEmpty())
                        <ul class="branch">
                            @foreach ($category->subs as $sub_category)
                                <a href="{{ url('products?type=category&id='.$sub_category->id) }}">
                                    {{ $sub_category->name }}</a>
                            @endforeach
                        </ul>
                    @endif
                </li> --}}
                {{-- <li class="alaa-menu-item">
                <a href="{{url('products?type=category&id='.$category->id)}}">{{$category->name}}</a>
            </li> --}}


            @endforeach

            <li class="alaa-menu-item  {{ request()->url() == url('/brands') ? 'active' : '' }}">
                <a href="{{ url('/brands') }}">{{ __('website.brands') }}</a>
            </li>


        </ul>
    </div>

    <div class="overlay_gen"></div>

    <!-- End mobile list -->

    <!-- start popup search -->
    <div class="search-popup search-popup__default">
        <div class="search-popup__overlay search-toggler"></div>
        <div class="search-popup__content">
            <div class="aws-container" data-url="/themes/agrikon/?wc-ajax=aws_action"
                data-siteurl="https://ninetheme.com/themes/agrikon" data-lang="" data-show-loader="true"
                data-show-more="true" data-show-page="true" data-show-clear="true" data-mobile-screen="false"
                data-use-analytics="false" data-min-chars="1" data-buttons-order="1" data-is-mobile="false"
                data-page-id="4016" data-tax="">
                <form class="aws-search-form aws-show-clear" action="https://ninetheme.com/themes/agrikon/" method="get"
                    role="search">
                    <div class="aws-wrapper">
                        <label
                            style="position:absolute !important;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;"
                            class="aws-search-label" for="6054afa526acc">Search</label>
                        <input type="search" name="s" id="6054afa526acc" value="" class="aws-search-field"
                            placeholder="Search" autocomplete="off">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End popup search -->

    <!-- Start Top Navbar -->
    <div class="top-nav show">
        <i class="lnr lnr-cross remove-top-nav-btn"></i>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-2">

                </div>
                <div class="col-md-4 col-10">
                    <div class="top-nav-info">
                        <div class="owl-carousel top-nav-slider">
                            <div class="tns-item">
                                <p>
                                    Abaya Square
                                </p>
                            </div>
                            <div class="tns-item">
                                <p>
                                    Abaya Square
                                </p>
                            </div>
                            <div class="tns-item">
                                <p>
                                    Abaya Square
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-4 desktop-langs">
                    <div class="top-nav-langs">
                        @if (app()->getLocale() == 'en')
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}"> <i class="fa fa-globe"
                                    aria-hidden="true"></i> العربية </a>

                        @else


                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}"> <i class="fa fa-globe"
                                    aria-hidden="true"></i>English</a>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Navbar -->

    <!-- Start Website Navbar -->
    <div class="alaa-header">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-5">
                    <div class="logo-box desktop-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('filter/images/logo.png') }}" alt="">
                        </a>
                    </div>
                    <form action="" class="desktop-search nav-search">
                        <select id="select" class="select" name="category">
                            <option value="All">@lang('website.all')</option>
                            {{-- <option value="Brands">{{__('website.brands')}}</option> --}}
                            @foreach (\App\Models\Category::where('status', 1)->get() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endforeach

                        </select>
                        {{-- <div class="search-con-box">
                            <form action="{{ route('search') }}" method="post">
                                @csrf
                                <input name="word" type="search" placeholder="@lang('website.search s')">

                                <!--<div class="icon_search"><input type="submit" value=""><i class="fas fa-search"></i></div>-->
                            </form>
                            <div class="search-con-list">
                                {{-- <ul class="search-list">

                            </ul>



                                <ul class="search-list  list-unstyled">

                                </ul>
                            </div>
                        </div> --}}
                    </form>
                    <div class="mobile-langs">
                        <div class="top-nav-langs">
                            <a href="{{ url('/') }}"> <img src="{{ asset('filter/images/ar.jpg') }}"> </a>

                        </div>
                    </div>
                </div>

                @if (auth()->check())

                    <div class="col-md-3 col-7">
                        <div class="nav-left-group">

                            <div class="icons-box">
                                <div class="account-box">
                                    <div class="user-box notf-box">
                                        <div class="notf-dropdown-c">
                                            <i class="las la-bell"></i>
                                            <span class="notfiction-num">{{ Auth::user()->unreadNotifications->count() }}</span>
                                        </div>
                                        <div class="user-dropdown-b">
                                            <ul>
                                                @if(!@empty (Auth::user()->notifications->count()))
                                                @foreach (Auth::user()->notifications as $not)
                                                <li id="{{ $not->id }}"  @if (!is_null($not->read_at)) class="opened" @endif id="{{ $not->id }}"  onclick="{{ $not->markAsRead() }}">
                                                    <a  href="{{ $not->data['link']??'' }}" >@json($not->data['text']??'', JSON_UNESCAPED_UNICODE)</a>
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="some-items">

                                <div class="shopping-cart-box">
                                    <i class="lnr lnr-cart"></i>
                                    <span>{{ __('website.cart') }}</span>
                                    <div class="shopping-cart-icon">
                                        @if (!empty(session('cart_ids')))
                                            <span class="shopping-cart-num">{{ count(session('cart_ids')) }}</span>
                                        @else
                                            <span class="shopping-cart-num">0</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="favorite-icon-box">
                                <a href="{{ url('followed-Products') }}">
                                    <i class="lnr lnr-heart active"></i>
                                </a>
                            </div>
                            <div class="icons-box">
                                <div class="account-box">
                                    <div class="user-box">
                                        @if (auth()->check())
                                            <div class="user-dropdown-c">
                                                <i class="lnr lnr-chevron-down"></i>
                                                @if (auth()->check())
                                                    <span class="user-name"><i class="lnr lnr-user"></i>
                                                        {{ auth()->user()->name }}</span>

                                                @endif
                                            </div>
                                            <div class="user-dropdown-b">
                                                <ul>
                                                    @if (auth()->user()->type == 1)

                                                        <li>
                                                            <a href="{{ url('/admin') }}"> <i
                                                                    class="lnr lnr-home"></i>@lang('website.admin')</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ url('/profile') }}"> <i
                                                                class="lnr lnr-home"></i>@lang('website.my account')</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ url('logout') }}"> <i class="lnr lnr-exit"></i>
                                                            @lang('website.logout')</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-3 col-7">
                        <a href="{{ url('test') }}" class="show-register btn-register">

                            <i class="fa fa-user"></i>
                            <!--<span>حسابي</span>-->
                            {{__('website.register s')}}
                        </a>
                    </div>
                @endif
            </div>

        </div>

    </div>
    <div class="bbb-q">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- <form action="" class="mobile-search nav-search">
                        <select  name="category_id"  id="category" class="select">
                            <option value="All">@lang('website.all')</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                            <option value="brand">{{__('website.brands')}}</option>

                        </select>
                        <div class="search-con-box">
                            <input name="word" type="text" placeholder="@lang('website.search s')">
                            <div class="search-con-list">


                                <ul class="search-list list-unstyled">

                                </ul>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <div class="col-5 mobile-logo">
                    <div class="logo-box">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('filter/images/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-7">
                    <div class="mobile-menu">
                        <i class="fa fa-bars open-mobile-menu"></i>
                        <div class="dropdown-mobile-menu">
                            <ul>
                                <li @if (request()->url() == url('/')) class="alaa-menu-item active"  @else class="alaa-menu-item" @endif>
                                    <a href="{{ url('/') }}">@lang('site.home')</a>
                                </li>
                                <li @if (request()->url() == url('/about')) class="alaa-menu-item active"  @else class="alaa-menu-item" @endif>
                                    <a href="{{ url('static-page/1') }}">@lang('website.about us')</a>
                                </li>
                                @foreach (\App\Models\Category::all() as $category)

                                    <li class="alaa-menu-item">
                                        <a
                                            href="{{ url('products?type=category&id='.$category->id) }}">{{ $category->name }}</a>
                                    </li>


                                @endforeach

                                <li class="alaa-menu-item">
                                    <a href="{{ url('/brands') }}">{{ __('website.brands') }}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Website Navbar -->

    {{-- <!-- Start Navbar -->
    <nav class="alaa-navbar desktop-logo">
        <div class="container">
            <div class="row">
                <div class="alaa-menu">
                    <ul>
                        <li class="alaa-menu-item {{ \Request::segment(4) == 'newArrival-all' ? 'active' : '' }}">
                            <a
                                href="{{ url('products') }}">{{ __('website.new_arrival') }}</a>
                        </li>


                        @foreach (\App\Models\Category::where('status', 1)->get() as $category)

                            {{-- <li
                                class="alaa-menu-item {{ $category->subs->isNotEmpty() ? 'dropdown-menu-item' : '' }}{{ \Request::segment(4) == 'categories-' . $category->id ? ' active' : '' }}">
                                <a
                                    href="{{ url('products?type=category&id='.$category->id) }}">{{ $category->name }}</a>



                                @if ($category->subs->isNotEmpty())
                                    <ul class="sub-menu">



                                        @foreach ($category->subs as $cat)
                                            <li>
                                                <a href="{{ url('products?type=category&id='.$cat->id) }}">
                                                    {{ $cat->name }}</a>
                                            </li>
                                        @endforeach


                                    </ul>

                                @endif


                            </li>

                        @endforeach
                        <li class="alaa-menu-item">
                            <a href="{{ url('/brands') }}">{{ __('website.brands') }}</a>
                        </li>
                        <li class="alaa-menu-item {{ \Request::segment(4) == 'sale-products' ? 'active' : '' }} ">
                            <a href="{{ url('products') }}">{{ __('website.sale') }}</a>
                        </li>
                        <li class="alaa-menu-item {{ \Request::segment(2) == 'auctions' ? 'active' : '' }} ">
                            <a href="{{ url('auctions') }}">{{ __('website.auctions') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="selling-box">
                    <a href="{{ url('add-product') }}"
                        class="{{ auth()->check() ? 'selling-btn  show' : 'show-register selling-btn  show' }}">@lang('website.selling now')</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar --> --}}



    @yield('content')




    <!-- Start Why Choose Us Section -->

    <!-- Start Why Choose Us Section -->
    @if (url()->current() != '')
        <section class="why_choose_us">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <span>@lang('website.choose us')</span>
                            <h1>@lang('website.resons shop')</h1>
                        </div>
                    </div>
                    {{-- @php
                        $reasons = \App\Models\ShopReasonTranslation::where('locale', app()->getLocale())->get();
                    @endphp
                    @foreach ($reasons as $reason)
                        <div class="col-md-4">
                            <div class="wcu-box">
                                <div class="img">
                                    <i class="las la-certificate"></i>
                                    <!--<img src="{{ asset('filter/images/logo.png') }}" alt="" class="img-fluid">-->
                                </div>
                                <div class="details">
                                    <h3>{{ $reason->title }}</h3>
                                    <p>{{ $reason->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}


                </div>
            </div>
        </section>
    @endif
    <!-- End Why Choose Us Section -->

    <!-- Start Top Footer -->
    <div class="top-footer">
        {{-- <div class="container-fluid">
            @php
                $socials_array = \App\Models\Setting::whereNotIn('flag', ['website.title', 'website.about'])
                    ->pluck('value')
                    ->toArray();
                $socials = \App\Models\Setting::whereNotIn('flag', ['website.title', 'website.about'])->get();

            @endphp --}}
            {{-- @foreach ($socials_array as $key => $value)
                @if ($value != null)

                    <div class="row">

                        <div class="col-12">


                            <div class="tf-social-media">

                                <span class="d-block">@lang('website.follow us')</span>

                                <ul>
                                    <div class="sochial_media">
                                        <li>
                                            <a class="instagram" href="#"> <i class="fab fa-instagram"></i> </a>
                                        </li>

                                        @foreach ($socials as $social)
                                            @if ($social->flag == 'facebook' && !empty($social->value))
                                                <li>
                                                    <a class="facebook" href="{{ $social->value }}"> <i
                                                            class="fab fa-facebook-f"></i> </a>
                                                </li>
                                            @elseif($social->flag == 'snapchat' && !empty($social->value))
                                                <li>
                                                    <a class="snapchat" href="{{ $social->value }}"> <i
                                                            class="fab fa-snapchat-ghost"></i> </a>
                                                </li>
                                            @elseif($social->flag == 'twitter' && !empty($social->value))
                                                <li>
                                                    <a class="twitter" href="{{ $social->value }}"> <i
                                                            class="fab fa-twitter"></i> </a>
                                                </li>
                                            @elseif($social->flag == 'instagram' && !empty($social->value))
                                                <li>
                                                    <a class="instagram" href="{{ $social->value }}"> <i
                                                            class="fab fa-instagram"></i> </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </div>

                                </ul>
                            </div>
                        </div>
                    </div>
                @break

            @endif
            @endforeach --}}


            <input type="hidden" id="local" value="{{ app()->getLocale() }}">

        </div>
    </div>
    <!-- End Top Footer -->

    <!-- Start Footer -->
    <footer>
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-3 col-md-6 d-md-block d-none">
                    <div class="site-footer-menu">
                        <a href="{{ url('/') }}" class="logo-f">
                            <img src="{{ asset('filter/images/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="site-footer-menu first-menu">
                        <h4 class="footer-menu-title">@lang('website.site pages')</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ url('static-page/1') }}"><i
                                        class="fa fa-chevron-right"></i>@lang('website.about us')</a></li>
                            <li><a href="#"><i class="fa fa-chevron-right"></i>@lang('website.our service')</a></li>
                            {{-- <li><a href="#"><i class="fa fa-chevron-right"></i>@lang('website.site map')</a></li> --}}
                            <li><a href="{{ url('static-page/2') }}"><i class="fa fa-chevron-right"></i>@lang('website.privacy policy')</a></li>
                            <li><a href="{{ url('static-page/3') }}"><i class="fa fa-chevron-right"></i>@lang('site.terms')</a></li>
                            {{-- <li><a href="#"><i class="fa fa-chevron-right"></i>@lang('website.contact us')</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="site-footer-menu">
                        <h4 class="footer-menu-title">@lang('website.categories')</h4>
                        <ul class="footer-menu">

                            @foreach (\App\Models\Category::where('status', 1)->get() as $category)
                                <li><a href="{{ url('/products?type=category&id='.$category->id) }}"><i
                                            class="fa fa-chevron-right"></i>{{ $category->name }}</a></li>
                            @endforeach


                            <li><a href="{{ url('products') }}"><i
                                        class="fa fa-chevron-right"></i>@lang('website.sale')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="site-footer-menu">
                        <h4 class="footer-menu-title">@lang('website.brands')</h4>
                        <ul class="footer-menu">
                            @foreach (\App\Models\Store::orderby('id', 'asc')->take(6)->get()
    as $brand)
                                <li><a href="{{ url('/products?type=brand&id='.$brand->id) }}"><i
                                            class="fa fa-chevron-right"></i> {{ $brand->name }}</a></li>

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->




    </div>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('filter/js/jquery.min.js') }}"></script>

    <script src="{{ asset('filter/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('filter/js/lity.min.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('filter/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('filter/js/jquery.nice-select.js') }}"></script>
    {{-- @if (App::isLocale('en'))
    <!--for english -->
    <script src="{{asset("filter/js/english-jquery-ui.min.js")}}" type="text/javascript"></script>
@else
    <!--for arabic-->
    <script src="{{asset("filter/js/arabic-jquery-ui.min.js")}}" type="text/javascript"></script>
@endif --}}

    <script src="{{ asset('filter/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('filter/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('filter/js/counterdown.js') }}"></script>
    <script src="{{ asset('filter/js/follow.product.js') }}"></script>
    <script src="{{ asset('filter/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('filter/js/dropzone.js') }}"></script>
    <script src="{{ asset('filter/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('filter/js/slick.js') }}"></script>
    <script src="{{ asset('filter/js/script.js') }}"></script>
    <script src="{{ asset('filter/js/index.js') }}"></script>










    <script>


    </script>
    @if (session('success'))


        <script type="text/javascript">
            // Show User Box In Mobile Mode


            Swal.fire({
                type: 'success',

                text: '{{ session('success') }}!',
                showConfirmButton: false,
                timer: 10000

            });

        </script>
    @endif


    <script>
        $("#form-register").submit(function(e) {


            e.preventDefault();
            e.stopPropagation();
            // alert('dgdg');
            $.ajax({
                type: 'POST',
                data: $("#form-register").serialize(),
                url: 'http://esraa.azq1.com/alaa/' + $('#local').val() + '/user-register',
                success: function(data) {




                    if (data['success'] === 'success') {


                        setTimeout(function() {

                            window.location.reload();
                        }, 200);





                    }

                    if (data['success'] === 'validation') {


                        $('#error-register').empty();
                        if (data['data']['email'])
                            $('#error-register').append(`<div>${data['data']['email'][0]}</div>`);

                        if (data['data']['password'])
                            $('#error-register').append(
                            `<div>${data['data']['password'][0]}</div>`);

                        if (data['data']['gender'])
                            $('#error-register').append(`<div>${data['data']['gender'][0]}</div>`);
                        if (data['data']['phone'])
                            $('#error-register').append(`<div>${data['data']['phone'][0]}</div>`);
                        $('#error-register').show();

                    }

                }
            });
        });





        $("#form-login").submit(function(e) {


            e.preventDefault();
            e.stopPropagation();
            // alert('dgdg');
            $.ajax({
                type: 'POST',
                data: $("#form-login").serialize(),
                url: 'http://esraa.azq1.com/alaa/' + $('#local').val() + '/user-login',
                success: function(data) {



                    if (data['success'] === 'auth') {
                        $('#error').empty();
                        $('#error').append(`<div>${data['data']}</div>`);
                        $('#error').show();

                    }

                    if (data['success'] === 'success') {
                        setTimeout(function() {

                            window.location.reload();
                        }, 200);





                    }

                    if (data['success'] === 'validation') {


                        $('#error').empty();
                        $('#error').append(`<div>${data['data']['email'][0]}</div>`);

                        $('#error').append(`<div>${data['data']['password'][0]}</div>`);
                        $('#error').show();

                    }

                }
            });
        });

        /* ===============================  search popup  =============================== */

        $('.header_mobile .icon-search').on('click', function(e) {
            e.preventDefault();
            $('.search-popup').addClass('active')
        })

        $('.search-popup').on('click', function() {
            $(this).removeClass('active')
        })

        $('.aws-search-form').on('click', function(e) {
            e.stopPropagation();
        })

    </script>

    @if (session('errors'))


        {{-- <script type="text/javascript">
        Swal.fire({
            type: 'error',

            text: '{{session('errors')->first() }}',
            showConfirmButton: false,
            timer: 10000

        });









    </script> --}}
    @endif

    @yield('scripts')


</body>

</html>
