<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('site.contact'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="demo1.html"><i class="fal fa-home"></i></a></li>
                    <li><?php echo app('translator')->get('site.contact'); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start Page Header =============================-->
    <section class="page_header" style="background-image: url(<?php echo e(asset('assets/img/contact-us.jpg')); ?>);">
        <div class="container content h-100">
            <h4 class="page_name m-0"><?php echo app('translator')->get('site.contact'); ?></h4>
        </div>
    </section>
    <!--======================== End Page Header =============================-->

    <!--======================== Start contact =============================-->
    <section class="contact_page login_page mt-50">
        <div class="container">
            

            <div class="content">
                <div class="box-form">
                    <div class="head">
                        <h5 class="bold"><?php echo app('translator')->get('site.c2'); ?></h5>
                    </div>
                    <form action="<?php echo e(route('send_msg')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for=""><?php echo app('translator')->get('site.name'); ?></label>
                            <input class="form-control" name="name" type="text"  placeholder="<?php echo app('translator')->get('site.name'); ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo app('translator')->get('site.phone_number'); ?></label>
                            <input class="form-control" name="phone_number" type="text"  placeholder="<?php echo app('translator')->get('site.phone_number'); ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo app('translator')->get('site.email'); ?></label>
                            <input class="form-control" type="email" name="email" placeholder="user@example.com" required="">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo app('translator')->get('site.msg'); ?></label>
                            <textarea class="form-control" name="msg" placeholder="<?php echo app('translator')->get('site.c3'); ?>"" required=""></textarea>
                        </div>
                        <button type="submit" class="main-btn submit-btn animate" id="send"><span><?php echo app('translator')->get('site.send'); ?></span></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End contact =============================-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(`[data-index=1]`).focus();

    $('.verify-input-field').keypress(function(e) {
        var ew = e.which;
        if (48 <= ew && ew <= 57)
            return true;
        return false;

        let inputBoxIndex = $(e.target).attr('data-index');
        let inputBox = $(e.target);

        if (inputBox.val().length > 0) {
            e.preventDefault();
        }
    })




    $('.verify-input-field').keyup(function(e) {

        let inputBoxIndex = $(e.target).attr('data-index');
        let pressedKeyCode = e.keyCode | e.which;
        let nextInputBox = $(`[data-index=${Number(inputBoxIndex) + 1}]`);
        let prevInputBox = $(`[data-index=${Number(inputBoxIndex) - 1}]`);

        if (48 <= pressedKeyCode && pressedKeyCode <= 57) {
            nextInputBox.focus();
        } else if (pressedKeyCode === 8 || pressedKeyCode === 37) {
            prevInputBox.focus();
        }

    })
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/contact.blade.php ENDPATH**/ ?>