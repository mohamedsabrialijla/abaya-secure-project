<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.roles.index'),'title'=>'الصلاحيات']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.roles.index'),'title'=>'الصلاحيات']
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
'Disname'=>'الصلاحيات',
'Disinfo'=>'تعديل صلاحية',
'add_url'=>route('system.roles.do.update',$out->id),
'back_url'=>'system.roles.index',
'action'=>'edit',


]); ?>
        <div class="row justify-content-center">

            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->name,'name'=>'name','text'=>'اسم الصلاحية','placeholder'=>'اسم الصلاحية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="w-100"></div>

            <div class="col-md-12">
                <div class="row">

                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th style="text-align: center">اسم القسم</th>
                            <?php
                                $permission_maps = ['view', 'add', 'edit', 'delete','activate','feature','slider'];
                            ?>

                            <?php $__currentLoopData = $permission_maps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th style="text-align: center"><?php echo e(__('cp.'.$p)); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="text-align: center">فعل</th>
                            <th style="text-align: center">عطل</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                            $models = ['dashboard','admins', 'settings', 'roles','translations','categories',
                                        'colors','sizes','stores','products','orders','orderCases','coupons',
                                        'users', 'notifications','contacts','about_us','terms','policies','payments','search_log'];
                        ?>


                        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="text-align: center">
                                    <?php echo e(__('cp.'.$model)); ?>

                                </td>
                                <?php $__currentLoopData = $permission_maps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_map): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td style="text-align: center">
                                        <label class="checkbox justify-content-center">
                                            <input type="checkbox"
                                                   name="permission[]" class="rule"
                                                   value="<?php echo e($permission_map . '_' . $model); ?>"
                                                <?php echo e(in_array($permission_map . '_' . $model, $out->permissions->pluck('name')->toArray())?'checked':''); ?>

                                            ><span></span>
                                        </label>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td style="width: 5%;">
                                    <a href="#" class="reg-all" style="padding: 5px;margin: 0 5px;"
                                       data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                       title="فعل الجميع"><i
                                            class="fa fa-check"></i> </a>
                                </td>
                                <td style="width: 5%;">
                                    <a href="#" class="de-reg-all" style="padding: 5px;margin: 0 5px;"
                                       data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                       title="عطل الجميع"><i
                                            class="fa fa-times"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    <?php echo $__env->renderComponent(); ?>




    <!-- END PAGE BASE CONTENT -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_scripts'); ?>



    <script>

        $(function () {

            /*       $('#form').validate({

                       errorElement: 'div', //default input error message container

                       errorClass: 'abs_error help-block has-error',


                   }).init();*/

        })


    </script>

    <script>
        $(function () {
            $('.reg-all').click(function (e) {
                e.preventDefault();
                $(this).parent().parent().find('.rule').each(function (i) {
                    var IsCheck = $(this).is(":checked");
                    if (!IsCheck) {
                        $(this).click();
                    }
                });
            });
            $('.de-reg-all').click(function (e) {
                e.preventDefault();
                $(this).parent().parent().find('.rule').each(function (i) {
                    var IsCheck = $(this).is(":checked");
                    if (IsCheck) {
                        $(this).click();
                    }
                });
            });

        })
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/roles/update.blade.php ENDPATH**/ ?>