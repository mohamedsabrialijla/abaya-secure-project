@extends('layouts.app1')

@section('style')

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('needle/css/faceted.css') }}" />
    <!-- Bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('needle/vendor/bootstrap-4.0.0-beta-dist/css/bootstrap.min.css') }}"/> --}}
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ asset('needle/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
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
@stop

@section('content')
    {{-- <div class="row"> --}}
    <div class="section products-page filter-pro body-inner dd">
        <div class="container">
            <div class="row">
                <!-- Filter Panel -->

                <div class="col-md-3 col-sm-12">
                    <div class="card side-products">
                        <div class="card-header">
                            <h3>@lang('site.filter')</h3>
                        </div>
                        <div class="btns-res">
                            <h2>الحقائب</h2>
                            <div class="inner-btns">
                                <div class="btn-re"><h3 class="btn-1">@lang('site.filter')</h3></div>
                                <div class="btn-re btn-2">
                                    <!--{{ Form::label('sorting', trans('site.sort_by'), ['class' => 'col-form-label']) }}-->
                                    <span class="after-icon">
                                        {{ Form::select('sorting', $repository->sorting(), 'new', ['class' => 'form-control', 'id' => 'sorting']) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body  single-filter-box">
                            <div class="btns-res">
                                <h3>@lang('site.filter')</h3>
                                <a class="closeFilter"><i class="la la-times"></i></a>
                            </div>
                            {{ Form::open(['action' => 'FilterController@index', 'method' => 'get', 'class' => 'form']) }}
                            <!--<p class="filter-title">@lang('site.current_filter')</p>-->
                            <p id="filter-item-category"></p>
                            <p id="filter-item-type"></p>
                            <p id="filter-item-brand"></p>
                            <p id="filter-item-color"></p>
                            {{-- <p id="filter-item-offer"></p> --}}
                            {{-- <p class="filter-title">Search</p> --}}
                            {{-- <p>{{ Form::text('search',null,['id'=>'search','placeholder'=>'Name or Description']) }}</p> --}}
                            <p class="filter-title"><a data-toggle="collapse" href="#collapseCat1" aria-expanded="false"
                                    aria-controls="collapseExample">@lang('website.top_categories')</a></p>
                            <ul class="filter-cat collapse" id="collapseCat1">
                                @foreach ($repository->main_categories() as $id => $category)
                                    <li>
                                        <label class="checkbox-container">
                                            @if (!is_null($catkey))
                                                @if ($catkey == $id)

                                                {{ Form::checkbox($category, $id, true, ['class' => 'category']) }}
                                                @else
                                                    {{ Form::checkbox($category, $id, false, ['class' => 'category']) }}

                                                @endif
                                            @else
                                                {{ Form::checkbox($category, $id, false, ['class' => 'category']) }}

                                            @endif
                                            <span class="checkmark"></span>
                                        </label>

                                        {{ Form::label($category, $category) }}

                                        <span>({{ \App\Models\Category::query()->findOrFail($id)->products->count() }})</span>
                                    </li>
                                @endforeach
                                {{-- <li><a id="loadCat" style="color:blue;text-decoration: underline;cursor: pointer;">Load More >>></a></li> --}}
                            </ul>
                            {{-- <p class="filter-title"><a data-toggle="collapse" href="#collapseCat2" aria-expanded="false"
                                    aria-controls="collapseExample">@lang('website.sub_cat')</a></p>
                            <ul class="filter-cat collapse" id="collapseCat2">
                                @foreach ($repository->sub_categories() as $id => $category)
                                    <li>
                                        <label class="checkbox-container">
                                        @if (!is_null($catkey))
                                            @if ($catkey == $id)

                                            {{ Form::checkbox($category, $id, true, ['class' => 'category']) }}
                                            @else
                                                {{ Form::checkbox($category, $id, false, ['class' => 'category']) }}

                                            @endif
                                        @else
                                            {{ Form::checkbox($category, $id, false, ['class' => 'category']) }}

                                        @endif
                                            <span class="checkmark"></span>
                                        </label>

                                        {{ Form::label($category, $category) }}
                                        <span>({{ \App\Models\Category::query()->findOrFail($id)->pcount() }})</span>
                                    </li>
                                @endforeach
                                {{-- <li><a id="loadCat" style="color:blue;text-decoration: underline;cursor: pointer;">Load More >>></a></li>
                            </ul> --}}
                            <p class="filter-title"><a data-toggle="collapse" href="#collapseBrand" aria-expanded="false"
                                    aria-controls="collapseExample">@lang('site.brand')</a></p>
                            <ul class="filter-cat collapse" id="collapseBrand">
                                @foreach ($repository->brands() as $id => $brand)
                                    <li>
                                        <label class="checkbox-container">
                                        @if (!is_null($brandkey))
                                            @if ($brandkey == $id)

                                                {{ Form::checkbox($brand, $id, true, ['class' => 'brand']) }}
                                            @else
                                                {{ Form::checkbox($brand, $id, false, ['class' => 'brand']) }}

                                            @endif
                                        @else
                                            {{ Form::checkbox($brand, $id, false, ['class' => 'brand']) }}

                                        @endif
                                            <span class="checkmark"></span>
                                        </label>

                                        {{ Form::label($brand, $brand) }}
                                        <span>({{ \App\Models\Store::query()->findOrFail($id)->products->count() }})</span>
                                    </li>
                                @endforeach
                                {{-- <li><a id="loadBrand" style="color:blue;text-decoration: underline;cursor: pointer;">Load More >>></a></li> --}}
                            </ul>
                            <p class="filter-title"><a data-toggle="collapse" href="#collapseType" aria-expanded="false"
                                    aria-controls="collapseExample">المقاس</a></p>
                            <ul class="filter-cat collapse" id="collapseType">

                                @foreach ($repository->types() as $id =>$type)
                                    <li>
                                        <label class="checkbox-container">
                                        @if (!is_null($catkey))
                                            @if ($typekey == $id)
                                            {{ Form::checkbox($type, $id, true, ['class' => 'type']) }}
                                            @else
                                                {{ Form::checkbox($type, $id, false, ['class' => 'type']) }}

                                            @endif
                                        @else
                                            {{ Form::checkbox($type, $id, false, ['class' => 'type']) }}

                                        @endif
                                            <span class="checkmark"></span>
                                        </label>


                                        {{ Form::label($type, $type) }}
                                        <span>({{ \App\Models\Size::query()->findOrFail($id)->products->count() }})</span>
                                    </li>
                                @endforeach
                                {{-- <li><a id="loadType" style="color:blue;text-decoration: underline;cursor: pointer;">Load More >>></a></li> --}}
                            </ul>
                            <p class="filter-title"><a data-toggle="collapse" href="#collapseColor" aria-expanded="false"
                                    aria-controls="collapseExample">@lang('site.color')</a></p>
                            <ul class="filter-cat collapse" id="collapseColor">
                                @foreach ($repository->colors() as $id => $color)
                                    <li>
                                        <label class="checkbox-container">
                                            {{ Form::checkbox($color, $id, false, ['class' => 'color']) }}
                                            <span class="checkmark"></span>
                                        </label>
                                        {{ Form::label($color, $color) }}
                                        <span>({{ \App\Models\Color::query()->findOrFail($id)->products->count() }})</span>
                                    </li>
                                @endforeach
                                {{-- <li><a id="loadColor" style="color:blue;text-decoration: underline;cursor: pointer;">Load More >>></a></li> --}}
                            </ul>
                            {{-- <p class="filter-title"><a data-toggle="collapse" href="#collapseOffer" aria-expanded="false" aria-controls="collapseExample">Active Offers</a></p>
                                <ul class="filter-cat collapse" id="collapseOffer">
                                    @foreach ($repository->offers() as $id => $offer)
                                        <li>
                                            <label class="checkbox-container">
                                                {{ Form::checkbox($offer,$id,false,['class'=>'offer']) }}
                                                <span class="checkmark"></span>
                                            </label>
                                            {{ Form::label($offer,$offer) }}
                                            <span>({{ \App\Models\Offer::query()->findOrFail($id)->products->count() }})</span>
                                        </li>
                                    @endforeach
                                    <li><a id="loadOffer" style="color:blue;text-decoration: underline;cursor: pointer;">Load More >>></a></li>
                                </ul> --}}

                            <p class="filter-title">
                                <label for="amount">@lang('site.price'):</label>
                                <input type="text" id="amount" readonly />
                            </p>

                            <div id="slider-range"></div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!-- /Filter Panel -->
                <!-- Search Result -->
                <div class="col-md-9 col-sm-12">
                    <div class="card body-products">
                        <!--<div class="card-header">-->
                        <!--    <h3>@lang('site.products')</h3>-->
                        <!--</div>-->
                        <div class="card-body">
                            <div>
                                <div class="form-group items">
                                    <div class="item">
                                        {{ Form::label('sorting', trans('site.sort_by'), ['class' => 'col-form-label']) }}
                                        <!--<span class="after-icon">-->
                                            {{ Form::select('sorting', $repository->sorting(), 'new', ['class' => 'form-control select', 'id' => 'sorting']) }}
                                        <!--</span>-->
                                    </div>

                                    {{-- <div class="col-sm-3">
                                        {{ Form::select('direction', $repository->direction(), null, ['class' => 'form-control', 'id' => 'direction']) }}
                                    </div> --}}

                                    <div class="item m-r-auto">
                                        {{ Form::label('qty', trans('site.desplay'), ['class' => 'col-form-label']) }}
                                        <!--<span class="after-icon">-->
                                            {{ Form::select('qty', [3 => 3, 6 => 6, 9 => 9, 12 => 12, 15 => 15], 6, ['class' => 'form-control select', 'id' => 'qty']) }}
                                        <!--</span>-->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="panel-body" id="result">
                            @yield('products')
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
    {{-- </div> --}}
@stop
{{-- @include('filter.script') --}}

@section('scripts')
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
            var csrf = "{{ csrf_token() }}";
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
                $("#filter-item-type").html('<b>Type: </b>' + typeName);
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
                    $("#result").html('<img src="{{ asset('needle/image/spinner.gif') }}" class="img-loading" alt=""/>')
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
            var csrf = "{{ csrf_token() }}";
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
            var csrf = "{{ csrf_token() }}";
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
            var csrf = "{{ csrf_token() }}";
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
            var csrf = "{{ csrf_token() }}";
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
            var csrf = "{{ csrf_token() }}";
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

@stop
