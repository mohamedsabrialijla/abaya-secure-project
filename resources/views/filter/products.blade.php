{{-- @extends('filter.index')
@section('products') --}}

<div class="card-deck row">
    @if (count($listings) > 0)
        @foreach ($listings->chunk(3) as $chunks)
            @foreach ($chunks as $list)
                <div class="col-md-4 col-sm-6">
                    <div class="box_product wow fadeInUp">
                        <figure>
                            <a href="{{ route('product_page', ['slug' => $list->slug]) }}">
                                <img data-src="{{ $list->image_url ?? asset('uploads/logo.png') }}" class="lazyload"
                                    width="280" height="280" alt="product">
                                <img data-src="{{ $list->feature_image_url ?? $list->image_url }}" class="lazyload"
                                    width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                {{-- <div class="product-label label-new">جديد</div> --}}
                                @if ($list->has_discount)
                                    <div class="product-label label-sale">{{ $list->discount_ratio }}%</div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="{{ route('store', ['id' => $list->store->id]) }}"
                                    class="product-category">{{ $list->store->name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('product_page', ['slug' => $list->slug]) }}">{{ $list->name }}</a>
                            </h3>
                            {{-- <div class="ratings-container">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div> --}}
                            <!-- End .product-container -->
                            <div class="price-box">
                                @if ($list->discount_ratio > 0)
                                    <del class="old-price">{{ $list->price }} @lang('site.rs')</del>
                                @endif
                                <span class="product-price">{{ $list->sale_price }} @lang('site.rs')</span>
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="{{ route('add_to_fav', ['id' => $list->id]) }}" class="btn-icon-wish"
                                    title="wishlist">
                                    @if (Auth::guard('user')->check())
                                        @php
                                            $prodfav = \App\Models\Favorite::where('content_id', $list->id)
                                                ->where('customer_id', Auth::guard('user')->user()->id)
                                                ->first();
                                        @endphp
                                        @if ($prodfav)
                                            <i class="fas fa-heart"></i>
                                </a>
                            @else
                                <i class="fal fa-heart"></i></a>
            @endif
        @else
            <i class="fal fa-heart"></i></a>
        @endif
        <!-- <button type="button" class="btn-icon btn-add-cart product-type-simple toggle-cartside border-0"><i class="fal fa-shopping-cart"></i><span>@lang('site.add_cart')</span></button>
                                <a href="{{ route('product_page', ['slug' => $list->slug]) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> -->
        <a href="{{ route('product_page', ['slug' => $list->slug]) }}"
            class="btn-icon btn-add-cart product-type-simple border-0"><i
                class="fal fa-eye"></i><span>@lang('site.details')</span></a>
        <a href="{{ route('product_page', ['slug' => $list->slug]) }}" data-toggle="modal" data-target="#shareModal"
            class="btn-quickview" aria-label="quickview" title="Quick View"><i class="fa-light fa-share-nodes"></i></a>
</div>
</div>
<!-- End .product-details -->
</div>

</div>
@endforeach
<!--<div class="w-100">&nbsp;</div>-->
@endforeach
@else
<div class="notFound">
    <img src="{{ asset('images/not-found.jpg') }}" />
    <p>@lang('site.o40')</p>
</div>

@endif
</div>
<!-- Modal -->
<div class="modal shareModal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModelLabel">@lang('site.o39')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <p>Share this link via</p>
                <div class="d-flex align-items-center icons">
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center face-link">
                        <span class="fab fa-facebook-f"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center twi-link">
                        <span class="fab fa-twitter"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center insta-link">
                        <span class="fab fa-instagram"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center whats-link">
                        <span class="fab fa-whatsapp"></span>
                    </a>
                    <a href="#" class="fs-5 d-flex align-items-center justify-content-center tele-link">
                        <span class="fab fa-telegram-plane"></span>
                    </a>
                </div>
                <p>Or copy link</p> --}}
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
            {{ $listings->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>
@push('script')
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = url.split('page=')[1];
            window.history.pushState("", "", url);
            faceted(page);
        })
    </script>
@endpush
{{-- @endsection --}}
