
<?php $__env->startSection('css'); ?>
<style>
.hidden{
    display:none;
}
</style>
<script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=6304876ea2413d00197af78c&product=inline-share-buttons"
        async="async"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 
    <!--======================== Start single product =============================-->
    <section class="single_product_page">
        <div class="container">
            <div class="content_page">
                <div class="product-navigation">
                    <ul class="breadcrumb breadcrumb-lg">
                        <li><a href="demo1.html"><i class="fal fa-home"></i></a></li>
                        <li><a href="<?php echo e(route('store', ['id' => $product->store->id])); ?>"
                                class="active"><?php echo e($product->store->name); ?> </a></li>
                        <li><?php echo e($product->name); ?></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product_iamges">
                            <!--=========================== start thumb ============================-->
                            <div class="thumb">
                                <div id="big_image" class="owl-carousel owl-theme">

                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <img src="<?php echo e(asset('uploads/' . $img->image)); ?>"
                                                alt="product image" />
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div id="thumbs_gallary" class="owl-carousel owl-theme">
                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <img src="<?php echo e(asset('uploads/' . $img->image)); ?>" width="130" height="100"
                                                alt="product image" />
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details mt-md-30">
                            <h1 class="product-name"><?php echo e($product->name); ?></h1>
                            <div class="product-meta">
                                <?php echo app('translator')->get('site.category'); ?>: <span><a
                                        href="<?php echo e(route('cat', ['id' => $product->category->id])); ?>"><?php echo e($product->category->name); ?></a></span>
                                <?php echo app('translator')->get('site.designer'); ?>:
                                <span><a
                                        href="<?php echo e(route('store', ['id' => $product->store->id])); ?>"><?php echo e($product->store->name); ?></a></span>
                                <img src="<?php echo e($product->store->image_url ?? asset('assets/img/logo.webp')); ?>" width="35"
                                    height="35" alt="">
                            </div>
                            <div class="product-price">
                                <?php if($product->discount_ratio > 0): ?>

                                <del class="old-price" style="color: #cac2b3"><?php echo e($product->price); ?> <?php echo app('translator')->get('site.rs'); ?></del>
                                <?php endif; ?>
                                <span class="price"><?php echo e($product->sale_price); ?> <?php echo app('translator')->get('site.rs'); ?></span>
                            </div>
                            
                            <div class="product-short-desc">
                                <?php echo $product->details; ?>

                            </div>

                            <form action="<?php echo e(route('add_to_cart')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                <!-- <div class="product-form product-variations product-color">
                                                                <label><?php echo app('translator')->get('site.color'); ?>:</label>
                                                                <div class="select-box">
                                                                    <select name="color" class="form-control " id="mySelectBox2">
                                                                        <option><?php echo app('translator')->get('site.choose_color'); ?></option>
                                                                        <?php $__currentLoopData = $product->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div> -->
                                <?php if($product->category->id != 29): ?>
                                <div class="product-form product-variations product-size">
                                    <label><?php echo app('translator')->get('site.size'); ?>:</label>

                                    <div class="product-form-group">
                                        <div class="select-box">
                                            <select name="size" class="form-control" id="mySelectBox">
                                                <option   disabled selected><?php echo app('translator')->get('site.choose_size'); ?></option>
                                                <?php $__currentLoopData = $product->productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($size->size_id); ?>"
                                                        <?php if($size->qty() <= 0): ?> disabled <?php endif; ?>>
                                                        <?php echo e($size->size->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>
                                        </div>

                                    </div>
                                    <?php else: ?>
                                    <select name="size" class="form-control hidden" id="mySelectBox">
                                                <!--<option   disabled selected><?php echo app('translator')->get('site.choose_size'); ?></option>-->
                                                <?php $__currentLoopData = $product->productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($size->size_id); ?>"
                                                        <?php if($size->size_id == 28): ?> selected <?php endif; ?>>
                                                        <?php echo e($size->size->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>
                                            
                                            
                                    <?php endif; ?>
                                    <!--dfgksgjk-->
                                    <!--jhgjhghjgh-->

                                </div>
                                <?php if($stock <= 0): ?>
                                <div>
                                <h1 class="not-found"
                                style="
                                    text-align: rigth;
                                    color: #aaa;
                                    font-weight: bold;
                                    margin: 30px 0;
                                    font-size: 40px;">
                                    <?php echo app('translator')->get('site.o41'); ?>
                                </h1>
                                </div>
                                <?php endif; ?>
                                <hr class="product-divider">

                                <div class="product-form product-qty">
                                    <div class="product-form-group">
                                        <div class="input-group mr-2">
                                            <button type="button" class="quantity-minus d-icon-minus"><i
                                                    class="fal fa-minus"></i></button>
                                            <input class="quantity form-control" name="quantity" type="number"
                                                min="1" max="50" value="1">
                                            <button type="button" class="quantity-plus d-icon-plus"><i
                                                    class="fal fa-plus"></i></button>
                                        </div>
                                        <button class="btn-cart" type="submit" <?php if($stock <= 0): ?> disabled <?php endif; ?>>
                                            <i class="fal fa-shopping-bag"></i>
                                            <span><?php echo app('translator')->get('site.add_to_cart'); ?></span>
                                        </button>

 
 
                                    </div>

                                </div>
                            </form> 
                            <?php if($product->category->id != 29): ?>
                            <a href="<?php echo e(url(app()->getLocale().'/table_size')); ?>"><i class="fa  fa-scissors fa-flip-vertical" style="margin-left: 10px;"></i><?php echo app('translator')->get('site.table_size'); ?> </a>
                            <?php endif; ?>
                            <hr class="product-divider d-lg-show mb-3">
                            <div id="TabbyPromo" class="mb-10"></div>
                            <div class="tamara-product-widget" data-lang="<?php echo e(app()->getLocale()); ?>"
                                data-price="<?php echo e($product->sale_price); ?>" data-currency="SAR" data-country-code="SA"
                                data-color-type="default" data-show-border="true" data-payment-type="installment"
                                data-number-of-installments="3" data-disable-installment="false"
                                data-disable-paylater="true">
                            </div>
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
                            <hr class="product-divider d-lg-show mb-3">
                            <div class="product-footer">
                                <div class="social-links mr-4">
                                    <div class="sharethis-inline-share-buttons"></div>
                                    
                                </div>

                                <div class="product-action">
                                    
                                    <a href="<?php echo e(route('add_to_fav', ['id' => $product->id])); ?>"
                                        class="btn-product btn-wishlist gap-5" title="wishlist">
                                        <?php if(Auth::guard('user')->check()): ?>
                                            <?php
                                                $prodfav = \App\Models\Favorite::where('content_id', $product->id)
                                                    ->where('customer_id', Auth::guard('user')->user()->id)
                                                    ->first();
                                            ?>
                                            <?php if($prodfav): ?>
                                                <i class="fas fa-heart"></i>
                                                <span><?php echo app('translator')->get('site.remove_from_fav'); ?></span>
                                    </a>
                                <?php else: ?>
                                    <i class="fal fa-heart"></i>
                                    <span><?php echo app('translator')->get('site.add_to_fav'); ?></span></a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <i class="fal fa-heart"></i>
                                    <span><?php echo app('translator')->get('site.add_to_fav'); ?></span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--====== for no products =====-->

        </div>

    </section>
    <!--======================== End single product =============================-->

    <!--======================== Start similar products section =============================-->
    <section class="products_section">
        <div class="container">
            <h2 class="section-title heading-border wow fadeInUp"><?php echo app('translator')->get('site.you_may_like'); ?></h2>
            <div class="owl-carousel wow fadeInUp">
                <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item_carousel">
                        <div class="box_product wow fadeInUp">
                            <figure>
                                <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>">
                                    <img data-src="<?php echo e($m->image_url ?? asset('uploads/logo.png')); ?>" class="lazyload"
                                        width="280" height="280" alt="product">
                                    <img data-src="<?php echo e($m->feature_image_url ?? asset('uploads/logo.png')); ?>"
                                        class="lazyload" width="280" height="280" alt="product">
                                </a>
                                
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="<?php echo e(route('store', ['id' => $m->store->id])); ?>"
                                        class="product-category"><?php echo e($m->store->name); ?></a>
                                </div>
                                <h2 class="product-title">
                                    <a href="<?php echo e(route('single_product', ['id' => $m->id])); ?>"><?php echo e($m->name); ?></a>
                                </h2>
                                
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal shareModal fade" id="shareModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!--======================== End similar products section =============================-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.tamara.co/widget/product-widget.min.js"></script>
    <script>
        setTimeout(() => {
            if (window.TamaraProductWidget) {
                window.TamaraProductWidget.init({
                    lang: 'en'
                })
                window.TamaraProductWidget.render()
            }
        }, 2000) // Waiting for 2s - Make sure Tamara's widget is installed
    </script>
    <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
    <script>
        new TabbyPromo({
            selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
            currency: 'SAR', // required, currency of your product. AED|SAR|KWD|BHD|EGP only supported, with NO spaces or lowercase.
            price: <?php echo json_encode($product->sale_price); ?>, // required, price or your product. 2 decimals max for AED|SAR|EGP and 3 decimals max for KWD|BHD supported.
            installmentsCount: 4, // Optional - custom installments number for tabby promo snippet (if not downpayment + 3 installments)
            lang: <?php echo json_encode(app()->getLocale()); ?>, // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag
            source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page
            publicKey: 'PUBLIC_API_KEY', // required, public key which identifies your account when communicating with tabby. Test or Production depending on the environment
            merchantCode: 'AbayaSquare' // required
        });
    </script>
    
    
    
    <!-- Google tag (gtag.js) -->
<script>

 



dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_item",
  ecommerce: {
    currency: "SAR",
    value: <?php echo e($product->sale_price); ?>,
    items: [
    {
       item_id: "SKU_<?php echo e($product->id); ?>",
      item_name: "<?php echo e($product->name); ?>",
      affiliation: "google merchant store",
      coupon: "",
      discount: <?php echo e($product->discount_ratio); ?>,
      index: <?php echo e($product->id); ?>,
      item_brand: "<?php echo e($product->store->name); ?>",
      item_category: "<?php echo e($product->category->name); ?>",
      item_list_id: "<?php echo e($product->category->id); ?>",
      item_list_name: "<?php echo e($product->category->name); ?>",
      item_variant: "",
      location_id: "",
      price: <?php echo e($product->sale_price); ?>,
      quantity: 1
    }
    ]
  }
});



<?php if(isset($products) && count($products) > 0  && $check == 1): ?>
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_to_cart",
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


<?php else: ?>
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "select_item",
  ecommerce: {
    currency: "SAR",
    value: <?php echo e($product->sale_price); ?>,
    items: [
    {
       item_id: "SKU_<?php echo e($product->id); ?>",
      item_name: "<?php echo e($product->name); ?>",
      affiliation: "google merchant store",
      coupon: "",
      discount: <?php echo e($product->discount_ratio); ?>,
      index: <?php echo e($product->id); ?>,
      item_brand: "<?php echo e($product->store->name); ?>",
      item_category: "<?php echo e($product->category->name); ?>",
      item_list_id: "<?php echo e($product->category->id); ?>",
      item_list_name: "<?php echo e($product->category->name); ?>",
      item_variant: "",
      location_id: "",
      price: <?php echo e($product->sale_price); ?>,
      quantity: 1
    }
    ]
  }
});


<?php endif; ?> 
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/single_product.blade.php ENDPATH**/ ?>