<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Abaya Square | عباية سكوير</title>
    <meta content="تطبيق عباية سكوير لبيع أحدث موديلات العبايات من خلال أمهر مصممين العبايات ومتاجرا لعبايات في المملكة العربية السعودية , عباية سكوير وجهتك الأفضل لساحة العبايات الخلي" name="descriptison">
    <meta content="تطبيق عباية سكوير لبيع أحدث موديلات العبايات من خلال أمهر مصممين العبايات ومتاجرا لعبايات في المملكة العربية السعودية , عباية سكوير وجهتك الأفضل لساحة العبايات الخلي" name="keywords">

    <!-- Favicons -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('abayasquare/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('abayasquare/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{asset('abayasquare/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('abayasquare/vendor/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('abayasquare/vendor/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('abayasquare/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('abayasquare/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('abayasquare/css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{asset('favicon/favicon-32x32.png')}}"/>
    <!-- =======================================================
    * Template Name: Appland - v2.0.0
    * Template URL: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->


    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
<!-- preload -->
<div class="se-pre-con" id="loader">
    <div data-loader="jumping"></div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top" dir="rtl">
    <div class="container d-flex" style="padding:0px 50px;">

        <nav class="nav-menu d-none d-lg-block" >
            <ul dir="rtl" style="list-style-type:arabic-indic ;direction:RTL; text-align: right">
                <li class="active"><a href="#header">الرئيسية</a></li>
                <li><a href="#features">عن  التطبيق</a></li>
                <li><a href="#gallery">صور التطبيق</a></li>
                <li><a href="#download">حمّل التطبيق</a></li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex">

    <div class="container">
        <br/>
        <div class="row">
            <div class="col-lg-4 d-lg-flex flex-lg-column pt-5 pt-lg-0 order-2 order-lg-1 mt-5" data-aos="fade-up" >
                <div class="hero-cont" style="text-align: center;height: 100%;">
                    <img src="{{asset('logos/logo_abaya.png')}}" class="img-fluid hero-logo"  alt="">
                    <div class="mt-5" >
                        <a href="{{$android}}" class="download-btn">

                            <div style="width: 20%;display: inline-block;">
                                <img src="{{asset('abayasquare/img/Google_Play.png')}}" style="width: 20px;">
                            </div>
                            <div style="width: 70%;display: inline-block;">
                                <span style="display: block;font-size: 18px; font-family: 'Tajawal', sans-serif;">Play Store</span>
                            </div>

                        </a>
                        <a href="{{$ios}}" class="download-btn">

                            <div style="width: 20%;display: inline-block;">
                                <img  src="{{asset('abayasquare/img/Apple.png')}}"style="width: 20px;">
                            </div>
                            <div style="width: 70%;display: inline-block;">
                                <span style="display: block;font-size: 18px; font-family: 'Tajawal', sans-serif;">App Store</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
                <div id="header_img" style="top: 40px;text-align: right;padding: 26px;color:#353535;">
                    <h2>
                        {!! $about_us !!}
                    </h2>
                </div>

            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= App Features Section ======= -->
    <section id="features" class="features" style="margin-top: 5%;">
        <div class="container">

            <div class="section-title">
                <h2 style="max-width:270px;margin:auto;width:fit-content;color:#9195A4;font-size: 16px;padding-bottom: 15px">
                    حول التطبيق
                </h2>
                <h2 style="margin:auto;width:fit-content;color:#24355A;padding-bottom: 15px">
                    العديد من المزايا الرائعة في تطبيق عباية
                </h2>
            </div>

            <div class="row no-gutters">
                <div class="col-xl-12 align-items-stretch order-2 order-lg-1" style="margin: auto;">
                    <div class="content d-flex flex-column">
                        <div class="row">
                            <div class="col-md-4 feature-cont" style="text-align: center;padding: 15px;height: 300px;">
                                <div style="margin:auto;margin-bottom:40px;width:100px;height:100px;padding:8%;text-align: center;border-radius: 10px;background-color: #fff;box-shadow: 0px 0px 30px rgba(169, 179, 203, 0.25);">
                                    <img src="{{asset('abayasquare/img/3.png')}}" {{asset('abayasquare/img/Google_Play.png')}} style="width:40px;">
                                </div>
                                <h4 style="padding-bottom:10px; ">العديد من طرق الدفع</h4>
                                <p style="padding:10px;font-size:14px;color: #9195A4;text-align:justify;text-align-last: center;">يمكنك كمستخدم الدفع من خلال التطبيق بكل سهولة , وكأدمن يمكنك سحب رصيدك بسهولة أيضاً</p>
                            </div>
                            <div class="col-md-4 feature-cont" style="text-align: center;padding: 15px;height: 300px;">
                                <div style="margin:auto;margin-bottom:40px;width:100px;height:100px;padding:8%;text-align: center;border-radius: 10px;background-color: #fff;box-shadow: 0px 0px 30px rgba(169, 179, 203, 0.25);">
                                    <img src="{{asset('abayasquare/img/2.png')}}"  style="width:40px;">
                                </div>
                                <h4 style="padding-bottom:10px; ">العديد من تصنيفات العبايات</h4>
                                <p style="padding:10px;font-size:14px;color: #9195A4;text-align:justify;text-align-last: center;">وجود العديد من التصنيفات الفاخرة والمميزة من العبايات العربية الخليجية. لا تترددي بطلبها
                                    الان عبر تطبيق عباية</p>
                            </div>
                            <div class="col-md-4 feature-cont" style="text-align: center;padding: 15px;height: 300px;">
                                <div style="margin:auto;margin-bottom:40px;width:100px;height:100px;padding:8%;text-align: center;border-radius: 10px;background-color: #fff;box-shadow: 0px 0px 30px rgba(169, 179, 203, 0.25);">
                                    <img src="{{asset('abayasquare/img/1.png')}}"  style="width:40px;">
                                </div>
                                <h4 style="padding-bottom:10px; ">سهولة استخدام التطبيق</h4>
                                <p style="padding:10px;font-size:14px;color: #9195A4;text-align:justify;text-align-last: center;">يمكنك طلب عبايتك الخاصة بكل سهولة مع إمكانية تخصيص المقاسات مع إمكانية التوصيل لجميع مناطق المملكة العربية السعودية</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 feature-cont" style="text-align: center;padding: 15px;height: 300px;">
                                <div style="margin:auto;margin-bottom:40px;width:100px;height:100px;padding:8%;text-align: center;border-radius: 10px;background-color: #fff;box-shadow: 0px 0px 30px rgba(169, 179, 203, 0.25);">
                                    <img src="{{asset('abayasquare/img/6.png')}}" style="width:25px;">
                                </div>
                                <h4 style="padding-bottom:10px; ">استعراض احدث المنتجات بسهولة</h4>
                                <p style="padding:10px;font-size:14px;color: #9195A4;text-align:justify;text-align-last: center;">تابع واستعرض احدث المنتجات سواء من المتاجر او المصممات الحرةً</p>
                            </div>
                            <div class="col-md-4 feature-cont" style="text-align: center;padding: 15px;height: 300px;">
                                <div style="margin:auto;margin-bottom:40px;width:100px;height:100px;padding:8%;text-align: center;border-radius: 10px;background-color: #fff;box-shadow: 0px 0px 30px rgba(169, 179, 203, 0.25);">
                                    <img src="{{asset('abayasquare/img/5.png')}}"  style="width:40px;">
                                </div>
                                <h4 style="padding-bottom:10px; ">امكانية الاشتراك كمصمة حرة</h4>
                                <p style="padding:10px;font-size:14px;color: #9195A4;text-align:justify;text-align-last: center;">تطبيق عباية يتيح لك انشاء حساب مصممة وعرض تصاميمك ومنتجاتك للبيع </p>
                            </div>
                            <div class="col-md-4 feature-cont" style="text-align: center;padding: 15px;height: 300px;">
                                <div style="margin:auto;margin-bottom:40px;width:100px;height:100px;padding:8%;text-align: center;border-radius: 10px;background-color: #fff;box-shadow: 0px 0px 30px rgba(169, 179, 203, 0.25);">
                                    <img src="{{asset('abayasquare/img/4.png')}}"  style="width:40px;">
                                </div>
                                <h4 style="padding-bottom:10px; ">إمكانية الاشتراك كمتجر</h4>
                                <p style="padding:10px;font-size:14px;color: #9195A4;text-align:justify;text-align-last: center;">يمكن الاشتراك بحساب متجر وعرض  المنتجات للبيع من خلال تطبيق عباية</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section><!-- End App Features Section -->



    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery" style="margin-top: 20px;">
        <div class="container">
            <div class="section-title">
                <h2 style="font-weight:bold;margin:auto;width:fit-content;color:#201E28;padding-bottom: 15px">
                    صور التطبيق
                </h2>
            </div>
            <div class="owl-carousel gallery-carousel" data-aos="fade-up">

                    @foreach($sliders as $slider)
                    <a href="{{$slider->image_url}}" class="venobox" data-gall="gallery-carousel"><img src="{{$slider->image_url}}" style="width:90%;" alt=""></a>
                    @endforeach

{{--                <a href="{{asset('abayasquare/img/gallery/2.png')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('abayasquare/img/gallery/2.png')}}" style="width:90%;" alt=""></a>--}}
{{--                <a href="{{asset('abayasquare/img/gallery/3.png')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('abayasquare/img/gallery/3.png')}}" style="width:90%;" alt=""></a>--}}
{{--                <a href="{{asset('abayasquare/img/gallery/4.png')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('abayasquare/img/gallery/4.png')}}" style="width:90%;" alt=""></a>--}}
{{--                <a href="{{asset('abayasquare/img/gallery/5.png')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('abayasquare/img/gallery/5.png')}}" style="width:90%;" alt=""></a>--}}
            </div>


        </div>
    </section><!-- End Gallery Section -->
    <!-- ======= Download Section ======= -->
    <section id="download" class="download" style="background-color: #F6F6F6;height:320px;">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-5 join-img-cont" style="text-align: center;padding: 25px">
                    <img src="{{asset('logos/logo_abaya.png')}}" style="width: 30%">
                </div>
                <div class="col-md-6 join-img-cont" style="text-align: center;padding: 25px">
                    <div style="margin-top: 10%;">
                        <h2 style="color:#152C3A;margin-bottom: 40px;font-weight: bold;vertical-align: middle;">حمل تطبيق عباية الآن</h2>
                        <div>
                            <a href="{{$android}}" class="download-btn">

                                <div style="width: 20%;display: inline-block;">
                                    <img src="{{asset('abayasquare/img/Google_Play.png')}}" style="width: 20px;">
                                </div>
                                <div style="width: 70%;display: inline-block;">
                                    <span style="display: block;font-size: 18px; font-family: 'Tajawal', sans-serif;">Play Store</span>
                                </div>

                            </a>
                            <a href="{{$ios}}" class="download-btn">

                                <div style="width: 20%;display: inline-block;">
                                    <img  src="{{asset('abayasquare/img/Apple.png')}}" style="width: 20px;">
                                </div>
                                <div style="width: 70%;display: inline-block;">
                                    <span style="display: block;font-size: 18px; font-family: 'Tajawal', sans-serif;">App Store</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End Download Section -->

    <section id="footer" class="" style="height:70px;color:#fff;background:#958876;">
        <div class="container py-4">
            <div class="copyright">
                جميع الحقوق محفوظة لصالح تطبيق عباية سكوير  &copy; 2021.
            </div>
        </div>
    </section><!-- End Footer -->
</main><!-- End #main -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('abayasquare/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('abayasquare/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('abayasquare/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('abayasquare/vendor/slick/slick.js')}}"></script>
<script src="{{asset('abayasquare/vendor/venobox/venobox.min.js')}}"></script>
<script src="{{asset('abayasquare/vendor/aos/aos.js')}}"></script>



<!-- Template Main JS File -->
<script src="{{asset('abayasquare/js/main.js')}}"></script>

</body>
</html>
