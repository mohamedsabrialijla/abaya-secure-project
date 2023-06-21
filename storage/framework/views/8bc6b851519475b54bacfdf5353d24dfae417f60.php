<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('css/pages/login/classic/login-4.rtl.css')); ?>" rel="stylesheet" type="text/css" />

       <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>"/>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('<?php echo e(asset('media/bg/bg-3.jpg')); ?>');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="<?php echo e(asset('logos/logo.png')); ?>" class="max-h-75px" alt=""/>
                    </a>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>تسجيل الدخول</h3>
                        <div class="text-muted font-weight-bold">ادخل البيانات</div>
                    </div>
                        <form class="m-login__form m-form" id="kt_login_signin_form" method="post" action="<?php echo e(route('system_admin.login')); ?>">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text" style="text-align: center" placeholder="Email" name="email" autocomplete="off" />
                            
            <?php


                if ($errors->has("email")){
                    echo '<span class="help-block has-error"> <strong>'.$errors->first("email").'</strong></span>'  ;
                }


            ?>
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" style="text-align: center" placeholder="Password" name="password" />
                        </div>

                        <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">تسجيل دخول</button>
                    </form>
                </div>
                <!--end::Login Sign in form-->

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/login.blade.php ENDPATH**/ ?>