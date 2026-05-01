@extends('website.layouts.sungoods')

@section('title', 'Home - '. ($ws->name ?? env('APP_NAME')))

@section('meta')
<meta name="description" content="{{ $ws->meta_description ?? 'Sungoods offers premium products and world-class services.' }}">
<meta name="keywords" content="{{ $ws->meta_keywords ?? 'Sungoods, ecommerce, quality products' }}">
<meta property="og:title" content="Home - {{ $ws->name ?? env('APP_NAME') }}">
<meta property="og:description" content="{{ $ws->meta_description ?? 'Discover quality products at Sungoods.' }}">
<meta property="og:image" content="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}">
<meta property="og:type" content="website">
<meta name="robots" content="index, follow">
@endsection

@section('content')
<div class="page-content">
    <section class="intro-section">
        <div class="owl-carousel owl-theme row owl-dot-inner owl-dot-white intro-slider animation-slider cols-1 gutter-no"
            data-owl-options="{
            'nav': false,
            'dots': true,
            'loop': true,
            'items': 1,
            'autoplay': true,
            'autoplayTimeout': 8000
        }">
            @foreach($sliders as $slider)
            <div class="banner banner-fixed intro-slide1" style="background-color: #46b2e8;">
                <figure>
                    <img src="{{ route('imagecache', ['template'=>'original','filename' => $slider->fi()]) }}" alt="{{ $slider->title }}" width="1903"
                        height="630" style="background-color: #34ace5;" />
                </figure>
                <div class="container">
                    <div class="banner-content y-50">
                        <h4 class="banner-subtitle font-weight-bold ls-l">
                            <!-- <span class="d-inline-block slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}">Premium</span>
                            <span class="d-inline-block label-star bg-white text-primary slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.4s'}">Quality</span> -->
                        </h4>
                        <h2 class="banner-title font-weight-bold text-white lh-1 ls-md slide-animate"
                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                            {!! $slider->title !!}</h2>
                        <p class="slide-animate text-white ls-s mb-7"
                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}">
                            {{ $slider->description }}</p>
                        @if($slider->link)
                        <a href="{{ $slider->link }}" class="btn btn-dark btn-rounded slide-animate"
                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}">Shop
                            Now<i class="d-icon-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="container mt-6 appear-animate">
            <div class="service-list">
                <div class="owl-carousel owl-theme row cols-lg-3 cols-sm-2 cols-1" data-owl-options="{
                        'items': 3,
                        'nav': false,
                        'dots': false,
                        'loop': true,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '0': {
                                'items': 1
                            },
                            '576': {
                                'items': 2
                            },
                            '768': {
                                'items': 3,
                                'loop': false
                            }
                        }
                    }">
                    <div class="icon-box icon-box-side icon-box1 appear-animate" data-animation-options="{
                            'name': 'fadeInRightShorter',
                            'delay': '.3s'
                        }">
                        <i class="icon-box-icon d-icon-truck"></i>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-capitalize ls-normal lh-1">Free Shipping &amp;
                                Return
                            </h4>
                            <p class="ls-s lh-1">Free shipping on orders over ৳999</p>
                        </div>
                    </div>

                    <div class="icon-box icon-box-side icon-box2 appear-animate" data-animation-options="{
                            'name': 'fadeInRightShorter',
                            'delay': '.4s'
                        }">
                        <i class="icon-box-icon d-icon-service"></i>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-capitalize ls-normal lh-1">Customer Support 24/7
                            </h4>
                            <p class="ls-s lh-1">Instant access to perfect support</p>
                        </div>
                    </div>

                    <div class="icon-box icon-box-side icon-box3 appear-animate" data-animation-options="{
                            'name': 'fadeInRightShorter',
                            'delay': '.5s'
                        }">
                        <i class="icon-box-icon d-icon-secure"></i>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-capitalize ls-normal lh-1">100% Secure Payment
                            </h4>
                            <p class="ls-s lh-1">We ensure secure payment!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 mt-7 appear-animate" data-animation-options="{
        'delay': '.3s'
    }">
        <div class="container">
            <h2 class="title title-center mb-5">Our Categories</h2>
            <div class="owl-carousel owl-theme row cols-2 cols-md-3 cols-lg-4" data-owl-options="{
                'items': 4,
                'nav': false,
                'dots': true,
                'loop': true,
                'autoplay': true,
                'autoplayTimeout': 4000,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '768': {
                        'items': 3
                    },
                    '992': {
                        'items': 4
                    }
                }
            }">
                @foreach($categories as $cat)
                <div class="category category-default1 category-absolute banner-radius overlay-zoom">
                    <a href="{{ route('productCategory', $cat->slug) }}">
                        <figure class="category-media">
                            <img src="{{ route('imagecache', ['template'=>'original','filename' => $cat->fi()]) }}" alt="{{ $cat->name_en }}" width="280"
                                height="280" style="background-color: #8c8c8d;" />
                        </figure>
                    </a>
                    <div class="category-content">
                        <h4 class="category-name font-weight-bold ls-l"><a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a></h4>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('allCategories') }}" class="btn btn-outline btn-primary btn-rounded btn-md">View All Categories</a>
            </div>
        </div>
    </section>

    <section class="product-wrapper container appear-animate mt-6 mt-md-10 pt-4 pb-8"
        data-animation-options="{
        'delay': '.3s'
    }">
        <h2 class="title title-center mb-5">Featured Products</h2>
        <div class="owl-carousel owl-theme row owl-nav-full cols-2 cols-md-3 cols-lg-4" data-owl-options="{
            'items': 4,
            'nav': true,
            'loop': true,
            'autoplay': true,
            'autoplayTimeout': 3000,
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
                    'items': 4
                }
            }
        }">
            @foreach($feature_products as $product)
            <div class="product text-center">
                <figure class="product-media">
                    <a href="{{ route('productDetails', $product->slug) }}">
                        <img src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}"
                            width="280" height="315" style="background-color: #f2f3f5;" />
                    </a>
                    <div class="product-label-group">
                    @if(!empty($product->discount_price) && $product->discount_price > 0)
                        <label class="product-label label-sale">
                            {{ calculateDiscountPercentage($product->selling_price, $product->discount_price) }}% off
                        </label>
                    @endif
                    </div>
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon add-to-cart-btn" data-id="{{ $product->id }}" title="Add to cart"><i class="d-icon-bag"></i></a>
                        <a href="#" class="btn-product-icon btn-wishlist add-to-wishlist" data-id="{{ $product->id }}" title="Add to wishlist"><i
                                class="d-icon-heart"></i></a>
                    </div>
                    <div class="product-action">
                        <a href="{{ route('productDetails', $product->slug) }}" class="btn-product" title="Quick View">View Details</a>
                    </div>
                </figure>
                <div class="product-details">
                    <div class="product-cat">
                        @if($product->categories->first())
                        <a href="{{ route('productCategory', $product->categories->first()->slug) }}">{{ $product->categories->first()->name_en }}</a>
                        @endif
                    </div>
                    <h3 class="product-name">
                        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
                    </h3>
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
                            <span class="ratings" style="width:100%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="{{ route('productDetails', $product->slug) }}" class="rating-reviews">( {{ $product->reviews_count ?? 0 }} reviews )</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{--@foreach($categories as $category)
    @if($category->products->count() > 0)
    <section class="product-wrapper container appear-animate mt-6 mt-md-10 pt-4 pb-8">
        <h2 class="title title-center mb-5">{{ $category->name_en }}</h2>
        <div class="owl-carousel owl-theme row owl-nav-full cols-2 cols-md-3 cols-lg-4" data-owl-options="{
            'items': 4,
            'nav': true,
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
                    'items': 4
                }
            }
        }">
            @foreach($category->products as $product)
            <div class="product text-center">
                <figure class="product-media">
                    <a href="{{ route('productDetails', $product->slug) }}">
                        <img src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}"
                            width="280" height="315" style="background-color: #f2f3f5;" />
                    </a>
                    <div class="product-label-group">
                        @if($product->final_price < $product->selling_price)
                        <label class="product-label label-sale">{{ calculateDiscountPercentage($product->selling_price, $product->discount_price) }}% off</label>
                        @endif
                    </div>
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon add-to-cart-btn" data-id="{{ $product->id }}" title="Add to cart"><i class="d-icon-bag"></i></a>
                        <a href="#" class="btn-product-icon btn-wishlist add-to-wishlist" data-id="{{ $product->id }}" title="Add to wishlist"><i
                                class="d-icon-heart"></i></a>
                    </div>
                    <div class="product-action">
                        <a href="{{ route('productDetails', $product->slug) }}" class="btn-product" title="Quick View">View Details</a>
                    </div>
                </figure>
                <div class="product-details">
                    <div class="product-cat">
                        <a href="{{ route('productCategory', $category->slug) }}">{{ $category->name_en }}</a>
                    </div>
                    <h3 class="product-name">
                        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
                    </h3>
                    <div class="product-price">
                        @if($product->final_price < $product->selling_price)
                        <ins class="new-price">৳{{ number_format($product->selling_price - $product->discount_price, 2) }}</ins><del class="old-price">৳{{ number_format($product->selling_price, 2) }}</del>
                        @else
                        <span class="price">৳{{ number_format($product->selling_price, 2) }}</span>
                        @endif
                    </div>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width:100%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="{{ route('productDetails', $product->slug) }}" class="rating-reviews">( {{ $product->reviews_count ?? 0 }} reviews )</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
    @endforeach--}}
    <section class="banner banner-background parallax text-center" data-option="{'offset': -60}"
        data-image-src="images/demos/demo1/parallax.jpg" style="background-color: #2d2f33;">
        <div class="container">
            <div class="banner-content appear-animate"
                data-animation-options="{'name': 'blurIn', 'duration': '1s', 'delay': '.2s'}">
                <h4 class="banner-subtitle text-white font-weight-bold ls-l">
                    Extra<span class="d-inline-block label-star bg-dark text-primary ml-4 mr-2">30%
                        Off</span>Online
                </h4>
                <h3 class="banner-title font-weight-bold text-white">Summer Season Sale</h3>
                <p class="text-white ls-s">Free shipping on orders over $99</p>
                <a href="shop.html" class="btn btn-primary btn-rounded btn-icon-right">Shop Now<i
                        class="d-icon-arrow-right"></i></a>
            </div>
        </div>
    </section>
    <!-- <section class="banner banner-background parallax" 
    style="background-color: #2d2f33; position: relative; overflow: hidden;">

    <div class="container">
        <div class="row align-items-center">

            {{-- LEFT CONTENT --}}
            <div class="col-lg-6 text-center text-lg-left">
                <div class="banner-content text-white">

                    <h4 class="banner-subtitle font-weight-bold mb-2">
                        Download Our App & Get
                        <span class="label-star bg-dark text-primary ml-2">30% OFF</span>
                    </h4>

                    <h3 class="banner-title font-weight-bold mb-3">
                        Shop Faster with Sungoods App
                    </h3>

                    <p class="mb-4">
                        Enjoy exclusive deals, faster checkout, and real-time order tracking.
                    </p>

                    <div class="d-flex flex-column flex-sm-row align-items-center">
                        <a href="{{ $ws->playstore_url ?? '#' }}" 
                           class="btn btn-primary btn-rounded mr-2 mb-2">
                            Download App
                        </a>

                        <a href="{{ $ws->apk_url ?? '#' }}" 
                           class="btn btn-outline-light btn-rounded mb-2">
                            Get APK
                        </a>
                    </div>

                </div>
            </div>

            {{-- RIGHT IMAGE --}}
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
                <div class="mobile-image-wrapper">
                    <img src="{{ asset('sungoods/images/app/mobile.png') }}" 
                         alt="Mobile App" 
                         class="mobile-img">
                </div>
            </div>

        </div>
    </div>

</section> -->
    <section class="blog-section mt-10 appear-animate">
        <div class="container">
            <h2 class="title title-center mb-5">Latest Articles</h2>
            <div class="owl-carousel owl-theme row cols-lg-3 cols-sm-2 cols-1" data-owl-options="{
                'nav': false,
                'dots': true,
                'items': 3,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '576': {
                        'items': 2
                    },
                    '992': {
                        'items': 3,
                        'dots': false
                    }
                }
            }">
                @foreach($newses as $news)
                <div class="blog-post mb-4">
                    <article class="post post-frame overlay-zoom">
                        <figure class="post-media">
                            <a href="{{ route('singleNews', $news->id) }}">
                                <img src="{{ route('imagecache', ['template'=>'original','filename' => $news->fi()]) }}" alt="{{ $news->title }}" width="340" height="206"
                                    style="background-color: #919fbc;" />
                            </a>
                            <div class="post-calendar">
                                <span class="post-day">{{ $news->created_at->format('d') }}</span>
                                <span class="post-month">{{ $news->created_at->format('M') }}</span>
                            </div>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="{{ route('singleNews', $news->id) }}">{{ $news->title }}</a></h4>
                            <p class="post-content">{{ Str::limit(strip_tags($news->text_en), 100) }}</p>
                            <a href="{{ route('singleNews', $news->id) }}" class="btn btn-primary btn-link btn-underline">Read
                                More<i class="d-icon-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="brand-section mt-10 mb-10 appear-animate">
        <div class="container">
            <h2 class="title title-center mb-5">Our Brands</h2>
            <div class="owl-carousel owl-theme row brand-carousel cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2"
                data-owl-options="{
                'nav': false,
                'dots': false,
                'autoplay': true,
                'margin': 20,
                'loop': true,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 4
                    },
                    '992': {
                        'items': 5
                    },
                    '1200': {
                        'items': 6
                    }
                }
            }">
                @foreach($brands as $brand)
                <figure><img src="{{ $brand->fi_url }}" alt="{{ $brand->title }}" width="180" height="100" />
                </figure>
                @endforeach
            </div>
        </div>
    </section>
    <section class="product-widget-wrapper pb-2 pb-md-10 appear-animate">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="widget widget-products appear-animate" data-animation-options="{
                        'name': 'fadeInLeftShorter',
                        'delay': '.5s'
                    }">
                        <h4 class="widget-title border-no lh-1 font-weight-bold">Sale Products</h4>
                        <div class="products-col">
                            @foreach($sale_products as $product)
                            <div class="product product-list-sm">
                                <figure class="product-media">
                                    <a href="{{ route('productDetails', $product->slug) }}">
                                        <img src="{{ route('imagecache', ['template'=>'pnism','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}"
                                            width="100" height="114" style="background-color: #f2f3f5;" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-name">
                                        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if($product->final_price < $product->selling_price)
                                        <ins class="new-price">৳{{ number_format($product->selling_price - $product->discount_price, 2) }}</ins><del class="old-price">৳{{ number_format($product->selling_price, 2) }}</del>
                                        @else
                                        <span class="price">৳{{ number_format($product->selling_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="widget widget-products appear-animate" data-animation-options="{
                        'name': 'fadeInLeftShorter',
                        'delay': '.3s'
                    }">
                        <h4 class="widget-title border-no lh-1 font-weight-bold">Latest Products</h4>
                        <div class="products-col">
                            @foreach($latest_products as $product)
                            <div class="product product-list-sm">
                                <figure class="product-media">
                                    <a href="{{ route('productDetails', $product->slug) }}">
                                        <img src="{{ route('imagecache', ['template'=>'pnism','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}"
                                            width="100" height="114" style="background-color: #f2f3f5;" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-name">
                                        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if($product->final_price < $product->selling_price)
                                        <ins class="new-price">৳{{ number_format($product->selling_price - $product->discount_price, 2) }}</ins><del class="old-price">৳{{ number_format($product->selling_price, 2) }}</del>
                                        @else
                                        <span class="price">৳{{ number_format($product->selling_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="widget widget-products appear-animate" data-animation-options="{
                        'name': 'fadeInRightShorter',
                        'delay': '.3s'
                    }">
                        <h4 class="widget-title border-no lh-1 font-weight-bold">Best of the Week</h4>
                        <div class="products-col">
                            @foreach($best_products as $product)
                            <div class="product product-list-sm">
                                <figure class="product-media">
                                    <a href="{{ route('productDetails', $product->slug) }}">
                                        <img src="{{ route('imagecache', ['template'=>'pnism','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}"
                                            width="100" height="114" style="background-color: #f2f3f5;" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-name">
                                        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if($product->final_price < $product->selling_price)
                                        <ins class="new-price">৳{{ number_format($product->selling_price - $product->discount_price, 2) }}</ins><del class="old-price">৳{{ number_format($product->selling_price, 2) }}</del>
                                        @else
                                        <span class="price">৳{{ number_format($product->selling_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="widget widget-products appear-animate" data-animation-options="{
                        'name': 'fadeInRightShorter',
                        'delay': '.5s'
                    }">
                        <h4 class="widget-title border-no lh-1 font-weight-bold">Popular</h4>
                        <div class="products-col">
                            @foreach($popular_products as $product)
                            <div class="product product-list-sm">
                                <figure class="product-media">
                                    <a href="{{ route('productDetails', $product->slug) }}">
                                        <img src="{{ route('imagecache', ['template'=>'pnism','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}"
                                            width="100" height="114" style="background-color: #f2f3f5;" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-name">
                                        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if($product->final_price < $product->selling_price)
                                        <ins class="new-price">৳{{ number_format($product->selling_price - $product->discount_price, 2) }}</ins><del class="old-price">৳{{ number_format($product->selling_price, 2) }}</del>
                                        @else
                                        <span class="price">৳{{ number_format($product->selling_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- testimonial  -->
 <style>
    /* Ensure consistent image size */
.user-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

/* Align content properly */
.testimonial-info {
    margin-top: 15px;
}

/* Improve blockquote spacing */
.testimonial blockquote {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
}
</style>
<section class="testimonial-section mt-10 pt-8 pb-10">
    <div class="container">
        <h2 class="title title-center mb-5">What Our Customers Say</h2>

        <div class="owl-carousel owl-theme row cols-lg-3 cols-sm-2 cols-1"
            data-owl-options='{
                "items": 3,
                "nav": false,
                "dots": true,
                "loop": true,
                "margin": 20,
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "576": {
                        "items": 2
                    },
                    "992": {
                        "items": 3,
                        "dots": false
                    }
                }
            }'>

            @foreach($testimonials as $item)
<div class="testimonial">
    <blockquote>{!! $item->text_en !!}</blockquote>

    <div class="testimonial-info d-flex align-items-center">
        <figure class="testimonial-author-thumbnail mb-0">
            <img 
                src="{{ asset($item->image ?? 'sungoods/images/default-users.png') }}" 
                alt="{{ $item->name }}" 
                class="user-img">
        </figure>

        <cite class="ml-3">
            {{ $item->name }}
            <span>{{ $item->designation ?? 'Customer' }}</span>
        </cite>
    </div>
</div>
            @endforeach
        </div>
    </div>
</section>
</div>
@endsection
