<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('site.fav_products'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="products_section">
        <div class="container">

            <h2 class="section-title heading-borderwow fadeInUp"><?php echo app('translator')->get('site.fav_products'); ?></h2>
            <div class="products_section_2">
                <div class="row">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($m->is_active == true): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
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
                            <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
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
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(empty($products->first())): ?>
        <div class="notFound">
            
            <p><?php echo app('translator')->get('site.o42'); ?></p>
        </div>
        <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/fav.blade.php ENDPATH**/ ?>