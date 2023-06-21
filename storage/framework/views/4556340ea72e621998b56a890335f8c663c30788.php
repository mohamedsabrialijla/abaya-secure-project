<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('site.profile'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10" style="background-color: #988a760d;">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i></a></li>
                    <li><?php echo app('translator')->get('site.profile'); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start profile =============================-->
    <section class="profile_page">
        <div class="container">
            <div class="content_page">
                <div class="profile_card">
                    <ul class="profile_tabs_control">
                        <li class="mou_tab active" data-content="User_info">
                            <span class="icon"><i class="fal fa-user-tie"></i></span>
                            <span class="text"><?php echo app('translator')->get('site.pr1'); ?></span>
                        </li>
                        <li class="mou_tab" data-content="address_section">
                            <span class="icon"><i class="fal fa-map-marker-alt"></i></span>
                            <span class="text"><?php echo app('translator')->get('site.pr2'); ?> </span>
                        </li>
                        <li class="mou_tab" data-content="orders_section">
                            <span class="icon"><i class="fal fa-bags-shopping"></i></span>
                            <span class="text"><?php echo app('translator')->get('site.pr3'); ?></span>
                        </li>
                        <li class="mou_tab" data-content="wallet_section">
                            <span class="icon"><i class="fal fa-wallet"></i></span>
                            <span class="text"><?php echo app('translator')->get('site.pr4'); ?></span>
                        </li>
                        <li class="mou_tab" data-content="notifications_section">
                            <span class="icon"><i class="fal fa-bell"></i></span>
                            <span class="text"><?php echo app('translator')->get('site.pr5'); ?></span>
                        </li>
                        <li class="mou_tab" data-content="coupons_section">
                            <span class="icon"><i class="fal fa-badge-percent"></i></span>
                            <span class="text"><?php echo app('translator')->get('site.pr6'); ?></span>
                        </li>
                        <li class="mou_tab">
                            <a class="icon" style="width: auto;"
                                href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> <span class="text" style="padding: 6px;" ><?php echo app('translator')->get('site.logout'); ?></span></a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="profile_content">

                    <div class="box_content active" id="User_info">
                        <form class="inforamtion_content" action="<?php echo e(route('update_profile')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-12 mb-30">
                                    <div class="form-group">
                                        <div class="image">
                                            <img src="<?php echo e($customer->avatar_url ?? asset('assets/img/person.jpg')); ?>"
                                                alt="" id="personalImg">
                                            <label for="editPersonalImg">
                                                <input type="file" name="avatar" onchange="readURL(this)" class="d-none"
                                                    id="editPersonalImg">
                                                <i class="fal fa-edit"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?php echo app('translator')->get('site.name'); ?></label>
                                        <div class="input-box">
                                            <span class="icon"><i class="fal fa-user"></i></span>
                                            <input class="form-control" name="name" type="text"
                                                value="<?php echo e($customer->name); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?php echo app('translator')->get('site.email'); ?></label>
                                        <div class="input-box">
                                            <span class="icon"><i class="fal fa-envelope"></i></span>
                                            <input class="form-control" type="email" name="email"
                                                value="<?php echo e($customer->email); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?php echo app('translator')->get('site.phone_number'); ?></label>
                                        <div class="input-box">
                                            <span class="icon"><i class="fal fa-phone"></i></span>
                                            <input class="form-control" name="mobile" type="number"
                                                value="<?php echo e($customer->mobile); ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-30">
                                    <button type="submit"
                                        class="main-btn main animate border-0 w-100"><?php echo app('translator')->get('site.save'); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="box_content" id="address_section">
                        <ul id="address_list" class="list list--shipping-address">
                            <li class="new-address">
                                <input type="radio" id="add_new_address" name="address"
                                    class="payment_method_input d-none">
                                <label for="add_new_address" class="btn btn--address-new">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span><?php echo app('translator')->get('site.pr11'); ?></span>
                                </label>
                            </li>
                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="address-entry">
                                        <input type="radio" id="address-entry-<?php echo e($address->id); ?>" name="address"
                                            class="payment_method_input d-none" checked="">
                                        <label for="address-entry-<?php echo e($address->id); ?>">
                                            <button type="button" class="address-delete delete_product_btn "
                                                data-toggle="modal" data-id="<?php echo e($address->id); ?>"
                                                data-target="#delete_product_modal">
                                                <i class="fal fa-times"></i>
                                            </button>
                                            <b><?php echo e($address->name); ?></b>
                                            <p><?php echo e($address->address); ?></p>
                                            
                                        </label>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div id="new_address_box" style="display: none;">
                            <form action="<?php echo e(route('addaddress')); ?>" method="post" class="w-100">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><?php echo app('translator')->get('site.name'); ?></label>
                                            <div class="input-box">
                                                
                                                <input class="form-control" name="name" type="text"
                                                    placeholder="<?php echo app('translator')->get('site.name'); ?>" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><?php echo app('translator')->get('site.phone_number'); ?></label>
                                            <div class="input-box">
                                                <select name="mobile_code" id="">
                                                    <option value="966">966</option>
                                                    <option value="965">965</option>
                                                    <option value="971">971</option>
                                                    <option value="974">974</option>
                                                    <option value="973">973</option>
                                                </select>
                                                
                                                <input class="form-control" name="mobile" type="number" value=""
                                                    placeholder="56xxxxxxxxxx" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><?php echo app('translator')->get('site.py11'); ?></label>
                                            <select class="select2" name="country">
                                                <option value=""><?php echo app('translator')->get('site.py11'); ?></option>
                                                <?php $__currentLoopData = $govs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(app()->getLocale() == 'ar'): ?>
                                                        <option value="<?php echo e($gov->id); ?>">
                                                            <?php echo e($gov->name_ar); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($gov->id); ?>">
                                                            <?php echo e($gov->name_en); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><?php echo app('translator')->get('site.py12'); ?></label>
                                            <select name="state" class="select2">
                                                <option value=""> <?php echo app('translator')->get('site.py12'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""><?php echo app('translator')->get('site.address'); ?></label>
                                            <textarea name="address" type="text" id="" class="form-control" required> <?php echo app('translator')->get('site.address'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="main-btn main animate remove-from-cart border-0"><?php echo app('translator')->get('site.save'); ?></button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    <div class="box_content" id="orders_section">
                        <div class="row">
                            <?php $__currentLoopData = $customer->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="order_box text-center">
                                        <div class="order-details">
                                            <h3 class="product-title">
                                                <a
                                                    href="<?php echo e(route('single_order', $order->id)); ?>">#<?php echo e($order->invoice_number); ?></a>
                                            </h3>
                                            <?php if($order->status->id == 1 ||
                                                $order->status->id == 3 ||
                                                $order->status->id == 4 ||
                                                $order->status->id == 5 ||
                                                $order->status->id == 6): ?>
                                                <span class="status yellow"><?php echo e($order->status->name); ?></span>
                                            <?php elseif($order->status->id == 2 || $order->status->id == 8 || $order->status->id == 9): ?>
                                                <span class="status red"><?php echo e($order->status->name); ?></span>
                                            <?php elseif($order->status->id == 7): ?>
                                                <span class="status green"><?php echo e($order->status->name); ?></span>
                                            <?php endif; ?>
                                            <div class="price">
                                                <span class="product-price"><?php echo e($order->total); ?>

                                                    <span><?php echo e($currency); ?>

                                                    </span></span>
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('single_order', $order->id)); ?>" class="main-btn main animate">
                                            <i class="fal fa-eye"></i>
                                            <span><?php echo app('translator')->get('site.o37'); ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="box_content" id="wallet_section">
                        <div class="row">
                            <div class="col-sm-6 box text-center">
                                <span class="icon"><img src="<?php echo e(asset('assets/img/icons/salary.png')); ?>"
                                        alt="" width="70" height="70"></span>
                                <h6><?php echo app('translator')->get('site.pr8'); ?></h6>
                                <div class="balance"><?php echo e($customer->wallet); ?> <?php echo app('translator')->get('site.rs'); ?></div>
                            </div>
                            <div class="col-sm-6 box text-center">
                                <span class="icon"><img src="<?php echo e(asset('assets/img/icons/box.png')); ?>" alt=""
                                        width="70" height="70"></span>
                                <h6><?php echo app('translator')->get('site.pr9'); ?></h6>
                                <div class="balance"><?php echo e($customer->points); ?></div>
                            </div>
                            <div class="col-12 mt-30">
                                <div class="share_box">
                                    <img src="<?php echo e(asset('assets/img/icons/collaboration.png')); ?>" alt=""
                                        width="100" height="100">
                                    <h5><?php echo app('translator')->get('site.pr10'); ?></h5>
                                    <span class="word"><?php echo e($customer->promo_code); ?></span>
                                    <button type="button" class="main-btn dark-btn border-0 w-50"
                                        id="share-btn"><?php echo app('translator')->get('site.share'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_content" id="notifications_section">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $not): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="#" class="noti_box">
                                <h6 class="head"> <?php echo json_encode($not->data['title'], JSON_UNESCAPED_UNICODE, 512) ?></h6>
                                <p class="desc m-0"><?php echo json_encode($not->data['msg'], JSON_UNESCAPED_UNICODE, 512) ?></p>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="box_content" id="coupons_section">
                        <?php if(!empty($coupons[0])): ?>
                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($coupon->show == 1): ?>
                                    <hr class="product-divider d-lg-show mb-3">

                                    <div class="discount-box">
                                        <i class="fa-regular fa-badge-percent"></i>
                                        <div>
                                            <h6><?php echo app('translator')->get('site.o34'); ?><span>
                                                    <?php if($coupon->flag == 1): ?>
                                                        <?php echo e($coupon->discount_ratio); ?> %
                                                    <?php elseif($coupon->flag == 2): ?>
                                                        <?php echo e($coupon->discount_ratio); ?> <?php echo app('translator')->get('site.sar'); ?>
                                                    <?php elseif($coupon->flag == 3): ?>
                                                        <?php echo app('translator')->get('site.o38'); ?>
                                                    <?php endif; ?>
                                                </span></h6>
                                            <p><?php echo app('translator')->get('site.o35'); ?> <?php echo e($coupon->code); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="no-found text-center">
                                <h2><?php echo app('translator')->get('site.pr7'); ?></h2>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--======================== End profile =============================-->

    <!-- ==================== Edit product modal =================== -->
    <div class="modal fade" data-id="" id="edit_product_modal" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('editaddress')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->get('site.name'); ?></label>
                                    <div class="input-box">
                                        
                                        <input type="hidden" value="" id="address_id">
                                        <input class="form-control" name="name" type="text"
                                            placeholder="<?php echo app('translator')->get('site.name'); ?>" id="address_name" value=""
                                            required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->get('site.phone_number'); ?></label>
                                    <div class="input-box">

                                        
                                        <input class="form-control" name="mobile" type="number" id="address_mobile"
                                            value="" placeholder="56xxxxxxxxxx" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->get('site.py11'); ?></label>
                                    <select class="select2" name="country">
                                        <option value=""><?php echo app('translator')->get('site.py11'); ?></option>
                                        <?php $__currentLoopData = $govs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(app()->getLocale() == 'ar'): ?>
                                                <option value="<?php echo e($gov->id); ?>">
                                                    <?php echo e($gov->name_ar); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($gov->id); ?>">
                                                    <?php echo e($gov->name_en); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->get('site.py12'); ?></label>
                                    <select name="state" class="select2">
                                        <option value=""> <?php echo app('translator')->get('site.py12'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->get('site.address'); ?></label>
                                    <div class="input-box">
                                        
                                        
                                        <textarea name="address" type="text" id="address_address" class="form-control" required> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="main-btn close animate border-0"
                            data-dismiss="modal"><?php echo app('translator')->get('site.close'); ?></button>
                        <button type="submit"
                            class="main-btn main animate remove-from-cart border-0"><?php echo app('translator')->get('site.edit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================== Edit product modal =================== -->

    <!-- ==================== Delete product modal =================== -->
    <div class="modal fade custom_modal" data-id="" id="delete_product_modal" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?php echo e(route('deleteaddress')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-body">
                        <input type="hidden" name="address_id" id="address_id" value="">
                        <p class="m-0"><?php echo app('translator')->get('site.delete_address'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="main-btn close animate"
                            data-dismiss="modal"><?php echo app('translator')->get('site.no'); ?></button>
                        <button type="submit" class="main-btn main animate remove-from-cart"><?php echo app('translator')->get('site.yes'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ==================== Delete product modal =================== -->
<?php $__env->stopSection(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="country"]').on('change', function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: '<?php echo e(url('findCity')); ?>/' + countryID,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('#loader').css("visibility", "visible");
                    },

                    success: function(data) {

                        $('select[name="state"]').empty();
                        $('select[name="state"]').append(
                            '<option value=""><?php echo app('translator')->get('site.py12'); ?></option>');


                        $.each(data, function(key, value) {

                            $('select[name="state"]').append('<option value="' +
                                key + '">' + value + '</option>');

                        });
                    },
                    complete: function() {
                        $('#loader').css("visibility", "hidden");
                    }
                });
            } else {
                $('select[name="state"]').empty();
            }
        });

    });
</script>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).on("click", ".delete_product_btn", function() {
            var id = $(this).data('id');
            $(".modal-body #address_id").val(id);
        });
        $(document).on("click", ".edit_product_btn", function() {
            var id = $(this).data('id');
            $(".modal-body #address_id").val(id);
        });

        $(".payment_method_input[name='address']").on('change', function() {
            if ($("#add_new_address").is(':checked')) {
                $("#new_address_box").slideDown();

            } else {
                $("#new_address_box").slideUp();
            }
        })



        // $(".remove-from-cart").click(function(e) {
        //     e.preventDefault();

        //     var ele = $(this);


        //     $.ajax({
        //         url: '<?php echo e(route('deleteaddress')); ?>',
        //         method: "DELETE",
        //         data: {
        //             _token: '<?php echo e(csrf_token()); ?>',
        //             id: ele.parents("div").attr("data-id")
        //         },
        //         success: function(response) {
        //             window.location.reload();
        //         }
        //     });

        // });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/profile.blade.php ENDPATH**/ ?>