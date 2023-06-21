<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.notifications.index'), 'title' => 'الاشعارات'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.notifications.index'), 'title' => 'الاشعارات'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/onesignal-emoji/css/emoji.css')); ?>">
    <style>
        .emoji-menu .emoji-items a {
            margin: -1px 0 0 -1px;
            padding: 6px;
            display: block;
            float: right;
            border-radius: 2px;
            border: 0;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>


    <?php $__env->startComponent('components.AddEditCard',
        [
            'Disname' => 'الاشعارات',
            'Disinfo' => 'اضافة اشعار جديد',
            'add_url' => route('system.notifications.do.create'),
            'back_url' => 'system.notifications.index',
            'action' => 'add',
        ]); ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="form-group 
            <?php


                if ($errors->has('title')){
                    echo "has_error"  ;
                }


            ?>">
                            <label for="title">العنوان</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control" data-emojiable="true" placeholder="العنوان" required
                                    name="title_with_imoje" value="<?php

                  echo old('title_with_imoje' ,"");


                 ?>" id="title">
                            </div>
                            
            <?php


                if ($errors->has('title')){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first('title').'</strong></span>'  ;
                }


            ?>

                        </div>

                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group 
            <?php


                if ($errors->has('name')){
                    echo "has_error"  ;
                }


            ?>">
                            <label for="name">إضافة اسم العميل لعنوان الاشعار</label>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="name" type="radio" value="0" checked="checked">
                                <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>
                                <br>
                                <input class="form-check-input" name="name" type="radio" value="1">
                                <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>
                            </label>
                            
            <?php


                if ($errors->has('name')){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first('name').'</strong></span>'  ;
                }


            ?>

                        </div>

                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group  
            <?php


                if ($errors->has('message')){
                    echo "has_error"  ;
                }


            ?>">
                            <label for="message">نص الاشعار </label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control" data-emojiable="true" placeholder="نص الاشعار"
                                    required name="message_with_imoje" value="<?php

                  echo old('message_with_imoje' ,"");


                 ?>" id="message">
                                
                            </div>
                            
            <?php


                if ($errors->has('message')){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first('message').'</strong></span>'  ;
                }


            ?>

                        </div>


                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group 
            <?php


                if ($errors->has('user_query')){
                    echo "has_error"  ;
                }


            ?>">
                            <label for="user_query">الفئة المستهدفة</label>
                            <div class="m-input-icon m-input-icon--left m-input-icon--right">
                                <div class="input-group">
                                    <select style="width: 100%;" name="user_query" id="user_query" required>
                                        <option value="0">الكل</option>
                                        <option value="1">حسابات غير مفعلة</option>
                                        <option value="2">حسابات بدون طلبات</option>
                                        

                                    </select>
                                </div>
                            </div>
                            
            <?php


                if ($errors->has('user_query')){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first('user_query').'</strong></span>'  ;
                }


            ?>

                        </div>


                    </div>
                    
                    
                    
                </div>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>


<?php $__env->stopSection(); ?>





<?php $__env->startSection('custom_scripts'); ?>
    <script src="<?php echo e(asset('admin/onesignal-emoji/js/config.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/onesignal-emoji/js/util.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/onesignal-emoji/js/jquery.emojiarea.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/onesignal-emoji/js/emoji-picker.js')); ?>"></script>
    <script>
        $(function() {

            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price: {
                        required: true,
                        number: true
                    }
                }

            }).init();
            $('#user_query').on('change', function() {
                let val = $(this).val();
                if (val == 3) {
                    $('.Users').show();
                } else {
                    $('.Users').hide();
                }
            })

        });
        $(function() {
            $(function() {
                // Initializes and creates emoji set from sprite sheet
                window.emojiPicker = new EmojiPicker({
                    emojiable_selector: '[data-emojiable=true]',
                    assetsPath: '<?php echo e(asset('admin/onesignal-emoji/img')); ?>',
                    popupButtonClasses: 'fa fa-smile'
                });
                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
                // It can be called as many times as necessary; previously converted input fields will not be converted again
                window.emojiPicker.discover();
                $('.emoji-picker-icon').css('top', '20px');
                $('.emoji-picker-icon').css('font-size', '1.8rem');
                $('.emoji-picker-icon').css('opacity', '0.4');
                $('.emoji-menu .emoji-items-wrap').css('height', '170px');
                $('.emoji-menu .emoji-items-wrap').css('overflow-y', 'auto');
                $('.emoji-menu .emoji-items-wrap').css('overflow-x', 'hidden');
            });
        });
    </script>
    <script type="text/javascript">
        // document.getElementById('MYimage_uploaded_file').addEventListener('change', readURL, true);
        // function readURL(){
        //
        //     var file = document.getElementById("MYimage_uploaded_file").files[0];
        //     var reader = new FileReader();
        //     reader.onloadend = function(){
        //         document.getElementById('MyImagePrivew').src =  reader.result ;
        //         document.getElementById('uploaded_image_name').value =  reader.result ;
        //
        //     }
        //     if(file){
        //         reader.readAsDataURL(file);
        //     }else{
        //     }
        // }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/notifications/create.blade.php ENDPATH**/ ?>