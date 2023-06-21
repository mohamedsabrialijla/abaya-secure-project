<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="terms_page">
    <div class="container">
        <h4 class="heading main-color bold text-center mb-50"><?php echo app('translator')->get('site.terms'); ?></h4>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content_section">
                   <?php echo $content; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!--======================== End terms =============================-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/terms.blade.php ENDPATH**/ ?>