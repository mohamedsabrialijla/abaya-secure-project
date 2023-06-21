<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('site.special_products'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!--======================== Start breadcrumb =============================-->
<div class="breadcrumb pt-10 pb-10">
    <div class="container">
        <div class="product-navigation">
            <ul class="breadcrumb breadcrumb-lg m-0">
                <li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i></a></li>
                <li><?php echo app('translator')->get('site.special_products'); ?></li>
            </ul>
        </div>
    </div>
</div>
<!--======================== End breadcrumb =============================-->


<!--======================== Start contact =============================-->
<section class="contact_page single_designer_page">
    <div class="container">
        <div class="designer_header">
            <div class="designer_box">
                
                <div class="info mb-0">
                    <h5 class="m-0"><?php echo app('translator')->get('site.special_products'); ?></h5>
                </div>
            </div>
        </div>
        <div class="products_section_2">
            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="box_product wow fadeInUp">
                        <figure>
                            <a href="<?php echo e(route('single_product', ['id'=>$m->id])); ?>">
                                <img data-src="<?php echo e($m->image_url ?? asset('uploads/logo.png')); ?>" class="lazyload" width="280" height="280" alt="product">
                                <img data-src="<?php echo e($m->feature_image_url ?? $m->image_url); ?>" class="lazyload" width="280" height="280" alt="product">
                            </a>
                            
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="<?php echo e(route('store', ['id'=>$m->store->id])); ?>" class="product-category"><?php echo e($m->store->name); ?></a>
                            </div>
                            <h3 class="product-title">
                                <a href="<?php echo e(route('single_product', ['id'=>$m->id])); ?>"><?php echo e($m->name); ?></a>
                            </h3>
                            
                            <!-- End .product-container -->
                            <div class="price-box">
                                <?php if($m->discount_ratio > 0): ?>
                                <del class="old-price"><?php echo e($m->price); ?> <?php echo app('translator')->get('site.rs'); ?></del>
                                <?php endif; ?>
                                <span class="product-price"><?php echo e($m->sale_price); ?> <?php echo app('translator')->get('site.rs'); ?></span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="<?php echo e(route('add_to_fav', ['id'=>$m->id])); ?>" class="btn-icon-wish" title="wishlist">
                                    <?php if(Auth::guard('user')->check()): ?>
                                    <?php
                                        $prodfav = \App\Models\Favorite::where('content_id',$m->id)->where('customer_id',Auth::guard('user')->user()->id)->first();
                                    ?>
                                        <?php if($prodfav): ?>
                                        <i class="fas fa-heart"></i></a>
                                        <?php else: ?>
                                        <i class="fal fa-heart"></i></a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <i class="fal fa-heart"></i></a>
                                    <?php endif; ?>
                                    <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span><?php echo app('translator')->get('site.add_cart'); ?></span></button>
                                <a href="<?php echo e(route('single_product', ['id'=>$m->id])); ?>" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
                                <a href="<?php echo e(route('single_product', ['id'=>$m->id])); ?>" class="btn-icon btn-add-cart product-type-simple border-0"><i class="fal fa-eye"></i><span><?php echo app('translator')->get('site.details'); ?></span></a>
                                <a href="<?php echo e(route('single_product', ['id'=>$m->id])); ?>" data-toggle="modal" data-target="#shareModal" class="btn-quickview" aria-label="quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a>
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal shareModal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModelLabel"><?php echo app('translator')->get('site.o39'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="field-share d-flex align-items-center justify-content-between">
                    <span class="fas fa-link text-center"></span>
                    <input type="text" class="field-input" value="some.com/share">
                    <button>Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>
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

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/web/favs_products.blade.php ENDPATH**/ ?>