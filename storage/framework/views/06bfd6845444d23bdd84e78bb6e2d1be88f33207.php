<?php
    $Disname='الاعدادات';
    $Disinfo='الاعدادات الخاصة بالتطبيق ';
?>
<?php $__env->startSection('title',  $Disname); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.settings.index'),'title'=>'الاعدادات']
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.settings.index'),'title'=>'الاعدادات']
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("styles"); ?>
    <style>
        #sizes_image img {
            width:50% !important;
            height: 200px !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>


    <div class="card card-custom">
        <div class="card-header  card-header-tabs-line">
            <div class="card-title">
                <h3 class="card-label"><?php echo e($Disname); ?>

                    <div class="text-muted pt-2 font-size-sm"><?php echo e($Disinfo); ?></div>
                </h3>
            </div>
            <div class="card-toolbar">


                <ul class="nav nav-tabs nav-bold nav-tabs-line">








                    <li class="nav-item tabs__item">
                        <a class="nav-link  <?php echo e(count($errors)==0||$errors->has('currency_ar')||$errors->has('currency_en')||$errors->has('ios')||$errors->has('android')||$errors->has('bank_name')||$errors->has('iban') || (isset($active_tab) && $active_tab == 'tab1')?'active':''); ?>"
                           data-toggle="tab" href="#tab1">
                            اعدادات التطبيق
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link <?php echo e($errors->has('mobile')||$errors->has('email')||$errors->has('whatsapp')||$errors->has('instagram')||$errors->has('facebook')||$errors->has('twitter') || (isset($active_tab) && $active_tab == 'tab2')?'active':''); ?>"
                           data-toggle="tab" href="#tab2">
                            اعدادات التواصل
                        </a>

                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link <?php echo e($errors->has('internal_shipping_cost')||$errors->has('external_shipping_cost')|| (isset($active_tab) && $active_tab == 'tab6')?'active':''); ?>"
                           data-toggle="tab" href="#tab6">
                            اعدادات الشحن
                        </a>

                    </li>


                    <li class="nav-item m-tabs__item">
                        <a class="nav-link <?php echo e($errors->has('referral_register_points')||$errors->has('points_to_cash_one_sar')|| (isset($active_tab) && $active_tab == 'tab7')?'active':''); ?>"
                           data-toggle="tab" href="#tab7">
                            اعدادات النقاط
                        </a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link <?php echo e((isset($active_tab) && $active_tab == 'tab10')?'active':''); ?>"
                           data-toggle="tab" href="#tab10">
                         صورة المقاسات
                        </a>
                    </li>





<!--                    <?php if(Auth::guard('system_admin')->user()->id == 1): ?>
                        <li class="nav-item m-tabs__item ">
                            <a class="nav-link " href="<?php echo e(route('system.settings.system_settings')); ?>">
                                اعدادات النظام
                            </a>

                        </li>
                    <?php endif; ?>-->
                </ul>
            </div>

        </div>

        <div class="card-body">

            <div class="m-content">
                <div class="row">
                    <div class="col-lg-12">



                        <div class="tab-content">
                            <!--begin::Portlet-->





























                            <div
                                class="tab-pane <?php echo e((isset($active_tab) && $active_tab == 'tab10')?'active':''); ?>"
                                id="tab10" role="tabpanel">
                                <form action="<?php echo e(route('system.settings.updateImage')); ?>" method="post" id="form">

                                    <?php echo csrf_field(); ?>

                                <div class="col-md-12">

                                    <?php $__env->startComponent('components.uploadModalImage',['name'=>'sizes_image','data'=>HELPER::set_if($page['sizes_image']),'text'=>'صورة المقاسات ','hint'=>'اضغط على الصورة لرفع صورة جديدة','id'=>'sizes_image','imgStyle'=>"width:50%!important"]); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                    <span class="text-danger" id="slider_image_error"></span>

                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="col">
                                            <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                                                <i class="fa fa-check"></i>
                                                <span>تعديل</span>
                                            </button>
                                            <a href="<?php echo e(route('system_admin.dashboard')); ?>"
                                               class="<?php echo e(config('layout.classes.cancel')); ?>">
                                                <i class="la la-times"></i>
                                                <span>الغاء</span>
                                            </a>
                                        </div>

                                        <div class="clearfix"></div>
                                        </form>
                                </div>
                            </div>


                                <div
                                class="tab-pane <?php echo e(count($errors)==0||$errors->has('currency_ar')||$errors->has('currency_en')||$errors->has('ios')||$errors->has('android')||$errors->has('bank_name')||$errors->has('iban')|| (isset($active_tab) && $active_tab == 'tab1')?'active':''); ?>"
                                id="tab1" role="tabpanel">

                                <form action="<?php echo e(route('system.settings.add')); ?>" method="post" id="form">

                                    <?php echo csrf_field(); ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'project_name_ar','data'=>HELPER::set_if($page['project_name_ar']),'text'=>'اسم التطبيق باللغة العربية ','placeholder'=>'اسم التطبيق باللغة العربية','icon'=>'']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'project_name_en','data'=>HELPER::set_if($page['project_name_en']),'text'=>'اسم التطبيق باللغة الانجليزية','placeholder'=>'اسم التطبيق باللغة العربية','icon'=>'']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'currency_ar','data'=>HELPER::set_if($page['currency_ar']),'text'=>'العملة باللغة العربية ','placeholder'=>'ادخل العملة باللغة العربية','icon'=>'fa-dollar-sign']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'currency_en','data'=>HELPER::set_if($page['currency_en']),'text'=>'العملة باللغة الانجليزية','placeholder'=>'ادخل العملة باللغة الانجليزية','icon'=>'fa-dollar-sign']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'ios','data'=>HELPER::set_if($page['ios']),'text'=>'رابط التطبيق ايفون ','icon'=>'fa-globe']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'android','data'=>HELPER::set_if($page['android']),'text'=>'رابط التطبيق اندرويد','icon'=>'fa-globe']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'app_commission_ratio','data'=>HELPER::set_if($page['app_commission_ratio']),'text'=>" نسبة التطبيق من الطلبات %",'icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'return_max_day','data'=>HELPER::set_if($page['return_max_day']),'text'=>"عدد ايام ارجاع المنتج بعد الاستلام",'icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'random_from','data'=>HELPER::set_if($page['random_from']),'text'=>"الحد الادني للمشاهدات",'icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'random_to','data'=>HELPER::set_if($page['random_to']),'text'=>"الحد الاعلي للمشاهدات",'icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'tax','data'=>HELPER::set_if($page['tax']),'text'=>"نسبة الضريبة %",'icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>




                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        


                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="<?php echo e(route('system_admin.dashboard')); ?>"
                                           class="<?php echo e(config('layout.classes.cancel')); ?>">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>

                            <div
                                class="tab-pane <?php echo e($errors->has('mobile')||$errors->has('email')||$errors->has('whatsapp')||$errors->has('address')||$errors->has('facebook')||$errors->has('twitter')||$errors->has('snapchat')||$errors->has('instagram') || (isset($active_tab) && $active_tab == 'tab2')?'active':''); ?>"
                                id="tab2" role="tabpanel">

                                <form action="<?php echo e(route('system.settings.addMedia')); ?>" method="post" id="form">

                                    <?php echo csrf_field(); ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'mobile','data'=>HELPER::set_if($page['mobile']),'text'=>'جوال','placeholder'=>'ادخل الجوال بصيغة: 966595341355','icon'=>'fa-phone','hint'=>'966595341355']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'email','data'=>HELPER::set_if($page['email']),'text'=>'ايميل','placeholder'=>'ادخل الايميل','icon'=>'fa-envelope']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'whatsapp','data'=>HELPER::set_if($page['whatsapp']),'text'=>'واتساب','placeholder'=>'ادخل الواتساب بصيغة: 966595341355','icon'=>'fa-phone','hint'=>'966595341355']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'address','data'=>HELPER::set_if($page['address']),'text'=>'العنوان','placeholder'=>'ادخل العنوان','icon'=>'fa-map']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'facebook','data'=>HELPER::set_if($page['facebook']),'text'=>'فيس بوك','icon_pre'=>'fab ','icon'=>'fa-facebook','not_req'=>true]); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'twitter','data'=>HELPER::set_if($page['twitter']),'text'=>'رابط تويتر','placeholder'=>'ادخل رابط تويتر','icon_pre'=>'fab ','icon'=>'fa-twitter','not_req'=>true]); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'snapchat','data'=>HELPER::set_if($page['snapchat']),'text'=>'رابط سناب','placeholder'=>'ادخل رابط سناب شات','icon_pre'=>'fab ','icon'=>'fa-snapchat','not_req'=>true]); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'instagram','data'=>HELPER::set_if($page['instagram']),'text'=>'رابط انيستجرام','placeholder'=>'ادخل رابط انيستجرام ','icon_pre'=>'fab ','icon'=>'fa-instagram','not_req'=>true]); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="w-100"></div>

                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="<?php echo e(route('system_admin.dashboard')); ?>"
                                           class="<?php echo e(config('layout.classes.cancel')); ?>">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>

                            <div
                                class="tab-pane disabled <?php echo e($errors->has('internal_shipping_cost') || $errors->has('external_shipping_cost') || (isset($active_tab) && $active_tab == 'tab6')?'active':''); ?>"
                                id="tab6" role="tabpanel">

                                <form action="<?php echo e(route('system.settings.addShippingCost')); ?>" method="post" id="form">

                                    <?php echo csrf_field(); ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'internal_shipping_cost','data'=>HELPER::set_if($page['internal_shipping_cost']),'text'=>'تكلفة الشحن الداخلية','placeholder'=>'تكلفة الشحن الداخلية','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'external_shipping_cost','data'=>HELPER::set_if($page['external_shipping_cost']),'text'=>'تكلفة الشحن الخارجية','placeholder'=>'تكلفة الشخن الخارجية','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="<?php echo e(route('system_admin.dashboard')); ?>"
                                           class="<?php echo e(config('layout.classes.cancel')); ?>">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>

                            <div
                                class="tab-pane disabled <?php echo e($errors->has('referral_register_points') || $errors->has('points_to_cash_one_sar') || (isset($active_tab) && $active_tab == 'tab7')?'active':''); ?>"
                                id="tab7" role="tabpanel">

                                <form action="<?php echo e(route('system.settings.addPoints')); ?>" method="post" id="form">

                                    <?php echo csrf_field(); ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'referral_register_points','data'=>HELPER::set_if($page['referral_register_points']),'text'=>' عدد النقاط لكل طلب جديد','placeholder'=>' عدد النقاط لكل طلب جديد','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'points_to_cash_one_sar','data'=>HELPER::set_if($page['points_to_cash_one_sar']),'text'=>'عدد النقاط مقابل الريال الواحد','placeholder'=>'عدد النقاط مقابل الريال الواحد','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $__env->startComponent('components.input',['name'=>'promo_code_discount_ratio','data'=>HELPER::set_if($page['promo_code_discount_ratio']),'text'=>'نسبة الخصم من خصم عمولة التطبيق','placeholder'=>'نسبة الخصم من عمولة التطبيق','icon_pre'=>'fab ','icon'=>'','class'=>'isNumber']); ?>
                                            <?php echo $__env->renderComponent(); ?>
                                        </div>
                                    </div>


                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col">
                                        <button type="submit" class="<?php echo e(config('layout.classes.submit')); ?>">
                                            <i class="fa fa-check"></i>
                                            <span>تعديل</span>
                                        </button>
                                        <a href="<?php echo e(route('system_admin.dashboard')); ?>"
                                           class="<?php echo e(config('layout.classes.cancel')); ?>">
                                            <i class="la la-times"></i>
                                            <span>الغاء</span>
                                        </a>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/settings/index.blade.php ENDPATH**/ ?>