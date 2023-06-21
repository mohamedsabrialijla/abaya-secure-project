<div class="imageCont 
            <?php


                if ($errors->has($name)){
                    echo "has_error"  ;
                }


            ?>" style="text-align: center">
    <h5 style="text-align: center"> <?php echo e($text); ?> </h5>
    <small style="color: gray;text-align: center;display: block;"><?php echo e(isset($hint)?$hint:'400 * 400 بيكسل'); ?></small>
    
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>
    <div class="imageContainer">
        <label for="MYimage_<?php echo e($name); ?>" style="width: 100%;cursor: pointer;">
            <img src="<?= old($name,(isset($data) && $data)?$data:null) ? url('uploads/' . old($name,isset($data) && $data?$data:null)) : url('blank.png') ?>"
                 style="width: 100%;" class="MyImagePrivew thumbnail"
                 alt="">


        </label>
        <input type="file" id="MYimage_<?php echo e($name); ?>" style="display: none"
               name="file"
               class="upload_image">
        <input type="hidden" value="<?= old($name,isset($data)?$data:null) ?>"
               name="<?php echo e($name); ?>"   id="<?php echo e($name); ?>" class="uploaded_image_name">
        <div class="image-loader"></div>
    </div>
</div>

<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/upload_image.blade.php ENDPATH**/ ?>