<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.offers.index'), 'title' => 'العروض'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.offers.index'), 'title' => 'العروض'],
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
        'Disname' => 'العروض',
        'Disinfo' => 'ادارة العروض',
        'add_url' => 'system.offers.create',
        'module' => 'stores',
        'actions' => [
        [
        'route' => 'system.offers.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        ],
        ]); ?>
        <div class="row">
            

            <div class="col-lg-12">

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

                                    <th class="text-center">الصورة</th>
                                    <th class="text-center">قابل للنقر</th>
                                    <th class="text-center">عدد المنتجات</th>
                                    <th class="text-center">تاريخ الاضافة</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="TR_<?php echo e($o->id); ?>">

                                        <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_<?php echo e($o->id); ?>">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <img src="<?php echo e($o->image_url); ?>" class="img_table" alt="">

                                        </td>

                                        <td class="text-center">
                                            <?php if($o->clickable == 0): ?>
                                                <span class="m--font-success"> لا </span>
                                            <?php elseif($o->clickable == 1): ?>
                                                <span class="m--font-warning"> نعم </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <p>
                                                <?php echo e(@$o->products()->count()); ?>

                                            </p>
                                        </td>
                                        <td class="text-center"> <?php echo e(@$o->created_at->toDateString()); ?></td>
                                        <td class="text-center">

                                            <ul class="list-inline">

                                                <?php if(auth('system_admin')->user()->can('view_stores', 'system_admin')): ?>
                                                <a href="<?php echo e(route('system.offers.view', ['offer' => $o->id])); ?>"
                                                    class="<?php echo e(config('layout.classes.warning')); ?>  mt-2">
                                                    <i class="fa fa-eye"></i>
                                                    تفاصيل
                                                </a>
                                                <?php endif; ?>

                                                <?php if(auth('system_admin')->user()->can('edit_stores', 'system_admin')): ?>
                                                    <li>
                                                        <a href="<?php echo e(route('system.offers.update', $o->id)); ?>"
                                                            class="<?php echo e(config('layout.classes.edit')); ?> mt-2"
                                                            data-toggle="tooltip" data-theme="dark" title="تعديل البيانات">
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if(auth('system_admin')->user()->can('delete_stores', 'system_admin')): ?>
                                                        <li>
                                                            <button type="button" data-id="<?= $o->id ?>"
                                                                data-url="<?php echo e(route('system.offers.delete')); ?>"
                                                                data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                                data-theme="dark" title="حذف"
                                                                class="<?php echo e(config('layout.classes.delete')); ?> mt-2 btn-del">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/system_admin/offers/index.blade.php ENDPATH**/ ?>