
<?php $__env->startSection('css'); ?>
<style type="text/css">
    
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('site.home'); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--======================== Start slider =============================-->
    <section class="header_section">
        <div class="cd-slider" id="cd-slider">
            <ul>
                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li data-color="#2a2424">
                    <a href="#" class="content d-block text-center" aria-label="Product details" style="background-image:url()">
                        <img src="<?php echo e($offer->image_url); ?>" alt="banner" width="auto" height="600" class="img-slider">
                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <nav>
                <div>
                    <a class="prev" href="#" aria-label="Prev"><i class="fal fa-chevron-left"></i></a>
                </div>
                <div>
                    <a class="next" href="#" aria-label="Next"><i class="fal fa-chevron-right"></i></a>
                </div>
            </nav>
        </div>
    </section>
    <!--======================== End slider =============================-->

    <!--======================== Start icon box wrapper =============================-->
    
    <!--======================== End icon box wrapper =============================-->



    <!--======================== Start categories section =============================-->
    <section class="categories_section wow fadeInUp">
        <div class=" container">
            <h2 class="section-title heading-border ls-20 border-0"><?php echo app('translator')->get('site.cats'); ?></h2>
            <div class="row justify-content-center mt-30">
               <?php if(isset($cats) && $cats != ''): ?>
               <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-12 col-12">
                    <a href="<?php echo e(route('cat', ['id' => $cat->id])); ?>" class="category category-ellipse d-block">
                        <div class="category-media">
                            <img data-src="<?php echo e($cat->image_url); ?>" class="lazyload" loading="lazy" alt="Categroy" width="190" height="190" style="background-color: #E2E2E2;">
                        </div>
                        <div class="category-content">
                            <h4 class="category-name">
                                <?php echo e($cat->name); ?>

                            </h4>
                        </div>
                    </a>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-4 col-6">
                    <a href="<?php echo e(route('cat', ['id' => $cat->id])); ?>" class="category category-ellipse d-block">
                        <div class="category-media">
                            <img data-src="<?php echo e($cat->image_url); ?>" class="lazyload" loading="lazy" alt="Categroy" width="190" height="190" style="background-color: #E2E2E2;">
                        </div>
                        <div class="category-content">
                            <h4 class="category-name">
                                <?php echo e($cat->name); ?>

                            </h4>
                        </div>
                    </a>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!--======================== End categories section =============================-->

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
                            <a href="<?php echo e(route('single_product', ['id'=>$f->id])); ?>">
                                <img data-src="<?php echo e($f->feature_image_url ?? $f->image_url); ?>" class="lazyload" width="280" height="280" alt="product">
                                <img data-src="<?php echo e($f->image_url ?? asset('uploads/logo.png')); ?>" class="lazyload" width="280" height="280" alt="product">
                            </a>
                            
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="<?php echo e(route('store', ['id'=>$f->store->id])); ?>" class="product-category"><?php echo e($f->store->name); ?></a>
                            </div>
                            <h3 class="product-title">
                                <a href="<?php echo e(route('single_product', ['id'=>$f->id])); ?>"><?php echo e($f->name); ?></a>
                            </h3>
                            
                            <!-- End .product-container -->
                            <div class="price-box">
                                <!--<?php if($f->discount_ratio > 0): ?>-->
                                <!--    <del class="old-price"><?php echo e($f->price); ?> <?php echo app('translator')->get('site.rs'); ?></del>-->
                                <!--<?php endif; ?>-->
                                <span class="product-price"><?php echo e($f->sale_price); ?> <?php echo app('translator')->get('site.rs'); ?></span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="<?php echo e(route('add_to_fav', ['id'=>$f->id])); ?>" class="btn-icon-wish" title="wishlist">
                                    <?php if(Auth::guard('user')->check()): ?>
                                    <?php
                                        $prodfav = \App\Models\Favorite::where('content_id',$f->id)->where('customer_id',Auth::guard('user')->user()->id)->first();
                                    ?>
                                        <?php if($prodfav): ?>
                                        <i class="fas fa-heart"></i></a>
                                        <?php else: ?>
                                        <i class="fal fa-heart"></i></a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <i class="fal fa-heart"></i></a>
                                    <?php endif; ?>
                                <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span><?php echo app('translator')->get('site.add_cart'); ?></span></button> -->

                                <!-- <a href="<?php echo e(route('single_product', ['id'=>$f->id])); ?>" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
                                <a href="<?php echo e(route('single_product', ['id'=>$f->id])); ?>" class="btn-icon btn-add-cart product-type-simple border-0">
                                    <i class="fal fa-eye"></i>
                                    <span><?php echo app('translator')->get('site.details'); ?></span>
                                </a>
                                <a href="<?php echo e(route('single_product', ['id'=>$f->id])); ?>" data-toggle="modal" data-target="#shareModal" class="btn-quickview" aria-label="Quickview" title="Quick View">
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

    <!--======================== Start promo section =============================-->

    

    <!--======================== End promo section =============================-->

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
                                <del class="old-price"><?php echo e($m->price); ?> <?php echo app('translator')->get('site.rs'); ?></del>
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
                                <a href="<?php echo e(route('single_product', ['id'=>$m->id])); ?>" class="btn-quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a> -->
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
    </section>
    <!--======================== End products section =============================-->

    <!--======================== Start slider =============================-->
    <section class="header_section stores_header">
        <div class="cd-slider" id="cd-slider-2">
            <ul>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li data-color="#2a2424">
                    <a href="#" class="content d-block text-center" aria-label="Product Details" style="background-image:url()">
                        <img src="<?php echo e($slider->image_url); ?>" alt="banner" width="auto" height="600" class="img-slider">

                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <nav>
                <div>
                    <a class="prev" href="#" aria-label="Prev"><i class="fal fa-chevron-left"></i></a>
                </div>
                <div>
                    <a class="next" href="#" aria-label="Next"><i class="fal fa-chevron-right"></i></a>
                </div>
            </nav>
        </div>
    </section>
    <!--======================== End slider =============================-->

    <!-- ==================== Start our designers =================== -->
    <section class="our_designers_section mt-50">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="designer_box gsap-reveal-hero">
                        <div class="image"><img data-src="<?php echo e(asset('uploads/'.$store->logo)); ?>" width="100" height="100" class="lazyload" alt="img"></div>
                        <div class="info">
                            <h5><?php echo e($store->name); ?></h5>
                            <h6><?php echo e($store->products_count); ?> <?php echo app('translator')->get('site.abaya'); ?></h6>
                        </div>
                        <a href="<?php echo e(route('store', ['id'=>$store->id])); ?>" class="main-btn animate main"><?php echo app('translator')->get('site.show_products'); ?></a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
        </div>
    </section>
    <!-- ==================== End our designers =================== -->

    

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
<script>
    (function() {

        var autoUpdate = true,
            timeTrans = 5000;

        var cdSlider = document.querySelector('#cd-slider'),
            item = cdSlider.querySelectorAll("li"),
            nav = cdSlider.querySelector("nav");

        item[0].className = "current_slide";

        for (var i = 0, len = item.length; i < len; i++) {
            var color = item[i].getAttribute("data-color");
            item[i].style.backgroundColor = color;
        }

        // Detect IE
        // hide ripple effect on IE9
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE");
        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            if (version === 9) {
                cdSlider.className = "cd-slider ie9";
            }
        }

        if (item.length <= 1) {
            nav.style.display = "none";
        }

        function prevSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                prevElement = currentSlide.previousElementSibling,
                prevSlide = (prevElement !== null) ? prevElement : item[item.length - 1],
                prevColor = prevSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            prevSlide.className = "current_slide";

            nav.children[0].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[0].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = prevColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        function nextSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                nextElement = currentSlide.nextElementSibling,
                nextSlide = (nextElement !== null) ? nextElement : item[0],
                nextColor = nextSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            nextSlide.className = "current_slide";

            nav.children[1].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[1].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = nextColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        updateNavColor();

        function updateNavColor() {
            var currentSlide = cdSlider.querySelector("li.current_slide");

            var nextColor = (currentSlide.nextElementSibling !== null) ? currentSlide.nextElementSibling
                .getAttribute("data-color") : item[0].getAttribute("data-color");
            var prevColor = (currentSlide.previousElementSibling !== null) ? currentSlide.previousElementSibling
                .getAttribute("data-color") : item[item.length - 1].getAttribute("data-color");

            if (item.length > 2) {
                nav.querySelector(".prev").style.backgroundColor = prevColor;
                nav.querySelector(".next").style.backgroundColor = nextColor;
            }
        }

        nav.querySelector(".next").addEventListener('click', function(event) {
            event.preventDefault();
            nextSlide();
            updateNavColor();
        });

        nav.querySelector(".prev").addEventListener("click", function(event) {
            event.preventDefault();
            prevSlide();
            updateNavColor();
        });

        //autoUpdate
        setInterval(function() {
            if (autoUpdate) {
                nextSlide();
                updateNavColor();
            };
        }, timeTrans);

    })();
</script>

<script>
    (function() {

        var autoUpdate = true,
            timeTrans = 5000;

        var cdSlider = document.querySelector('#cd-slider-2'),
            item = cdSlider.querySelectorAll("li"),
            nav = cdSlider.querySelector("nav");

        item[0].className = "current_slide";

        for (var i = 0, len = item.length; i < len; i++) {
            var color = item[i].getAttribute("data-color");
            item[i].style.backgroundColor = color;
        }

        // Detect IE
        // hide ripple effect on IE9
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE");
        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            if (version === 9) {
                cdSlider.className = "cd-slider ie9";
            }
        }

        if (item.length <= 1) {
            nav.style.display = "none";
        }

        function prevSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                prevElement = currentSlide.previousElementSibling,
                prevSlide = (prevElement !== null) ? prevElement : item[item.length - 1],
                prevColor = prevSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            prevSlide.className = "current_slide";

            nav.children[0].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[0].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = prevColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        function nextSlide() {
            var currentSlide = cdSlider.querySelector("li.current_slide"),
                nextElement = currentSlide.nextElementSibling,
                nextSlide = (nextElement !== null) ? nextElement : item[0],
                nextColor = nextSlide.getAttribute("data-color"),
                el = document.createElement('span');

            currentSlide.className = "";
            nextSlide.className = "current_slide";

            nav.children[1].appendChild(el);

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider
                .clientHeight * 2,
                ripple = nav.children[1].querySelector("span");

            ripple.style.height = size + 'px';
            ripple.style.width = size + 'px';
            ripple.style.backgroundColor = nextColor;

            ripple.addEventListener("webkitTransitionEnd", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

            ripple.addEventListener("transitionend", function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            });

        }

        updateNavColor();

        function updateNavColor() {
            var currentSlide = cdSlider.querySelector("li.current_slide");

            var nextColor = (currentSlide.nextElementSibling !== null) ? currentSlide.nextElementSibling
                .getAttribute("data-color") : item[0].getAttribute("data-color");
            var prevColor = (currentSlide.previousElementSibling !== null) ? currentSlide.previousElementSibling
                .getAttribute("data-color") : item[item.length - 1].getAttribute("data-color");

            if (item.length > 2) {
                nav.querySelector(".prev").style.backgroundColor = prevColor;
                nav.querySelector(".next").style.backgroundColor = nextColor;
            }
        }

        nav.querySelector(".next").addEventListener('click', function(event) {
            event.preventDefault();
            nextSlide();
            updateNavColor();
        });

        nav.querySelector(".prev").addEventListener("click", function(event) {
            event.preventDefault();
            prevSlide();
            updateNavColor();
        });

        //autoUpdate
        setInterval(function() {
            if (autoUpdate) {
                nextSlide();
                updateNavColor();
            };
        }, timeTrans);

    })();
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/web/home.blade.php ENDPATH**/ ?>