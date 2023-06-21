<?php $__env->startSection('title', $Disname); ?>
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label"><?php echo e($Disname); ?>

                <div class="text-muted pt-2 font-size-sm"><?php echo e($Disinfo); ?></div>
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="card-toolbar">

                <a href="<?php echo e(URL::previous()); ?>" class="<?php echo e(config('layout.classes.black')); ?> m-2">
                    <i class="la la-arrow-right"></i>
                    رجوع
                </a>

                <?php if(isset($actions) && count($actions)): ?>
                    <?php if(auth('system_admin')->user()->can('activate_' . $module, 'system_admin') ||
    auth('system_admin')->user()->can('delete_' . $module, 'system_admin')): ?>
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="<?php echo e(config('layout.classes.actions')); ?>" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="la la-gear"></i>
                                <span>عمليات</span>
                            </button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover">
                                    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(auth('system_admin')->user()->can($action['role'] . '_' . $module, 'system_admin')): ?>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link DoAction"
                                                    data-url="<?php echo e(route($action['route'])); ?>"
                                                    data-token="<?= csrf_token() ?>">
                                                    <i class="<?php echo e($action['icon']); ?>"></i>
                                                    <span class="navi-text"><?php echo e($action['text']); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($add_url)): ?>
                    <?php if(auth('system_admin')->user()->can('add_' . $module, 'system_admin')): ?>
                        <?php if(isset($store_id)): ?>
                            <a href="<?php echo e(route($add_url, ['storeId' => $store_id])); ?>"
                                class="<?php echo e(config('layout.classes.add')); ?>">
                                <i class="la la-plus"></i>
                                <span>اضافة جديد</span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route($add_url)); ?>" class="<?php echo e(config('layout.classes.add')); ?>">
                                <i class="la la-plus"></i>
                                <span>اضافة جديد</span>
                            </a>
                        <?php endif; ?>


                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($excel)): ?>
                    <?php if(auth('system_admin')->user()->can('view_' . $module, 'system_admin')): ?>
                        <a href="<?php echo e(route($excel)); ?>" class="<?php echo e(config('layout.classes.add')); ?>">
                            <i class="las la-file-excel"></i>
                            <span>تصدير اكسيل</span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($print)): ?>
                    <?php if(auth('system_admin')->user()->can('view_' . $module, 'system_admin')): ?>
                        <a  onclick="window.print()" class="<?php echo e(config('layout.classes.add')); ?>">
                            <i class="las la-file"></i>
                            <span>طباعة</span>
                        </a>
                        
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($add_popup_class)): ?>
                    <a href="javascript:;" class="<?php echo e(config('layout.classes.add')); ?> <?php echo e($add_popup_class); ?>">
                        <i class="la la-plus"></i>
                        <span>اضافة جديد</span>
                    </a>
                <?php endif; ?>


            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="m-content">
            <?php echo e($slot); ?>

        </div>
    </div>

</div>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/ShowCard.blade.php ENDPATH**/ ?>