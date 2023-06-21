
<?php if(config('layout.content.extended')): ?>
    <?php echo $__env->yieldContent('page_content'); ?>
<?php else: ?>
    <div class="d-flex flex-column-fluid">
        <div class="<?php echo e(Metronic::printClasses('content-container', false)); ?>">
            <?php echo $__env->yieldContent('page_content'); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/abayasquare/public_html/resources/views/layouts/base/_content.blade.php ENDPATH**/ ?>