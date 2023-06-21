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

    <?php $__env->startComponent('components.ShowCard',
        [
            'Disname' => 'المبيعات',
            'Disinfo' => 'ادارة المصممون',
            'module' => 'stores',
            'print' => '',
            'excel' => 'salesexport',
        ]); ?>
        <div class="row">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">


                            <?php $__env->startComponent('components.serach.dateRanger'); ?>
                            <?php echo $__env->renderComponent(); ?>

                            <?php $__env->startComponent('components.serach.inputwithsearch', ['inputs' => []]); ?>
                            <?php echo $__env->renderComponent(); ?>

                            <a href="<?php echo e(route('system.stores.sales', ['id' => $id])); ?>"
                                class="<?php echo e(config('layout.classes.delete')); ?> mb-4 ml-5">
                                <i class="fa fa-refresh"></i> تفريغ
                            </a>

                        </div>

                    </div>

                </form>
            </div>

            <div class="col-lg-12" id="printarea">

                <?php if(isset($out) && count($out) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>


                                    <th>#</th>

                                    <th class="text-center">تاريخ الطلب</th>
                                    <th class="text-center">الموديل</th>
                                    <th class="text-center">رقم الطلب</th>
                                    <th class="text-center">عدد القطع</th>
                                    <th class="text-center">المقاس</th>
                                    <th class="text-center">السعر قبل الخصم</th>
                                    <th class="text-center">نسبة الخصم</th>
                                    <th class="text-center">قيمة الخصم</th>
                                    <th class="text-center">السعر بعد الخصم</th>
                                    <th class="text-center">طريقة السداد</th>
                                    <th class="text-center">نسبة عمولة البنك</th>
                                    <th class="text-center">قيمة عمولة السداد</th>
                                    <th class="text-center">إجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="TR_<?php echo e($o->id); ?>">

                                        <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-right">
                                            <p>
                                                <?php echo e($o->order->created_at->toDateString()); ?>

                                            </p>


                                        </td>
                                        <td class="text-center">
                                            <p> <?php echo e(@$o->product->name_ar); ?></p>
                                            
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('system.orders.details', $o->order_id)); ?>">
                                                <?php echo e(@$o->order->invoice_number); ?></a>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->qty); ?></p>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->size->name_ar); ?></p>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->price); ?></p>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->discount_ratio ?? '0'); ?></p>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->discount ?? '0'); ?> </p>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->total); ?></p>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->order->paymentType->name_ar); ?></p>
                                            <p> <?php echo e(@$o->order->paymentType->name_en); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p> <?php echo e(@$o->order->paymentType->ratio); ?> %</p>
                                        </td>

                                        <td class="text-center">
                                            <?php if(@$o->order->paymentType->ratio > 0): ?>
                                                <p><?php echo e((@$o->order->paymentType->ratio * @$o->total) / 100); ?></p>
                                            <?php else: ?>
                                                <p>0</p>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <p> <?php echo e(@$o->total - (@$o->order->paymentType->ratio * @$o->total) / 100); ?></p>
                                        </td>


                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <?php

                        $sum= $out->sum('total');
                        if ($com > 0) {
                            $tcom = ($sum * $com) / 100;
                        } else {
                            $tcom = 0;
                        }
                        $tax = 0;
                        foreach ($out as $key => $i) {
                            if ($i->order->paymentType->ratio > 0) {
                                $tax = ($i->order->paymentType->ratio * @$i->total) / 100 + $tax;
                            }
                        }

                        $total = $sum - $tcom - $tax;
                    ?>
                    <div>
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>المصمم</th>
                                    <td>
                                        <?php echo e($store->name_ar); ?> - <?php echo e($store->name_en); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>التاريخ</th>
                                    <td>
                                        <?php echo e(request()->date_from); ?> -- <?php echo e(request()->date_to); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>الإجمالي</th>
                                    <td>
                                        <?php echo e($sum); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>مصاريف إدارية</th>
                                    <td><?php echo e($tcom); ?></td>
                                </tr>
                                <tr>
                                    <th>عمولات سداد</th>
                                    <td><?php echo e($tax); ?></td>
                                </tr>
                                <tr class="table-active">
                                    <th>الصافي المستحق</th>
                                    <td><?php echo e($total); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if(isset($out1) && count($out1) > 0): ?>
                    <div>
                        <h4>الطلبات المرجعه</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>


                                        <th>#</th>

                                        <th class="text-center">تاريخ الطلب</th>
                                        <th class="text-center">الموديل</th>
                                        <th class="text-center">رقم الطلب</th>
                                        <th class="text-center">عدد القطع</th>
                                        <th class="text-center">المقاس</th>
                                        <th class="text-center">السعر قبل الخصم</th>
                                        <th class="text-center">نسبة الخصم</th>
                                        <th class="text-center">قيمة الخصم</th>
                                        <th class="text-center">السعر بعد الخصم</th>
                                        <th class="text-center">طريقة السداد</th>
                                        <th class="text-center">نسبة عمولة البنك</th>
                                        <th class="text-center">قيمة عمولة السداد</th>
                                        <th class="text-center">إجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $out1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="TR_<?php echo e($o1->id); ?>">

                                            <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-right">
                                                <p>
                                                    <?php echo e($o1->order->created_at->toDateString()); ?>

                                                </p>


                                            </td>
                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->product->name_ar); ?></p>
                                                
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo e(route('system.orders.details', $o1->order_id)); ?>">
                                                    <?php echo e(@$o1->order->invoice_number); ?></a>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->qty); ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->size->name_ar); ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->price); ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->discount_ratio ?? '0'); ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->discount ?? '0'); ?> </p>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->total); ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->order->paymentType->name_ar); ?></p>
                                                <p> <?php echo e(@$o1->order->paymentType->name_en); ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->order->paymentType->ratio); ?> %</p>
                                            </td>

                                            <td class="text-center">
                                                <?php if(@$o1->order->paymentType->ratio > 0): ?>
                                                    <p><?php echo e((@$o1->order->paymentType->ratio * @$o1->total) / 100); ?></p>
                                                <?php else: ?>
                                                    <p>0</p>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <p> <?php echo e(@$o1->total - (@$o1->order->paymentType->ratio * @$o1->total) / 100); ?></p>
                                            </td>


                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/sales.blade.php ENDPATH**/ ?>