<?php $__env->startSection('title', $Disname); ?>
<form action="<?php echo e($add_url); ?>" id="form" method="post">
    <?php echo csrf_field(); ?>
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label"><?php echo e($Disname); ?>

                    <div class="text-muted pt-2 font-size-sm"><?php echo e($Disinfo); ?></div>
                </h3>
            </div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    <a href="<?php echo e(route($back_url)); ?>" class="<?php echo e(config('layout.classes.cancel')); ?> ml-7">
                        <i class="la la-times"></i>
                        <span>الغاء</span>
                    </a>


                    <?php if($action == 'add'): ?>
                        <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                            <i class="la la-check"></i>
                            <span>اضافة</span>
                        </button>

                    <?php else: ?>
                        <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                            <i class="la la-edit"></i>
                            <span>تعديل</span>
                        </button>

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

</form>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/AddEditCard.blade.php ENDPATH**/ ?>