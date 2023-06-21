<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.payments.index'), 'title' => 'طرق الدفع'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.payments.index'), 'title' => 'طرق الدفع'],
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
        'Disname' => 'طرق الدفع',
        'Disinfo' => 'ادارة طرق الدفع',
        'add_url' => null,
        'module' => 'payments',
        'actions' => [
        [
        'route' => 'system.payments.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.payments.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
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
                                    <th class="text-center">أيقونة طريقة الدفع</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">نسبة العمولة %</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="TR_<?php echo e($o->id); ?>">

                                        <td class="LOOPIDS">
                                            <?php echo e(($out->currentpage() - 1) * $out->perpage() + $loop->iteration); ?></td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_<?php echo e($o->id); ?>">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <img style="background-color: #ccc;" src="<?php echo e($o->icon_url); ?>"
                                                class="img_table" alt="">
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->name_ar); ?></p>
                                            <p><?php echo e($o->name_en); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo e($o->ratio); ?> %</p>
                                        </td>
                                        <td class="text-center">
                                            
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox" class="paymentActive" id="is_active"
                                                        data-id="<?php echo e($o->id); ?>" name="is_active"
                                                        <?php echo e($o->is_active === 1 ? 'checked="checked"' : ''); ?> />
                                                    <span></span>
                                                </label>

                                                <?php if($o->is_active == 1): ?>
                                                    <span class="m--font-success"> مفعل </span>
                                                <?php else: ?>
                                                    <span class="m--font-warning"> معطل </span>
                                                <?php endif; ?>
                                            </span>

                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        </td>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <td class="text-center">

                                            <ul class="list-inline">
                                                <li>
                                                    <a href="<?php echo e(route('system.payments.update', ['id' => $o->id])); ?>"
                                                        class=" <?php echo e(config('layout.classes.warning')); ?> mt-2 "
                                                        title="تعديل" data-toggle="tooltip" data-theme="dark"
                                                        data-placement="top">
                                                        <i class="fa fa-edit"></i> تعديل
                                                    </a>

                                                </li>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {

            $('.paymentActive').change(function() {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '<?php echo e(route('system.payments.change_is_active')); ?>',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        'is_active': is_active,
                        'id': id
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });


        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/payments/index.blade.php ENDPATH**/ ?>