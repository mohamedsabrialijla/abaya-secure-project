<div class="<?php echo e(isset($col)?'col-md-'.$col:'col'); ?>">
    <a href="<?php echo e($url); ?>" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <?php if(isset($icon)): ?>
                <?php if(\App\Classes\Theme\Metronic::isSVG($icon)): ?>
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                     <?php echo e(Metronic::getSVG($icon)); ?>

                </span>
                <?php else: ?>

                    <i class="<?php echo e($icon); ?> fa-3x text-inverse-danger"></i>

                <?php endif; ?>
            <?php else: ?>
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">

                    <?php echo e(Metronic::getSVG('media/svg/icons/General/Settings-2.svg')); ?>

                </span>
            <?php endif; ?>


            <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5"><?php echo e($name); ?></div>
            <?php if(isset($count) && $name == ' الطلبات  ملغي'): ?>
                <div class="font-weight-bold text-inverse-danger font-size-sm"><?php echo e($count); ?> </div>
            <?php endif; ?> 
            
             <?php if(isset($count) && $name != ' الطلبات  ملغي'): ?>
                <div class="font-weight-bold text-inverse-danger font-size-sm"><?php echo e($count); ?></div>
            <?php endif; ?>
        </div>
        <!--end::Body-->
    </a>
</div>

<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/dash/card.blade.php ENDPATH**/ ?>