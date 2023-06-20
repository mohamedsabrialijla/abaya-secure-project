@extends('web.master')
@section('css')

@endsection
@section('title')
@lang('site.about_us')
@endsection

@section('content')
<!--======================== Start breadcrumb =============================-->
<div class="breadcrumb pt-10 pb-10">
    <div class="container">
        <div class="product-navigation">
            <ul class="breadcrumb breadcrumb-lg m-0">
                <li><a href="demo1.html"><i class="fal fa-home"></i></a></li>
                <li>@lang('site.about_us')</li>
            </ul>
        </div>
    </div>
</div>
<!--======================== End breadcrumb =============================-->

<!--======================== Start Page Header =============================-->
<section class="page_header" style="background-image: url({{ asset('assets/img/contact-us.jpg') }});">
    <div class="container content h-100">
        <h4 class="page_name m-0 gsap-reveal-hero">@lang('site.about_us')</h4>
    </div>
</section>
<!--======================== End Page Header =============================-->


<!--======================= Start about section 2 ==========================-->
<section class="about_section_2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="welcome-image-box gsap-reveal-hero">
                    <div class="thm-shape" style="background-image: url({{ asset('assets/img/thm-shape-1.png') }});"></div>
                    <div class="inner ">
                        <img alt="Awesome Image" class="lazyload" data-src="{{ asset('assets/img/about.jpg') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 custom-padding gsap-reveal mt-md-30">
                <div class="sec-title">
                    <h2>دار ازياء سعودية</h2>
                    <div class="text">كل الملذات هي مرحب بها الألم الذي يتم تجنبه بسبب واجب التزامات العمل الذي سيحدث في كثير من الأحيان أن الملذات يجب نبذها من المضايقات المقبولة.</div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-30">
                        <div class="text-block flex-h">
                            <span class="icon"><i class="fal fa-gem"></i></span>
                            <div class="textin">
                                <h5>الجودة هي شعارنا</h5>
                                <h4>التركيز على ما نفعله بشكل أفضل</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-30">
                        <div class="text-block flex-h">
                            <span class="icon"><i class="fal fa-gem"></i></span>
                            <div class="textin">
                                <h5>ثقة عملائنا</h5>
                                <h4>التركيز على ما نفعله بشكل أفضل</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-30">
                        <div class="text-block flex-h">
                            <span class="icon"><i class="fal fa-gem"></i></span>
                            <div class="textin">
                                <h5>الجودة هي شعارنا</h5>
                                <h4>التركيز على ما نفعله بشكل أفضل</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-30">
                        <div class="text-block flex-h">
                            <span class="icon"><i class="fal fa-gem"></i></span>
                            <div class="textin">
                                <h5>ثقة عملائنا</h5>
                                <h4>التركيز على ما نفعله بشكل أفضل</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-30">
                        <div class="text-block flex-h">
                            <span class="icon"><i class="fal fa-gem"></i></span>
                            <div class="textin">
                                <h5>ثقة عملائنا</h5>
                                <h4>التركيز على ما نفعله بشكل أفضل</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-30">
                        <div class="text-block flex-h">
                            <span class="icon"><i class="fal fa-gem"></i></span>
                            <div class="textin">
                                <h5>ثقة عملائنا</h5>
                                <h4>التركيز على ما نفعله بشكل أفضل</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--======================= End about section 2 ==========================-->

<!--======================= Start features ==========================-->
<section class="features_section">
    <div class="container">
        <div class="main_heading text-center mb-40 wow fadeInUp">
            <h2>ما يمزنا</h2>
            <p>خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً</p>
        </div>
        <div class="wrapper-box wow fadeInUp">
            <div class="outer-box">
                <div class="row m-0">
                    <div class="col-lg-4 col-md-6 whay-choose-block">
                        <div class="inner-box">
                            <div class="icon">
                                <span>
                                    <img src="{{ asset('assets/img/icons/spaceship.png') }}" alt="" width="45">
                                </span>
                            </div>
                            <h4>رد سريع</h4>
                            <div class="text">سوف تحدث الأعمال بشكل متكرر يجب أن تقبل كل الملذات.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 whay-choose-block">
                        <div class="inner-box">
                            <div class="icon">
                                <span>
                                    <img src="{{ asset('assets/img/icons/target.png') }}" alt="" width="45">
                                </span>
                            </div>
                            <h4>فريق الخبرة</h4>
                            <div class="text">تشرح الحسابات الكاملة للنظام في التعاليم العظيمة.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 whay-choose-block">
                        <div class="inner-box">
                            <div class="icon">
                                <span>
                                    <img src="{{ asset('assets/img/icons/credit-card.png') }}" alt="" width="45">
                                </span>
                            </div>
                            <h4>سداد سهل</h4>
                            <div class="text">لنأخذ مثالا تافها ، أي منا يتخذه يوما ما مجهودا.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 whay-choose-block">
                        <div class="inner-box">
                            <div class="icon">
                                <span>
                                    <img src="{{ asset('assets/img/icons/lightbulb.png') }}" alt="" width="45">
                                </span>
                            </div>
                            <h4>نصائح مخصصة</h4>
                            <div class="text">تشرح الحسابات الكاملة للنظام في التعاليم العظيمة.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 whay-choose-block">
                        <div class="inner-box">
                            <div class="icon">
                                <span>
                                    <img src="{{ asset('assets/img/icons/badge.png') }}" alt="" width="45">
                                </span>
                            </div>
                            <h4>جودة الخدمة</h4>
                            <div class="text">لنأخذ مثالا تافها ، أي منا يتخذه يوما ما مجهودا.</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 whay-choose-block">
                        <div class="inner-box">
                            <div class="icon">
                                <span>
                                    <img src="{{ asset('assets/img/icons/agreement.png') }}" alt="" width="45">
                                </span>
                            </div>
                            <h4>24/7 دعم</h4>
                            <div class="text">سوف تحدث الأعمال بشكل متكرر يجب أن تقبل كل الملذات.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--======================= End features ==========================-->

<!--======================= Start funfact section ==========================-->

<section class="funfacts_section">
    <div class="container">
        <!-- Fact Counter -->
        <div class="fact-counter-two p-relative">
            <div class="row">
                <!--Column-->
                <div class="column counter-column col-lg-4">
                    <div class="inner">
                        <div class="icon-box">
                            <div class="icon"><img src="{{ asset('assets/img/icons/trophy.png') }}" alt="" width="60"></div>
                        </div>
                        <div class="content">
                            <div class="counter-title">منتجاتنا</div>
                            <div class="count-outer count-box counted">
                                <span class="count-text odometer" data-odometer-final="1200"></span>

                            </div>
                            <div class="text">منتجات مميزة</div>
                        </div>
                    </div>
                </div>
                <!--Column-->
                <!--Column-->
                <div class="column counter-column col-lg-4">
                    <div class="inner">
                        <div class="icon-box">
                            <div class="icon"><img src="{{ asset('assets/img/icons/employee.png') }}" alt="" width="60"></div>
                        </div>
                        <div class="content">
                            <div class="counter-title">فريقنا</div>
                            <div class="count-outer count-box counted">
                                <span class="count-text odometer" data-odometer-final="138"></span>
                            </div>
                            <div class="text">فريق عمل ذو خبرة</div>
                        </div>
                    </div>
                </div>
                <!--Column-->
                <!--Column-->
                <div class="column counter-column col-lg-4">
                    <div class="inner">
                        <div class="icon-box">
                            <div class="icon"><img src="{{ asset('assets/img/icons/meeting.png') }}" alt="" width="60"></div>
                        </div>
                        <div class="content">
                            <div class="counter-title">عملاء سعداء</div>
                            <div class="count-outer count-box counted">
                                <span class="count-text odometer" data-odometer-final="99"></span><span>%</span>
                            </div>
                            <div class="text">رضا العملاء</div>
                        </div>
                    </div>
                </div>
                <!--Column-->

            </div>
        </div>
    </div>
</section>

<!--======================= End funfact section ==========================-->

<!--======================= Start testimonials section ==========================-->
<section class="testimonials_section">
    <div class="container">
        <div class="main_heading text-center mb-40 wow fadeInUp">
            <h2>أراء عملائنا</h2>
            <p>خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً</p>
        </div>
        <div class="owl-carousel owl-theme wow fadeInUp">
            <div class="item_carousel_p">
                <div class="inner-box">
                    <div class="quote"><img src="{{ asset('assets/img/icons/double-quotes.png') }}" width="35" alt=""></div>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star style-two"></i>
                        <i class="fas fa-star style-two"></i>
                    </div>
                    <div class="text">خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً</div>
                    <div class="author-box">
                        <div class="image">
                            <img width="70" height="70" alt="" data-src="{{ asset('assets/img/person.jpg') }}" class="lazyload">
                        </div>
                        <div class="author-title">محمد اسماعيل</div>
                        <div class="designation">مدير مبيعات</div>
                    </div>
                </div>
            </div>
            <div class="item_carousel_p">
                <div class="inner-box">
                    <div class="quote"><img src="{{ asset('assets/img/icons/double-quotes.png') }}" width="35" alt=""></div>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star style-two"></i>
                        <i class="fas fa-star style-two"></i>
                    </div>
                    <div class="text">خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً</div>
                    <div class="author-box">
                        <div class="image">
                            <img width="70" height="70" alt="" data-src="{{ asset('assets/img/person.jpg') }}" class="lazyload">
                        </div>
                        <div class="author-title">محمد اسماعيل</div>
                        <div class="designation">مدير مبيعات</div>
                    </div>
                </div>
            </div>
            <div class="item_carousel_p">
                <div class="inner-box">
                    <div class="quote"><img src="{{ asset('assets/img/icons/double-quotes.png') }}" width="35" alt=""></div>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star style-two"></i>
                        <i class="fas fa-star style-two"></i>
                    </div>
                    <div class="text">خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً</div>
                    <div class="author-box">
                        <div class="image">
                            <img width="70" height="70" alt="" data-src="{{ asset('assets/img/person.jpg') }}" class="lazyload">
                        </div>
                        <div class="author-title">محمد اسماعيل</div>
                        <div class="designation">مدير مبيعات</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--======================= End testimonials section ==========================-->

@endsection

@section('js')

@endsection
