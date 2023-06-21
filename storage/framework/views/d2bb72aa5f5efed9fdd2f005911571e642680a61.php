<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.areas.index'),'title'=>'المناطق']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.areas.index'),'title'=>'المناطق']
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
'Disname'=>'المناطق',
'Disinfo'=>'اضافة منطقة  جديدة',
'add_url'=>route('system.areas.do.create'),
'back_url'=>'system.govs.index',
'action'=>'add',


]); ?>
        <div class="row justify-content-center">

            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['name'=>'name_ar','text'=>'المنطقة باللغة العربية','placeholder'=>'ادخل المنطقة باللغة العربية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['name'=>'name_en','text'=>'المنطقة باللغة الانجليزية','placeholder'=>'ادخل المنطقة باللغة الانجليزية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.selectWithAdd',['name'=>'gov_id','text'=>'المحافظة','select'=>$govs,'add_url'=>route('system.govs.createJson')]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>

            <div class="col-md-2 align-right">
                <label class="col col-form-label" for="is_cash">الدفع (كاش)</label>
                <div class="col">
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox" id="is_cash" name="is_cash"
                                   <?php if(old('is_cash')): ?> checked <?php endif; ?>/>
                            <span></span>
                        </label>
                    </span>
                </div>

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






<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/area_new/create.blade.php ENDPATH**/ ?>