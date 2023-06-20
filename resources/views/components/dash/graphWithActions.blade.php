{{-- Mixed Widget 1 --}}

<div class="card card-custom bg-gray-100 {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 bg-danger py-5">
        <h3 class="card-title font-weight-bolder text-white">{{$card_title}}</h3>
    </div>
    {{-- Body --}}
    <div class="card-body p-0 position-relative overflow-hidden">
        {{-- Chart --}}
        <div id="{{$id}}" class="card-rounded-bottom bg-danger" style="height: 200px"></div>

        {{-- Stats --}}
        <div class="card-spacer mt-n25">
            {{-- Row --}}
            <div class="row m-0">
                @foreach($actions as $action)
                    <div class="col bg-light-{{$action['color']}} px-6 py-8 rounded-xl mr-7 mb-7">
                        @if(\App\Classes\Theme\Metronic::isSVG($action['icon']))
                        {{ Metronic::getSVG("media/svg/icons/Media/Equalizer.svg", "svg-icon-3x svg-icon-".$action['color']." d-block my-2") }}
                        @else
                            <i class="{{$action['icon']}} fa-3x text-{{$action['color']}} d-block my-2"></i>
                        @endif

                        <a href="{{$action['url']}}" class="text-{{$action['color']}} font-weight-bold font-size-h6">
                            {{$action['name']}}
                        </a>
                    </div>
                    @if($loop->index %2 == 1)
                        <div class="w-100"></div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
</div>
@section('graph_js')
    @parent
    <script>
        var _initMixedWidget{{$id}} = function () {
            var element = document.getElementById("{{$id}}");
            var height = parseInt(KTUtil.css(element, 'height'));

            if (!element) {
                return;
            }

            var strokeColor = '{!! isset($bg_color)?$bg_color:'#D13647' !!}';

            var options = {
                series: [{
                    name: '{{$name}}',
                    data: {!! json_encode($values) !!}
                }],
                chart: {
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        top: 5,
                        left: 0,
                        blur: 3,
                        color: strokeColor,
                        opacity: 0.5
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 0
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [strokeColor]
                },
                xaxis: {
                    categories: {!! json_encode($axis) !!},
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: KTApp.getSettings()['colors']['gray']['gray-300'],
                            width: 1,
                            dashArray: 3
                        }
                    }
                },
                yaxis: {
                    max:function(max) { return max+1 },


                    labels: {
                        show: false,
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    y: {
                        formatter: function (val) {
                            return  val + " {{$formatter}}"
                        }
                    },
                    marker: {
                        show: false
                    }
                },
                colors: ['transparent'],
                markers: {
                    colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                    strokeColor: [strokeColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }


        $(function (){
            _initMixedWidget{{$id}}();
        })

    </script>
@endsection
