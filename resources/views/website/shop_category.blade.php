@extends('website.layouts.sungoods')

@section('title', (isset($category) ? $category->name_en : 'All Categories') . ' - '. ($ws->name ?? env('APP_NAME')))

@section('body_class', 'shop')

@section('meta')
    <meta name="description" content="Browse our wide selection of products in {{ isset($category) ? $category->name_en : 'All Categories' }} at {{ $ws->name ?? 'Sungoods' }}.">
    <meta name="keywords" content="shop, ecommerce, products, {{ isset($category) ? $category->name_en : '' }}, {{ $ws->meta_keywords ?? '' }}">
    <meta property="og:title" content="{{ isset($category) ? $category->name_en : 'All Categories' }} - {{ $ws->name ?? env('APP_NAME') }}">
    <meta property="og:description" content="Explore our product collection and shop online.">
    <meta property="og:type" content="website">
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('sungoods/css/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('sungoods/vendor/nouislider/nouislider.min.css') }}">
<style>
    .pagination {
        justify-content: center;
    }
    .widget-body {
        display: block !important;
    }
    .filter-price-slider {
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<nav class="breadcrumb-nav">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li>{{ isset($category) ? $category->name_en : 'All Categories' }}</li>
        </ul>
    </div>
</nav>
{{--<div class="page-header" style="background-image: url('{{ asset('sungoods/images/shop/page-header-back.jpg') }}'); background-color: #3C63A4;">
    <h1 class="page-title">{{ isset($category) ? $category->name_en : 'All Categories' }}</h1>
    <ul class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
        <li class="delimiter">/</li>
        <li><a href="{{ route('shop') }}">Shop</a></li>
        @if(isset($category))
        <li class="delimiter">/</li>
        <li>{{ $category->name_en }}</li>
        @endif
    </ul>
</div>--}}
<!-- End PageHeader -->

<div class="page-content mb-10 pb-3">
    <div class="container">
        <div class="row main-content-wrap gutter-lg">
            <aside class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
                <div class="sidebar-content">
                    <div class="sticky-sidebar" data-sticky-options="{'top': 10}">
                        <div class="filter-actions mb-4">
                            <a href="#" class="sidebar-toggle-btn toggle-remain btn btn-outline btn-primary btn-icon-right btn-rounded">Filter<i class="d-icon-arrow-left"></i></a>
                            <a href="{{ route('productCategory', 'all') }}" class="filter-clean">Clean All</a>
                        </div>
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">All Categories</h3>
                            <ul class="widget-body filter-items search-ul">
                                <li class="{{ $slug == 'all' || !$slug ? 'active' : '' }}"><a href="{{ route('productCategory', 'all') }}">All ({{ \App\Models\Product::where('active', 1)->count() }})</a></li>
                                @foreach ($allRootCategories as $rootCategory)
                                    <li class="{{ $slug == $rootCategory->slug ? 'active' : '' }}">
                                        <a href="{{ route('productCategory', $rootCategory->slug) }}">{{ $rootCategory->name_en }} ({{ $rootCategory->products()->count() }})</a>
                                        @if($rootCategory->children->count() > 0)
                                        <ul style="{{ (isset($category) && ($category->id == $rootCategory->id || $category->parent_id == $rootCategory->id)) ? 'display: block' : '' }}">
                                            @foreach($rootCategory->children as $child)
                                            <li class="{{ $slug == $child->slug ? 'active' : '' }}"><a href="{{ route('productCategory', $child->slug) }}">{{ $child->name_en }} ({{ $child->products()->count() }})</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">Filter by Price</h3>
                            <div class="widget-body mt-3">
                                <form method="GET" action="{{ url()->current() }}">
                                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                                    @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                                    
                                    <div class="filter-price-slider"></div>
                                    <input type="hidden" name="price" id="price-range-input" value="{{ request('price') }}">

                                    <div class="filter-actions">
                                        <div class="filter-price-text mb-4">Price:
                                            <span class="filter-price-range"></span>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-filter btn-rounded">Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="widget widget-collapsible">
                            <h4 class="widget-title">Top Rated Product</h4>
                            <div class="widget-body">
                                @foreach($topClickedProducts as $topProduct)
                                <div class="product product-list-sm mb-4">
                                    <figure class="product-media">
                                        <a href="{{ route('productDetails', $topProduct->slug) }}">
                                            <img src="{{ route('imagecache', ['template' => 'sbism', 'filename' => $topProduct->fi()]) }}" alt="{{ $topProduct->name_en }}" width="100" height="114">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-name">
                                            <a href="{{ route('productDetails', $topProduct->slug) }}">{{ $topProduct->name_en }}</a>
                                        </h3>
                                        <div class="product-price">
                                            <span class="price">৳{{ number_format($topProduct->final_price, 2) }}</span>
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width:{{ ($topProduct->averageRating() / 5) * 100 }}%"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="widget widget-collapsible">
                            <div class="widget-body">
                                <a href="#"><img src="{{ asset('sungoods/images/shop/banner.jpg') }}" alt="Banner"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="col-lg-9 main-content">
                <nav class="toolbox sticky-toolbox sticky-content fix-top">
                    <div class="toolbox-left">
                        <a href="#" class="toolbox-item left-sidebar-toggle btn btn-sm btn-outline btn-primary btn-rounded btn-icon-right d-lg-none">Filter<i class="d-icon-arrow-right"></i></a>
                        <div class="toolbox-item toolbox-sort select-box text-dark">
                            <label>Sort By :</label>
                            <form method="GET" action="{{ url()->current() }}" id="sort-form">
                                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                                @if(request('price')) <input type="hidden" name="price" value="{{ request('price') }}"> @endif
                                <select name="sort" class="form-control" onchange="this.form.submit()">
                                    <option value="">Default sorting</option>
                                    <option value="1" {{ request('sort') == 1 ? 'selected' : '' }}>Latest</option>
                                    <option value="2" {{ request('sort') == 2 ? 'selected' : '' }}>Oldest</option>
                                    <option value="3" {{ request('sort') == 3 ? 'selected' : '' }}>Price: High → Low</option>
                                    <option value="4" {{ request('sort') == 4 ? 'selected' : '' }}>Price: Low → High</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="toolbox-right">
                        <div class="toolbox-item toolbox-show select-box text-dark">
                            <label>Show :</label>
                            <select name="count" class="form-control">
                                <option value="12">12</option>
                                <option value="24">24</option>
                                <option value="36">36</option>
                            </select>
                        </div>
                        <div class="toolbox-item toolbox-layout">
                            <a href="#" class="d-icon-mode-list btn-layout"></a>
                            <a href="#" class="d-icon-mode-grid btn-layout active"></a>
                        </div>
                    </div>
                </nav>
                <div class="row cols-2 cols-sm-3 product-wrapper">
                    @forelse($products as $product)
                    <div class="product-wrap">
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('productDetails', $product->slug) }}">
                                    <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}" alt="{{ $product->name_en }}" width="280" height="315">
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
                                    <a href="#" class="btn-product-icon btn-wishlist add-to-wishlist" data-id="{{ $product->id }}" title="Add to wishlist"><i class="d-icon-heart"></i></a>
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
                                        <span class="ratings" style="width:{{ ($product->averageRating() / 5) * 100 }}%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="{{ route('productDetails', $product->slug) }}" class="rating-reviews">( {{ $product->reviews_count ?? 0 }} reviews )</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p class="text-center">No products found.</p>
                    </div>
                    @endforelse
                </div>
                
                <nav class="toolbox toolbox-pagination">
                    <p class="show-info">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} results</p>
                    {{ $products->links('pagination.riode') }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection