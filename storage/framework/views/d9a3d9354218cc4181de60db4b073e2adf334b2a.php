<?php $attributes = $attributes->exceptProps([
    'text'=>'',
    'hint'=>'',
    'name'=>'',
    'name1'=>'',
    ]); ?>
<?php foreach (array_filter(([
    'text'=>'',
    'hint'=>'',
    'name'=>'',
    'name1'=>'',
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
        <label for="MYimage_<?php echo e($name); ?>" class="MutiImageText">
            <span>اختر صور لرفعها</span>
            <i class="fa fa-image fa-2x MutiImageTextIcon"></i>
        </label>
        <button class="btn MainImageSelect" data-toggle="modal"
                data-target="#imageModal" type="button" data-inputname="<?php echo e($name); ?>">
            الصورة الرئيسية<i class="fa fa-check" id="ChickIfImageSelected2" style="display: none"></i>
        </button>

        <input type="file" id="MYimage_<?php echo e($name); ?>" style="display: none" multiple name="file"
               class="upload_image_multi">

        <input type="hidden" value="<?= old($name1) ?>" name="<?php echo e($name1); ?>"
               class="uploaded_image_def">

        <input type="hidden" value='<?= old($name, '[]') ?>'
               class="uploaded_multi_image_name"
               name="<?php echo e($name); ?>">
        <div class="MultiImagePrev">
            <?php
            if (old($name)) {
            $arr = json_decode(old($name));
            foreach ($arr as $a) {
            ?>
            <div class="edit_images">

                <img src="<?= asset('uploads/' . $a) ?>" class="Muti-Image-prev" alt="">
                <div class="actions">
                    <a href="#" class="DelImageCreate" data-image="<?=$a?>" title="حذف"
                       style="color: red;cursor: pointer;font-size: 1.2em;text-decoration: none;">
                        <i class="fa fa-trash "></i>
                    </a>
                </div>
            </div>
            <?php
            }
            }
            ?>

        </div>
        
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>

    </div>
    <div class="col-md-2">
        <div class="imageContainer">
            <img src="<?= old($name1) ? url('uploads/' . old($name1)) : url('blank.png') ?>"
                 class="img-fluid thumbnail" id="DefaultImagePrev" alt="">
            <div class="image-loader"></div>
        </div>
    </div>
</div>
<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="imagePrev">
                    <div class="col-md-12 text-center">
                        يرجى رفع صور لاختيار الصورة الرئيسية
                    </div>


                </div>
                <div class="clearfix"></div>
            </div>

        </div>

    </div>
</div>

<?php /**PATH /home/abayasquare/public_html/resources/views/components/multiuploadcreate.blade.php ENDPATH**/ ?>