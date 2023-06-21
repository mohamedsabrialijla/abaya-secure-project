
<?php $__env->startSection('css'); ?>
<script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
<style>
    apple-pay-button {
      --apple-pay-button-width: 140px;
      --apple-pay-button-height: 30px;
      --apple-pay-button-border-radius: 5px;
      --apple-pay-button-padding: 5px 0px;
    }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10" style="background-color: #988a760d;">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i></a></li>
                    <li><a href="<?php echo e(route('cart')); ?>"><?php echo app('translator')->get('site.cart'); ?></a></li>
                    <li><?php echo app('translator')->get('site.checkout'); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start cart =============================-->
    <section class="cart_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp">
                    <div id="payment_process">


                        <main class="sections-wrapper">
                            <header class="store-info">
                                <div class="flex-h">
                                    <div class="store-info__logo">
                                        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/img/logo.webp')); ?>"
                                                alt="Logo"></a>
                                    </div>
                                    <div class="store-info__detail">
                                        <h1><?php echo app('translator')->get('site.hello'); ?> <?php echo e(Auth::guard('user')->user()->name); ?></h1>
                                    </div>
                                </div>
                            </header>
                            <div class="section section--payment">
                                <form action="<?php echo e(route('payment')); ?>" method="post" id="shipping_form"
                                    class="form form--options-edit">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="shipping_step" class="payment-step">
                                                <div data-step="1" class="title title--step"><img
                                                        src="<?php echo e(asset('assets/img/icons/step-shipping.svg')); ?>">
                                                    <h3><?php echo app('translator')->get('site.py1'); ?></h3>
                                                </div>

                                            </div>
                                            <div id="shipping_method_fields">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="title title--small title--smaller">
                                                            <h2><?php echo app('translator')->get('site.py2'); ?></h2>
                                                        </div>
                                                        <ul id="address_list" class="list list--shipping-address">
                                                            <li class="new-address">
                                                                <input type="radio" id="add_new_address" name="address"
                                                                    class="payment_method_input d-none">
                                                                <label for="add_new_address" class="btn btn--address-new"
                                                                    data-toggle="modal"
                                                                    data-target="#add_new_address_modal">
                                                                    <i class="fal fa-map-marker-alt"></i>
                                                                    <span><?php echo app('translator')->get('site.pr11'); ?></span>
                                                                </label>
                                                            </li>
                                                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li>
                                                                    <div class="address-entry">
                                                                        <input type="radio"
                                                                            id="address-entry-<?php echo e($address->id); ?>"
                                                                            name="address_id" value="<?php echo e($address->id); ?>"
                                                                            class="payment_method_input d-none"
                                                                            checked="">
                                                                        <label for="address-entry-<?php echo e($address->id); ?>">

                                                                            <b><?php echo e($address->name); ?></b>
                                                                            <p><?php echo e($address->address); ?></p>

                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-md-12">
                                            <div id="payment_step" class="payment-step mb-0">
                                                <div data-step="2" class="title title--step"><img
                                                        src="<?php echo e(asset('assets/img/icons/step-payment.svg')); ?>">
                                                    <h3><?php echo app('translator')->get('site.py4'); ?></h3>
                                                </div>
                                                <div id="payment_methods_wrapper">
                                                    <ul id="payment_methods" class="list list--payment-methods">
                                                        <?php if($cod > 0): ?>

                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="cash-option"
                                                                value="1" class="d-none payment_method_input"
                                                                data-method="stcpay_method" checked>
                                                            <label for="cash-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img style="height:27px"
                                                                    src="<?php echo e(asset('assets/img/icons/handshake.png')); ?>"
                                                                    alt="Mada">
                                                                <h6 style="margin: 4px 0 0 0; font-size: 13px;">
                                                                    <?php echo app('translator')->get('site.py6'); ?></h6>
                                                            </label>
                                                        </li>
                                                        <?php else: ?>
                                                        
                                                         <li style="opacity: .5;">
                                                            
                                                            <label for="cash-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img style="height:27px"
                                                                    src="<?php echo e(asset('assets/img/icons/handshake.png')); ?>"
                                                                    alt="Mada">
                                                                <h6 style="margin: 4px 0 0 0; font-size: 13px;">
                                                                    <?php echo app('translator')->get('site.py6'); ?></h6>
                                                            </label>
                                                        </li>
                                                        
                                                        <?php endif; ?>
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="mada-option"
                                                                value="3" class="d-none payment_method_input"
                                                                data-method="no_method" checked>
                                                            <label for="mada-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="<?php echo e(asset('assets/img/icons/pay-option-mada.svg')); ?>"
                                                                    alt="Mada">
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="credit-option"
                                                                value="2" class="d-none payment_method_input"
                                                                data-method="no_method">
                                                            <label for="credit-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="<?php echo e(asset('assets/img/icons/pay-option-credit-2.svg')); ?>"
                                                                    alt="Credit card Logo" class="large">
                                                            </label>
                                                        </li>
                                                        <!--<li>-->
                                                        <!--    <input type="radio" name="paymentMethod"-->
                                                        <!--        id="applepay-option" value="5"-->
                                                        <!--        class="d-none payment_method_input"-->
                                                        <!--        data-method="no_method">-->
                                                        <!--    <label for="applepay-option"-->
                                                        <!--        class="btn btn--round btn--payment-option">-->
                                                        <!--        <img src="<?php echo e(asset('assets/img/icons/applepay.svg')); ?>"-->
                                                        <!--            alt="applepay">-->
                                                        <!--    </label>-->
                                                        <!--</li>-->
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="tamara-option"
                                                                value="10" class="d-none payment_method_input"
                                                                data-method="tamara_method">
                                                            <label for="tamara-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="<?php echo e(asset('assets/img/icons/ar-label.svg')); ?>"
                                                                    alt="Tamara">
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" name="paymentMethod" id="Tabby-option"
                                                                value="6" class="d-none payment_method_input"
                                                                data-method="tabby_method">
                                                            <label for="Tabby-option"
                                                                class="btn btn--round btn--payment-option">
                                                                <img src="<?php echo e(asset('assets/img/icons/pay-option-tabby_en.webp')); ?>"
                                                                    alt="Tabby">
                                                            </label>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="form--payment">
                                                    <div class="all_methods">
                                                        <div class="method-box" id="tamara_method">
                                                            <div class="row row-payment">
                                                                <div class="col-md-12">
                                                                    <div class="tamara-installment-plan-widget"
                                                                        data-lang="<?php echo e(app()->getLocale()); ?>" data-price="<?php echo e(\Cart::getTotal()+session()->get('ship')); ?>"
                                                                        data-currency="SAR" data-color-type="default"
                                                                        data-country-code="SA"
                                                                        data-number-of-installments="3">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="method-box" id="tabby_method">
                                                            <div class="row row-payment">

                                                                    <div id="tabbyCard" style="width: 100%">

                                                                    </div>
                                                                    

                                                            </div>
                                                        </div>
                                                        <div class="method-box" id="no_method"></div>
                                                    </div>
                                                    <button id="submit-form-btn"
                                                        class="main-btn main animate w-100 border-0">
                                                        <span><?php echo app('translator')->get('site.py5'); ?></span>
                                                    </button>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                </form>
                            </div>

                        </main>
                        <ul class="list list--brands">
                            <li><?php echo app('translator')->get('site.py7'); ?></li>
                            <li><img src="<?php echo e(asset('assets/img/icons/secure-payment.svg')); ?>"></li>
                            <li><img src="<?php echo e(asset('assets/img/icons/secure-payment-02.svg')); ?>"></li>
                            <li><img src="<?php echo e(asset('assets/img/icons/secure-payment-03.svg')); ?>"></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    
                    <div class="cart_cardSide wow fadeInUp sticky mt-md-30">

                        <div class="head flex-h flex-between">
                            <span class="text"><?php echo app('translator')->get('site.py8'); ?></span>
                            <?php
                                $ttotal = 0;
                                foreach ($cartItems as $item) {
                                    $ttotal = $ttotal+$item->getPriceSum();
                                }

                            ?>
                            <span class="num"><?php echo e($ttotal); ?>  <?php echo app('translator')->get('site.rs'); ?> </span>
                        </div>
                        <div class="head flex-h flex-between">
                            <span class="text"><?php echo app('translator')->get('site.tax'); ?> (%0)</span>
                            <span class="num">0 <?php echo app('translator')->get('site.rs'); ?></span>
                        </div>
                        <?php if(!is_null(session()->get('ship'))): ?>

                        <div class="head flex-h flex-between">
                            <span class="text"><?php echo app('translator')->get('site.co9'); ?></span>
                            <?php if((!is_null(\Cart::getConditionsByType('ship')->first()))): ?>

                            <span class="num" style="color: rgb(25, 192, 25)"> <?php echo app('translator')->get('site.co10'); ?></span>
                            <?php else: ?>
                            <span class="num" > <?php echo e(session()->get('ship')); ?> <?php echo app('translator')->get('site.rs'); ?></span>

                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if($ttotal - \Cart::getTotal() > 0): ?>

                        <div class="head flex-h flex-between">
                            <span class="text"><?php echo app('translator')->get('site.co11'); ?></span>
                            <span class="num"><?php echo e($ttotal - \Cart::getTotal()); ?> <?php echo app('translator')->get('site.rs'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="head flex-h flex-between">
                            <span class="text"><?php echo app('translator')->get('site.o36'); ?></span>
                            <?php if((!is_null(\Cart::getConditionsByType('ship')->first()))): ?>

                            <span class="num"><?php echo e(\Cart::getTotal()); ?>  <?php echo app('translator')->get('site.rs'); ?></span>
                            <?php elseif(!is_null(session()->get('ship'))): ?>
                            <span class="num"><?php echo e(\Cart::getTotal()+session()->get('ship')); ?>  <?php echo app('translator')->get('site.rs'); ?></span>

                            <?php else: ?>
                            <span class="num"><?php echo e(\Cart::getTotal()); ?>  <?php echo app('translator')->get('site.rs'); ?></span>


                            <?php endif; ?>
                        </div>
                        <div class="coupon_box">
                        <div>
                            <button class="btn btn--link btn--coupon"><?php echo app('translator')->get('site.co1'); ?></button>
                            <form name="coupon_form" action="<?php echo e(route('checkCoupon')); ?>" method="POST" class="form form--payment form--coupon" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <fieldset class="form-group">
                                    <i class="fal fa-times clear-input"></i>
                                    <input id="coupon_field" type="text" name="code" placeholder="<?php echo app('translator')->get('site.co2'); ?>" class="form-control" required>
                                    <button id="coupon_form_submit" type="submit" class="btn btn--primary" ><?php echo app('translator')->get('site.co3'); ?></button>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                    <apple-pay-button buttonstyle="black" type="buy" locale="el-GR"></apple-pay-button>

                </div>
            </div>
        </div>
    </section>
    <!--======================== End cart =============================-->
    <!-- ==================== Edit product modal =================== -->
    <div class="modal fade" data-id="" id="add_new_address_modal" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('addaddress')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
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
                                    <select class="select2" name="country" required>
                                        <option value=""><?php echo app('translator')->get('site.py11'); ?>
                                        </option>
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
                                    <select name="state" class="select2" required>
                                        <option value=""> <?php echo app('translator')->get('site.py12'); ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><?php echo app('translator')->get('site.address'); ?></label>
                                    <textarea name="address" type="text" id="" class="form-control" required
                                        placeholder="<?php echo app('translator')->get('site.address'); ?>" style="height: 100px; resize: none;"></textarea>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="main-btn close border-0"
                            data-dismiss="modal"><?php echo app('translator')->get('site.close'); ?></button>
                        <button type="submit"
                            class="main-btn main animate remove-from-cart border-0"><?php echo app('translator')->get('site.save'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================== Edit product modal =================== -->
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

<script src="https://checkout.tabby.ai/tabby-card.js"></script>
<script src="https://unpkg.com/bowser@2.7.0/es5.js"></script>

<script>
new TabbyCard({
  selector: '#tabbyCard', // empty div for TabbyCard
  currency: 'SAR', // or SAR, BHD, KWD, EGP
  lang: <?php echo json_encode(app()->getLocale()); ?>, // or ar
  price: <?php echo json_encode(\Cart::getTotal()+session()->get('ship')); ?>,
  size: 'wide', // or wide, depending on the width
  theme: 'default', // or can be black
  header: true // if there is a Payment method name already
});
</script>

<script src="https://cdn.tamara.co/widget/installment-plan.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    var result = bowser.getParser(window.navigator.userAgent);
   // if(result.parsedResult.browser.name != 'Safari' || result.parsedResult.browser.name == 'Safari'){
        $('#applepay-option').parent().hide();
   // }
    
    
    $('#tamara-option').click(function() {
    // alert($(this).attr('id')); qrqtr'
    var price = $('.num:last').html().match(/\d+/)[0];
    if(price < 100 ){
        swal("مرحبا بك , لن تتم عملية الدفع تمارا مجموع الطلب اقل من 100 رس")

    }
    
});

</script>
<script>


    setTimeout(() => {
      if (window.TamaraInstallmentPlan) {
        window.TamaraInstallmentPlan.init({ lang: 'en' })
        window.TamaraInstallmentPlan.render()
      }
    }, 2000) // Waiting for 2s - Make sure Tamara's widget is installed
  </script>
    <script>
        $('#payment_methods .payment_method_input').on('change', function() {

            var id = $(this).attr('data-method')

            $('.method-box[id="' + id + '"]').addClass('active').siblings().removeClass('active')

        })


        $(".payment_method_input[name='address']").on('change', function() {
            if ($("#add_new_address").is(':checked')) {
                $("#new_address_box").slideDown();

            } else {
                $("#new_address_box").slideUp();
            }
        })

        $("#edit_address_btn").on('click', function() {
            $("#new_address_box").slideDown();
        })
        
        
        
        
        
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_payment_info",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
              item_id: "SKU_<?php echo e($product->id); ?>",
              item_name: "<?php echo e($product->name); ?>",
              affiliation: "google merchant store",
              coupon: "",
              discount: <?php echo e($product->discount_ratio); ?>,
              index: <?php echo e($product->id); ?>,
              item_brand: "<?php if(isset($product->store) && $product->store->name != ''): ?> <?php echo e($product->store->name); ?> <?php endif; ?>",
              item_category: "<?php echo e($product->category->name); ?>",
              item_list_id: "<?php echo e($product->category->id); ?>",
              item_list_name: "<?php echo e($product->category->name); ?>",
              item_variant: "",
              location_id: "",
              price: <?php echo e($product->sale_price); ?>,
              quantity: <?php echo e($quentites[$k]); ?>

            },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
        }
    });
    
    
          
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "begin_checkout",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
              item_id: "SKU_<?php echo e($product->id); ?>",
              item_name: "<?php echo e($product->name); ?>",
              affiliation: "google merchant store",
              coupon: "",
              discount: <?php echo e($product->discount_ratio); ?>,
              index: <?php echo e($product->id); ?>,
              item_brand: "<?php if(isset($product->store) && $product->store->name != ''): ?> <?php echo e($product->store->name); ?> <?php endif; ?>",
              item_category: "<?php echo e($product->category->name); ?>",
              item_list_id: "<?php echo e($product->category->id); ?>",
              item_list_name: "<?php echo e($product->category->name); ?>",
              item_variant: "",
              location_id: "",
              price: <?php echo e($product->sale_price); ?>,
              quantity: <?php echo e($quentites[$k]); ?>

            },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
        }
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/payment.blade.php ENDPATH**/ ?>