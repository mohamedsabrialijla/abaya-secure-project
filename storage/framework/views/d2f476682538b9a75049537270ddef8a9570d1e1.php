<div class="row justify-content-between">
    <label class="col col-form-label" for="<?php echo e($name); ?>"><?php echo e($text); ?></label>
    <div class="col">
			<span class="switch switch-icon">
				<label>
					<input type="checkbox"  id="<?php echo e(isset($id)?$id:$name); ?>"  name="<?php echo e($name); ?>" <?php echo e(old($name,isset($data)?$data:null)==1?'checked="checked"':''); ?>/>
					<span></span>
				</label>
			</span>
    </div>

    <div class="col-12" style="text-align: center">
        
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>
    </div>
</div>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/switch.blade.php ENDPATH**/ ?>