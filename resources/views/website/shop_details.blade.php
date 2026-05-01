@extends('website.layouts.sungoods')

@section('title', $product->name_en . ' - Sungoods')

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($product->description_en), 160) }}">
<meta property="og:title" content="{{ $product->name_en }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($product->description_en), 160) }}">
<meta property="og:image" content="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}">
@endsection

@push('css')
<style>
    .breadcrumb {
        display: flex !important;
        flex-wrap: wrap;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0 0 20px 0;
    }
    .breadcrumb li {
        display: flex;
        align-items: center;
    }
    .breadcrumb li a {
        display: inline-flex;
        align-items: center;
    }
    .breadcrumb .delimiter {
        margin: 0 10px;
        color: #999;
    }
    .product-navigation {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    /* Disable hover effects on product details */
    .product-details, .product-single .col-md-6 {
        transform: none !important;
        transition: none !important;
    }
    .product-details:hover {
        transform: none !important;
    }
    .product-nav {
        display: none !important; /* Hide prev/next product for now as logic not provided */
    }
</style>
@endpush

@section('content')
<div class="page-content mb-10 pb-6">
    <div class="container">
        <div class="product product-single row mb-7">
            <div class="col-md-6">
                <div class="product-gallery pg-vertical">
                    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no"
                        data-owl-options="{
                            'nav': true,
                            'dots': false,
                            'loop': false,
                            'autoHeight': false
                        }">
                        <figure class="product-image">
                            <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}"
                                data-zoom-image="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}"
                                alt="{{ $product->name_en }}" width="800" height="900">
                        </figure>
                        @foreach($product->media as $media)
                        <figure class="product-image">
                            <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $media->file_name]) }}"
                                data-zoom-image="{{ route('imagecache', ['template' => 'original', 'filename' => $media->file_name]) }}"
                                alt="{{ $product->name_en }}" width="800" height="900">
                        </figure>
                        @endforeach
                    </div>
                    <div class="product-thumbs-wrap">
                        <div class="product-thumbs">
                            <div class="product-thumb active">
                                <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}"
                                    alt="product thumbnail" width="109" height="122">
                            </div>
                            @foreach($product->media as $media)
                            <div class="product-thumb">
                                <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $media->file_name]) }}"
                                    alt="product thumbnail" width="109" height="122">
                            </div>
                            @endforeach
                        </div>
                        <button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
                        <button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    @if(!empty($product->discount_price) && $product->discount_price > 0)
                        <div class="product-label-group">    
                          <label class="product-label label-sale">
                                {{ calculateDiscountPercentage($product->selling_price, $product->discount_price) }}% off
                            </label>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <div class="product-navigation">
                        <ul class="breadcrumb breadcrumb-lg">
                            <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
                            <li class="delimiter">/</li>
                            <li><a href="{{ route('shop') }}" class="active">Products</a></li>
                            <li class="delimiter">/</li>
                            <li>Detail</li>
                        </ul>
                    </div>

                    <h1 class="product-name">{{ $product->name_en }}</h1>
                    <div class="product-meta">
                        SKU: <span class="product-sku">{{ $product->sku ?? 'N/A' }}</span>
                        CATEGORIES: <span class="product-brand">
                            @foreach ($product->categories as $cat)
                                <a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a>@if(!$loop->last), @endif
                            @endforeach
                        </span>
                    </div>
                    <div class="product-price">
                        @if(!empty($product->discount_price) && $product->discount_price > 0)
                            <ins class="new-price">
                                ৳{{ number_format($product->selling_price - $product->discount_price, 2) }}
                            </ins>
                            <del class="old-price">
                                ৳{{ number_format($product->selling_price, 2) }}
                            </del>
                        @else
                            <span class="price">
                                ৳{{ number_format($product->selling_price, 2) }}
                            </span>
                        @endif
                    </div>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width:80%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#product-tab-reviews" class="link-to-tab rating-reviews">( 0 reviews )</a>
                    </div>
                    <p class="product-short-desc">
                        {!! Str::limit(strip_tags($product->description_en), 200) !!}
                    </p>

                    <hr class="product-divider">

                    <div class="product-form product-qty">
                        <div class="product-form-group">
                            <div class="input-group mr-2">
                                <button class="quantity-minus d-icon-minus"></button>
                                <input class="quantity form-control" type="number" min="1" max="1000000" value="1">
                                <button class="quantity-plus d-icon-plus"></button>
                            </div>
                            <button class="btn-product text-normal ls-normal font-weight-semi-bold add-to-cart-btn" 
                                data-id="{{ $product->id }}">
                                <i class="d-icon-bag"></i>Add to Cart
                            </button>
                        </div>
                    </div>

                    <hr class="product-divider mb-3">

                    <div class="product-footer">
                        <div class="social-links mr-4">
                            <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                            <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                            <a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a>
                        </div>
                        <span class="divider d-lg-show"></span>
                        <a href="#" class="btn-product btn-wishlist mr-6 add-to-wishlist" data-id="{{ $product->id }}">
                            <i class="d-icon-heart"></i>Add to wishlist</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab tab-nav-simple product-tabs">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#product-tab-description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#product-tab-reviews">Reviews (0)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active in" id="product-tab-description">
                    <div class="row mt-6">
                        <div class="col-md-12">
                            {!! $product->description_en !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product-tab-reviews">
                    <div class="row">
                        <div class="col-lg-4 mb-6">
                            <div class="avg-rating-container">
                                <mark>0.0</mark>
                                <div class="avg-rating">
                                    <span class="avg-rating-title">Average Rating</span>
                                    <div class="ratings-container mb-0">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:0%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <span class="rating-reviews">( 0 Reviews )</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-6">
                            {{-- Add Review Form logic here --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
        <section class="pt-3 mt-10">
            <h2 class="title justify-content-center">Related Products</h2>

            <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4"
                data-owl-options="{
                'items': 5,
                'nav': false,
                'loop': false,
                'dots': true,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '768': {
                        'items': 3
                    },
                    '992': {
                        'items': 4,
                        'dots': false,
                        'nav': true
                    }
                }
            }">
                @foreach($relatedProducts as $related)
                <div class="product">
                    <figure class="product-media">
                        <a href="{{ route('productDetails', $related->slug) }}">
                            <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $related->fi()]) }}" alt="product" width="280" height="315">
                        </a>
                        <div class="product-label-group">
                            @if(!empty($related->discount_price) && $related->discount_price > 0)
                                <label class="product-label label-sale">
                                    {{ calculateDiscountPercentage($related->selling_price, $related->discount_price) }}% off
                                </label>
                            @endif
                        </div>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon add-to-cart-btn" title="Add to cart" data-id="{{ $related->id }}" >
                                <i class="d-icon-bag"></i></a>
                            <a href="#" class="btn-product-icon add-to-wishlist" title="Add to wishlist" data-id="{{ $related->id }}">
                                <i class="d-icon-heart"></i></a>
                        </div>
                        <div class="product-action">
                            <a href="{{ route('productDetails', $related->slug) }}" class="btn-product" title="Quick View">View Details</a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                            @foreach($related->categories as $cat)
                                <a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a>@if(!$loop->last), @endif
                            @endforeach
                        </div>
                        <h3 class="product-name">
                            <a href="{{ route('productDetails', $related->slug) }}">{{ $related->name_en }}</a>
                        </h3>
                        <div class="product-price">
                            <span class="price">৳{{ number_format($related->selling_price - $related->discount_price, 2) }}</span>
                            @if($related->discount_price > 0)
                                <del class="old-price">৳{{ number_format($related->selling_price, 2) }}</del>
                            @endif
                        </div>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width:{{ ($related->averageRating() / 5) * 100 }}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="{{ route('productDetails', $related->slug) }}" class="rating-reviews">( {{ $related->reviews_count ?? 0 }} reviews )</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // // Quantity buttons logic
        // $(document).on('click', '.quantity-plus', function() {
        //     let $input = $(this).closest('.input-group').find('input.quantity');
        //     $input.val(parseInt($input.val()) + 1);
        // });

        // $(document).on('click', '.quantity-minus', function() {
        //     let $input = $(this).closest('.input-group').find('input.quantity');
        //     if (parseInt($input.val()) > 1) {
        //         $input.val(parseInt($input.val()) - 1);
        //     }
        // });

        function initZoomOnActive() {
            if ($.fn.elevateZoom) {
                var $activeItem = $('.product-single-carousel .owl-item.active');
                
                // If owl hasn't fully initialized yet, target the first item
                if (!$activeItem.length) {
                    $activeItem = $('.product-single-carousel .owl-item').first();
                }
                
                var $activeImg = $activeItem.find('img');
                
                if ($activeImg.length && $activeImg.attr('src')) {
                    // Thorough cleanup
                    $('.zoomContainer').remove();
                    $('.product-single-carousel img').each(function() {
                        var $img = $(this);
                        if ($img.data('elevateZoom')) {
                            $img.data('elevateZoom').destroy();
                        }
                        $img.removeData('elevateZoom');
                        $img.removeData('zoomImage');
                    });

                    var zoomOptions = (typeof Riode !== 'undefined' && Riode.defaults && Riode.defaults.zoomImage) 
                        ? $.extend({}, Riode.defaults.zoomImage) 
                        : { responsive: true, zoomType: 'inner', cursor: 'crosshair' };
                    
                    zoomOptions.zoomType = 'inner'; 
                    
                    // Re-initialize
                    $activeImg.elevateZoom(zoomOptions);
                }
            }
        }

        // Initial load with multiple strategies
        $(window).on('load', function() {
            initZoomOnActive();
        });

        // Use imagesLoaded for reliability
        $('.product-single-carousel').imagesLoaded(function() {
            initZoomOnActive();
        });

        // Retry mechanism for slow loading
        var initRetryCount = 0;
        var initRetry = setInterval(function() {
            initZoomOnActive();
            initRetryCount++;
            if (initRetryCount >= 5) clearInterval(initRetry);
        }, 1000);

        $('.product-single-carousel').on('translated.owl.carousel', function() {
            initZoomOnActive();
        });

        // Also handle thumbnail clicks if they don't trigger translated event immediately
        $(document).on('click', '.product-thumb', function() {
            var index = $(this).index();
            $('.product-single-carousel').trigger('to.owl.carousel', [index, 300]);
            setTimeout(initZoomOnActive, 400);
        });
    });
</script>
@endpush
