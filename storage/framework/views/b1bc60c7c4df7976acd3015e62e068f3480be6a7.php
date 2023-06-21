



    <div class="form-group  
            <?php


                if ($errors->has($name)){
                    echo "has_error"  ;
                }


            ?>" style="<?php echo e(HELPER::endWith($name, '_en') !== false?'direction:ltr;text-align: left;':''); ?>">
        <label for="<?php echo e($name); ?>"><?php echo e($text); ?><span id="<?php echo e($name.'_related'); ?>" style="display: none;"></span></label>

        <div class="input-group input-group-solid">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="<?php echo e(isset($icon_pre)?$icon_pre:'fa'); ?> <?php echo e(isset($icon)?$icon:'fa-desktop'); ?> icon-lg"></i>
                </span>
            </div>

            <input

                <?php if(isset($type)): ?>
                <?php if($type == 'date'): ?>
                data-provide="datepicker"
                type="text"
                <?php if(isset($startDate)): ?>
                data-date-start-date="<?php echo e($startDate); ?>"
                <?php else: ?>
                data-date-start-date="<?php echo e(\Carbon\Carbon::now()->subYears(10)->toDateString()); ?>"
                <?php endif; ?>
                <?php else: ?>
                type="<?php echo e($type); ?>"
                <?php endif; ?>
                <?php if($type == "password"): ?>
                autocomplete="off"
                <?php endif; ?>
                <?php else: ?>
                type="text"

                <?php endif; ?>

                <?php if(isset($min)): ?>
                    min="<?php echo e($min); ?>"
                <?php endif; ?>
                class="form-control <?php echo e(@$class); ?>" placeholder="<?php echo e(isset($placeholder)?$placeholder:$text); ?>"
                <?php echo e(isset($not_req)?'':'required'); ?> name="<?php echo e($name); ?>" value="<?php

                  echo old($name,isset($data)?$data:null ,"");


                 ?>" id="<?php echo e($name); ?>" />

        </div>
        <span class="form-text text-muted"><?php echo e(isset($hint)?$hint:""); ?></span>
        
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>
    </div>



<?php /**PATH /home/abayasquare/public_html/resources/views/components/input.blade.php ENDPATH**/ ?>