
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('site.cart'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10" style="background-color: #988a760d;">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i></a></li>
                    <li><?php echo app('translator')->get('site.cart'); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start cart =============================-->
    <section class="cart_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="my_products wow fadeInUp">
                                <div class="cart_product">
                                    <div class="info_broduct d-flex">
                                        <a href="<?php echo e(route('single_product', $item->attributes->product_id)); ?>" class="image d-block"><img
                                                src="<?php echo e($item->attributes->image); ?>" alt=""></a>
                                        <div class="details">
                                            <h6 class="name"><a
                                                    href="<?php echo e(route('single_product', $item->attributes->product_id)); ?>"><?php echo e($item->name); ?></a></h6>
                                            <div class="price">
                                                <span class="num bold"><?php echo e($item->price); ?></span>
                                                <span class="text"><?php echo app('translator')->get('site.rs'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="meta mt-20">
                                        <div class="product-form product-size">
                                            <label><?php echo app('translator')->get('site.size'); ?>:</label>
                                            <div class="product-form-group">
                                                <label for=""><?php echo e($item->attributes->size); ?></label>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="product-form product-qty">
                                            <label><?php echo app('translator')->get('site.quantity'); ?>:</label>
                                            <form action="<?php echo e(route('update_cart')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>" >
                                            <div class="product-form-group">
                                                <div class="input-group mr-2">
                                                    <button class="quantity-minus d-icon-minus update-cart"><i
                                                            class="fal fa-minus"></i></button>
                                                    <input class="quantity form-control" type="number" min="1"
                                                        max="1000000" value="<?php echo e($item->quantity); ?>" name="quantity">
                                                    <button class="quantity-plus d-icon-plus update-cart"><i
                                                            class="fal fa-plus"></i></button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>


                                    </div>
                                    <div class="more_details">
                                        <button type="button" class="delete_product_btn " data-toggle="modal"
                                            data-target="#delete_product_modal<?php echo e($item->id); ?>">
                                            <i class="fal fa-times-circle"></i>
                                        </button>
                                    </div>
                                    <!-- ==================== Delete product modal =================== -->

                                    <div class="modal fade custom_modal" data-id="<?php echo e($item->id); ?>"
                                        id="delete_product_modal<?php echo e($item->id); ?>" tabindex="-1"
                                        aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('remove_from_cart')); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <p class="m-0"><?php echo app('translator')->get('site.delete_cart'); ?></p>
                                                        <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="main-btn close animate"
                                                            data-dismiss="modal"><?php echo app('translator')->get('site.no'); ?></button>
                                                        <button type="submit"
                                                            class="main-btn main animate remove-from-cart"><?php echo app('translator')->get('site.yes'); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ==================== Delete product modal =================== -->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <a href="<?php echo e(route('checkout')); ?>" class="main-btn main animate w-100"><?php echo app('translator')->get('site.checkout'); ?></a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End cart =============================-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '<?php echo e(route('update_cart')); ?>',
                method: "patch",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: ele.parents("div").attr("data-id"),
                    quantity: ele.parents("div").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        // $(".remove-from-cart").click(function(e) {
        //     e.preventDefault();

        //     var ele = $(this);


        //     $.ajax({
        //         url: '<?php echo e(route('remove_from_cart')); ?>',
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
        
        //kfwrjkghjkrehtgjkwre

 <?php 
 $products2 = Session::get('products2'); 
 $products_session = Session::get('products'); 

 ?>
       
<?php if(isset($products) && count($products) > 0): ?>

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_cart",
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
    
    
   <?php endif; ?> 



         
<?php if(isset($products_session) && count($products_session) > 0): ?>

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_cart",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        <?php $__currentLoopData = $products_session; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    
    
   <?php endif; ?> 
    



<?php if(isset($products2) && count($products2) > 0): ?>
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "remove_from_cart",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        <?php $__currentLoopData = $products2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
              quantity: 1
            },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
        }
    });
     
<?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/web/cart.blade.php ENDPATH**/ ?>