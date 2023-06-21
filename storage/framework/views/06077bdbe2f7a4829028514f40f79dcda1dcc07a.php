<div class="input-group mr-2">
    <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="text" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" class="form-control m-input m-input--pill " style="border-radius: 0"
               value="<?php echo e(request()->$key); ?>" placeholder="<?php echo e($text); ?>">

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->startSection('scripts'); ?>
   

<?php $__env->stopSection(); ?>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/serach/input.blade.php ENDPATH**/ ?>