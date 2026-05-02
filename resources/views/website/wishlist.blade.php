@extends('website.layouts.solevera')

@section('title', 'Wishlist - '. ($ws->name ?? env('APP_NAME')))

@section('content')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> /
                        <li class="active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Wishlist Detail ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2 class="ft-bold mb-1">My Wishlist</h2>
                </div>
            </div>
        </div>
        
        <div class="row align-items-start">
        
            <div class="col-xl-12 col-lg-12 col-md-12">
                @if($wishlists->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="wishlist-items-wrapper">
                            @foreach ($wishlists as $w)
                                @if($w->product)
                                <tr id="wishlist-row-{{ $w->id }}">
                                    <td>
                                        <div class="cart_single d-flex align-items-center">
                                            <div class="cart_selected_single_thumb">
                                                <a href="{{ route('productDetails', $w->product->slug) }}">
                                                    <img src="{{ route('imagecache', ['template'=>'original', 'filename'=>$w->product->fi()]) }}" width="80" class="img-fluid" alt="{{ $w->product->name_en }}">
                                                </a>
                                            </div>
                                            <div class="cart_single_caption ps-3">
                                                <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $w->product->name_en }}</h4>
                                                <p class="mb-2"><span class="text-dark ft-medium">Category:</span> {{ $w->product->categories->first()->name_en ?? 'N/A' }}</p>
                                                <a href="javascript:void(0)" class="remove-wishlist text-danger small ft-medium" data-id="{{ $w->id }}"><i class="fas fa-trash me-1"></i>Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-price ft-medium text-dark">
                                            @if(!empty($w->product->discount_price) && $w->product->discount_price > 0)
                                                <span>৳{{ number_format($w->product->selling_price - $w->product->discount_price, 2) }}</span>
                                                <span class="text-muted text-decoration-line-through small ms-1">৳{{ number_format($w->product->selling_price, 2) }}</span>
                                            @else
                                                <span>৳{{ number_format($w->product->selling_price, 2) }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($w->product->stock > 0)
                                            <span class="badge bg-light-success text-success">In Stock</span>
                                        @else
                                            <span class="badge bg-light-danger text-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-dark btn-sm rounded add-to-cart-btn" data-id="{{ $w->product->id }}">Add to Cart</button>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="lni lni-heart text-muted display-1"></i>
                    </div>
                    <h3 class="ft-bold">Your Wishlist is Empty</h3>
                    <p class="mb-4">You haven't added any products to your wishlist yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-dark rounded">Continue Shopping</a>
                </div>
                @endif
            </div>
            
        </div>
        
    </div>
</section>
<!-- ======================= Wishlist Detail End ======================== -->

@endsection

@push('js')
<script>
$(document).on('click', '.remove-wishlist', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var $row = $('#wishlist-row-' + id);

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this item from wishlist!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('wishlist.remove') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('.dn-counter').filter(function() {
                            return $(this).siblings('.lni-heart').length > 0;
                        }).text(res.wishlistCount);
                        
                        $row.fadeOut(function() {
                            $(this).remove();
                            if ($('.wishlist-items-wrapper tr').length == 0) {
                                location.reload();
                            }
                        });

                        Snackbar.show({
                            text: res.message,
                            pos: 'top-right',
                            showAction: false,
                            duration: 3000,
                            backgroundColor: '#151515'
                        });
                    }
                }
            });
        }
    })
});
</script>
@endpush
