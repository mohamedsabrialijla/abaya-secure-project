<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.settings.getPolicy'),'title'=>'سياسة الخصوصية']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.settings.getPolicy'),'title'=>'سياسة الخصوصية']
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
'Disname'=>'سياسة الخصوصية',
'Disinfo'=>'تعديل بيانات سياسة الخصوصية',
'add_url'=>route('system.settings.postPolicy'),
'back_url'=>'system_admin.dashboard',
'action'=>'edit',


]); ?>

        <div class="row">
            <div class="col-md-12">

                <?php $__env->startComponent('components.area_editor',['data'=>HELPER::set_if($page['privacy_and_policy_ar']),'name'=>'privacy_and_policy_ar','text'=>'التفاصيل باللغة العربية ']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="col-md-12">

                <?php $__env->startComponent('components.area_editor',['data'=>HELPER::set_if($page['privacy_and_policy_en']),'name'=>'privacy_and_policy_en','text'=>'التفاصيل باللغة الإنجليزية']); ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/privacy_and_policy/page.blade.php ENDPATH**/ ?>