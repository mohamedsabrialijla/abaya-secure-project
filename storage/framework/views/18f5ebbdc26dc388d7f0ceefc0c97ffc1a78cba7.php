<div class="input-group mr-2">
    <select name="<?php echo e($key); ?>" style="min-width: 150px;" class="autoSubmit" id="<?php echo e($key); ?>" >
        <option value="-1" <?php echo e(request()->$key == -1?'selected':''); ?> ><?php echo e($text); ?></option>
        <?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($r->id); ?>" <?php echo e(request()->$key == $r->id?'selected':''); ?> ><?php echo e($r->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>
</div>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/serach/select.blade.php ENDPATH**/ ?>