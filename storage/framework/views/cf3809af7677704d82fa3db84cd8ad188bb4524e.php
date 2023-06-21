
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" <?php echo e(Metronic::printAttrs('html')); ?>

    <?php echo e(Metronic::printClasses('html')); ?>

    <?php echo config('layout.self.rtl') ? ' direction="rtl" dir="rtl" style="direction: rtl" ' : ''; ?>>
    <head>
        <meta charset="utf-8"/>

        
        <title><?php echo e(config('app.name')); ?> | <?php echo $__env->yieldContent('title', $page_title ?? ''); ?></title>
        
        <meta name="description" content="<?php echo $__env->yieldContent('page_description', $page_description ?? ''); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        
        <link rel="shortcut icon" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <?php echo e(Metronic::getGoogleFontsInclude()); ?>


        
        <?php $__currentLoopData = config('layout.resources.css'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <link href="<?php echo e(config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style)); ?>" rel="stylesheet" type="text/css"/>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php $__currentLoopData = Metronic::initThemes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <link href="<?php echo e(config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme)); ?>" rel="stylesheet" type="text/css"/>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <link href="<?php echo e(asset('admin/admin.min.css')); ?>" rel="stylesheet" type="text/css"/>
        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>"/>

        <link href="<?php echo e(asset('croper/cropper.min.css')); ?>" rel="stylesheet">
        <script src="<?php echo e(asset('croper/cropper.min.js')); ?>"></script>
        
        <?php echo $__env->yieldContent('styles'); ?>
        <?php echo $__env->yieldContent('head'); ?>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(asset('favicon/apple-icon-57x57.png')); ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('favicon/apple-icon-60x60.png')); ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('favicon/apple-icon-72x72.png')); ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('favicon/apple-icon-76x76.png')); ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('favicon/apple-icon-114x114.png')); ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('favicon/apple-icon-120x120.png')); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('favicon/apple-icon-144x144.png')); ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('favicon/apple-icon-152x152.png')); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('favicon/apple-icon-180x180.png')); ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(asset('favicon/android-icon-192x192.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('favicon/favicon-96x96.png')); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon/favicon-16x16.png')); ?>">
        <link rel="manifest" href="<?php echo e(asset('favicon/manifest.json')); ?> ">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo e(asset('favicon/ms-icon-144x144.png')); ?>">
        <meta name="theme-color" content="#ffffff">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>

    <body <?php echo e(Metronic::printAttrs('body')); ?> <?php echo e(Metronic::printClasses('body')); ?>>

        <?php if(config('layout.page-loader.type') != ''): ?>
            <?php echo $__env->make('layouts.partials._page-loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php echo $__env->make('layouts.base._layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <script>var HOST_URL = "<?php echo e(route('system_admin.quick-search')); ?>";</script>
        <script>
            UrlForScripts='<?php echo e(url('/')); ?>';
            UrlForAssets='<?php echo e(url('/')); ?>';

        </script>


        
        <script>
            var KTAppSettings = <?php echo json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES); ?>;
        </script>

        
        <?php $__currentLoopData = config('layout.resources.js'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $script): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script src="<?php echo e(asset($script)); ?>" type="text/javascript"></script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <script>
            const Swal=swal.mixin({
                buttonsStyling: false,
                confirmButtonClass: "<?php echo e(config('layout.classes.submit')); ?>",
                confirmButtonColor: null,
                cancelButtonClass: "<?php echo e(config('layout.classes.cancel')); ?>",
                cancelButtonColor: null
            });
        </script>

        <script src="<?php echo e(asset('admin/jquery-validation/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/jquery-validation/js/additional-methods.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/jquery-validation/js/localization/messages_ar.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/jquery.minicolors.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/datepicker/js/bootstrap-datepicker.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/datepicker/locales/bootstrap-datepicker.ar.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('ckeditor/translations/en.js')); ?>"></script>
        <script src="<?php echo e(asset('ckeditor/ckeditor.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/main.js')); ?>" type="text/javascript"></script>



        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        



        <?php echo $__env->yieldContent('custom_scripts'); ?>
        <?php echo $__env->yieldContent('upload1_scripts'); ?>
        <?php echo $__env->yieldContent('upload2_scripts'); ?>
        <?php echo $__env->yieldContent('area_scripts'); ?>
        <?php echo $__env->yieldContent('graph_js'); ?>
        <script>


            <?php if(count($errors->all())): ?>
                <?php
                $err='<ul class="text-right mb-5" style="padding:0 20px;">';
                foreach ($errors->all() as $e){
                    $err.='<li>'.$e.'</li>';
                }
                $err.='</ul>'
                ?>
            Swal.fire({
                toast:true,
                html: '<?php echo $err; ?>',
                icon: 'error',
                timer: 30000,
                position:'bottom-start',
                timerProgressBar: true,
                showConfirmButton: false,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            <?php endif; ?>
        </script>

        <?php echo $__env->make('layouts.partials.firebase_notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('scripts'); ?>
        <script>
                $(document).ready(function (){
                    $('.isNumber').keydown(function(event) {
                            var charCode = event.keyCode;
                            console.log(charCode);
                            if(charCode>=96 && charCode<=105 ){
                                return true;
                            }
                            if ((charCode > 31 && (charCode < 48 || charCode > 57 )) || charCode==192 ) {
                                return false;
                            }
                            return true;
                    });
                });
        </script>
    </body>
</html>

<?php /**PATH /home/abayasquare/public_html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>