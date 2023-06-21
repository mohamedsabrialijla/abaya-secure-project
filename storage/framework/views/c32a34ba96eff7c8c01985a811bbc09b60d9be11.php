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
<?php $__env->startSection('page_content'); ?>


    <?php $__env->startComponent('components.AddEditCard',[
'Disname'=>'الادارة',
'Disinfo'=>'تعديل بياناتي',
'add_url'=>route('system.admin.do.profile',$out->id),
'back_url'=>'system.admin.index',
'action'=>'edit',


]); ?>

        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input',['name'=>'name','data'=>$out->name,'text'=>'الاسم','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>


                    </div>
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input',['name'=>'username','data'=>$out->email,'text'=>'اسم المستخدم','placeholder'=>'ادخل اسم المستخدم','icon'=>'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>

                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">

                        <?php $__env->startComponent('components.input',['name'=>'mobile','data'=>$out->mobile,'text'=>'رقم الجوال','placeholder'=>'ادخل رقم الجوال','icon'=>'fa-phone']); ?>
                        <?php echo $__env->renderComponent(); ?>

                    </div>

                    <div class="w-100"></div>
                </div>

            </div>
            <div class="col-md-2">
                <?php $__env->startComponent('components.upload_image',['name'=>'image','data'=>$out->avatar,'text'=>'صورة الحساب','hint'=>'100 * 100 بيكسل']); ?>
                <?php echo $__env->renderComponent(); ?>
                    <div class="col">
                        <a href="<?php echo e(route('system.admin.profile.password')); ?>" style="margin: 25px auto;"
                           class="<?php echo e(config('layout.classes.edit')); ?> btn-block" data-aaa="tooltip" title="تغيير كلمة المرور">
                            <i class="fa fa-lock"></i> تغيير كلمة المرور </a>
                    </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/admins/profile.blade.php ENDPATH**/ ?>