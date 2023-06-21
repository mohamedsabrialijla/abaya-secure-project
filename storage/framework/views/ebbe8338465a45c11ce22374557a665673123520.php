<?php $attributes = $attributes->exceptProps([
    'breadcrumbs'=>['page'=>'#','title'=>'home']
    ]); ?>
<?php foreach (array_filter(([
    'breadcrumbs'=>['page'=>'#','title'=>'home']
    ]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>


<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
    <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="breadcrumb-item">
            <a href="<?php echo e($item['page']); ?>" class="text-muted">
                <?php echo e($item['title']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH /home/abayasquare/public_html/resources/views/components/breadcrumbs.blade.php ENDPATH**/ ?>