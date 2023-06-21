<?php $rand=rand(100,9999);?>
<div class="input-daterange input-group input-daterange-<?php echo e($rand); ?> mr-2">
    <input type="text" name="date_from" id="date_from" value="<?php echo e(request()->date_from); ?>" class="form-control" placeholder="من تاريخ">

    <input type="text" name="date_to" id="date_to" value="<?php echo e(request()->date_to); ?>" class="form-control" placeholder="الى تاريخ">

</div>

<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script>
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
        $('.input-daterange-<?php echo e($rand); ?>').datepicker({
            rtl: true,
            todayHighlight: true,
            templates: arrows
        });


        $(function() {
            $('.input-daterange-<?php echo e($rand); ?>').keypress(function(event) {
                event.preventDefault();
                return false;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/serach/dateRanger.blade.php ENDPATH**/ ?>