<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
    <style>

        .apexcharts-tooltip.apexcharts-theme-light {
            right: auto !important;
        }

        .apexcharts-tooltip.apexcharts-theme-dark {

            right: auto !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>

    

    <div class="row justify-content-center">


        <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $__env->startComponent('components.dash.card',[
                'url'=>$c['url'],
                'icon'=>'fa fa-list',
                'name'=>$c['text'],
                'count'=>$c['count'].$c['count_text'],
                 'col'=>3
            ]); ?>
            <?php echo $__env->renderComponent(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo $__env->make('components.dash.PieChart',
              [
              'class' =>'card-stretch  gutter-b',
              'card_title'=>'تقسيم الطلبات',
              "card_description"=>'تقسيم الطلبات حسب الحالة',
              'bg_color'=>'success',
              'id'=>'G5',
              "values"=>$order_case_statistics->pluck('count'),
              "labels"=>$order_case_statistics->pluck('name_ar'),
              "colors"=>$order_case_statistics->pluck('hex_color'),
               ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        

       

     

            


                
             

                




                            






                            
                       






        </div>

        
        
        

        
        
        

        
        
        

        
        
        

        
        
        
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('js/pages/widgets.js')); ?>" type="text/javascript"></script>
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
                    url: '<?php echo e(URL::to('/admin/system/admins/update-fcm-token')); ?>',
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/system_admin/dashboard.blade.php ENDPATH**/ ?>