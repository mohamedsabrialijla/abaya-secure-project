<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sary | @yield('title')  </title>
    <base href="{{route('website.home')}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="{{asset('website/css/animate.css')}}" rel="stylesheet">


    <!-- preload -->
    <link href="{{asset('website/css/loaders.css')}}" rel="stylesheet">
    <!-- style -->
    <link href="{{asset('website/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/owl.theme.default.css')}}" rel="stylesheet">
    <link href="{{asset('website/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('website/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/responsive.css')}}" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/png" href="{{asset('website/imgs/logo_abaya.png')}}"/>


</head>
<body>
<!-- preload -->
<div class="se-pre-con" id="loader">
    <div data-loader="jumping"></div>
</div>


@yield('page_content')

<footer id="Footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{asset('website/imgs/logowithtext.png')}}" class=" wow fadeInUp" data-wow-duration="1s" alt="">
                <h5 class="title4  wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".2s">للتواصل معنا</h5>
                <form action="{{route('website.do.contact')}}" class="footer_form" method="post">
                    @csrf
                    <input type="text" name="email" class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s" placeholder="البريد الالكتروني">
                    @show_error('email')
                    <textarea name="details" id="details" class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s" cols="30" rows="4"placeholder="نص الرسالة"></textarea>
                    @show_error('details')
                    <button type="submit" class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">ارسال</button>
                </form>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <h4 class=" wow fadeInUp" data-wow-duration="1s">للتواصل المباشر</h4>
                <div class="goldbox  wow fadeInUp" data-wow-duration="1s"  data-wow-delay=".2s"></div>
                <ul>
                    <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s"><span>رقم الهاتف       : </span><span>{{str_replace_first('05','9665',\App\Models\Settings::get('mobile'))}}</span></li>
                    <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><span>رقم الفاكس       : </span><span>{{str_replace_first('05','9665',\App\Models\Settings::get('fax'))}}</span></li>
                    <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s"><span>البريد الإلكتروني : </span><span>{{\App\Models\Settings::get('email')}}</span></li>
                </ul>
                <ul class=" margin-top-50">
                    <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s"><span>العنوان          : </span><span>{{\App\Models\Settings::get('address')}}</span></li>

                </ul>
            </div>




        </div>

    </div>
    <div class="footerfooter">
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">جميع الحقوق محفظة © شركة ساري 2019</p>

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="row justify-content-center">
                    <ul class="sm">
                        <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
                            <a href="{{\App\Models\Settings::get('facebook')}}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
                            <a  href="{{\App\Models\Settings::get('twitter')}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".9s">
                            <a  href="{{\App\Models\Settings::get('linkedin')}}" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <a href="{{\App\Models\Settings::get('pinterest')}}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        </div>
    </div>
</footer>


<?php $MESSDELAY = 2500; ?>
@include('flash::message')

<!-- scripts -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('website/js/popper.min.js')}}"></script>

<script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js"
        integrity="sha384-54+cucJ4QbVb99v8dcttx/0JRx4FHMmhOWi4W+xrXpKcsKQodCBwAvu3xxkZAwsH"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('website/js/WOW.min.js')}}"></script>
<script src="{{asset('website/slick/slick.js')}}"></script>
<script src="{{asset('admin/sweetalert2.js')}}" type="text/javascript"></script>

<script src="{{asset('website/js/scripts.js')}}"></script>
<script src="{{asset('admin/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/jquery-validation/js/localization/messages_ar.min.js')}}" type="text/javascript"></script>
<script>
    wow = new WOW(
        {
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: false,       // default
            live: true        // default
        }
    );
    wow.init();
</script>
@yield("custom_scripts")
</body>
</html>
