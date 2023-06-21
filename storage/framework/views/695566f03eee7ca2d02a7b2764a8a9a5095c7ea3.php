<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.colors.index'),'title'=>'الالوان']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.colors.index'),'title'=>'الالوان']
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>


    <?php $__env->startComponent('components.AddEditCard',[
'Disname'=>'الالوان',
'Disinfo'=>'تعديل بيانات لون',
'add_url'=>route('system.colors.do.update',$out->id),
'back_url'=>'system.colors.index',
'action'=>'edit',


]); ?>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php $__env->startComponent('components.colorpicker',['data'=>$out->hexa,'name'=>'hexa','text'=>'اللون']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'اللون باللغة العربية','placeholder'=>'ادخل اللون باللغة العربية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'اللون باللغة الانجليزية','placeholder'=>'ادخل اللون باللغة الانجليزية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>


    <?php echo $__env->renderComponent(); ?>




    <!-- END PAGE BASE CONTENT -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>

    <script>

        $(function () {

            $('#form').validate({

                errorElement: 'div', //default input error message container

                errorClass: 'abs_error help-block has-error',

            }).init();

        })



    </script>



<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/colors/update.blade.php ENDPATH**/ ?>