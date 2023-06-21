<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.products.index'), 'title' => 'الطلبات'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.products.index'), 'title' => 'الطلبات'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>


<!--ldklkdlgfkldhl-->
    <?php $__env->startComponent('components.ShowCard', [
        'Disname' => 'الطلبات',
        'Disinfo' => 'مشاهدة الطلبات',
        'module' => 'products',
        'store_id' => @$storeId,
        'actions' => [
       
        ],
        ]); ?>
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">

                        <?php $__env->startComponent('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'غير مدفوع', 0 => 'مدفوع']]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        
                        <?php $__env->startComponent('components.serach.dateRanger'); ?>
                        <?php echo $__env->renderComponent(); ?>
                        
                        <?php $__env->startComponent('components.serach.inputwithsearch', ['inputs' => ['name' => 'اسم الحالة']]); ?>
                        <?php echo $__env->renderComponent(); ?>

                        <a href="<?php echo e(route('system.products.index')); ?>" class="<?php echo e(config('layout.classes.delete')); ?> mb-4 ml-5">
                            <i class="fa fa-refresh"></i> تفريغ
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <?php if(isset($out) && count($out) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>


                            <th>رقم الفاتورة</th>
                            <th class="text-right">التاريخ</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">الحجم</th>
                            <th class="text-center">الزبون</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="TR_<?php echo e($o->id); ?>">
<!--dfjghdfk-->
                                <td class="LOOPIDS"><a href="<?php echo e(url('admin/system/orders/details/'.$o->order->id)); ?>"><?php echo e($o->order->invoice_number); ?></a></td>
                               
                                <td class="text-right">
                                    <?php echo e($o->order->created_at->format('Y-m-d')); ?>

                                </td>
                                <td class="text-center"> <?php echo e(@$o->order->status->name_ar); ?></td>
                              
                                <td class="text-center"> <?php echo e(@$o->size->name); ?></td>
                                <td class="text-center"> <?php echo e(@$o->order->customer->mobile); ?></td>
                                
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


            <?php echo $out->appends(Request::except('page'))->links(); ?>

        <?php else: ?>
            <div class="note note-info">
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal" id="updateFeature" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">تعديل</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->


            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function() {
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price_from: {
                        number: true
                    },
                    price_to: {
                        number: true
                    }
                }
                /*,
                                message:{
                                   title: 'يجب ادخال ارقام فقط',
                                }*/
            }).init();


        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {

            $('.productActive').change(function() {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '<?php echo e(route('system.products.change_is_active')); ?>',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        'is_active': is_active,
                        'id': id
                    },
                    success: function(data) {

                    }
                });
            });


        });
    </script>

    <script>
        // var product_id = 0;

        $('.update').click(function() {

            let product_id = $(this).data('id');
            let AnnotationAr = $(this).data('ar');
            let AnnotationEn = $(this).data('en');

            feature(product_id, AnnotationAr, AnnotationEn);

        });
        $('.updateSliderImage').click(function() {

            let product_id = $(this).data('id');


            slider(product_id);

        });

        function slider(product_id) {

            $("#updatesliderModal").modal('show');

            $('#sliderImageUpdateBtn').click(function(e) {
                e.preventDefault();
                var slider_image = $('input[name=slider_image]').val();
                var token = '<?php echo e(csrf_token()); ?>';

                var url = '<?php echo e(route('system.slider.update')); ?>';

                $.post(url, {
                            _token: token,
                            id: product_id,
                            slider_image: slider_image,

                        },

                        function(data, status) {
                            if (data) {
                                $("#updatesliderModal").modal('hide');
                                location.reload();
                            } else {
                                alert('هناك خطأ ما');
                            }
                        })
                    .fail(function(data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function(key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        }); //end each
                    });

            });
        }

        function feature(product_id, AnnotationAr, AnnotationEn) {
            $('#annotation_ar').val(AnnotationAr);
            $('#annotation_en').val(AnnotationEn);
            $("#updateFeature").modal('show');

            $('.feature').click(function(e) {
                e.preventDefault();

                var annotation_ar = $('input[name=annotation_ar]');
                var annotation_en = $('input[name=annotation_en]');

                var token = '<?= csrf_token() ?>';

                var urll = '<?php echo e(route('system.featureProducts.update')); ?>';

                $.post(urll, {
                            _token: token,
                            id: product_id,
                            annotation_ar: annotation_ar.val(),
                            annotation_en: annotation_en.val(),

                        },

                        function(data, status) {

                            if (data) {
                                $("#updateFeature").modal('hide');
                                location.reload();

                            } else {

                                alert('هناك خطأ ما');

                            }

                        })
                    .fail(function(data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function(key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        }); //end each
                    });


            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/products/orders.blade.php ENDPATH**/ ?>