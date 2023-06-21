<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.products.index'), 'title' => 'المنتجات'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.products.index'), 'title' => 'المنتجات'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>




    <?php $__env->startComponent('components.ShowCard', [
        'Disname' => 'المنتجات',
        'Disinfo' => 'ادارة المنتجات',
        'add_url' => 'system.products.create',
        'excel' => 'storeproductsexport',
        'module' => 'products',
        'store_id' => @$storeId,
        'actions' => [
        [
        'route' => 'system.products.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        [
        'route' => 'system.products.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.products.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
        ],
        ],
        ]); ?>
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">

                        <?php $__env->startComponent('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'مفعل', 0 => 'معطل']]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.serach.select', ['key' => 'category_id', 'text' => 'بحث حسب التصنيف', 'select' =>
                            $categories]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.serach.input', ['type' => 'number', 'min' => 0, 'inputs' => ['price_from' =>
                            'السعر من', 'price_to' => 'السعر الى']]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.serach.inputwithsearch', ['inputs' => ['name' => 'اسم المنتج']]); ?>
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


                            <th>#</th>
                            <th width="5%" style="text-align: center;vertical-align: middle;">
                                <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                    <input type="checkbox" id="SelectAll">
                                    <span></span>
                                </label>


                            </th>
                            <th class="text-right">الإسم</th>
                            <th class="text-center">التصنيف</th>
                            <th class="text-center">المصمم</th>
                            <th class="text-center">السعر</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ الاضافة</th>
                            <th class="text-center">الإعدادات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="TR_<?php echo e($o->id); ?>">

                                <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                        <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                                            id="che_<?php echo e($o->id); ?>">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-right">
                                    <img src="<?php echo e($o->image_url); ?>" class="img_table" alt="">
                                    <?php echo e($o->name); ?>

                                </td>
                                <td class="text-center"> <?php echo e(@$o->category->name); ?></td>
                                <td class="text-center"> <?php echo e(@$o->store->name); ?></td>
                                <td class="text-center">
                                    <?php if($o->has_discount): ?>
                                        <span class="old_price"><?php echo e($o->real_price); ?></span> <span
                                            class="new_price"><?php echo e($o->price); ?>

                                            <?php echo e(\App\Models\Settings::get('currency_ar')); ?></span>
                                    <?php else: ?>
                                        <?php echo e($o->price); ?> <?php echo e(\App\Models\Settings::get('currency_ar')); ?>

                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?php if(auth('system_admin')->user()->can('activate_products', 'system_admin')): ?>
                                        <span class="switch switch-icon">
                                            <label>
                                                <input type="checkbox" class="productActive" id="is_active"
                                                    data-id="<?php echo e($o->id); ?>" name="is_active"
                                                    <?php echo e($o->is_active === 1 ? 'checked="checked"' : ''); ?> />
                                                <span></span>
                                            </label>
                                        </span>
                                    <?php else: ?>
                                        <?php if($o->is_active == 1): ?>
                                            <span class="m--font-success"> مفعل </span>
                                        <?php elseif($o->is_active == 0): ?>
                                            <span class="m--font-warning"> غير مفعل </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"> <?php echo e(@$o->created_at->toDateString()); ?></td>
                                <td class="text-center">

                                    <ul class="list-inline">

                                        <?php if(auth('system_admin')->user()->can('edit_products', 'system_admin')): ?>
                                            <li>

                                                <?php if($o->is_feature == 0): ?>
                                                    <button type="button"
                                                        class="<?php echo e(config('layout.classes.warning')); ?>  mt-2 update"
                                                        title="<?php echo e($o->is_feature == 1 ? 'اخفاء المنتج من قائمة منتجات المميزة' : 'عرض المنتج في قائمة منتجات المميزة'); ?>"
                                                        data-ar="<?= $o->annotation_ar ?>" data-en="<?= $o->annotation_en ?>"
                                                        data-id="<?= $o->id ?>"
                                                        data-url="<?php echo e(route('system.featureProducts.update')); ?>"
                                                        data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top">
                                                        <i class="fa fa-gift "></i>

                                                        عرض
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" data-id="<?= $o->id ?>"
                                                        data-url="<?php echo e(route('system.featureProducts.change_show_feature_product')); ?>"
                                                        data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top"
                                                        title="<?php echo e($o->is_feature == 1 ? 'اخفاء المنتج من قائمة منتجات المميزة' : 'عرض المنتج في قائمة منتجات المميزة'); ?>"
                                                        class="<?php echo e(config('layout.classes.edit')); ?> mt-2 btn-doAction">

                                                        <i class="fa fa-gift "></i>

                                                        اخفاء

                                                    </button>
                                                <?php endif; ?>

                                            </li>

                                            <li>

                                                <?php if($o->show_in_slider == 0): ?>
                                                    <button type="button"
                                                        class="<?php echo e(config('layout.classes.warning')); ?>  mt-2 updateSliderImage"
                                                        title="عرض المنتج في قائمة السلايدر" data-id="<?= $o->id ?>"
                                                        data-url="<?php echo e(route('system.featureProducts.update')); ?>"
                                                        data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top">
                                                        <i class="fa fa-gift "></i>

                                                        عرض
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" data-id="<?= $o->id ?>"
                                                        data-url="<?php echo e(route('system.sliderProducts.change_show_in_slider')); ?>"
                                                        data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top"
                                                        title="<?php echo e($o->show_in_slider == 1 ? 'اخفاء المنتج من قائمة منتجات السلايدر' : 'عرض المنتج في قائمة منتجات السلايدر'); ?>"
                                                        class="<?php echo e(config('layout.classes.edit')); ?> mt-2 btn-doAction">

                                                        <i class="fa fa-eye "></i>

                                                        اخفاء

                                                    </button>
                                                <?php endif; ?>

                                            </li>

                                            <li>


                                                <a class="<?php echo e(config('layout.classes.edit')); ?> mt-2"
                                                    href="<?php echo e(route('system.products.sizes', $o->id)); ?>">
                                                    <i class="fa fa-file "></i>
                                                    المقاسات
                                                </a>

                                            </li>
                                            <li>
                                                <a href="<?php echo e(route('system.products.update', $o->id)); ?>"
                                                    class="<?php echo e(config('layout.classes.edit')); ?> mt-2" data-toggle="tooltip"
                                                    data-theme="dark" title="تعديل البيانات">
                                                    <i class="fa fa-edit"></i> تعديل </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(auth('system_admin')->user()->can('delete_products', 'system_admin')): ?>
                                            <li>
                                                <button type="button" data-id="<?= $o->id ?>"
                                                    data-url="<?php echo e(route('system.products.delete')); ?>"
                                                    data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip" data-theme="dark"
                                                    title="حذف" class="<?php echo e(config('layout.classes.delete')); ?>  mt-2 btn-del">
                                                    <i class="<?php echo e(config('layout.icons.delete_icon')); ?>"></i>
                                                    حذف
                                                </button>
                                            </li>
                                        <?php endif; ?>


                                    </ul>

                                </td>
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

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">

                            <?php $__env->startComponent('components.input', ['name' => 'annotation_ar', 'text' => 'نص المنتج المميز
                                بالعربية', 'not_req' => true, 'id' => 'annotation_ar']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="annotation_ar_error"></span>
                            <?php $__env->startComponent('components.input', ['name' => 'annotation_en', 'text' => 'نص المنتج المميز
                                بالانجليزية', 'not_req' => true, 'id' => 'annotation_en']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="annotation_en_error"></span>
                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                            class="btn m-btn--pill m-btn--air btn-danger m-btn m-btn--custom  btn-action-7 feature">
                            <span>تعديل</span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="modal" id="updatesliderModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">عرض المنتج في السلايدر</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">
                            <?php echo csrf_field(); ?>
                            <?php $__env->startComponent('components.upload_image', ['name' => 'slider_image', 'text' => 'صورة الغلاف ', 'id'
                                => 'slider_image']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="slider_image_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                            class="btn m-btn--pill m-btn--air btn-primary m-btn m-btn--custom  btn-action-7 "
                            id="sliderImageUpdateBtn">
                            <span>عرض في السلايدر</span>

                        </button>

                    </div>

                </div>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/products.blade.php ENDPATH**/ ?>