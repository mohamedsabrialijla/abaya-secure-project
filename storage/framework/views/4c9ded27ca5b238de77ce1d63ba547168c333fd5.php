<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'السلايدرز'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'السلايدرز'],
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
        'Disname' => 'السلايدرز',
        'Disinfo' => 'تعديل بيانات السلايدر ',
        'add_url' => route('system.sliders.do.update', $out->id),
        'back_url' => 'system.sliders.index',
        'action' => 'edit',
        ]); ?>
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col-md-6">
                        
                        <?php $__env->startComponent('components.upload_image',['data'=>$out->image,'name'=>'image','text' => 'صورة السلايدر','hint'=>'']); ?>
                   <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="col-md-6 d-flex flex-stack mb-8">
                        <!--begin::Label-->
                        <div class="me-5">
                            <label class="fs-6 fw-bold">قابل للنقر</label>
                            <div class="fs-7 fw-bold text-muted">إمكانية الانتقال الي منتجات السلايدر</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="clickable" type="radio" value="1" <?php if($out->clickable == 1): ?> checked="checked"
                            <?php endif; ?> >
                            <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>
                            <hr>
                            <input class="form-check-input" name="clickable" type="radio" value="0" <?php if($out->clickable == 0): ?> checked="checked"
                            <?php endif; ?>>
                            <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>
                        </label>
                        <!--end::Switch-->
                    </div>
                    <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">المنتجات</span>

                        </label>
                        <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار المنتجات"
                            data-allow-clear="true" multiple="multiple" name="products[]">
                            <option></option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>" <?php if($out->products->contains('id', $product->id)): ?> selected <?php endif; ?>><?php echo e($product->name_ar); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">الاقسام</span>

                        </label>
                        <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار القسم"
                            data-allow-clear="true" multiple="multiple" name="cats[]">
                            <option></option>
                            <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name_ar); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="clearfix"></div>
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
            </script>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/sliders/update.blade.php ENDPATH**/ ?>