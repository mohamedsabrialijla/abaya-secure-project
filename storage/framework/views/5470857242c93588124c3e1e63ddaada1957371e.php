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
'Disinfo'=>'تعديل كلمة المرور',
'add_url'=>route('system.admin.do.password',$out->id),
'back_url'=>'system.admin.index',
'action'=>'edit',


]); ?>

        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input',['name'=>'password','text'=>'كلمة المرور الجديدة','placeholder'=>'كلمة المرور الجديدة','icon'=>'fa-lock']); ?>
                        <?php echo $__env->renderComponent(); ?>


                    </div>
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input',['name'=>'password_confirmation','text'=>'تأكيد كلمة المرور الجديدة','placeholder'=>'تأكيد كلمة المرور الجديدة','icon'=>'fa-lock']); ?>
                        <?php echo $__env->renderComponent(); ?>

                    </div>


                    <div class="w-100"></div>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>




    <?php echo $__env->renderComponent(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/admins/password.blade.php ENDPATH**/ ?>