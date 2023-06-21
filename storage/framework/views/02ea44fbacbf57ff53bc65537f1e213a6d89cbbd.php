<div class="form-group  
            <?php


                if ($errors->has($name)){
                    echo "has_error"  ;
                }


            ?>">
    <label for="<?php echo e($name); ?>"><?php echo e($text); ?> </label>
    <select name="<?php echo e($name); ?>" style="width: 100%;"
            <?php if(isset($class)): ?> class="<?php echo e($class); ?>" <?php endif; ?> id="<?php echo e(str_replace(['[]','[',']'],'',$name)); ?>" <?php echo e(HELPER::endWith($name, '[]') !== false?'multiple="multiple"':''); ?> <?php echo e(isset($not_req)?'':'required'); ?>>
        <?php if(!isset($no_def)): ?>
            <?php if(HELPER::endWith($name, '[]') === false): ?>
                <option value=""><?php echo e(isset($placeholder)?$placeholder:$text); ?></option>
            <?php endif; ?>
        <?php endif; ?>
        <?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(HELPER::endWith($name, '[]') === false): ?>
                <option value="<?php echo e($s->id); ?>" <?php echo e(old($name,isset($data)?$data:null)==$s->id?'selected':''); ?>><?php echo e($s->name); ?></option>
            <?php else: ?>
                <option value="<?php echo e($s->id); ?>" <?php echo e(in_array($s->id,old(trim($name,'[]'),isset($data)?$data:[]))?'selected':''); ?>>
                    <?php if($s->name !=null): ?>
                        <?php echo e($s->name); ?>

                    <?php elseif($s->mobile !=null): ?>
                        <?php echo e($s->mobile); ?>

                    <?php elseif($s->email !=null): ?>
                        <?php echo e($s->email); ?>

                    <?php endif; ?>
                </option>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>

</div>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/select.blade.php ENDPATH**/ ?>