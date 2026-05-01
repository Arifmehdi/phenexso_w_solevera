@extends('website.layouts.sungoods')

@section('title', 'Wishlist - '. ($ws->name ?? env('APP_NAME')))

@section('body_class', 'wishlist-page')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('sungoods/css/style.min.css') }}">
<style>
    /* Isolated Wishlist Styles to avoid conflicts */
    .sg-wishlist-container {
        padding: 40px 0;
    }
    .sg-wishlist-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }
    .sg-wishlist-table thead th {
        padding: 15px 10px;
        font-size: 14px;
        font-weight: 700;
        color: #222;
        text-transform: uppercase;
        background-color: #f4f4f4;
        border-bottom: 2px solid #eee;
        text-align: left;
    }
    .sg-wishlist-table tbody td {
        padding: 20px 10px;
        vertical-align: middle !important;
        border-bottom: 1px solid #eee;
        color: #666;
        font-size: 14px;
    }
    .sg-wishlist-table .product-thumbnail img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #f0f0f0;
    }
    .sg-wishlist-table .product-name a {
        font-weight: 600;
        color: #222;
        text-decoration: none;
        font-size: 15px;
    }
    .sg-wishlist-table .product-name a:hover {
        color: #27c;
    }
    .sg-wishlist-table .product-price {
        font-weight: 700;
        color: #222;
    }
    .sg-wishlist-table .old-price {
        color: #999;
        text-decoration: line-through;
        font-size: 13px;
        margin-left: 5px;
        font-weight: 400;
    }
    .sg-wishlist-table .stock-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .sg-wishlist-table .in-stock {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    .sg-wishlist-table .out-of-stock {
        background-color: #ffebee;
        color: #c62828;
    }
    .sg-wishlist-table .remove-btn {
        color: #999;
        font-size: 18px;
        cursor: pointer;
        transition: color 0.2s;
    }
    .sg-wishlist-table .remove-btn:hover {
        color: #e32937;
    }
    .sg-empty-wishlist {
        text-align: center;
        padding: 60px 20px;
    }
    .sg-empty-wishlist i {
        font-size: 60px;
        color: #e0e0e0;
        margin-bottom: 20px;
        display: block;
    }
</style>
@endpush

@section('content')
<nav class="breadcrumb-nav">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
            <li>{{ 'Wishlist' }}</li>
        </ul>
    </div>
</nav>

<div class="page-header" style="background-image: url({{ asset('sungoods/images/page-header/about-us.jpg') }})">
    <h1 class="page-title font-weight-bold text-capitalize ls-l">Wishlist</h1>
</div>


<div class="page-content sg-wishlist-container">
    <div class="container">
        @if($wishlists->count() > 0)
        <div class="table-responsive">
            <table class="sg-wishlist-table">
                <thead>
                    <tr>
                        <th style="width: 50px;"></th>
                        <th style="width: 100px;">Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody class="wishlist-items-wrapper">
                    @foreach ($wishlists as $w)
                        @if($w->product)
                        <tr id="wishlist-row-{{ $w->id }}">
                            <td class="text-center">
                                <a href="javascript:void(0)" class="remove-wishlist remove-btn" data-id="{{ $w->id }}">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                            <td class="product-thumbnail">
                                <a href="{{ route('productDetails', $w->product->slug) }}">
                                    <img src="{{ route('imagecache', ['template'=>'small', 'filename'=>$w->product->fi()]) }}" alt="{{ $w->product->name_en }}">
                                </a>
                            </td>
                            <td class="product-name">
                                <a href="{{ route('productDetails', $w->product->slug) }}">{{ $w->product->name_en }}</a>
                            </td>
                            <td class="product-price">
                                @if(!empty($w->product->discount_price) && $w->product->discount_price > 0)
                                    <span>৳{{ number_format($w->product->selling_price - $w->product->discount_price, 2) }}</span>
                                    <span class="old-price">৳{{ number_format($w->product->selling_price, 2) }}</span>
                                @else
                                    <span>৳{{ number_format($w->product->selling_price, 2) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($w->product->stock > 0)
                                    <span class="stock-badge in-stock">In Stock</span>
                                @else
                                    <span class="stock-badge out-of-stock">Out of Stock</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <a href="javascript:void(0)" class="btn btn-dark btn-rounded btn-sm add-to-cart-btn" data-id="{{ $w->product->id }}">
                                    Add to Cart
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="sg-empty-wishlist">
            <i class="d-icon-heart"></i>
            <h3>Your wishlist is empty</h3>
            <p>Looks like you haven't added anything to your wishlist yet.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary btn-rounded mt-4">Go to Shop</a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('js')
<script>
$(document).on('click','.remove-wishlist',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var $row = $('#wishlist-row-' + id);

    $.ajax({
        url: "{{ route('wishlist.remove') }}",
        type: "POST",
        data: {
            id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function(res){
            if(res.status == 'success') {
                $('.wishlist-count').text(res.wishlistCount);
                $row.fadeOut(function(){
                    $(this).remove();
                    if($('.wishlist-items-wrapper tr').length == 0) {
                        location.reload();
                    }
                });
            }
        }
    });
});
</script>
@endpush
