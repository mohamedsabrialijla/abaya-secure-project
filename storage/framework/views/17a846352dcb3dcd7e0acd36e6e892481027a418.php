<?php
$images=[];
?>
<?php $__currentLoopData = $out->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $images[]=$a->image;?>
<div class="edit_images">
    <img src="<?php echo e(url('public/uploads/'.$a->image)); ?>" class="Muti-Image-prev" alt="">
    <div class="actions">

        <?php if($a->is_main ==1): ?>
        <i class="fa fa-star"
           style="color: green;cursor: pointer;font-size: 1.2em" title="الصورة الرئيسية"></i>
        <?php else: ?>
        <a href="#" class="SetAsDefault" data-url="<?php echo e(route('system.products.default_image')); ?>" data-image="<?php echo e($a->id); ?>" title="تعيين كصورة رئيسية" style="color: yellow;cursor: pointer;font-size: 1.2em;text-decoration: none;">
            <i class="fa fa-star "></i>
        </a>
        <a href="#" class="DelImage" data-url="<?php echo e(route('system.products.delete_image')); ?>" data-image="<?php echo e($a->id); ?>" title="حذف" style="color: red;cursor: pointer;font-size: 1.2em;text-decoration: none;">
            <i class="fa fa-trash "></i>
        </a>
        <?php endif; ?>


    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" value='<?php echo json_encode($images, 15, 512) ?>'  class="uploaded_multi_image_name" name="uploaded_multi_image_name">
<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/products/images.blade.php ENDPATH**/ ?>