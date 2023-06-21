<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.orderCases.index'),'title'=>'حالات الطلب']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.orderCases.index'),'title'=>'حالات الطلب']
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>

    <?php $__env->startComponent('components.ShowCard',[
'Disname'=>'حالات الطلب',
'Disinfo'=>'ادارة حالات الطلب',
'add_url'=>null,
'module'=>'orderCases',
'actions'=>[

]
]); ?>
        <div class="row">

            <div class="col-lg-12">


                <?php if(isset($out) && count($out) > 0): ?>
                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="5%" style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                        <input type="checkbox" id="SelectAll">
                                        <span></span>
                                    </label>

                                </th>
                                <th class="text-center">الاسم</th>
                                <th class="text-center">اللون</th>
                                <th class="text-center">الاعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="TR_<?php echo e($o->id); ?>">

                                    <td class="LOOPIDS"><?php echo e(($out ->currentpage()-1) * $out ->perpage() + $loop->iteration); ?></td>
                                    <td style="text-align: center;vertical-align: middle;">
                                        <label
                                            class="checkbox checkbox-outline checkbox-success justify-content-center">
                                            <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                   class="CheckedItem"
                                                   id="che_<?php echo e($o->id); ?>">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <p><?php echo e($o->name_ar); ?></p>
                                        <p><?php echo e($o->name_en); ?></p>
                                    </td>
                                    <td class="text-center">
                                        <span class="label mr-2" style="background-color: <?php echo e($o->hex_color); ?>"></span>
                                    </td>
                                    <td class="text-center">

                                        <ul class="list-inline">

                                            <?php if(auth('system_admin')->user()->can('edit_orderCases','system_admin')): ?>

                                                <li>
                                                    <a href="<?php echo e(route('system.orderCases.update',$o->id)); ?>"
                                                       class="<?php echo e(config('layout.classes.edit')); ?> mt-2"

                                                       data-toggle="tooltip" data-theme="dark" title="تعديل"
                                                    >
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <?php echo $out->links(); ?>

                <?php else: ?>
                    <div class="note note-info">
                        <h4 class="block">لا يوجد بيانات مضافة</h4>
                    </div>
                <?php endif; ?>

            </div>
        </div>



    <?php echo $__env->renderComponent(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/order_cases/index.blade.php ENDPATH**/ ?>