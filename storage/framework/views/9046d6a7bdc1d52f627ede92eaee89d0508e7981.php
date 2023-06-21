<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories.index'),'title'=>'التصنيفات']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories.index'),'title'=>'التصنيفات']
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
'Disname'=>'التصنيفات',
'Disinfo'=>'اضافة تصنيف جديد',
'add_url'=>route('system.categories.do.create'),
'back_url'=>'system.categories.index',
'action'=>'add',


]); ?>
        <div class="row justify-content-center">

            <div class="col-md-3">
                <?php $__env->startComponent('components.upload_image',['name'=>'image','text'=>'صورة التصنيف','hint'=>'60 * 60 بيكسل']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['name'=>'name_ar','text'=>'اسم التصنيف بالعربية','placeholder'=>'ادخل اسم التصنيف بالعربية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['name'=>'name_en','text'=>'اسم التصنيف بالانجليزية','placeholder'=>'ادخل اسم التصنيف بالانجليزية','icon'=>'fa-user-alt']); ?>
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






<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/system_admin/categories/create.blade.php ENDPATH**/ ?>