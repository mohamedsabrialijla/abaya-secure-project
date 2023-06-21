<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.notifications.index'),'title'=>'الاشعارات']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.notifications.index'),'title'=>'الاشعارات']
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
'Disname'=>'الاشعارات',
'Disinfo'=>'ادارة الاشعارات العامة',
'add_url'=>'system.notifications.create',
'module'=>'notifications',
'actions'=>[
    [
        'route'=>'system.notifications.delete',
        'icon'=>config('layout.icons.delete_icon'),
        'text'=>'حذف',
        'role'=>"delete",
    ]
]
]); ?>
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            <?php $__env->startComponent('components.serach.dateRanger'); ?>
                            <?php echo $__env->renderComponent(); ?>

                                <?php $__env->startComponent('components.serach.inputwithsearch',['inputs'=>['name'=>'عنوان الاشعار']]); ?>
                                <?php echo $__env->renderComponent(); ?>

                                <a href="<?php echo e(route('system.notifications.index')); ?>"
                                   class="<?php echo e(config('layout.classes.delete')); ?> mb-4 mr-2">
                                    <i class="fa fa-refresh"></i> تفريغ
                                </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

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
                        <th class="text-center">العنوان</th>
                        <th class="text-center">الرسالة</th>
                        <th class="text-center">تاريخ الارسال</th>
                        <th class="text-center">الإعدادات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="TR_<?php echo e($o->id); ?>">

                            <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                            <td style="text-align: center;vertical-align: middle;">
                                <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                    <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                                           id="che_<?php echo e($o->id); ?>">
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-center"><?php echo $o->title; ?></td>
                            <td class="text-center"><?php echo $o->message; ?></td>
                            <td class="text-center"><?=$o->created_at->toDateString()?></td>
                            <td class="text-center">

                                <ul class="list-inline">
                                    <?php if(auth('system_admin')->user()->can('delete_notifications','system_admin')): ?>
                                        <li>
                                            <button type="button"
                                                    data-id="<?= $o->id ?>"
                                                    data-url="<?php echo e(route('system.notifications.delete')); ?>"
                                                    data-token="<?php echo e(csrf_token()); ?>"
                                                    data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                                    title="حذف"
                                                    class="<?php echo e(config('layout.classes.delete')); ?> btn-del">
                                                <i class="<?php echo e(config('layout.icons.delete_icon')); ?> "></i>
                                                حذف
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
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/notifications/index.blade.php ENDPATH**/ ?>