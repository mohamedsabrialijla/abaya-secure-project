@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ]"/>
@endsection
@section('head')
    <style>

        .apexcharts-tooltip.apexcharts-theme-light {
            right: auto !important;
        }

        .apexcharts-tooltip.apexcharts-theme-dark {

            right: auto !important;
        }
    </style>
@endsection
@section('page_content')

    {{-- Dashboard 1 --}}

    <div class="row justify-content-center">


        @foreach($counts as $c)

            @component('components.dash.card',[
                'url'=>$c['url'],
                'icon'=>'fa fa-list',
                'name'=>$c['text'],
                'count'=>$c['count'].$c['count_text'],
                 'col'=>3
            ])
            @endcomponent

        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('components.dash.PieChart',
              [
              'class' =>'card-stretch  gutter-b',
              'card_title'=>'تقسيم الطلبات',
              "card_description"=>'تقسيم الطلبات حسب الحالة',
              'bg_color'=>'success',
              'id'=>'G5',
              "values"=>$order_case_statistics->pluck('count'),
              "labels"=>$order_case_statistics->pluck('name_ar'),
              "colors"=>$order_case_statistics->pluck('hex_color'),
               ])
        </div>

        {{--        <div class="col-lg-6 col-xxl-4">
            @include('components.dash.graphWithActions',
                [
                'class' => 'card-stretch gutter-b',
                'card_title'=>'المنتجات حسب التصنيف',
                'id'=>'G2',
                'bg_color'=>'#D13647',
                'name'=>'عدد الاعلانات',
                "values"=>[5,6,7,2],
                "axis"=>['يناير','فبراير','مارس','ابريل'],
                "formatter"=>'منتج ',
                "actions"=>[
                        [
                            'icon'=>'media/svg/icons/Code/Git4.svg',
                            'url'=>route('system.categories.index'),
                            'name'=>'عرض التصنيفات',
                            'color'=>'warning'
                        ],
                        [
                            'icon'=>'media/svg/icons/Home/Book-open.svg',
                            'url'=>route('system.products.index'),
                            'name'=>'عرض المنتجات',
                            'color'=>'success'
                        ],
                        [
                            'icon'=>'fa fa-plus',
                            'url'=>route('system.categories.create'),
                            'name'=>'اضافة تصنيف',
                            'color'=>'info'
                        ],
    ]
                ])
        </div>--}}

       {{-- <div class="col-lg-6 col-xxl-4">
            @include('components.dash.graph1',
                [
                'class' => 'card-stretch card-stretch-half gutter-b',
                'card_title'=>'تقسيم الطلبات',
                "card_description"=>'تقسيم الطلبات حسب الشهر',
                "card_count"=>50,
                'id'=>'G1',
                'bg_color'=>'success',
                'name'=>'عدد الطلبات',
                "values"=>[5,6,7,2],
                "axis"=>['يناير','فبراير','مارس','ابريل'],
                "formatter"=>'طلب '
                ])
            @include('components.dash.PieChart',
                [
                'class' =>'card-stretch card-stretch-half gutter-b',
                'id'=>'G5',
                "values"=>[5,6,7,2],
                "labels"=>['يناير','فبراير','مارس','ابريل'],
                "colors"=>['#6993FF','#1BC5BD','#8950FC','#FFA800']
                ])
        </div>--}}

     {{--  <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1"> --}}

            {{-- List Widget 1 --}}

{{--            <div class="card card-custom card-stretch gutter-b">--}}
                {{-- Header --}}
             {{--   <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">احدث الاعلانات</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">احدث 6 اعلانات</span>
                    </h3>
                </div>--}}

                {{-- Body --}}
{{--                <div class="card-body pt-8">--}}

{{--                    @foreach($newOrders as $p)--}}
{{--                        <div class="d-flex align-items-center mb-10">--}}
                            {{-- Symbol --}}
{{--                            <div class="symbol symbol-40 symbol-light-danger mr-5">--}}
{{--                        <span class="symbol-label">--}}
{{--                            <img src="{{$p->customer->image_url}}" class="img-fluid" alt="">--}}
{{--                        </span>--}}
{{--                            </div>--}}

                            {{-- Text --}}
                       {{--     <div class="d-flex flex-column font-weight-bold">
                                <a href="{{route('system.orders.details',$p->id)}}"
                                   class="text-dark text-hover-primary mb-1 font-size-lg">{{$p->name}}</a>
                                <span class="text-muted">{{$p->customer->name}}</span>
                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}


        </div>

        {{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">--}}
        {{--            @include('widgets._widget-5', ['class' => 'card-stretch gutter-b'])--}}
        {{--        </div>--}}

        {{--        <div class="col-xxl-8 order-2 order-xxl-1">--}}
        {{--            @include('widgets._widget-6', ['class' => 'card-stretch gutter-b'])--}}
        {{--        </div>--}}

        {{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
        {{--            @include('widgets._widget-7', ['class' => 'card-stretch gutter-b'])--}}
        {{--        </div>--}}

        {{--        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
        {{--            @include('widgets._widget-8', ['class' => 'card-stretch gutter-b'])--}}
        {{--        </div>--}}

        {{--        <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">--}}
        {{--            @include('widgets._widget-9', ['class' => 'card-stretch gutter-b'])--}}
        {{--        </div>--}}
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')

    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
<script>


        messaging.requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ URL::to('/admin/system/admins/update-fcm-token') }}',
                    type: 'POST',
                    data: {
                        fcm_token: token,

                    },
                    dataType: 'JSON',
                    success: function (response) {
                        // console.log(response)
                    },
                    error: function (err) {
                        console.log(" Can't do because: " + err);
                    },
                });
            })
            .catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });




    </script>
@endsection
