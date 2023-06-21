

<div class="card-deck row">
    <?php if(count($listings) > 0): ?>
        <?php $__currentLoopData = $listings->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6">
                    <div class="box_product wow fadeInUp">
                        <figure>
                            <a href="<?php echo e(route('single_product', ['id' => $list->id])); ?>">
                                <img data-src="<?php echo e($list->image_url ?? asset('uploads/logo.png')); ?>" class="lazyload"
                                    width="280" height="280" alt="product">
                                <img data-src="<?php echo e($list->feature_image_url ?? $list->image_url); ?>" class="lazyload"
                                    width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                
                                <?php if($list->has_discount): ?>
                                    <div class="product-label label-sale"><?php echo e($list->discount_ratio); ?>%</div>
                                <?php endif; ?>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="<?php echo e(route('store', ['id' => $list->store->id])); ?>"
                                    class="product-category"><?php echo e($list->store->name); ?></a>
                            </div>
                            <h3 class="product-title">
                                <a href="<?php echo e(route('single_product', ['id' => $list->id])); ?>"><?php echo e($list->name); ?></a>
                            </h3>
                            
                            <!-- End .product-container -->
                            <div class="price-box">
                                <?php if($list->discount_ratio > 0): ?>
                                    <del class="old-price"><?php echo e($list->price); ?> <?php echo app('translator')->get('site.rs'); ?></del>
                                <?php endif; ?>
                                <span class="product-price"><?php echo e($list->sale_price); ?> <?php echo app('translator')->get('site.rs'); ?></span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="<?php echo e(route('add_to_fav', ['id' => $list->id])); ?>" class="btn-icon-wish"
                                    title="wishlist">
                                    <?php if(Auth::guard('user')->check()): ?>
                                        <?php
                                            $prodfav = \App\Models\Favorite::where('content_id', $list->id)
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
                                <a href="<?php echo e(route('single_product', ['id' => $list->id])); ?>" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
        <a href="<?php echo e(route('single_product', ['id' => $list->id])); ?>"
            class="btn-icon btn-add-cart product-type-simple border-0"><i
                class="fal fa-eye"></i><span><?php echo app('translator')->get('site.details'); ?></span></a>
        <a href="<?php echo e(route('single_product', ['id' => $list->id])); ?>" data-toggle="modal" data-target="#shareModal"
            class="btn-quickview" aria-label="quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a>
</div>
</div>
<!-- End .product-details -->
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--<div class="w-100">&nbsp;</div>-->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div class="notFound">
    <img src="<?php echo e(asset('images/not-found.jpg')); ?>" />
    <p><?php echo app('translator')->get('site.o40'); ?></p>
</div>

<?php endif; ?>
</div>
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
<div class="panel">
    <div class="panel-body">
        <nav aria-label="Page navigation example">
            <?php echo e($listings->links('pagination::bootstrap-4')); ?>

        </nav>
    </div>
</div>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = url.split('page=')[1];
            window.history.pushState("", "", url);
            faceted(page);
        })
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /home/abayasquare/public_html/new/resources/views/filter/products.blade.php ENDPATH**/ ?>