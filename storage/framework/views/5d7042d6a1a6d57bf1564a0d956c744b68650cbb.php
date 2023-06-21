<?php $__env->startSection('page_content'); ?>


    <?php $__env->startComponent('components.AddEditCard',[
'Disname'=>'عن التطبيق',
'Disinfo'=>'تعديل بيانات عن التطبيق',
'add_url'=>route('system.settings.postAbout'),
'back_url'=>'system_admin.dashboard',
'action'=>'edit',


]); ?>

        <div class="row">
            <div class="col-md-12">

                <?php $__env->startComponent('components.area_editor',['data'=>HELPER::set_if($page['about_us_ar']),'name'=>'about_us_ar','text'=>'التفاصيل باللغة العربية ']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="col-md-12">

                <?php $__env->startComponent('components.area_editor',['data'=>HELPER::set_if($page['about_us_en']),'name'=>'about_us_en','text'=>'التفاصيل باللغة الإنجليزية ']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>

        </div>
    <?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('custom_scripts'); ?>

    <script>
        $(document).ready(function () {
            var form3 = $('#form');
            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error'
            }).init();


        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/about_us/page.blade.php ENDPATH**/ ?>