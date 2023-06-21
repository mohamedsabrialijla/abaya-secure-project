<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'المصممون'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'المصممون'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_content'); ?>

    <?php $__env->startComponent('components.AddEditCard', [
        'Disname' => 'المصممون',
        'Disinfo' => 'اضافة مصمم جديد',
        'add_url' => route('system.stores.do.create'),
        'back_url' => 'system.stores.index',
        'action' => 'add',
        ]); ?>
        <div class="row">
            <div class="col-10">
                <div class="row">

                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input', ['name' => 'name_ar', 'text' => 'الاسم باللغة العربية', 'placeholder' =>
                            'ادخل الاسم باللغة العربية', 'icon' => 'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input', ['name' => 'name_en', 'text' => 'الاسم باللغة الانجليزية', 'placeholder'
                            => 'ادخل الاسم باللغة الانجليزية', 'icon' => 'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="w-100"></div>

                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input', ['name' => 'mobile', 'text' => 'الجوال', 'placeholder' => 'ادخل رقم
                            الجوال', 'not_req' => true, 'class' => 'isNumber']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="col-md-6">
                        <?php $__env->startComponent('components.input', ['name' => 'commission','type' =>'number', 'text' => 'نسبة عمولة البرناج', 'placeholder' => '%', 'icon' => 'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="w-100"></div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <?php $__env->startComponent('components.input', ['name' => 'whatsapp', 'text' => 'واتس آب', 'not_req' => true, 'hint' =>
                            '555-555-566', 'icon' => 'fa-user-alt', 'class' => 'isNumber']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="col-md-4">
                        <?php $__env->startComponent('components.input', ['name' => 'instagram', 'text' => 'انستاجرام', 'not_req' => true, 'hint'
                            => 'اسم حساب انستاجرام', 'icon' => 'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>

                    <div class="col-md-4">
                        <?php $__env->startComponent('components.input', ['name' => 'snapchat', 'text' => 'سناب شات', 'not_req' => true, 'hint' =>
                            'اسم حساب سناب شات', 'icon' => 'fa-user-alt']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="w-100"></div>


                    <div class="w-100"></div>
                </div>

                <div class="w-100"></div>
                <div class="row">
                    <div class="col-md-12">
                        <?php $__env->startComponent('components.area_editor', ['name' => 'return_policy_ar', 'text' => 'سياسة الارجاع باللغة
                            العربية ']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <?php $__env->startComponent('components.area_editor', ['name' => 'return_policy_en', 'text' => 'سياسة الارجاع باللغة
                            بالانجليزية ']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="w-100"></div>
                </div>

            </div>
            <div class="col-md-2">
                <?php $__env->startComponent('components.upload_image', ['name' => 'logo', 'text' => 'شعار المصمم', 'hint' => '60 * 60 بيكسل']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php echo $__env->renderComponent(); ?>




    <!-- END PAGE BASE CONTENT -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function() {

            $('#form').validate({

                errorElement: 'div', //default input error message container

                errorClass: 'abs_error help-block has-error',


            }).init();

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/create.blade.php ENDPATH**/ ?>