<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'المصممون'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'المصممون'],
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
        'Disname' => 'المصممون',
        'Disinfo' => 'ادارة المصممون',
        'add_url' => 'system.stores.create',
        'excel' => 'storesexport',
        'module' => 'stores',
        'actions' => [
        [
        'route' => 'system.stores.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.stores.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.stores.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        ],
        ]); ?>
        <div class="row">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        <?php $__env->startComponent('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'مفعل', 2 => 'معطل']]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.serach.input', ['inputs' => ['mobile' => 'بحسب الجوال']]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        <?php $__env->startComponent('components.serach.inputwithsearch', ['inputs' => ['name' => 'بحسب الاسم']]); ?>
                        <?php echo $__env->renderComponent(); ?>
                        <a href="<?php echo e(route('system.stores.index')); ?>" class="<?php echo e(config('layout.classes.delete')); ?> mb-4 ml-5">
                            <i class="fa fa-refresh"></i> تفريغ
                        </a>
                    </div>

                </form>
            </div>

            <div class="col-lg-12">

                <?php if(isset($out) && count($out) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>


                                    <th>الترتيب</th>
                                    <th width="5%" style="text-align: center;vertical-align: middle;">
                                        <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                            <input type="checkbox" id="SelectAll">
                                            <span></span>
                                        </label>

                                    </th>

                                    <th class="text-center">الصورة</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">التواصل</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">عدد المنتجات</th>
                                    <th class="text-center">تاريخ التسجيل</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                   
                                    <tr id="TR_<?php echo e($o->id); ?>">

                                        <td class="LOOPIDS"><?php echo e($o->ordering); ?></td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_<?php echo e($o->id); ?>">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <img src="<?php echo e($o->image); ?>" class="img_table" alt="">

                                        </td>
                                        <td class="text-center">
                                            <p> <?php echo e(@$o->name_ar); ?></p>
                                            <p> <?php echo e(@$o->name_en); ?></p>
                                        </td>


                                        <td class="text-center">
                                            <?php if($o->mobile): ?>
                                                جوال : <?php echo e($o->mobile); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if($o->status == 1): ?>
                                                <span class="m--font-success"> مفعل </span>
                                            <?php elseif($o->status == 2): ?>
                                                <span class="m--font-warning"> غير مفعل </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <p>
                                                <a
                                                    href="<?php echo e(route('system.products.index')); ?>?store_id=<?php echo e($o->id); ?>"><?php echo e(@$o->products()->count()); ?></a>
                                            </p>
                                        </td>
                                        <td class="text-center"> <?php echo e(@$o->created_at->toDateString()); ?></td>
                                        <td class="text-center">

                                            <ul class="list-inline">
                                                <li>
                                                    <a href="<?php echo e(route('system.products.store', ['storeId' => $o->id])); ?>"
                                                        class=" <?php echo e(config('layout.classes.warning')); ?> mt-2 "
                                                        title="عرض المنتجات" data-toggle="tooltip" data-theme="dark"
                                                        data-placement="top">
                                                        <i class="fa fa-box"></i> عرض المنتجات
                                                    </a>

                                                </li>
                                                <a href="<?php echo e(route('system.stores.view', ['store' => $o->id])); ?>"
                                                    class="<?php echo e(config('layout.classes.warning')); ?>  mt-2">
                                                    <i class="fa fa-eye"></i>
                                                    تفاصيل
                                                </a>
                                                <?php if(auth('system_admin')->user()->can('view_oustores', 'system_admin')): ?>
                                                <?php endif; ?>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                                                
                                                
                                                

                                                
                                                
                                                <?php if(auth('system_admin')->user()->can('edit_stores', 'system_admin')): ?>
                                                <li>
                                                    <a href="<?php echo e(route('system.stores.update', $o->id)); ?>"
                                                        class="<?php echo e(config('layout.classes.edit')); ?> mt-2"
                                                        data-toggle="tooltip" data-theme="dark" title="تعديل البيانات">
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                                    <li>
                                                        <a href="<?php echo e(route('system.stores.sales', ['id' => $o->id])); ?>"
                                                            class="<?php echo e(config('layout.classes.edit')); ?> mt-2"
                                                            data-toggle="tooltip" data-theme="dark" title="المبيعات">
                                                            <i class="fa fa-money-bill"></i> المبيعات </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if(auth('system_admin')->user()->can('delete_stores', 'system_admin')): ?>
                                                    <?php if($o->can_del): ?>
                                                        <li>
                                                            <button type="button" data-id="<?= $o->id ?>"
                                                                data-url="<?php echo e(route('system.stores.delete')); ?>"
                                                                data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                                data-theme="dark" title="حذف"
                                                                class="<?php echo e(config('layout.classes.delete')); ?> mt-2 btn-del">
                                                                <i class="<?php echo e(config('layout.icons.delete_icon')); ?>"></i>
                                                                حذف
                                                            </button>
                                                        </li>
                                                    <?php else: ?>
                                                        <li>
                                                            <button type="button" data-toggle="tooltip" data-theme="dark"
                                                                title="لا يمكن حذف المصمم لوجود منتجات تابعة له"
                                                                class="<?php echo e(config('layout.classes.delete')); ?> mt-2 disabled">
                                                                <i class="fa fa-trash "></i>
                                                                حذف
                                                            </button>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>


                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <?php echo $out->links(); ?>

                <?php else: ?>
                    <div class="note note-info">
                        <h4 class="block">لا يوجد بيانات مضافة</h4>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal  " id="designer-modal" data-backdrop="static">

        <div class="modal-dialog  modal-dialog-centered modal-lg">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title"> تفاصيل المصمم</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">




                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $("input[name=mobile]").keyup(function() {
            if ($(this)) {
                $(this).attr({
                    'pattern': '\\d*',
                    'title': "الرجاء ادخال ارقام فقط"
                });
            }
        });
    </script>

    <script>
        $('.show-designer-details').click(function() {


            let id = $(this).data('id');

            var token = '<?= csrf_token() ?>';

            var url = $(this).data('url');

            $.get(url, {
                    _token: token,
                    id: id,
                },
                function(data, status) {
                    if (data) {
                        $("#designer-modal .modal-body").html(data.details);
                        $("#designer-modal").modal('show');

                    } else {

                        Swal.fire("تنبيه", "يوجد خطأ ما", "warning")

                    }

                });
        });
    </script>


    <script>
        ClassicEditor
            .create(document.querySelector('#return_policy_ar'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontColor',
                        'alignment',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'exportPdf',
                        'exportWord'
                    ]
                },
                language: "ar",
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                editor.isReadOnly = true;







            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                    );
                console.warn('Build id: xcs2esji16m9-tqzhsy8f19xk');
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#return_policy_en'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontColor',
                        'alignment',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'exportPdf',
                        'exportWord'
                    ]
                },
                language: "en",
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                editor.isReadOnly = true;







            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                    );
                console.warn('Build id: xcs2esji16m9-tqzhsy8f19xk');
                console.error(error);
            });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/index.blade.php ENDPATH**/ ?>