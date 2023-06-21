<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.users.mostcustomers'), 'title' => 'الزبائن الأكثر شراءً'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.users.mostcustomers'), 'title' => 'الزبائن الأكثر شراءً'],
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
            'Disname' => 'الزبائن الأكثر شراءً',
            'Disinfo' => 'ادارة الزبائن',
            'module' => 'mostcustomers',
        ]); ?>
        
        <?php if(isset($out) && count($out) > 0): ?>
            <div class="table-responsive">
                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="5%" style="text-align: center;vertical-align: middle;">
                                <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                    <input type="checkbox" id="SelectAll">
                                    <span></span>
                                </label>

                            </th>
                            <th class="text-center">الإسم</th>
                            <th class="text-center">البريد الإلكتروني</th>
                            <th class="text-center">رقم الجوال</th>
                            
                            <th class="text-center">تاريخ التسجيل</th>
                            <th class="text-center">إجمالي الشراء</th>
                            <th class="text-center">عدد الطلبات</th>
                            <th class="text-center">الإعدادات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($o): ?>
                                <tr id="TR_<?php echo e($o->customer->id); ?>">
                                    <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                    <td style="text-align: center;vertical-align: middle;">
                                        <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                            <input type="checkbox" value="<?= $o->customer->id ?>" name="Item[]"
                                                class="CheckedItem" id="che_<?php echo e($o->customer->id); ?>">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="text-center"><?php echo e($o->customer->name); ?></td>
                                    <td class="text-center"> <?php echo e($o->customer->email); ?></td>
                                    <td class="text-center"> <?php echo e($o->customer->mobile); ?></td>

                                    

                                    <td class="text-center"> <?php echo e($o->customer->created_at->toDateString()); ?></td>
                                    <td class="text-center"> <?php echo e($o->purchase_total); ?></td>
                                    <td class="text-center"> <?php echo e($o->customer->orders->count()); ?></td>
                                    <td class="text-center">

                                        <ul class="list-inline">
                                            <?php if(auth('system_admin')->user()->can('view_users', 'system_admin')): ?>
                                                <li>
                                                    <a href="<?php echo e(route('system.users.details', $o->customer->id)); ?>"
                                                        class="<?php echo e(config('layout.classes.edit')); ?> mt-2" data-toggle="tooltip"
                                                        data-theme="dark" title="عرض بيانات المستخدم">
                                                        <i class="fa fa-eye"></i> تفاصيل </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(auth('system_admin')->user()->can('delete_users', 'system_admin')): ?>
                                                <li>
                                                    <button type="button" data-id="<?= $o->customer->id ?>"
                                                        data-url="<?php echo e(route('system.users.delete')); ?>"
                                                        data-token="<?php echo e(csrf_token()); ?>" data-toggle="tooltip"
                                                        data-theme="dark" title="حذف"
                                                        class="<?php echo e(config('layout.classes.delete')); ?>  mt-2 btn-del">
                                                        <i class="<?php echo e(config('layout.icons.delete_icon')); ?>"></i>
                                                        حذف
                                                    </button>
                                                </li>
                                            <?php endif; ?>
                                        </ul>

                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="note note-info">
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function() {
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price_to: {
                        number: true
                    }
                }
                /*,
                                message:{
                                   title: 'يجب ادخال ارقام فقط',
                                }*/
            }).init();

        });
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.change_status').change(function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                swal.fire({
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد تغيير حالة المستخدم؟",
                    type: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتغيير !",
                    cancelButtonText: "لا, الغي العملية !",
                    reverseButtons: 1
                }).then(function(e) {
                    if (e.value) {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            url: '<?php echo e(route('system.users.change_status')); ?>',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                'status': status,
                                'id': id
                            },
                            success: function(data) {

                            }
                        });
                    } else {
                        e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");
                        location.reload();
                    }
                });

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/customers/most.blade.php ENDPATH**/ ?>