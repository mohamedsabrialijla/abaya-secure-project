@extends('website._layout')

@section('title', 'الرئيسية')

@section('page_content')


    <header id="header">


        <img src="{{asset('website/imgs/logo_abaya.png')}}" class="header_logo" alt="">
        <div class="my-nav">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#header">الرئيسية</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#Services">ماذا نقدم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Works">فعاليات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Sponsors">داعمين</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Footer">اتصل بنا</a>
                </li>
            </ul>
        </div>

        <div class="header-wrapper" dir="rtl">
            <div class="container" dir="rtl">
                <div class="slider fade show" dir="rtl">
                    @foreach($headslider as $h)
                        <div class="headerslide" dir="rtl">
                            <img class="wow zoomIn" data-wow-duration="1s" data-wow-delay="0s" src="{{url('uploads/'.$h->image)}}" alt="">
                            <h1 class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">{{$h->name}}</h1>
                            <p class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">{{$h->description}}</p>
                            @if(\Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($h->start_date)))
                            <a class=" wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s" href="{{route('website.activity',['name'=>urlencode($h->name),'id'=>$h->id])}}">اشترك
                                بالفعالية</a>
                                @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </header>
    <section id="About">
        <div class="row">
            <div class="col-md-6">
                <h1 class=" wow fadeInUp" data-wow-duration="1s">تعرف معنا علي شركة ساري</h1>
                <div class="goldbox  wow fadeInUp" data-wow-duration="1s"></div>
                <p class="wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s">{{\App\Models\Settings::get('about_text')}}</p>
            </div>
            <div class="col-md-6">
                <div class="img wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s">
                    <img src="{{asset('website/imgs/logo_abaya.png')}}" alt="">

                </div>
            </div>
        </div>


    </section>
    <section id="Services">
        <h2 class="title wow fadeInUp" data-wow-duration="1s">ماذا نقدم في شركة ساري</h2>

        <div class="container services_container">
            <div class="row justify-content-center">

                @foreach($services as $service)
                    <div class="col-md-4 col-xs-12">
                        <div class="f-item wow zoomIn" data-wow-duration="1s" data-wow-delay=".{{$loop->iteration}}s">

                            <div class="center-image">
                                <img src="{{url('uploads/'.$service->image)}}" alt="">
                            </div>
                            <h3>{{$service->title}}</h3>
                            <p>{{mb_substr($service->details,0,60,'utf8')}}</p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>


    </section>
    <section id="Works">
        <h2 class="title wow fadeInUp" data-wow-duration="1s">شاهد اعمالنا</h2>

        <div class="work_grid">
            @foreach($works as $work)
                <div class="grid {{$loop->iteration == 1?'big6':($loop->iteration == 7?'small6':'small3')}} wow zoomIn" data-wow-duration="1s" data-wow-delay=".{{$loop->iteration}}s">
                    <img src="{{url('uploads/'.$work->image)}}" alt="">
                    <table class="over">
                        <tr>
                            <td><a href="{{route('website.activity',['name'=>urlencode($work->name),'id'=>$work->id])}}" target="_blank">{{$work->description}}</a></td>
                        </tr>
                    </table>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>

    </section>
    <section id="RegWork">
        <h2 class="title wow fadeInUp" data-wow-duration="1s">فعاليات يمكنك المشاركة بها</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="row justify-content-center">

                @if(isset($newActivities) && count($newActivities) > 0)
                @foreach($newActivities as $a)
                    <div class="col-md-6 margin-top-50">
                        <div class="activityblock  wow fadeInUp" data-wow-duration="1s" data-wow-delay=".{{$loop->iteration}}s">
                            <img src="{{url('uploads/'.$a->image)}}" alt="">
                            <h3>{{$a->name}}</h3>
                            <p><span>العنوان : </span><span>{{mb_substr($a->address,0,30,'utf8')}} {{mb_substr($a->address,0,30,'utf8')!=mb_substr($a->address,0,31,'utf8')?'...':''}}</span></p>
                            <p><span>المدة : </span><span>{{$a->days_text}}</span></p>
                            <a href="{{route('website.activity',['name'=>urlencode($a->name),'id'=>$a->id])}}">عرض التفاصيل</a>
                        </div>
                    </div>



                @endforeach
                    @else
                    <h1 style="text-align: center;color: #BC9A48;">لا يوجد فعاليات حاليا</h1>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="calender wow fadeInUp" data-wow-duration="1s">
                    <h3>{{\Carbon\Carbon::now()->monthName}} {{\Carbon\Carbon::now()->year}}</h3>
                    @foreach($dates as $day=>$is)
                        <div class="calender_item {{$is?'used':'free'}}">{{$day}}</div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </section>
    <section id="Sponsors">
        <h2 class="title wow fadeInUp" data-wow-duration="1s">الداعمين والرعاه</h2>
        <div class="partnersSlider  margin-top-50" dir="rtl">
            <div class="slider responsive" dir="rtl">
                @foreach($sponsors as $sponsor)
                <div class="sponsor_slider_item wow zoomIn" data-wow-duration="1s" data-wow-delay=".{{$loop->iteration}}s">
                    <a href="{{$sponsor->url}}">
                        <img src="{{url('uploads/'.$sponsor->image)}}" alt="">
                    </a>

                </div>
                @endforeach

            </div>

        </div>


    </section>

@endsection

@section('custom_scripts')
    <script>
        $(function () {
            $('.fade').slick({
                dots: false,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                rtl: true
            });

            $('.responsive').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 5,
                centerMode: true,
                rtl: true,
                arrows:false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        })
    </script>
@endsection
