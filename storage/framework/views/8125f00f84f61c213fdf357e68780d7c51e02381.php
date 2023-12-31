
<div id="kt_header" class="header <?php echo e(Metronic::printClasses('header', false)); ?>" <?php echo e(Metronic::printAttrs('header')); ?>>

    
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <?php if(config('layout.header.self.display')): ?>

            <?php
                $kt_logo_image = 'logo_abaya.png';
            ?>

            <?php if(config('layout.header.self.theme') === 'light'): ?>
                <?php $kt_logo_image = 'logo_abaya.png' ?>
            <?php elseif(config('layout.header.self.theme') === 'dark'): ?>
                <?php $kt_logo_image = 'logo_abaya.png' ?>
            <?php endif; ?>

            
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <?php if(config('layout.aside.self.display') == false): ?>
                    <div class="header-logo justify-content-center w-100">
                        <a href="<?php echo e(route('system_admin.dashboard')); ?>">
                            <img alt="Logo" src="<?php echo e(asset('logos/'.$kt_logo_image)); ?>" width="36px"/>
                        </a>
                    </div>
                <?php endif; ?>

                <div id="kt_header_menu" class="header-menu header-menu-mobile <?php echo e(Metronic::printClasses('header_menu', false)); ?>" <?php echo e(Metronic::printAttrs('header_menu')); ?>>
                    <ul class="menu-nav <?php echo e(Metronic::printClasses('header_menu_nav', false)); ?>">
                        <?php echo $__env->yieldContent('breadcrumbs'); ?>
                    </ul>
                </div>
            </div>

        <?php else: ?>
            <div></div>
        <?php endif; ?>

        <?php echo $__env->make('layouts.partials.extras._topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/layouts/base/_header.blade.php ENDPATH**/ ?>