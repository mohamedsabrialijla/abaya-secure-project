<div class="input-group mr-2">
    <select name="<?php echo e($key); ?>" style="min-width: 150px"  class="autoSubmit" id="<?php echo e($key); ?>" >
        <option value="-1" <?php echo e(HELPER::set_if($_GET[$key],-1) == -1?'selected':''); ?>><?php echo e($text); ?></option>
        <?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($k); ?>" <?php echo e(HELPER::set_if($_GET[$key],-1) == $k?'selected':''); ?>><?php echo e($r); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>
</div>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/serach/selectArr.blade.php ENDPATH**/ ?>