<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>

    <?php $__env->startComponent('components.AddEditCard',[
'Disname'=>'الادارة',
'Disinfo'=>'اضافة مدير جديد',
'add_url'=>route('system.admin.do.create'),
'back_url'=>'system.admin.index',
'action'=>'add',


]); ?>

            <div class="row justify-content-center align-items-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <?php $__env->startComponent('components.input',['name'=>'name','text'=>'الاسم','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt']); ?>
                            <?php echo $__env->renderComponent(); ?>


                        </div>
                        <div class="col-md-6">
                            <?php $__env->startComponent('components.input',['name'=>'username','text'=>'اسم المستخدم','placeholder'=>'ادخل اسم المستخدم','icon'=>'fa-user-alt']); ?>
                            <?php echo $__env->renderComponent(); ?>

                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">

                            <?php $__env->startComponent('components.input',['name'=>'mobile','text'=>'رقم الجوال','placeholder'=>'ادخل رقم الجوال','icon'=>'fa-phone']); ?>
                            <?php echo $__env->renderComponent(); ?>

                        </div>
                        <div class="col">

                            <?php $__env->startComponent('components.input',['name'=>'password','type'=>'password','text'=>'كلمة المرور','placeholder'=>'ادخل كلمة المرور','icon'=>'fa-lock']); ?>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <div class="w-100"></div>

                        <div class="col-md-6">

                            <?php $__env->startComponent('components.select',['name'=>'roles','text'=>'الصلاحية','placeholder'=>'اختر الصلاحية','icon'=>'fa-cog','select'=>$roles]); ?>
                            <?php echo $__env->renderComponent(); ?>

                        </div>
                        <div class="w-100"></div>
                    </div>

                </div>
                <div class="col-md-2">
                    <?php $__env->startComponent('components.upload_image',['name'=>'image','text'=>'صورة الحساب','hint'=>'100 * 100 بيكسل']); ?>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div class="clearfix"></div>
            </div>




    <?php echo $__env->renderComponent(); ?>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function () {
            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price: {
                        required: true,
                        number: true
                    }
                }

            }).init();


        })

    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/admins/create.blade.php ENDPATH**/ ?>