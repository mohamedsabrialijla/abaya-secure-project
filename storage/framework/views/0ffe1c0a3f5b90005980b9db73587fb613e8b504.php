<div class="card card-custom  <?php echo e(@$class); ?>">
    <div class="card-body">
        <!--begin::Chart-->
        <div id="<?php echo e($id); ?>" class="d-flex justify-content-center"></div>
        <!--end::Chart-->
    </div>
</div>
<?php $__env->startSection('graph_js'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('graph_js'); ?>
    <script>
        var _initStatsWidget<?php echo e($id); ?> = function () {
            const apexChart = "#<?php echo e($id); ?>";
            var options = {
                series: <?php echo json_encode($values); ?>,
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: <?php echo json_encode($labels); ?>,
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
                colors: <?php echo json_encode($colors); ?>,
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }


        $(function (){
            _initStatsWidget<?php echo e($id); ?>();
        })

    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/dash/PieChart.blade.php ENDPATH**/ ?>