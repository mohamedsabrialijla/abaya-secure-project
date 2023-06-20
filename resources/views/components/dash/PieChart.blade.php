<div class="card card-custom  {{ @$class }}">
    <div class="card-body">
        <!--begin::Chart-->
        <div id="{{$id}}" class="d-flex justify-content-center"></div>
        <!--end::Chart-->
    </div>
</div>
@section('graph_js')
    @parent
    <script>
        var _initStatsWidget{{$id}} = function () {
            const apexChart = "#{{$id}}";
            var options = {
                series: {!! json_encode($values) !!},
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: {!! json_encode($labels) !!},
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                colors: {!! json_encode($colors) !!},
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }


        $(function (){
            _initStatsWidget{{$id}}();
        })

    </script>
@endsection
