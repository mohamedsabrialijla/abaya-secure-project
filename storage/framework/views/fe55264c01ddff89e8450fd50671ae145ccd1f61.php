<div class="form-group m-form__group 
            <?php


                if ($errors->has($name)){
                    echo "has_error"  ;
                }


            ?>" style="margin-top: 1rem;<?php echo e(strpos($name, '_en') !== false?'direction:ltr;text-align: left;':''); ?> " <?php echo e(strpos($name, '_en') !== false?'dir="ltr"':''); ?>>
    <label for="<?php echo e($name); ?>"><?php echo e($text); ?> </label>
    <textarea <?php echo e(isset($not_req)?'':'required'); ?> name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" class="editor" rows="<?php echo e(isset($rows)?$rows:5); ?>" placeholder="<?php echo e(isset($placeholder)?$placeholder:$text); ?>"><?php

                  echo old($name,isset($data)?$data:null ,"");


                 ?></textarea>

    
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>

</div>
<?php $__env->startSection('area_scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('area_scripts'); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#<?php echo e($name); ?>' ), {

            toolbar: {
                items: [
                    'heading',
                    '|',
                    'fontSize',
                    'fontColor',
                    'alignment',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'mediaEmbed',
                    'undo',
                    'redo',
                    'exportPdf',
                    'exportWord'
                ]
            },
            language: "<?php echo e(strpos($name, '_en') === false?'ar':'en'); ?>",
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;








        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: xcs2esji16m9-tqzhsy8f19xk' );
            console.error( error );
        } );


</script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/components/area_editor.blade.php ENDPATH**/ ?>