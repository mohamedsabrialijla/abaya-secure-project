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

    <?php $__env->startComponent('components.ShowCard',[
    'Disname'=>'الادارة',
    'Disinfo'=>'ادارة مديري لوحة التحكم',
    'add_url'=>'system.admin.create',
    'module'=>'admins',
    'actions'=>[
        [
            'route'=>'system.admin.delete',
            'icon'=>config('layout.icons.delete_icon'),
            'text'=>'حذف',
            'role'=>"delete",
        ]
    ]
    ]); ?>
        <div class="row">

            <div class="row">
                <div class="col">
                    <form class="form-inline" style="float: right">
                        <div class="form-group m-form__group">

                            <?php $__env->startComponent('components.serach.inputwithsearch',['inputs'=>['name'=>'الاسم']]); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <a href="<?php echo e(route('system.admin.index')); ?>"
                               class="<?php echo e(config('layout.classes.delete')); ?> mb-4 ml-5">
                                <i class="fa fa-refresh"></i> تفريغ
                            </a>
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
                                <th class="text-center table-td-small">#</th>
                                <th class="text-center table-td-small">
                                    <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                        <input type="checkbox" id="SelectAll">
                                        <span></span>
                                    </label>


                                </th>

                                <th class="text-right"> الاسم</th>
                                <th class="text-center"> اسم المستخدم</th>
                                <th class="text-center"> الجوال</th>
                                
                                <th class="text-center">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="TR_<?php echo e($o->id); ?>">

                                    <td class="text-center table-td-small LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-center table-td-small">
                                        <?php if($o->id !=1): ?>
                                            <label
                                                class="checkbox checkbox-outline checkbox-success justify-content-center">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                       class="CheckedItem"
                                                       id="che_<?php echo e($o->id); ?>">
                                                <span></span>
                                            </label>

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <img src="<?php echo e($o->image_url); ?>" class="img_table" alt="">
                                        <?php echo e($o->name); ?>

                                    </td>
                                    <td class="text-center"><?php echo e($o->email); ?></td>
                                    <td class="text-center"><?php echo e($o->mobile); ?></td>
                                    

                                    <td class="text-center">
                                        <?php if($o->id !=1): ?>
                                            <ul class="list-inline">

                                                <?php if(auth('system_admin')->user()->can('edit_admins','system_admin')): ?>
                                                    <li>
                                                        <a href="<?php echo e(route('system.admin.update',$o->id)); ?>"
                                                           class="<?php echo e(config('layout.classes.edit')); ?> mt-1"
                                                           data-toggle="tooltip" data-theme="dark"
                                                           title="تعديل البيانات"
                                                        >
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>

                                                    <li>
                                                        <a href="<?php echo e(route('system.admin.password',$o->id)); ?>"
                                                           class="<?php echo e(config('layout.classes.black')); ?> mt-2"
                                                           data-toggle="tooltip" data-theme="dark"
                                                           title="تعديل كلمة المرور">
                                                            <i class="fa fa-lock"></i> كلمة المرور </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if(auth('system_admin')->user()->can('delete_admins','system_admin')): ?>
                                                    <li>
                                                        <button type="button"
                                                                data-id="<?= $o->id ?>"
                                                                data-url="<?php echo e(route('system.admin.delete')); ?>"
                                                                data-token="<?php echo e(csrf_token()); ?>"
                                                                data-toggle="tooltip" data-theme="dark"
                                                                title="حذف"
                                                                class="<?php echo e(config('layout.classes.delete')); ?> mt-2 btn-del">
                                                            <i class="<?php echo e(config('layout.icons.delete_icon')); ?> "></i>
                                                            حذف
                                                        </button>

                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        <?php endif; ?>
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
            </div>
        </div>


    <?php echo $__env->renderComponent(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/admins/index.blade.php ENDPATH**/ ?>