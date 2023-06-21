<?php $attributes = $attributes->exceptProps([
    'text'=>'',
    'hint'=>'',
    'name'=>'',
    'path'=>'',
    'addroute'=>'',
    'out'=>'',
    ]); ?>
<?php foreach (array_filter(([
    'text'=>'',
    'hint'=>'',
    'name'=>'',
    'path'=>'',
    'addroute'=>'',
    'out'=>'',
    ]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div class="row multimg_container">
        <div class="text">
            <h5> <?php echo e($text); ?> </h5>
            <small><?php echo e(isset($hint)?$hint:'400 * 400 بيكسل'); ?></small>
        </div>
    <div class="col-md-10">
                <label for="MYimage_<?php echo e($name); ?>" class="MutiImageText" style="width: 100%;">
                    <span>اختر صور لرفعها</span>
                    <i class="fa fa-image fa-2x MutiImageTextIcon"></i>
                </label>
        <input type="file" id="MYimage_<?php echo e($name); ?>" style="display: none" multiple name="file" data-url="<?php echo e(route($addroute)); ?>" data-place="<?=$out->id?>" class="upload_image_multi2">

                <input type="file" id="MYimage_<?php echo e($name); ?>" style="display: none" multiple name="file"
                       class="upload_image_multi">
                <div class="MultiImagePrev">
                    <?php echo $__env->make($path, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>
        
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>

    </div>
    <div class="col-md-2">
        <div class="imageContainer">
            <img src="<?php echo e($out->image ? asset('uploads/' . $out->image) : url('blank.png')); ?>"
                 class="img-fluid thumbnail" id="DefaultImagePrev" alt="">
            <div class="image-loader"></div>
        </div>
    </div>
</div>
<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="imagePrev"></div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" style="display: none" class="btn btn-default" id="CloSEForm" data-dismiss="modal">
                    اغلاق
                </button>
            </div>
        </div>

    </div>
</div>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/multiuploadupdate.blade.php ENDPATH**/ ?>