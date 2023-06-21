<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.coupons.index'), 'title' => 'كبونات الخصم'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.coupons.index'), 'title' => 'كبونات الخصم'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_content'); ?>

    <?php $__env->startComponent('components.AddEditCard', [
        'Disname' => 'كبونات الخصم',
        'Disinfo' => 'اضافة كبون خصم جديد',
        'add_url' => route('system.coupons.do.create'),
        'back_url' => 'system.coupons.index',
        'action' => 'add',
        ]); ?>
        <div class="row">

            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input', ['name' => 'code', 'text' => 'الكود', 'placeholder' => 'ادخل الكود']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.switch', ['name' => 'is_active', 'text' => 'حالة الكود']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input', ['name' => 'discount_ratio', 'text' => 'نسبة او قيمة الخصم', 'icon' => 'fa-percent']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-6 d-flex flex-stack mb-8">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-bold">طريقة الخصم</label>
                    <div class="fs-7 fw-bold text-muted">اختيار طريقة الخصم اما نسبة مئوية او مبلغ محدد</div>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" name="flag" type="radio" value="1" checked="checked">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نسبة مئوية</span></div>
                    <hr>
                    <input class="form-check-input" name="flag" type="radio" value="2" checked="">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">مبلغ محدد</span></div>
                    <hr>
                    <input class="form-check-input" name="flag" type="radio" value="3" checked="">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">خصم قيمة الشحن</span></div>
                </label>
                <!--end::Switch-->
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input', ['name' => 'limit', 'text' => 'الحد الادني لقيمة الطلب لتفعيل الكوبون', 'icon' => 'fa-dollar']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.switch', ['name' => 'show', 'text' => 'ظهور الكوبون تحت المنتج ']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>

            <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">المنتجات</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار المنتجات" data-allow-clear="true" multiple="multiple" name="products[]">
                    <option></option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name_ar); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">المنتجات بدلالة الأقسام</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار القسم" data-allow-clear="true" multiple="multiple" name="cats[]">
                    <option></option>
                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name_ar); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="w-100"></div>

            <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">المنتجات بدلالة المصممين</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار المصمم" data-allow-clear="true" multiple="multiple" name="stores[]">
                    <option></option>
                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($store->id); ?>"><?php echo e($store->name_ar); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input', ['name' => 'count_of_use', 'text' => 'عدد مرات الاستخدام']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.datepicker', ['name' => 'start_date', 'text' => 'تاريخ البداية']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.datepicker', ['name' => 'expire_date', 'text' => 'تاريخ الانتهاء']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>




        </div>
    <?php echo $__env->renderComponent(); ?>




    <!-- END PAGE BASE CONTENT -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function() {

            $('#form').validate({

                errorElement: 'div', //default input error message container

                errorClass: 'abs_error help-block has-error',


            }).init();

        })

        $('#start_date').datepicker();
        $('#expire_date').datepicker();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/coupons/create.blade.php ENDPATH**/ ?>