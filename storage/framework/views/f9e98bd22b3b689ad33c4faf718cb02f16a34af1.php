<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.coupons.index'), 'title' => 'كبونات الخصم'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.coupons.index'), 'title' => 'كبونات الخصم'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>

    <?php $__env->startComponent('components.ShowCard',
        [
            'Disname' => 'كبونات الخصم',
            'Disinfo' => 'ادارة كبونات الخصم',
            'add_url' => 'system.coupons.create',
            'module' => 'coupons',
            'actions' => [
                [
                    'route' => 'system.coupons.activate',
                    'icon' => config('layout.icons.activate_icon'),
                    'text' => 'تفعيل',
                    'role' => 'activate',
                ],
                [
                    'route' => 'system.coupons.deactivate',
                    'icon' => config('layout.icons.deactivate_icon'),
                    'text' => 'تعطيل',
                    'role' => 'activate',
                ],
                [
                    'route' => 'system.coupons.delete',
                    'icon' => config('layout.icons.delete_icon'),
                    'text' => 'حذف',
                    'role' => 'delete',
                ],
            ],
        ]); ?>
        <div class="row">

            <div class="row">
                <div class="col">
                    <form class="form-inline" id="form" style="float: right">
                        <div class="form-group m-form__group">
                            <div class="input-group">
                                <?php $__env->startComponent('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 => 'مفعل', 0 => 'معطل']]); ?>
                                <?php echo $__env->renderComponent(); ?>
                                

                                <?php $__env->startComponent('components.serach.dateRanger'); ?>
                                <?php echo $__env->renderComponent(); ?>

                                <?php $__env->startComponent('components.serach.inputwithsearch', ['inputs' => ['name' => 'الكود']]); ?>
                                <?php echo $__env->renderComponent(); ?>

                                <a href="<?php echo e(route('system.coupons.index')); ?>"
                                    class="<?php echo e(config('layout.classes.delete')); ?> mb-4 ml-5">
                                    <i class="fa fa-refresh"></i> تفريغ
                                </a>

                            </div>
                        </div>


                    </form>
                </div>
            </div>

            <div class="col-lg-12">
                <?php if(isset($out) && count($out) > 0): ?>
                    <div class="table-responsive">
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
                                    <th class="text-center">الكود</th>
                                    <th class="text-center">نوع الخصم</th>
                                    <th class="text-center">قيمة الخصم</th>
                                    <th class="text-center">تاريخ البداية</th>
                                    <th class="text-center">تاريخ الانتهاء</th>
                                    <th class="text-center">مرات الاستخدام المسموح </th>
                                    <th class="text-center">مرات الاستخدام </th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">الاعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="TR_<?php echo e($o->id); ?>">

                                        <td class="LOOPIDS">
                                            <?php echo e(($out->currentpage() - 1) * $out->perpage() + $loop->iteration); ?></td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_<?php echo e($o->id); ?>">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->code); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <?php if($o->flag == 1): ?>
                                                <p> نسبة مئوية</p>
                                            <?php elseif($o->flag == 2): ?>
                                                <p> مبلغ محدد</p>
                                            <?php elseif($o->flag == 3): ?>
                                                <p> خصم قيمة الشحن</p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->discount_ratio); ?> </p>

                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->start_date->toDateString()); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->expire_date->toDateString()); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->count_of_use); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->used_count); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <?php if($o->is_active == 1): ?>
                                                <span class="m--font-success"> مفعل </span>
                                            <?php else: ?>
                                                <span class="m--font-warning"> معطل </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">

                                            <ul class="list-inline">
                                                <?php if(auth('system_admin')->user()->can('edit_coupons', 'system_admin')): ?>
                                                <li>
                                                    <a href="<?php echo e(route('system.coupons.orders', $o->id)); ?>"
                                                        class="<?php echo e(config('layout.classes.edit')); ?> mt-2"
                                                        data-toggle="tooltip" data-theme="dark" title="الطلبات">
                                                        <i class="fa fa-eye"></i> الطلبات </a>
                                                </li>
                                            <?php endif; ?>

                                                <?php if(auth('system_admin')->user()->can('edit_coupons', 'system_admin')): ?>
                                                    <li>
                                                        <a href="<?php echo e(route('system.coupons.update', $o->id)); ?>"
                                                            class="<?php echo e(config('layout.classes.edit')); ?> mt-2"
                                                            data-toggle="tooltip" data-theme="dark" title="تعديل">
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if(auth('system_admin')->user()->can('delete_coupons', 'system_admin')): ?>
                                                    <li>

                                                        <button class="<?php echo e(config('layout.classes.delete')); ?> mt-2 btn-del"
                                                            data-id="<?= $o->id ?>" data-toggle="tooltip" data-theme="dark"
                                                            data-url="<?php echo e(route('system.coupons.delete')); ?>"
                                                            data-token="<?php echo e(csrf_token()); ?>" title="حذف"><i
                                                                class="fa fa-trash"> </i>حذف
                                                        </button>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/coupons/index.blade.php ENDPATH**/ ?>