<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('site.designers'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--======================== Start breadcrumb =============================-->
<div class="breadcrumb pt-10 pb-10">
    <div class="container">
        <div class="product-navigation">
            <ul class="breadcrumb breadcrumb-lg m-0">
                <li><a href="<?php echo e(route('stores')); ?>"><i class="fal fa-home"></i></a></li>
                <li><h1 style="
                    font-size: inherit;
                    font-weight: inherit;
                    margin-top: revert;
                "><?php echo app('translator')->get('site.designers'); ?></h1></li>
            </ul>
        </div>
    </div>
</div>
<!--======================== End breadcrumb =============================-->
<!--======================== Start slider =============================-->
<section class="header_section stores_header">
    <div class="cd-slider">
        <ul>
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li data-color="#2a2424">
                <a href="#" class="content d-block text-center" style="background-image:url()">
                    <img src="<?php echo e($slider->image_url); ?>" alt="" class="img-slider">

                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <nav>
            <div>
                <a class="prev" href="#"><i class="fal fa-chevron-left"></i></a>
            </div>
            <div>
                <a class="next" href="#"><i class="fal fa-chevron-right"></i></a>
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

            <div class="col-lg-3 col-md-4 col-sm-6 gsap-reveal-hero">
                <div class="designer_box">
                    <div class="image"><img data-src="<?php echo e(asset('uploads/'.$store->logo)); ?>" width="100" height="100" class="lazyload" alt="img"></div>
                    <div class="info">
                        <h2 style="font-size: inherit;"><?php echo e($store->name); ?></h2>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    (function() {

        var autoUpdate = true,
            timeTrans = 5000;

        var cdSlider = document.querySelector('.cd-slider'),
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

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider.clientHeight * 2,
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

            var size = (cdSlider.clientWidth >= cdSlider.clientHeight) ? cdSlider.clientWidth * 2 : cdSlider.clientHeight * 2,
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

            var nextColor = (currentSlide.nextElementSibling !== null) ? currentSlide.nextElementSibling.getAttribute("data-color") : item[0].getAttribute("data-color");
            var prevColor = (currentSlide.previousElementSibling !== null) ? currentSlide.previousElementSibling.getAttribute("data-color") : item[item.length - 1].getAttribute("data-color");

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

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/web/stores.blade.php ENDPATH**/ ?>