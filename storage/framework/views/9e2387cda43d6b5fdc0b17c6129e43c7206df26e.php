
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('site.all'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 
    <!-- Theme Style -->
    <link rel="stylesheet" href="<?php echo e(asset('needle/css/faceted.css')); ?>" />
    <!-- jQuery UI -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/jquery-ui.css')); ?>">
    <style>
        .pagination>li>a {
            cursor: pointer;
        }

        .pagination>li {
            list-style-type: none;
        }

        ul>li {
            list-style-type: none;
        }

        ul>li>label {
            padding-left: 5px;
            vertical-align: middle;
        }

        .price {
            font-size: 20px;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="section products-page filter-pro body-inner">
        <div class="container">
            <div class="row">
                <!-- Filter Panel -->

                <div class="col-md-3 col-sm-12">
                    <div class="card side-products">
                        <div class="card-header">
                            <h3><?php echo app('translator')->get('site.filter'); ?></h3>
                        </div>
                        <div class="btns-res">
                            <h2>الحقائب</h2>
                            <div class="inner-btns">
                                <div class="btn-re"><h3 class="btn-1"><?php echo app('translator')->get('site.filter'); ?></h3></div>
                                <div class="btn-re btn-2">
                                    <!--<?php echo e(Form::label('sorting', trans('site.sort_by'), ['class' => 'col-form-label'])); ?>-->
                                    <span class="after-icon">
                                        <?php echo e(Form::select('sorting', $repository->sorting(), 'new', ['class' => 'form-control', 'id' => 'sorting'])); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body  single-filter-box">
                            <div class="btns-res">
                                <h3><?php echo app('translator')->get('site.filter'); ?></h3>
                                <a class="closeFilter"><i class="la la-times"></i></a>
                            </div>
                            <?php echo e(Form::open(['action' => 'FilterController@index', 'method' => 'get', 'class' => 'form'])); ?>

                            <p id="filter-item-category"></p>
                            <p id="filter-item-type"></p>
                            <p id="filter-item-brand"></p>
                            <p id="filter-item-color"></p>
                            
                            
                            
                            <div class="filter_row">
                                <p class="filter-title"><a data-toggle="collapse" href="#collapseCat1" aria-expanded="false" aria-controls="collapseExample"><?php echo app('translator')->get('website.top_categories'); ?></a></p>
                                <ul class="filter-cat collapse" id="collapseCat1">
                                    <?php $__currentLoopData = $repository->main_categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <label class="checkbox-container">
                                                <?php if(!is_null($catkey)): ?>
                                                    <?php if($catkey == $id): ?>

                                                    <?php echo e(Form::checkbox($category, $id, true, ['class' => 'category'])); ?>

                                                    <?php else: ?>
                                                        <?php echo e(Form::checkbox($category, $id, false, ['class' => 'category'])); ?>


                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php echo e(Form::checkbox($category, $id, false, ['class' => 'category'])); ?>


                                                <?php endif; ?>
                                                <span class="checkmark"></span>
                                            </label>

                                            <?php echo e(Form::label($category, $category)); ?>


                                            <span>(<?php echo e(\App\Models\Category::query()->findOrFail($id)->products->count()); ?>)</span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                            
                            <div class="filter_row">
                                <p class="filter-title"><a data-toggle="collapse" href="#collapseBrand" aria-expanded="false"
                                        aria-controls="collapseExample"><?php echo app('translator')->get('site.brand'); ?></a></p>
                                <ul class="filter-cat collapse" id="collapseBrand">
                                    <?php $__currentLoopData = $repository->brands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <label class="checkbox-container">
                                            <?php if(!is_null($brandkey)): ?>
                                                <?php if($brandkey == $id): ?>

                                                    <?php echo e(Form::checkbox($brand, $id, true, ['class' => 'brand'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::checkbox($brand, $id, false, ['class' => 'brand'])); ?>


                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e(Form::checkbox($brand, $id, false, ['class' => 'brand'])); ?>


                                            <?php endif; ?>
                                                <span class="checkmark"></span>
                                            </label>

                                            <?php echo e(Form::label($brand, $brand)); ?>

                                            <span>(<?php echo e(\App\Models\Store::query()->findOrFail($id)->products->count()); ?>)</span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                            <div class="filter_row">
                                <p class="filter-title"><a data-toggle="collapse" href="#collapseType" aria-expanded="false"
                                        aria-controls="collapseExample">المقاس</a></p>
                                <ul class="filter-cat collapse" id="collapseType">

                                    <?php $__currentLoopData = $repository->types(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id =>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <label class="checkbox-container">
                                            <?php if(!is_null($catkey)): ?>
                                                <?php if($typekey == $id): ?>
                                                <?php echo e(Form::checkbox($type, $id, true, ['class' => 'type'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::checkbox($type, $id, false, ['class' => 'type'])); ?>


                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e(Form::checkbox($type, $id, false, ['class' => 'type'])); ?>


                                            <?php endif; ?>
                                                <span class="checkmark"></span>
                                            </label>


                                            <?php echo e(Form::label($type, $type)); ?>

                                            <span>(<?php echo e(\App\Models\Size::query()->findOrFail($id)->products->count()); ?>)</span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                            <div class="filter_row">
                                <p class="filter-title"><a data-toggle="collapse" href="#collapseColor" aria-expanded="false"
                                        aria-controls="collapseExample"><?php echo app('translator')->get('site.color'); ?></a></p>
                                <ul class="filter-cat collapse" id="collapseColor">
                                    <?php $__currentLoopData = $repository->colors(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <label class="checkbox-container">
                                                <?php echo e(Form::checkbox($color, $id, false, ['class' => 'color'])); ?>

                                                <span class="checkmark"></span>
                                            </label>
                                            <?php echo e(Form::label($color, $color)); ?>

                                            <span>(<?php echo e(\App\Models\Color::query()->findOrFail($id)->products->count()); ?>)</span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                            

                            <p class="filter-title">
                                <label for="amount"><?php echo app('translator')->get('site.price'); ?>:</label>
                                <input type="text" id="amount" readonly />
                            </p>

                            <div id="slider-range"></div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
                <!-- /Filter Panel -->
                <!-- Search Result -->
                <div class="col-md-9 col-sm-12">
                    <div class="card body-products">
                        <!--<div class="card-header">-->
                        <!--    <h3><?php echo app('translator')->get('site.products'); ?></h3>-->
                        <!--</div>-->
                        <div class="card-body">
                            <div>
                                <div class="form-group items">
                                    <div class="item">
                                        <?php echo e(Form::label('sorting', trans('site.sort_by'), ['class' => 'col-form-label'])); ?>

                                        <!--<span class="after-icon">-->
                                            <?php echo e(Form::select('sorting', $repository->sorting(), 'new', ['class' => 'form-control select', 'id' => 'sorting'])); ?>

                                        <!--</span>-->
                                    </div>

                                    

                                    <div class="item m-r-auto">
                                        <?php echo e(Form::label('qty', trans('site.desplay'), ['class' => 'col-form-label'])); ?>

                                        <!--<span class="after-icon">-->
                                            <?php echo e(Form::select('qty', [3 => 3, 6 => 6, 9 => 9, 12 => 12, 15 => 15], 6, ['class' => 'form-control select', 'id' => 'qty'])); ?>

                                        <!--</span>-->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="panel-body" id="result">
                            <?php echo $__env->yieldContent('products'); ?>
                            <!-- Search result will appeared here -->
                        </div>
                        <!-- Pagination -->
                        <div class="text-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center" id="pagination">

                                </ul>
                            </nav>
                        </div>
                        <!-- /Pagination -->
                    </div>
                </div>
                <!-- /Search Result -->
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/vendor/jquery-ui.min.js')); ?>"></script>
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = url.split('page=')[1];
            window.history.pushState("", "", url);
            faceted(page);
        })
    </script>
    <script>
        var xhr = new XMLHttpRequest();

        function faceted(page) {
            var csrf = "<?php echo e(csrf_token()); ?>";
            var search = $("#search").val();
            var categories = [];
            var types = [];
            var brands = [];
            var colors = [];
            var offers = [];
            var price = $("#amount").val();
            var sorting = $("#sorting").val();
            var direction = $("#direction").val();
            var qty = $("#qty").val();
            var categoryName = [];
            var typeName = [];
            var brandName = [];
            var colorName = [];
            var offerName = [];
            $(".category:checked").each(function() {
                categories.push($(this).val());
                categoryName.push(this.name);
                $("#filter-item-category").html('<b>Category: </b>' + categoryName);
            });
            $(".brand:checked").each(function() {
                brands.push($(this).val());
                brandName.push(this.name);
                $("#filter-item-brand").html('<b>Brand: </b>' + brandName);
            });
            $(".color:checked").each(function() {
                colors.push($(this).val());
                colorName.push(this.name);
                $("#filter-item-color").html('<b>Color: </b>' + colorName);
            });
            $(".type:checked").each(function() {
                types.push($(this).val());
                typeName.push(this.name);
                $("#filter-item-type").html('<b>size: </b>' + typeName);
            });
            $(".offer:checked").each(function() {
                offers.push($(this).val());
                offerName.push(this.name);
                $("#filter-item-offer").html('<b>Offer: </b>' + offerName);
            });

            if (categories.length == 0) {
                $("#filter-item-category").html('')
            }
            if (brands.length == 0) {
                $("#filter-item-brand").html('')
            }
            if (colors.length == 0) {
                $("#filter-item-color").html('')
            }
            if (types.length == 0) {
                $("#filter-item-type").html('')
            }
            if (offers.length == 0) {
                $("#filter-item-offer").html('')
            }

            if (xhr !== 'undefined') {
                xhr.abort(); //stop existing ajax request if new request has been sent to server
            }
            xhr = $.ajax({
                url: 'filter',
                data: {
                    _token: csrf,
                    search: search,
                    categories: categories,
                    brands: brands,
                    colors: colors,
                    types: types,
                    offers: offers,
                    price: price,
                    sorting: sorting,
                    direction: direction,
                    page: page,
                    qty: qty
                },
                type: 'get',
                beforeSend: function() {
                    $("#result").html('<img src="<?php echo e(asset('needle/image/spinner.gif')); ?>" class="img-loading" alt=""/>')
                }
            }).done(function(e) {
                $data = $(e);
                $("#result").html($data);
                pagination(e['rows'],e['qty'],e['active']);
                window.history.pushState('page2', 'Title', this.url); // still in test
            });
        }
    </script>
    <script>
        $(window).on("load", faceted())
    </script>
    <script>
        $("#search").keyup(function() {
            faceted();
        })
    </script>
    <script>
        $(".category,.type,.brand,.color,.offer").on("click", function() {
            faceted();
        });
    </script>
    <script>
        $("#sorting,#direction,#qty").on('change', function() {
            faceted();
        });
    </script>
    <script>
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 10000,
                values: [0, 10000],
                slide: function(event, ui) {
                    $("#amount").val("" + ui.values[0] + " - " + ui.values[1]);
                    faceted();
                }
            });
            $("#amount").val("" + $("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        });
    </script>

    <script>
        /** load more categories */
        $("#loadCat").click(function() {
            var categories = $(".category").length;
            var csrf = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                url: 'load-cat',
                data: {
                    _token: csrf,
                    categories: categories
                },
                type: 'post',
                beforeSend: function() {
                    $("#collapseBrand").addClass('loading');
                }
            }).done(function(e) {
                //$("#collapseCat #loadCat").before(e);
                $("#collapseCat li").last().before(e);
                $("#collapseCat").removeClass('loading');
                $(".category").click(function() {
                    faceted();
                });
            })
        });
        /** load more brands */
        $("#loadBrand").click(function() {
            var brands = $(".brand").length;
            var csrf = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                url: 'load-brand',
                data: {
                    _token: csrf,
                    brands: brands
                },
                type: 'post',
                beforeSend: function() {
                    $("#collapseBrand").addClass('loading');
                }
            }).done(function(e) {
                $("#collapseBrand #loadBrand").before(e);
                $("#collapseBrand").removeClass('loading');
                $(".brand").click(function() {
                    faceted();
                });
            })
        });
        /** load more types */
        $("#loadType").click(function() {
            var types = $(".type").length;
            var csrf = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                url: 'load-type',
                data: {
                    _token: csrf,
                    types: types
                },
                type: 'post',
                beforeSend: function() {
                    $("#collapseType").addClass('loading');
                }
            }).done(function(e) {
                $("#collapseType #loadType").before(e);
                $("#collapseType").removeClass('loading');
                $(".type").click(function() {
                    faceted();
                });
            })
        });
        /** load more colors */
        $("#loadColor").click(function() {
            var colors = $(".color").length;
            var csrf = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                url: 'load-color',
                data: {
                    _token: csrf,
                    colors: colors
                },
                type: 'post',
                beforeSend: function() {
                    $("#collapseColor").addClass('loading');
                }
            }).done(function(e) {
                $("#collapseColor #loadColor").before(e);
                $("#collapseColor").removeClass('loading');
                $(".color").click(function() {
                    faceted();
                });
            })
        });
        /** load more offers */
        $("#loadOffer").click(function() {
            var offers = $(".offer").length;
            var csrf = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                url: 'load-offer',
                data: {
                    _token: csrf,
                    offers: offers
                },
                type: 'post',
                beforeSend: function() {
                    $("#collapseOffer").addClass('loading');
                }
            }).done(function(e) {
                $("#collapseOffer #loadOffer").before(e);
                $("#collapseOffer").removeClass('loading');
                $(".offer").click(function() {
                    faceted();
                });
            })
        });
    </script>




 <script>



dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "view_item_list",
  ecommerce: {
    item_list_id: "related_products",
    item_list_name: "Related products",
    items: [
        <?php $__currentLoopData = $products_without_paginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
              item_id: "SKU_<?php echo e($product->id); ?>",
              item_name: "<?php echo e($product->name); ?>",
              affiliation: "google merchant store",
              coupon: "",
              discount: <?php echo e($product->discount_ratio); ?>,
              index: <?php echo e($product->id); ?>,
              item_brand: "<?php if(isset($product->store) && $product->store->name != ''): ?> <?php echo e($product->store->name); ?> <?php endif; ?>",
              item_category: "<?php if(isset($product->category) && $product->category->name != ''): ?><?php echo e($product->category->name); ?><?php endif; ?>",
              item_list_id: "<?php if(isset($product->category) && $product->category->name != ''): ?><?php echo e($product->category->name); ?><?php endif; ?>",
              item_list_name: "<?php if(isset($product->category) && $product->category->name != ''): ?><?php echo e($product->category->name); ?><?php endif; ?>",
              item_variant: "",
              location_id: "",
              price: <?php echo e($product->sale_price); ?>,
              quantity: 1
            },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
        }
    });
     
  

 </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/filter/index1.blade.php ENDPATH**/ ?>