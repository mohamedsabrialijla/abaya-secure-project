<div class="form-group m-form__group  
            <?php


                if ($errors->has('<?php echo e($name); ?>')){
                    echo "has_error"  ;
                }


            ?>">
    <label for="<?php echo e($name); ?>"><?php echo e($text); ?> </label>
    <div class="m-input-icon m-input-icon--left m-input-icon--right">
        <input class="form-control" type="color" <?php echo e(isset($not_req)?'':'required'); ?> name="<?php echo e($name); ?>"
               value="<?php

                  echo old($name,isset($data)?$data:null ,"");


                 ?>" id="<?php echo e($name); ?>">
    </div>
    
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>

</div>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/colorpicker.blade.php ENDPATH**/ ?>