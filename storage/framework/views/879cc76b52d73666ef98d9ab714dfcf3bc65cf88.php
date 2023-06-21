<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.stores.index'),'title'=>'المصممون'],

        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.stores.index'),'title'=>'المصممون'],

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
'Disname'=>'المصممون',
'Disinfo'=>'تعديل بيانات مصمم ',
'add_url'=>route('system.stores.do.update',$out->id),
'back_url'=>'system.stores.index',
'action'=>'edit',


]); ?>
       <div class="row">
           <div class="col-10">
               <div class="row">

                   <div class="col-md-6">
                       <?php $__env->startComponent('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم باللغة العربية','icon'=>'fa-user-alt']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   <div class="col-md-6">
                       <?php $__env->startComponent('components.input',['data'=>$out->name_en,'name'=>'name_en','text'=>'الاسم باللغة الانجليزية','placeholder'=>'ادخل الاسم باللغة الانجليزية','icon'=>'fa-user-alt']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   <div class="w-100"></div>

                   <div class="col-md-6">
                       <?php $__env->startComponent('components.input',['data'=>substr($out->mobile, 3, 12),'name'=>'mobile','text'=>'الجوال','placeholder'=>'ادخل رقم الجوال','not_req'=>true]); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>

                   <div class="col-md-6">
                    <?php $__env->startComponent('components.input', ['name' => 'commission','data'=> $out->commission,'type' =>'number', 'text' => 'نسبة عمولة البرناج', 'placeholder' => '%', 'icon' => 'fa-user-alt']); ?>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                   <div class="w-100"></div>
               </div>

               <div class="row">

                   <div class="col-md-4">
                       <?php $__env->startComponent('components.input',['data'=>$out->whatsapp,'name'=>'whatsapp','text'=>'واتس آب','not_req'=>true , 'hint'=>'966595341355','icon'=>'fa-user-alt']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   <div class="col-md-4">
                       <?php $__env->startComponent('components.input',['data'=>$out->instagram,'name'=>'instagram','text'=>'انستاجرام','not_req'=>true , 'hint'=>'username','icon'=>'fa-user-alt']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>

                   <div class="col-md-4">
                       <?php $__env->startComponent('components.input',['data'=>$out->snapchat,'name'=>'snapchat','text'=>'سناب شات','not_req'=>true , 'hint'=>'username','icon'=>'fa-user-alt']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   <div class="w-100"></div>


                   <div class="w-100"></div>
               </div>

               <div class="row">
                   <div class="col-md-12">
                       <?php $__env->startComponent('components.area_editor',['data'=>$out->return_policy_ar,'name'=>'return_policy_ar','text'=>'سياسة الارجاع باللغة العربية ']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   <div class="w-100"></div>
                   <div class="col-md-12">
                       <?php $__env->startComponent('components.area_editor',['data'=>$out->return_policy_en,'name'=>'return_policy_en','text'=>'سياسة الارجاع باللغة بالانجليزية ']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   <div class="w-100"></div>
               </div>


           </div>
           <div class="col-md-2">
                   <?php $__env->startComponent('components.upload_image',['data'=>$out->logo,'name'=>'logo','text'=>'شعار المتجر','hint'=>'60 * 60 بيكسل']); ?>
                   <?php echo $__env->renderComponent(); ?>
           </div>
           
            <div class="col-md-6">
                      
 <?php $__env->startComponent('components.input',['data'=>$out->ordering,'name'=>'ordering','text'=> 'الترتيب','placeholder'=>'الترتيب','icon'=>'fa fa-sort icon-lg']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
           <div class="clearfix"></div>
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



    </script>



<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/update.blade.php ENDPATH**/ ?>