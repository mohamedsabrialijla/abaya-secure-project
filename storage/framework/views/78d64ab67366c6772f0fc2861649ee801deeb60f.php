<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.featureProducts.index'),'title'=>'المنتجات المميزة']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.featureProducts.index'),'title'=>'المنتجات المميزة']
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>




    <?php $__env->startComponent('components.ShowCard',[
   'Disname'=>'المنتجات المميزة',
   'Disinfo'=>'ادارة المنتجات المميزة',
   'add_url'=>null,
   'module'=>'products',
   'actions'=>[

   ]
   ]); ?>

        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">























            </div>


        </div>

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


                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('feature-products', [])->html();
} elseif ($_instance->childHasBeenRendered('F26uhHu')) {
    $componentId = $_instance->getRenderedChildComponentId('F26uhHu');
    $componentTag = $_instance->getRenderedChildComponentTagName('F26uhHu');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('F26uhHu');
} else {
    $response = \Livewire\Livewire::mount('feature-products', []);
    $html = $response->html();
    $_instance->logRenderedChild('F26uhHu', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </table>
            </div>
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

                                <?php echo csrf_field(); ?>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <?php $__env->startComponent('components.upload_image',['name'=>'feature_image','text'=>'الصورة المميزة','hint'=>'60 * 60 بيكسل','id'=>'annotation_image']); ?>
                                <?php echo $__env->renderComponent(); ?>
                                <span class="text-danger" id="annotation_image_error"></span>
                            </div>
                            <div class="w-100"></div>
                            <?php $__env->startComponent('components.input',['name'=>'annotation_ar' ,'text'=>'نص المنتج المميز بالعربية','not_req'=>true,'id'=>'annotation_ar']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="annotation_ar_error"></span>

                            <?php $__env->startComponent('components.input',['name'=>'annotation_en' ,'text'=>'نص المنتج المميز بالانجليزية','not_req'=>true,'id'=>'annotation_en']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="annotation_en_error"></span>
                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                                class="btn m-btn--pill m-btn--air btn-danger m-btn   " id="update-feature-product"
                                >
                            <span>تعديل</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
<?php echo \Livewire\Livewire::scripts(); ?>

<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    <script>
        $(function () {
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
                }/*,
                message:{
                   title: 'يجب ادخال ارقام فقط',
                }*/
            }).init();


        });

    </script>

    <script>

        var product_id=0;
        $('.update').click(function () {

            product_id= $(this).data('id');
            let AnnotationAr = $(this).data('ar');
            let AnnotationEn = $(this).data('en');
            let feature_image = $(this).data('feature');

            // console.log(product_id, AnnotationAr, AnnotationEn, feature_image)
            console.log(feature_image);
            feature(product_id, AnnotationAr, AnnotationEn,feature_image);

        });

        function feature(product_id, AnnotationAr, AnnotationEn,feature_image) {
            $('#annotation_ar').val(AnnotationAr);
            $('#annotation_en').val(AnnotationEn);
            $('.MyImagePrivew').attr("src", feature_image);

            $("#updateFeature").modal('show');


        }
        $('#update-feature-product').click(function (e) {
            e.preventDefault();

            var annotation_ar = $('input[name=annotation_ar]');
            var annotation_en = $('input[name=annotation_en]');
            // var feature_image = $('img[csr=feature_image]');
            var feature_image =$('input[name=feature_image]').val();
            var token = '<?php echo e(csrf_token()); ?>';

            var url = '<?php echo e(route('system.featureProducts.update')); ?>';

            $.post(url, {
                    _token: token,
                    id: product_id,
                    feature_image: feature_image,
                    annotation_ar: annotation_ar.val(),
                    annotation_en: annotation_en.val(),
                },

                function (data, status) {
                    if (data) {
                        $("#updateFeature").modal('hide');
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

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/products/features.blade.php ENDPATH**/ ?>