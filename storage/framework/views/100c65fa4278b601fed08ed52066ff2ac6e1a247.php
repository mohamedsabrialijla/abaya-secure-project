<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
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
            'Disname' => 'الطلبات',
            'Disinfo' => 'ادارة الطلبات الخاصة بالتطبيق',
            'actions' => [],
        ]); ?>
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            <input type="hidden" name="status" value="<?php echo e(@Str::lower($status)); ?>">

                            <?php $__env->startComponent('components.serach.inputwithsearch', ['inputs' => ['name' => 'رقم الفاتورة']]); ?>
                            <?php echo $__env->renderComponent(); ?>


                        </div>
                    </div>


                </form>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $orderCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.dash.card',
                    [
                        'col' => '4',
                        'icon' => 'media/svg/icons/Layout/Layout-top-panel-1.svg',
                        'url' => route('system.orders.index', ['status' => Str::lower($case->name_en)]),
                        'name' => ' الطلبات  ' . $case->name,
                        'count' => $case->orders()->count() . ' طلب',
                    ]); ?>
                <?php echo $__env->renderComponent(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    <?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function() {

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/orders/main-index.blade.php ENDPATH**/ ?>