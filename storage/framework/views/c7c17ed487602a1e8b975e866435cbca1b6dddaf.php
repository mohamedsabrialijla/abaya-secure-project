

<?php
    $kt_logo_image = 'logo_abaya.png';
?>

<?php if(config('layout.brand.self.theme') === 'light'): ?>
    <?php $kt_logo_image = 'logo_abaya.png' ?>
<?php elseif(config('layout.brand.self.theme') === 'dark'): ?>
    <?php $kt_logo_image = 'logo_abaya.png' ?>
<?php endif; ?>

<div class="aside aside-left <?php echo e(Metronic::printClasses('aside', false)); ?> d-flex flex-column flex-row-auto" id="kt_aside">

    
    <div class="brand flex-column-auto <?php echo e(Metronic::printClasses('brand', false)); ?>" id="kt_brand">
        <div class="brand-logo justify-content-center w-100">
            <a href="<?php echo e(route('system_admin.dashboard')); ?>">
                <img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('logos/'.$kt_logo_image)); ?>" width="45" style="margin:auto"/>
            </a>
        </div>

        <?php if(config('layout.aside.self.minimize.toggle')): ?>
            <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                <?php echo e(Metronic::getSVG("media/svg/icons/Navigation/Angle-double-left.svg", "svg-icon-xl")); ?>

            </button>
        <?php endif; ?>

    </div>

    
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        <?php if(config('layout.aside.self.display') === false): ?>
            <div class="header-logo justify-content-center w-100">
                <a href="<?php echo e(route('system_admin.dashboard')); ?>">
                    <img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('logos/'.$kt_logo_image)); ?>"/>
                </a>
            </div>
        <?php endif; ?>

        <div
            id="kt_aside_menu"
            class="aside-menu my-4 <?php echo e(Metronic::printClasses('aside_menu', false)); ?>"
            data-menu-vertical="1"
            <?php echo e(Metronic::printAttrs('aside_menu')); ?>>

            <ul class="menu-nav <?php echo e(Metronic::printClasses('aside_menu_nav', false)); ?>">
                <?php echo e(Menu::renderVerMenu(config('menu_aside.items'))); ?>

            </ul>
        </div>
    </div>

</div>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/layouts/base/_aside.blade.php ENDPATH**/ ?>