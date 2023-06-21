
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--======================== Start breadcrumb =============================-->
    
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start order =============================-->
    
    
    <!--<?php if(Session::has('success')): ?>-->
    <!--    <ul style="border: 1px solid #01b070; background-color: white">-->
    <!--        <li style="color: #01b070; margin: 15px">jkhjkhjkhhk</li>-->
    <!--    </ul>-->
    <!--<?php endif; ?>-->
    <section class="order_page"  >
        <div class="container">

            <div class="form-wizard-header">
                <ul class="list-unstyled form-wizard-steps clearfix" id="progressbar">
                    <?php if(is_null($casenew)): ?>
                        <li>
                            <div class="icon">
                                <i class="fal fa-bags-shopping"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o4'); ?></h6>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-bags-shopping"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o4'); ?></h6>
                                <span
                                    class="date"><?php echo e(\Carbon\Carbon::parse(@$casenew->created_at)->translatedFormat('D jS M Y g:i a')); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(is_null($caseconfirm)): ?>
                        <li>
                            <div class="icon">
                                <i class="fal fa-thumbs-up"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o5'); ?></h6>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-thumbs-up"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o5'); ?></h6>
                                <span
                                    class="date"><?php echo e(\Carbon\Carbon::parse(@$caseconfirm->created_at)->translatedFormat('D jS M Y g:i a')); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(is_null($caseshipping)): ?>
                        <li>
                            <div class="icon">
                                <i class="fal fa-truck-loading"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o6'); ?></h6>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-truck-loading"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o6'); ?></h6>
                                <span
                                    class="date"><?php echo e(\Carbon\Carbon::parse(@$caseshipping->created_at)->translatedFormat('D jS M Y g:i a')); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(is_null($caseshipped)): ?>
                        <li>
                            <div class="icon">
                                <i class="fal fa-shipping-timed"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o7'); ?></h6>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-shipping-timed"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o7'); ?></h6>
                                <span
                                    class="date"><?php echo e(\Carbon\Carbon::parse(@$caseshipped->created_at)->translatedFormat('D jS M Y g:i a')); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(is_null($casedelivery)): ?>
                        <li>
                            <div class="icon">
                                <i class="fal fa-shipping-fast"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o8'); ?></h6>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-shipping-fast"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o8'); ?></h6>
                                <span
                                    class="date"><?php echo e(\Carbon\Carbon::parse(@$casedelivery->created_at)->translatedFormat('D jS M Y g:i a')); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(is_null($casedelivered)): ?>
                        <li>
                            <div class="icon">
                                <i class="fal fa-check-double"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o9'); ?></h6>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <div class="icon">
                                <i class="fal fa-check-double"></i>
                            </div>
                            <div class="details">
                                <h6><?php echo app('translator')->get('site.o9'); ?></h6>
                                <span
                                    class="date"><?php echo e(\Carbon\Carbon::parse(@$casedelivered->created_at)->translatedFormat('D jS M Y g:i a')); ?></span>
                            </div>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
            <div class="mt-50">
                <a href="<?php echo e($order->invoice_url); ?>" target="_blank" class="main-btn main animate">
                    <?php echo app('translator')->get('site.o1'); ?>
                </a>
                
                <?php if($order->case_id > 3 && $order->case_id != 9): ?>

                <a href="http://www.sls-express.com/tracking?tracking_number=<?php echo e($order->shipment_id); ?>" target="_blank"
                    class="main-btn main animate">
                    <?php echo app('translator')->get('site.o3'); ?>
                </a>
                <?php endif; ?>
            </div>
            <div>
                <div class="box-style">
                    <h4><?php echo app('translator')->get('site.o11'); ?></h4>
                    <div class="details">
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o12'); ?>:</h6>
                            <span>#<?php echo e($order->invoice_number); ?></span>
                        </div>
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o13'); ?>:</h6>
                            <span class="calendar">
                                <i class="fa fa-calendar" aria-hidden="true"></i>

                                <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')); ?>


                                <i class="fa fa-clock" aria-hidden="true"></i>

                                <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('H:i A')); ?>


                            </span>
                        </div>
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o14'); ?>:</h6>
                            <span>
                                <?php echo e(@$order->paymentType->name); ?>

                            </span>
                            &nbsp; &nbsp;
                            <?php if($order->payment_type_id != 4 && $order->use_wallet): ?>
                                <?php echo app('translator')->get('site.18'); ?>(<?php echo e($order->wallet_amount); ?>)
                            <?php endif; ?>
                        </div>
                        <?php if($order->transaction && $order->transaction->tranid): ?>
                            <div class="item">
                                <h6><?php echo app('translator')->get('site.o15'); ?>:</h6>
                                <span><?php echo e(@$order->transaction->tranid); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o16'); ?>:</h6>
                            <span><?php echo e(@$order->status->name); ?></span>
                        </div>
                        <?php if($order->shipment_id): ?>
                            <div class="item">
                                <h6><?php echo app('translator')->get('site.o16'); ?>:</h6>
                                <span><?php echo e(@$order->shipment_id); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box-style">
                    <h4><?php echo app('translator')->get('site.o10'); ?></h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><?php echo app('translator')->get('site.o19'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o20'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o21'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o22'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o23'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o24'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o25'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('site.o26'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><img src="<?php echo e(asset('uploads/' . @$product->product->image)); ?>" /></td>
                                        <td><?php echo e(@$product->product->store->name); ?></td>
                                        <td><?php echo e(@$product->product->name); ?></td>
                                        <td><?php echo e(@$product->size->name); ?></td>
                                        <td><?php echo e(@$product->qty); ?></td>
                                        <td><?php echo e(@$product->price); ?></td>
                                        <td><?php echo e(@$product->discount); ?></td>
                                        <td><?php echo e(@$product->total); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="box-style">
                    <h4><?php echo app('translator')->get('site.o27'); ?></h4>
                    <div class="details">
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o28'); ?>:</h6>
                            <span><?php echo e($order->sub_total_1); ?> <span><?php echo e($currency); ?></span></span>
                        </div>
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o29'); ?>:</h6>
                            <span><?php echo e(@$order->tax); ?> <span><?php echo e($currency); ?></span> </span>
                        </div>
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o30'); ?>:</h6>
                            <span> <?php echo e(@$order->discount); ?> <span><?php echo e($currency); ?></span></span>
                        </div>
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o31'); ?>:</h6>
                            <span> <?php echo e($order->delivery_cost); ?> <span><?php echo e($currency); ?></span></span>
                        </div>
                    </div>
                    <hr>
                    <div class="details">
                        <div class="item">
                            <h6><?php echo app('translator')->get('site.o32'); ?>:</h6>
                            <span><?php echo e($order->total); ?> <span><?php echo e($currency); ?> </span></span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End order =============================-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $( document ).ready(function() {
    $('.swal2-icon-success').attr('id', 'success_payment_in_abayasquare');
});



dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_payment_info",
  ecommerce: { 
    currency: "SAR",
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        
        ]
        }
    });
     

<?php if($check == 1): ?>

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "purchase",
  ecommerce: {
      transaction_id: "T_<?php echo e($order->id); ?>",
      value: "<?php echo e($order->total); ?>",
      tax: "<?php echo e($order->tax); ?>",
      shipping: "0.0",
      currency: "SAR",
      coupon: "SUMMER_SALE",
      items: [
      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       {
        item_id: "SKU_<?php echo e($product->id); ?>",
        item_name: "<?php echo e($product->name); ?>",
        affiliation: "Google Merchandise Store",
        coupon: "SUMMER_FUN",
        discount: "0.0",
        index: "<?php echo e($product->id); ?>",
        item_category4: "<?php echo e($check); ?>",
        item_category5: "Short sleeve",
        item_list_id: "related_products",
        item_list_name: "Related Products",
        item_variant: "green",
        location_id: "ChIJIQBpAG2ahYAR_6128GcTUEo",
        price: <?php echo e($product->sale_price); ?>,
        quantity: 1
      },
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      ]
      //rwjgrk
  }
});

<?php endif; ?>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/single_order.blade.php ENDPATH**/ ?>