<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.splash.index'),'title'=>'شاشة السبلاش']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.splash.index'),'title'=>'شاشة السبلاش']
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>


    <?php $__env->startComponent('components.AddEditCard',[
'Disname'=>' شاشة السبلاش',
'Disinfo'=>'تعديل بيانات شاشة السبلاش',
'add_url'=>route('system.splash.update'),
"back_url"=>'system.settings.index',
'action'=>'edit',


]); ?>

        <div class="row justify-content-center">


            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>@$splash_promotion_text_ar,'name'=>'splash_promotion_text_ar','text'=>'النص الترويجي عربي ','placeholder'=>'النص الترويجي عربي','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$splash_promotion_text_en,'name'=>'splash_promotion_text_en','text'=>'النص الترويجي انجليزي','placeholder'=>'النص الترويجي انجليزي','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>


        </div>

        <div class="row mt-5">


            <div class="col-md-6">


                <div class="row">
                    <br/>
                    <div class="col-md-12 mt-5">

                        <div class="d-flex justify-content-end">


                            <button type="button"
                                    class="<?php echo e(config('layout.classes.warning')); ?>  mt-2 updateSliderImage"
                                    title="اضافة صورة سبلاش جديدة"
                                    data-token="<?php echo e(csrf_token()); ?>"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    data-placement="top"
                            >
                                <i class="fa fa-gift "></i>

                                إضافة صورة جديدة
                            </button>


                        </div>
                    </div>

                </div>


                <table class="table table-hover mt-5">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>العمليات</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $splashImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td>
                                <img src="<?php echo e($image->image_url); ?>" class="img_table" alt="">
                                <?php echo e($image->name); ?>


                            </td>
                            <td>
                                <?php if(count($splashImages)>1): ?>
                                <button type="button"
                                        data-id="<?php echo e($image->id); ?>"
                                        data-url="<?php echo e(route('system.splash.delete.image')); ?>"
                                        data-token="<?php echo e(csrf_token()); ?>"
                                        data-toggle="tooltip" data-theme="dark" title="حذف"
                                        class="<?php echo e(config('layout.classes.delete')); ?>  mt-2 btn-del">
                                    <i class="<?php echo e(config('layout.icons.delete_icon')); ?>"></i>
                                    حذف
                                </button>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>


    <?php echo $__env->renderComponent(); ?>




    <div class="modal" id="updatesliderModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title"> صورة المنتج</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">
                            <?php echo csrf_field(); ?>
                            <?php $__env->startComponent('components.upload_media',['name'=>'splash_image','text'=>'صورة السبلاش ','id'=>'splash_image']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="splash_image_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                                class="btn m-btn--pill m-btn--air btn-primary m-btn m-btn--custom  btn-action-7 "
                                id="sliderImageUpdateBtn">
                            <span>حفظ</span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- END PAGE BASE CONTENT -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>

    <script>

        $(function () {



        });

        $('.updateSliderImage').click(function () {



            slider();

        });
        function slider(product_id) {

            $("#updatesliderModal").modal('show');

            $('#sliderImageUpdateBtn').click(function (e) {
                e.preventDefault();
                var splash_image =$('input[name=splash_image]').val();
                var token = '<?php echo e(csrf_token()); ?>';

                var url = '<?php echo e(route('system.splash.add.image')); ?>';

                $.post(url, {
                        _token: token,
                        splash_image: splash_image,

                    },

                    function (data, status) {
                        if (data) {
                            $("#updatesliderModal").modal('hide');
                            location.reload();
                        } else {
                            alert('هناك خطأ ما');
                        }
                    })
                    .fail(function (data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function (key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        });//end each
                    });

            });
        }
    </script>



<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/settings/splash.blade.php ENDPATH**/ ?>