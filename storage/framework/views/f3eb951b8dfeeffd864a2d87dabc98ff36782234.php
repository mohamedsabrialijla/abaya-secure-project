<?php $__env->startSection('breadcrumbs'); ?>
    <x-breadcrumbs :breadcrumbs="[
    ['title'=>'الصفحة الرئيسية','page'=>route('system_admin.dashboard')],
    ['title'=>'المنتجات','page'=>route('system.products.index')],
    ]"

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>

    <?php $__env->startComponent('components.AddEditCard',[
'Disname'=>'المنتجات',
'Disinfo'=>'تعديل بيانات منتج ',
'add_url'=>route('system.products.do.update',$out->id),
'back_url'=>'system.products.index',
'action'=>'edit',


]); ?>


        <div class="row">
            
             <div class="col-md-6">
                      
                       <?php $__env->startComponent('components.input',['data'=>$out->ordering,'name'=>'ordering','text'=> 'الترتيب','placeholder'=>'الترتيب','icon'=>'fa fa-sort icon-lg']); ?>
                       <?php echo $__env->renderComponent(); ?>
                   </div>
                   
                   <div class="col-md-6"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->name_en,'name'=>'name_en','text'=>'Name in English','placeholder'=>'Enter the name','icon'=>'fa-user-alt']); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="w-100"></div>


            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.selectWithAdd',['data'=>$out->category_id,'name'=>'category_id','text'=>'التصنيف','select'=>$categories,'add_url'=>route('system.categories.createJson')]); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.selectWithAdd',['data'=>$out->store_id,'name'=>'store_id','text'=>'المصمم','select'=>$stores,'add_url'=>route('system.stores.createJson')]); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->price,'type'=>'number','min'=>0,'name'=>'price','text'=>'السعر','icon'=>'fa-dollar-sign']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.input',['data'=>$out->discount_ratio,'name'=>'ratio','text'=>'نسبة الخصم تترك 0 اذا لا يوجد خصم','icon'=>'fa-percent']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>

            <div class="w-100"></div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.area_editor',['data'=>$out->details_ar,'name'=>'details_ar','text'=>'التفاصيل']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.area_editor',['data'=>$out->details_en,'name'=>'details_en','text'=>'Details']); ?>
                <?php echo $__env->renderComponent(); ?>

            </div>



            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">المقاسات</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="<?php echo e(config('layout.classes.add')); ?> sizeid"
                                        data-toggle="modal" data-target="#size">
                                    <i class="la la-plus"></i>
                                    <span>اضافة جديد</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <div class="m-content">
                            <div class="row sizeValue">






                                    <?php $__currentLoopData = $sizeslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <input type="checkbox"
                                                           name="sizes[<?php echo e($key); ?>][id]"
                                                           <?php echo e(in_array($size->id,$product_sizes)?'checked':''); ?>

                                                           class="volumeData"
                                                           value="<?php echo e($size->id); ?>">
                                                    <?php echo e($size->name); ?>

                                                </div>


                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
            <?php


                if ($errors->has('sizes')){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first('sizes').'</strong></span>'  ;
                }


            ?>

                            </div>
                            <span></span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الألوان</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="<?php echo e(config('layout.classes.add')); ?> colorid"
                                        data-toggle="modal" data-target="#color">
                                    <i class="la la-plus"></i>
                                    <span>اضافة جديد</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row colorValue">
                                <?php $__currentLoopData = $colors_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-3"> <input type="checkbox" name="colors[]"  value="<?php echo e($color->id); ?>" <?php echo e(in_array($color->id,$product_colors)? 'checked':''); ?>>
                                        <?php echo e($color->name); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <span></span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6 mt-5">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">المخزون</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="m-content">

                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <?php $__currentLoopData = $out->productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item ">
                                        <a class="nav-link <?php echo e((isset($active_tab) && $active_tab=="tab".$key+1)?'active':$key==0?'active':''); ?>"
                                           data-toggle="tab" href="#tab<?php echo e($key+1); ?>">
                                            <?php echo e($size->size->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content">
                                <?php $__currentLoopData = $out->productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$productSize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane <?php echo e((isset($active_tab) && $active_tab=="tab".$key+1)?'active':$key==0?'active':''); ?> " id="tab<?php echo e($key+1); ?>" role="tabpanel">


                                        <div class="row mt-5">


                                            <div class="col-md-12" style="height: 200px; overflow: auto">


                                                <table class="table table-hover">
                                                    <thead class="table-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>المقاس</th>
                                                        <th>العملية</th>
                                                        <th>تاريخ العملية</th>
                                                        <th>الكمية</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php $__currentLoopData = $productSize->stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($key+1); ?></td>
                                                            <td><?php echo e($stock->productSize->size->name); ?></td>
                                                            <td><?php echo e($stock->type_label); ?></td>
                                                            <td><?php echo e(\Carbon\Carbon::parse($stock->created_at)->format('Y-m-d H:i:s')); ?></td>
                                                            <td><?php echo e($stock->qty); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="table-active">
                                                        <td colspan="4">
                                                            اجمالي الكمية المتوفرة
                                                        </td>
                                                        <td >
                                                            <?php echo e($productSize->qty()); ?>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="col-md-12">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.multiuploadupdate','data' => ['text' => ' صور المنتج','hint' => 'الرجاء اختيار حجم مناسب','name' => 'images','addroute' => 'system.products.upload_image','path' => 'system_admin.products.images','out' => $out]]); ?>
<?php $component->withName('multiuploadupdate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['text' => ' صور المنتج','hint' => 'الرجاء اختيار حجم مناسب','name' => 'images','addroute' => 'system.products.upload_image','path' => 'system_admin.products.images','out' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($out)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>


            <div class="w-100"></div>

            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="is_active">الحالة</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="is_active" name="is_active" <?php if(old('is_active',$out->is_active)): ?> checked <?php endif; ?>/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>

            </div>
            <div class="w-100"></div>
            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="show_in_slider">إضافة للأكثر مبيعا</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="show_in_slider" name="show_in_slider"
                                       <?php if(old('show_in_slider',$out->show_in_slider)): ?> checked <?php endif; ?>/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>

            </div>


            <div class="w-100"></div>

        
            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="is_feature">اضافة المنتج كمميز</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="is_feature_switch" name="is_feature"
                                       <?php if(old('is_feature',$out->is_feature)): ?> checked <?php endif; ?>/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="cod"> إتاحة الدفع عند الاستلام</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                
                                <input type="checkbox" id="" name="cod"
                                       <?php if(old('cod',$out->cod)): ?> checked <?php endif; ?>/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>

            </div>
            <div class="w-100"></div>
        </br>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5" id="annotation_ar" style="display:none">
                        <?php $__env->startComponent('components.input',['data'=>$out->annotation_ar,'name'=>'annotation_ar' ,'text'=>'نص المنتج المميز بالعربية','not_req'=>true]); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>

                    <div class="col-md-5" id="annotation_en" style="display:none">
                        <?php $__env->startComponent('components.input',['data'=>$out->annotation_en,'name'=>'annotation_en' ,'text'=>'نص المنتج المميز بالنجليزية','not_req'=>true]); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                    <div class="col-md-2" id="annotation_image" style="display:none">
                        <?php $__env->startComponent('components.upload_image',['data'=>$out->feature_image,'name'=>'feature_image','text'=>'الصورة المميزة','hint'=>'60 * 60 بيكسل']); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
            </div>
        </div>






    <?php echo $__env->renderComponent(); ?>


    <div id="size" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">المقاسات
                                <div class="text-muted pt-2 font-size-sm">
                                    اضافة مقاس جديد
                                </div>
                            </h3>

                        </div>

                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="<?php echo e(config('layout.classes.delete')); ?>" data-dismiss="modal"
                                        aria-label="Close">
                                    <i class="ki ki-close"></i>
                                    <span>الغاء</span>
                                </button>
                                <button type="button"
                                        data-url="<?php echo e(route('system.sizes.addNewSize')); ?>"
                                        data-token="<?php echo e(csrf_token()); ?>"
                                        data-toggle="tooltip" data-theme="dark"
                                        class="<?php echo e(config('layout.classes.add')); ?> addSize">
                                    <i class="la la-check"></i>
                                    <span>اضافة</span>
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row justify-content-center">

                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <?php $__env->startComponent('components.input',['name'=>'size_ar','text'=>'المقاس باللغة العربية','placeholder'=>'ادخل المقاس باللغة العربية','id'=>'size_ar']); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                    <span class=" text-danger" id="size_ar_error"></span>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    <?php $__env->startComponent('components.input',['name'=>'size_en','text'=>'المقاس باللغة الانجليزية','placeholder'=>'ادخل المقاس باللغة الانجليزية','id'=>'size_en']); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                    <span class="text-danger" id="size_en_error"></span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div id="color" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الألوان
                                <div class="text-muted pt-2 font-size-sm">
                                    اضافة لون جديد
                                </div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="<?php echo e(config('layout.classes.delete')); ?>" data-dismiss="modal"
                                        aria-label="Close">
                                    <i class="ki ki-close"></i>
                                    <span>الغاء</span>
                                </button>
                                <button type="button"
                                        data-url="<?php echo e(route('system.colors.addNewColor')); ?>"
                                        data-token="<?php echo e(csrf_token()); ?>"
                                        data-toggle="tooltip" data-theme="dark"
                                        class="<?php echo e(config('layout.classes.add')); ?> addColor">
                                    <i class="la la-check"></i>
                                    <span>اضافة</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <?php $__env->startComponent('components.colorpicker',['name'=>'hexa','text'=>'اللون']); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                </div>

                                <div class="w-100"></div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <?php $__env->startComponent('components.input',['name'=>'color_ar','text'=>'اسم اللون','placeholder'=>'ادخل اسم اللون']); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                    <span class="text-danger" id="color_ar_error"></span>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    <?php $__env->startComponent('components.input',['name'=>'color_en','text'=>'color name','placeholder'=>'Enter the color name']); ?>
                                    <?php echo $__env->renderComponent(); ?>
                                    <span class="text-danger" id="color_en_error"></span>
                                </div>

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
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price: {
                        required: true,
                        number: true
                    }
                }

            }).init();
            if ( $('#show_in_slider').is(':checked')) {

                $('#slider_image').show()
            } else {

                $('#slider_image').hide()

            }

        });

    </script>

    <script>

        <?php if(old('is_feature',$out->is_feature)): ?>
        $('#annotation_ar').show()
        $('#annotation_en').show()
        $('#annotation_image').show()
        <?php else: ?>
        $('#annotation_ar').hide()
        $('#annotation_en').hide()
        $('#annotation_image').hide()
        <?php endif; ?>

        <?php if(old('cod',$out->cod)): ?>
        $('#annotation_ar').show()
        $('#annotation_en').show()
        $('#annotation_image').show()
        <?php else: ?>
        $('#annotation_ar').hide()
        $('#annotation_en').hide()
        $('#annotation_image').hide()
        <?php endif; ?>

        $(function () {

            $('#is_feature_switch').on('change', function () {
                var value = $('#is_feature_switch').is(':checked');
                console.log(value)
                if (value) {
                    $('#annotation_ar').show()
                    $('#annotation_en').show()
                    $('#annotation_image').show()
                } else {
                    $('#annotation_ar').hide()
                    $('#annotation_en').hide()
                }
            });
            $('#is_cod_switch').on('change', function () {
                var value = $('#is_cod_switch').is(':checked');
                console.log(value)
                if (value) {
                    $('#annotation_ar').show()
                    $('#annotation_en').show()
                    $('#annotation_image').show()
                } else {
                    $('#annotation_ar').hide()
                    $('#annotation_en').hide()
                }
            });

            $('#show_in_slider').on('change', function () {
                var value = $('#show_in_slider').is(':checked');
                if (value) {

                    $('#slider_image').show()
                } else {

                    $('#slider_image').hide()

                }
            });

        });
    </script>

    <script>

        $('.sizeid').click(function () {
            $("#size").modal('show');
        });


        $('.addSize').click(function () {

            var url = '<?php echo e(route('system.sizes.addNewSize')); ?>';

            let size_ar = $('input[name=size_ar]');
            let size_en = $('input[name=size_en]');

            var token = '<?= csrf_token() ?>';

            $.post(url,
                {
                    _token: token,
                    size_ar: size_ar.val(),
                    size_en: size_en.val(),
                },

                function (data, status) {

                    if (data) {

                        var container = $('.sizeValue');
                        var items = '';
                        $.each(data, function (key, value) {
                            // items += '<div class="col-3"><input type="checkbox" name="sizes[]" checked value="' + key + '">' + ' ' + value + ' ' + '</div>';

                            items += '<div class="col-md-6"><div class="form-group row">' +
                                '<div class="col-md-4"><input type="checkbox" name="sizes[' + key + '][id]" class="volumeData" checked value="' + key + '">' + ' ' + value + ' ' + '</div>' +
                                '<div class="col-md-8"><input type="text" class="volume_price" name="sizes[' + key + '][qty]" value="" required placeholder="أدخل  الكمية"></div>' +
                                '</div></div>';

                        });
                        container.append(items);

                        $("#size").modal('hide');
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
                })
            ;


        });


    </script>


    <script>

        $('.colorid').click(function () {
            $("#color").modal('show');
        });


        $('.addColor').click(function () {

            var url = '<?php echo e(route('system.colors.addNewColor')); ?>';

            let color_ar = $('input[name=color_ar]');
            let color_en = $('input[name=color_en]');
            let hexa = $('input[name=hexa]');

            var token = '<?= csrf_token() ?>';

            $.post(url,
                {
                    _token: token,
                    color_ar: color_ar.val(),
                    color_en: color_en.val(),
                    hexa: hexa.val(),
                },

                function (data, status) {

                    if (data) {

                        var container = $('.colorValue');
                        var items = '';
                        $.each(data, function (key, value) {
                            items += '<div class="col-3"><input type="checkbox" name="colors[]" value="' + key + '">' + ' ' + value + ' ' + '</div>';
                        });
                        container.append(items);

                        $("#color").modal('hide');
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
                })
            ;


        });
        $(function () {
            $('.volumeData').change(function () {
                let value = $(this).is(':checked');
                if (value) {

                    $(this).parent().parent().find('.volume_price').attr("required", "true").removeAttr('disabled').show();

                } else {
                    // $(this).parent().parent().find('.volume_price').val('');
                    $(this).parent().parent().find('.volume_price').attr("required", "false").attr("disabled", "disabled").hide();
                }
            });

        });

    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/system_admin/products/update.blade.php ENDPATH**/ ?>