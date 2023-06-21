<div class="form-group m-form__group 
            <?php


                if ($errors->has('<?php echo e($name); ?>')){
                    echo "has_error"  ;
                }


            ?>">
    <label for="<?php echo e($name); ?>"><?php echo e($text); ?> </label>
    <select name="<?php echo e($name); ?>" class="selWithAdd" style="width: 100%;" id="<?php echo e($name); ?>"
            <?php echo e(isset($not_req)?'':'required'); ?> data-addurl="<?php echo e($add_url); ?>" data-token="<?php echo e(csrf_token()); ?>" >
        <?php if(!isset($no_def)): ?>
            <option value="0"><?php echo e(isset($placeholder)?$placeholder:$text); ?></option>
        <?php endif; ?>

        <?php $__currentLoopData = $select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($s->id); ?>" <?php echo e(old($name,isset($data)?$data:null)==$s->id?'selected':''); ?>><?php echo e($s->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>

    <input type="hidden" name="RetSelect" class="RetSelect">
    
            <?php


                if ($errors->has($name)){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first($name).'</strong></span>'  ;
                }


            ?>

</div>
<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script>
        $(function (){
            $("body").on('change', ".selWithAdd",

                function () {


                    if($(this).val() === 'AddNewToList'){
                        var select = $(this);

                        $('.RetSelect').val(select.attr('id'));

                        $('#name_ar_to_add').val('');

                        $('#name_en_to_add').val('');

                        $('#AddNewModal').modal('show');
                        select.val(0).trigger('change');


                    }


                });
            $("body").on('click', '.btn_addToList',

                function () {

                    var selecttxt = $('.RetSelect').val();

                    var select = $('#' + selecttxt);

                    var url = select.data('addurl');

                    var token = select.data('token');

                    var name = $('#name_ar_to_add').val();

                    var name_en = $('#name_en_to_add').val();


                    if (name == '') {

                        alert('الرجاء ادخال الاسم');

                        return;

                    }

                    if (name_en == '') {

                        alert('Please enter the name');

                        return;

                    }


                    $.post(url,

                        {

                            _token: token,

                            name_ar: name,

                            name_en: name_en,


                        },

                        function (data, status) {

                            if (data.done == 1) {

                                select.html(data.out).trigger('change');

                                $('#AddNewModal').modal('hide');

                                Swal.fire({

                                    title: 'تمت الاضافة بنجاح',

                                    text: 'تمت الاضافة بنجاح',

                                    icon: 'success',

                                    timer: 2000,

                                    showConfirmButton: false

                                })

                                $('#name_ar_to_add').val('');

                                $('#name_en_to_add').val('');




                            } else {


                                Swal.fire({

                                    title: 'حدث خطأ ما',

                                    text: 'خطأ مجهول',

                                    icon: 'error',

                                    timer: 4000,

                                    showConfirmButton: false

                                })


                            }

                        })


                });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/selectWithAdd.blade.php ENDPATH**/ ?>