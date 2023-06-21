<?php $__env->startSection('css'); ?>
    <meta name="robots" content="noindex">
    <title><?php echo $__env->yieldContent('title'); ?></title>
<?php $__env->stopSection(); ?>
<?php

    $features = \App\Models\Product::where('is_active', true)
        ->where('is_feature', 1)
        ->inRandomOrder()
        ->take(10)
        ->get();
    $sales = \App\Models\Product::where('is_active', true)
        ->where('show_in_slider', '1')
        ->inRandomOrder()
        ->take(10)
        ->get();
?>
<?php $__env->startSection('content'); ?>
    <section class="error_page">
        <div id="particles-js"></div>
        <div class="content">
            <div class="content-box text-center">
                <div class="big-content">
                    <div class="list-square"> <span class="square"></span> <span class="square"></span> <span
                            class="square"></span> </div>
                    <div class="list-line"> <span class="line"></span> <span class="line"></span> <span
                            class="line"></span> <span class="line"></span> <span class="line"></span> <span
                            class="line"></span> </div>
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <div class="clear"></div>
                </div>
                <h1><?php echo $__env->yieldContent('code'); ?></h1>
                <p><?php echo $__env->yieldContent('message'); ?></p>
            </div>
        </div>

    </section>

    <!--======================== Start products section =============================-->
    <section class="products_section">
        <div class="container">
            <div class="heading-side mb-30">
                <h2 class="section-title heading-border wow fadeInUp"><?php echo app('translator')->get('site.special_products'); ?></h2>
                <a href="<?php echo e(route('special')); ?>" class="main-btn main"><?php echo app('translator')->get('site.show_all'); ?></a>
            </div>
            <div class="owl-carousel wow fadeInUp">
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item_carousel">
                        <div class="box_product wow fadeInUp">
                            <figure>
                                <a href="<?php echo e(route('single_product', ['id' => $f->id])); ?>">
                                    <img data-src="<?php echo e($f->feature_image_url ?? $f->image_url); ?>" class="lazyload"
                                        width="280" height="280" alt="product">
                                    <img data-src="<?php echo e($f->image_url ?? asset('uploads/logo.png')); ?>" class="lazyload"
                                        width="280" height="280" alt="product">
                                </a>
                                
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="<?php echo e(route('store', ['id' => $f->store->id])); ?>"
                                        class="product-category"><?php echo e($f->store->name); ?></a>
                                </div>
                                <h3 class="product-title">
                                    <a href="<?php echo e(route('single_product', ['id' => $f->id])); ?>"><?php echo e($f->name); ?></a>
                                </h3>
                                
                                <!-- End .product-container -->
                                <div class="price-box">
                                    <?php if($f->discount_ratio > 0): ?>
                                    <del class="old-price"><?php echo e($f->price); ?> <?php echo app('translator')->get('site.rs'); ?></del>
                                    <?php endif; ?>
                                    <span class="product-price"><?php echo e($f->sale_price); ?> <?php echo app('translator')->get('site.rs'); ?></span>
                                </div>
                                <!-- End .price-box -->
                                <div class="product-action">
                                    <a href="<?php echo e(route('add_to_fav', ['id' => $f->id])); ?>" class="btn-icon-wish"
                                        title="wishlist">
                                        <?php if(Auth::guard('user')->check()): ?>
                                            <?php
                                                $prodfav = \App\Models\Favorite::where('content_id', $f->id)
                                                    ->where('customer_id', Auth::guard('user')->user()->id)
                                                    ->first();
                                            ?>
                                            <?php if($prodfav): ?>
                                                <i class="fas fa-heart"></i>
                                    </a>
                                <?php else: ?>
                                    <i class="fal fa-heart"></i></a>
                <?php endif; ?>
            <?php else: ?>
                <i class="fal fa-heart"></i></a>
                <?php endif; ?>
                <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span><?php echo app('translator')->get('site.add_cart'); ?></span></button> -->

                <!-- <a href="<?php echo e(route('single_product', ['id' => $f->id])); ?>" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
                <a href="<?php echo e(route('single_product', ['id' => $f->id])); ?>"
                    class="btn-icon btn-add-cart product-type-simple border-0">
                    <i class="fal fa-eye"></i>
                    <span><?php echo app('translator')->get('site.details'); ?></span>
                </a>
                <a href="<?php echo e(route('single_product', ['id' => $f->id])); ?>" data-toggle="modal" data-target="#shareModal"
                    class="btn-quickview" aria-label="Quickview" title="Quick View">
                    <i class="fa-light fa-share-nodes"></i>
                </a>
            </div>
        </div>
        <!-- End .product-details -->
        </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
    </section>
    <!--======================== End products section =============================-->
    <!--======================== Start products section =============================-->
    <section class="products_section">
        <div class="container">
            
            <div class="heading-side mb-30">
                <h2 class="section-title heading-border wow fadeInUp"><?php echo app('translator')->get('site.most_selling'); ?></h2>
                <a href="<?php echo e(route('most_sell')); ?>" class="main-btn main"><?php echo app('translator')->get('site.show_all'); ?></a>
            </div>
            <div class="owl-carousel wow fadeInUp">
                <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item_carousel">
                        <div class="box_product wow fadeInUp">
                            <figure>
                                <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>">
                                    <img data-src="<?php echo e($m->image_url ?? asset('uploads/logo.png')); ?>" class="lazyload"
                                        width="280" height="280" alt="product">
                                    <img data-src="<?php echo e($m->feature_image_url ?? $m->image_url); ?>" class="lazyload"
                                        width="280" height="280" alt="product">
                                </a>
                                
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="<?php echo e(route('store', ['id' => $m->store->id])); ?>"
                                        class="product-category"><?php echo e($m->store->name); ?></a>
                                </div>
                                <h3 class="product-title">
                                    <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>"><?php echo e($m->name); ?></a>
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
                                    <a href="<?php echo e(route('add_to_fav', ['id' => $m->id])); ?>" class="btn-icon-wish"
                                        title="wishlist">
                                        <?php if(Auth::guard('user')->check()): ?>
                                            <?php
                                                $prodfav = \App\Models\Favorite::where('content_id', $m->id)
                                                    ->where('customer_id', Auth::guard('user')->user()->id)
                                                    ->first();
                                            ?>
                                            <?php if($prodfav): ?>
                                                <i class="fas fa-heart"></i>
                                    </a>
                                <?php else: ?>
                                    <i class="fal fa-heart"></i></a>
                <?php endif; ?>
            <?php else: ?>
                <i class="fal fa-heart"></i></a>
                <?php endif; ?>
                <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span><?php echo app('translator')->get('site.add_cart'); ?></span></button>
                                <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
                <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>"
                    class="btn-icon btn-add-cart product-type-simple border-0"><i
                        class="fal fa-eye"></i><span><?php echo app('translator')->get('site.details'); ?></span></a>
                <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>" data-toggle="modal" data-target="#shareModal"
                    class="btn-quickview" aria-label="quickview" title="Quick View"><i
                        class="fa-light fa-share-nodes"></i></a>
            </div>
        </div>
        <!-- End .product-details -->
        </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
    </section>
    <!--======================== End products section =============================-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/errors/minimal.blade.php ENDPATH**/ ?>