
<?php $__env->startComponent('mail::layout'); ?>
    
    <?php $__env->slot('header'); ?>
        <?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
            <?php echo e(config('app.name')); ?>

        <?php echo $__env->renderComponent(); ?>
    <?php $__env->endSlot(); ?>

  <h3>الكود الخاص للدخول إلى تطبيق عباية سكوير هو : </h3>
    <br>
    <?php $__env->startComponent('mail::table'); ?>
        | <?php echo e($code); ?>     |
        |:-------------:|
    <?php echo $__env->renderComponent(); ?>

    شكراً,
    <?php echo e(config('app.name')); ?>



    
    <?php $__env->slot('footer'); ?>
        <?php $__env->startComponent('mail::footer'); ?>

               ." جميع الحقوق محفوظة لدى تطبيق<?php echo e(" " .config('app.name')); ?>  © <?php echo e(date('Y')); ?>  "
        <?php echo $__env->renderComponent(); ?>
    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/emails/activate.blade.php ENDPATH**/ ?>