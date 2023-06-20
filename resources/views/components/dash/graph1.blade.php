
<div class="card card-custom {{ @$class }}">
    {{-- Body --}}
    <div class="card-body d-flex flex-column p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
            <div class="d-flex flex-column mr-2">
                <a href="#" class="text-dark-75 text-hover-{{$bg_color}} font-weight-bolder font-size-h5">{{$card_title}}</a>
                <span class="text-muted font-weight-bold mt-2">{{$card_description}}</span>
            </div>
            @if(isset($card_count))
                <span class="symbol symbol-light-{{$bg_color}} symbol-45">
                    <span class="symbol-label font-weight-bolder font-size-h6">{{$card_count}}</span>
                </span>
            @endif
        </div>
        <div id="{{$id}}" class="card-rounded-bottom" style="height: 150px"></div>
    </div>
</div>
@section('graph_js')
    @parent
    <script>
        var _initStatsWidget{{$id}} = function () {
            var element = document.getElementById("{{$id}}");

            var height = parseInt(KTUtil.css(element, 'height'));
            var color = '{{$bg_color}}';

            if (!element) {
                return;
            }

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
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
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
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                yaxis: {
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
                    }
                },
                colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
                markers: {
                    colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
                    strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        $(function (){
            _initStatsWidget{{$id}}();
        })

    </script>
@endsection
