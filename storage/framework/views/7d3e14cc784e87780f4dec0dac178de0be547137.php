
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div style="padding:42px;">
    <p><?php echo app('translator')->get('site.table_size'); ?> </p>

    <p><?php echo app('translator')->get('site.describe_tabel_sizes'); ?></p>  
  
</div>

<!-- <img src="<?php echo e(url('/table_size/1.jpg')); ?>"> -->
<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="<?php echo e(asset('table_size/1.jpg')); ?>" >
        </div>
    </figure>
</div>

<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="<?php echo e(asset('table_size/2.jpg')); ?>" >
        </div>
    </figure>
</div>



<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="<?php echo e(asset('table_size/3.jpg')); ?>" >
        </div>
    </figure>
</div>

<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="<?php echo e(asset('table_size/5.jpg')); ?>" >
        </div>
    </figure>
</div> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/web/table_size.blade.php ENDPATH**/ ?>