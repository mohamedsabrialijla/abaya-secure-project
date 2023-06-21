
<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.styles.index'),'title'=>'الموديلات']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.styles.index'),'title'=>'الموديلات']
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
'Disname'=>'الموديلات',
'Disinfo'=>'ادارة الموديلات',
'add_url'=>'system.styles.create',
'module'=>'style',
'actions'=>[
        [
           'route'=>'system.styles.activate',
           'icon'=>config('layout.icons.activate_icon'),
           'text'=>'تفعيل',
           'role'=>"activate",
       ],
       [
           'route'=>'system.styles.deactivate',
           'icon'=>config('layout.icons.deactivate_icon'),
           'text'=>'تعطيل',
           'role'=>"activate",
       ],
       [
            'route'=>'system.styles.delete',
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

                            <?php $__env->startComponent('components.serach.inputwithsearch',['inputs'=>['name'=>'اسم الموديل']]); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <a href="<?php echo e(route('system.styles.index')); ?>"
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
                                <th>#</th>
                                <th width="5%" style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                        <input type="checkbox" id="SelectAll">
                                        <span></span>
                                    </label>

                                </th>

                                <th class="text-center">اسم الموديل</th>
                                <th class="text-center">الحالة</th>
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
                                        <?php if($o->status == 1): ?>
                                            <span class="m--font-success"> مفعل </span>
                                        <?php else: ?>
                                            <span class="m--font-warning"> معطل </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">

                                        <ul class="list-inline">
                                            <?php if(auth('system_admin')->user()->can('edit_style','system_admin')): ?>
                                                <li>
                                                    <a href="<?php echo e(route('system.styles.update',$o->id)); ?>"
                                                       class="<?php echo e(config('layout.classes.edit')); ?> mt-2"

                                                       data-toggle="tooltip" data-theme="dark" title="تعديل">
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(auth('system_admin')->user()->can('delete_style','system_admin')): ?>
                                                <li>
                                                    <?php if ($o->can_del) { ?>
                                                    <button class="<?php echo e(config('layout.classes.delete')); ?> mt-2 btn-del"
                                                            data-id="<?= $o->id ?>"
                                                            data-toggle="tooltip" data-theme="dark"
                                                            data-url="<?php echo e(route('system.styles.delete')); ?>"
                                                            data-token="<?php echo e(csrf_token()); ?>"
                                                            title="حذف"><i class="fa fa-trash"> </i>حذف
                                                    </button>
                                                    <?php }else{ ?>
                                                    <div style="display: inline-block;" data-skin="dark"
                                                         data-tooltip="m-tooltip" data-placement="top"
                                                         title="لا يمكن الحذف لوجود منتجات تابعة له">
                                                        <a class="<?php echo e(config('layout.classes.delete')); ?> mt-2"
                                                           style="pointer-events: none;cursor: default;opacity: 0.7;color: #f4516c;"
                                                           data-skin="dark" data-tooltip="m-tooltip"
                                                           data-placement="top"
                                                           title="لا يمكن الحذف لوجود منتجات تابعة له">
                                                            <i class="fa fa-trash"></i>حذف
                                                        </a>
                                                    </div>
                                                    <?php } ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/system_admin/style/index.blade.php ENDPATH**/ ?>