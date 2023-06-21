
<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories.index'),'title'=>'التصنيفات']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories.index'),'title'=>'التصنيفات']
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
'Disname'=>'التصنيفات',
'Disinfo'=>'تعديل بيانات تصنيف',
'add_url'=>route('system.categories.do.update',$out->id),
'back_url'=>'system.categories.index',
'action'=>'edit',


]); ?>

        <div class="row justify-content-center">
            <div class="col-md-3">
                <?php $__env->startComponent('components.upload_image',['data'=>$out->logo,'name'=>'image','text'=>'صورة التصنيف','hint'=>'60 * 60 بيكسل']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'اسم التصنيف بالعربية','placeholder'=>'ادخل اسم التصنيف بالعربية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'اسم التصنيف بالانجليزية','placeholder'=>'ادخل اسم التصنيف بالانجليزية','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="w-100"></div>
 
        
            <div class="col-md-6">
                <label>يرجى اضافة المنتجات </label>
               <select class="js-example-basic-multiple col-md-12" name="products[]" multiple="multiple">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option <?php if(isset($out->product_selected) && $out->product_selected != '' && in_array($p->id,$out->product_selected)): ?> selected <?php endif; ?> value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <!--نملنمبلن-->
                 <!--<div class="col-md-7 d-flex flex-stack mb-12">-->
                        <!--begin::Label-->
                 <!--       <div class="me-5">-->
                 <!--           <label class="fs-6 fw-bold">قسم بعرض الصفحة</label>-->
                 <!--           <div class="fs-7 fw-bold text-muted">يتيح لك هذه الخاصية بعرض القسم كاملا بعرض الصفحة </div>-->
                 <!--       </div>-->
                        <!--end::Label-->
                        <!--begin::Switch-->
                 <!--       <label class="form-check form-switch form-check-custom form-check-solid">-->
                 <!--           <input class="form-check-input" name="full_width" type="radio" value="1" <?php if($out->full_width == 1): ?> checked="checked"-->
                 <!--           <?php endif; ?> >-->
                 <!--           <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>-->
                 <!--           <hr>-->
                 <!--           <input class="form-check-input" name="full_width" type="radio" value="0" <?php if($out->full_width == 0): ?> checked="checked"-->
                 <!--           <?php endif; ?>>-->
                 <!--           <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>-->
                 <!--       </label>-->
                        <!--end::Switch-->
                 <!--   </div>-->


               
        </div>


    <?php echo $__env->renderComponent(); ?>

 





    <!-- END PAGE BASE CONTENT -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>

    <script>

        $(function () {

            $('#form').validate({

                errorElement: 'div', //default input error message container

                errorClass: 'abs_error help-block has-error',

            }).init();

        })


 

$(".js-example-basic-multiple").select2({
    placeholder: "يرجى اضافة المنتجات",
    allowClear: true
});

    </script>



<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/categories/update.blade.php ENDPATH**/ ?>