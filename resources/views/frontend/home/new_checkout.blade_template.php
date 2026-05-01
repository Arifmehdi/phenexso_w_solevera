@extends('website.layouts.sungoods')

@section('title', 'Checkout - Sungoods')

@section('content')
<div class="page-content pt-10 pb-10 bg-light">
    <!-- Step Tracker -->
    <div class="container mb-8">
        <div class="step-by-step breadcrumb-lg flex-container border-no justify-content-center">
            <a href="{{ route('cart') }}" class="cart"><i class="d-icon-bag mr-2"></i>1. Shopping Cart</a>
            <a href="{{ route('new.checkout') }}" class="checkout active"><i class="d-icon-check mr-2"></i>2. Checkout</a>
            <a href="#" class="order-complete"><i class="d-icon-finish mr-2"></i>3. Order Complete</a>
        </div>
    </div>

    <div class="container">
        @php
            $me = Auth::user();
            if($me){
                $dl = $me->locations()->first();
            }
            else{
                $dl = $location ?? null;
            }
            
            $subtotal = $cartItems->sum(function($item) {
                return ($item->product->selling_price - $item->product->discount_price) * $item->quantity;
            });
            $shippingCharge = $ws->shipping_charge ?? 0;
            $grandTotal = $subtotal + $shippingCharge;
        @endphp

        <!-- Promo/Login Section -->
        <div class="row mb-4">
            <div class="col-md-6 mb-2">
                <div class="promo-card">
                    <i class="fas fa-user-circle"></i>
                    <span>Returning customer? <a href="javascript:void(0)" class="toggle-login-form">Login here</a></span>
                </div>
                <div class="collapsible-content login-form-content p-4 bg-white mt-2 shadow-sm rounded" style="display: none;">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="label-sm">Username or email *</label>
                                <input type="text" class="form-control form-control-sm" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="label-sm">Password *</label>
                                <input type="password" class="form-control form-control-sm" name="password" required>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary btn-sm btn-rounded">Login</button>
                            <a href="#" class="ml-auto text-primary small">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="promo-card">
                    <i class="fas fa-tag"></i>
                    <span>Have a coupon? <a href="javascript:void(0)" class="toggle-coupon-form">Enter your code</a></span>
                </div>
                <div class="collapsible-content coupon-form-content p-4 bg-white mt-2 shadow-sm rounded" style="display: none;">
                    <form action="#" class="input-wrapper input-wrapper-inline">
                        <input type="text" class="form-control form-control-sm" name="coupon_code" placeholder="Coupon code" required>
                        <button type="submit" class="btn btn-primary btn-sm btn-rounded ml-2">Apply</button>
                    </form>
                </div>
            </div>
        </div>

        @if($cartItems->isEmpty())
            <div class="text-center pt-10 pb-10 bg-white shadow-sm rounded">
                <i class="d-icon-bag fs-1 mb-4 text-grey"></i>
                <h3 class="mt-4">Your cart is empty</h3>
                <p class="mb-7">Add some products to your cart before checking out.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary btn-md btn-rounded">Go To Shop</a>
            </div>
        @else
            <form action="{{ route('codOrderStore') }}" method="POST" id="checkout-form" class="form">
                @csrf
                
                <!-- Order Review Table -->
                <div class="card shadow-sm mb-6 border-0 rounded overflow-hidden">
                    <div class="card-header bg-white py-3 px-4 border-bottom">
                        <h4 class="card-title mb-0"><i class="d-icon-search mr-2"></i>Review Your Order</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="modern-checkout-table w-100">
                                <thead class="bg-light text-grey">
                                    <tr>
                                        <th class="py-3 px-4">Product</th>
                                        <th class="py-3">Price</th>
                                        <th class="py-3">Qty</th>
                                        <th class="py-3 px-4 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        @php 
                                            $price = $item->product->selling_price - $item->product->discount_price;
                                            $lineTotal = $price * $item->quantity;
                                        @endphp
                                        <tr class="border-bottom">
                                            <td class="py-3 px-4">
                                                <div class="d-flex align-items-center">
                                                    <figure class="rounded border mb-0 mr-3" style="width: 50px; height: 50px; overflow: hidden;">
                                                        <img src="{{ route('imagecache', ['template'=>'ppsm','filename' => $item->product->fi()]) }}" width="50" height="50" alt="{{ $item->product->name_en }}" style="object-fit: cover;">
                                                    </figure>
                                                    <a href="{{ route('productDetails', $item->product->slug) }}" class="text-dark font-weight-semi-bold">{{ $item->product->name_en }}</a>
                                                </div>
                                            </td>
                                            <td class="py-3">৳{{ number_format($price, 2) }}</td>
                                            <td class="py-3"><span class="qty-badge">{{ $item->quantity }}</span></td>
                                            <td class="py-3 px-4 text-right font-weight-bold">৳{{ number_format($lineTotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Billing Details -->
                    <div class="col-lg-7 pr-lg-6">
                        <div class="card shadow-sm border-0 rounded mb-6">
                            <div class="card-header bg-white py-3 px-4 border-bottom">
                                <h4 class="card-title mb-0"><i class="d-icon-map mr-2"></i>Billing Details</h4>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label class="font-weight-bold text-dark">Full Name *</label>
                                        <input type="text" class="form-control modern-input" name="name" 
                                            value="{{ $dl ? $dl->name : ($me ? $me->name : '') }}" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-weight-bold text-dark">Phone Number *</label>
                                        <input type="tel" class="form-control modern-input" name="mobile" 
                                            value="{{ $dl ? $dl->mobile : ($me ? $me->mobile : '') }}" placeholder="e.g. 01700000000" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-weight-bold text-dark">Email Address</label>
                                        <input type="email" class="form-control modern-input" name="email" 
                                            value="{{ $dl ? $dl->email : ($me ? $me->email : '') }}" placeholder="Enter your email">
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="font-weight-bold text-dark">Shipping Address *</label>
                                        <textarea class="form-control modern-input" name="billing_address" rows="3" 
                                            placeholder="Detailed address (House/Road/Area)" required>{{ $dl ? $dl->address_title : '' }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="font-weight-bold text-dark">Order Notes (Optional)</label>
                                        <textarea class="form-control modern-input" name="order_note" rows="4"
                                            placeholder="Special notes for delivery (e.g. Call before delivery)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Sidebar -->
                    <aside class="col-lg-5 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar" data-sticky-options="{'bottom': 50}">
                            <div class="summary card shadow-sm border-0 rounded p-5 bg-white">
                                <h3 class="title title-simple text-left text-uppercase mb-4">Order Summary</h3>
                                <div class="summary-rows mb-4">
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <span class="text-grey">Subtotal</span>
                                        <span class="font-weight-bold">৳{{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <span class="text-grey">Shipping Fee</span>
                                        <span class="font-weight-bold">৳{{ number_format($shippingCharge, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3">
                                        <span class="text-dark font-weight-bold fs-5">Total</span>
                                        <span class="text-primary font-weight-bold fs-3">৳{{ number_format($grandTotal, 2) }}</span>
                                    </div>
                                </div>

                                <div class="payment-accordion modern-payment">
                                    <div class="payment-method-card mb-2">
                                        <div class="form-check payment-method-check px-3 py-2 rounded">
                                            <input type="radio" id="cod" name="payment_method" value="cod" class="form-check-input" checked>
                                            <label class="form-check-label font-weight-bold text-dark ml-2" for="cod">
                                                Cash on delivery
                                            </label>
                                        </div>
                                        <div id="cash-on-delivery" class="payment-body p-3 bg-light rounded mt-1">
                                            <p class="mb-0 small text-grey">Pay securely with cash upon receiving your items at your doorstep.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="payment-method-card mb-4">
                                        <div class="form-check payment-method-check px-3 py-2 rounded">
                                            <input type="radio" id="online" name="payment_method" value="online" class="form-check-input">
                                            <label class="form-check-label font-weight-bold text-dark ml-2" for="online">
                                                Online Payment (bKash)
                                            </label>
                                        </div>
                                        <div id="online-payment" class="payment-body p-3 bg-light rounded mt-1" style="display: none;">
                                            <p class="mb-1 small font-weight-bold">Merchant bKash: 01790552864</p>
                                            <p class="mb-2 small text-grey">Please send money to the number above and enter your Transaction ID.</p>
                                            <input type="text" class="form-control form-control-sm" name="transaction_id" placeholder="Enter Transaction ID">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-checkbox mb-5">
                                    <input type="checkbox" class="custom-checkbox" id="terms-condition" name="terms-condition" required />
                                    <label class="form-control-label small text-grey" for="terms-condition">
                                        I agree to the <a href="{{ route('terms') }}" class="text-primary font-weight-bold">Terms & Conditions</a> *
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-rounded btn-md font-weight-bold shadow-sm">
                                    Confirm Order <i class="d-icon-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </aside>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Toggle Promo Forms
        $('.toggle-login-form').on('click', function() {
            $('.login-form-content').slideToggle();
        });
        $('.toggle-coupon-form').on('click', function() {
            $('.coupon-form-content').slideToggle();
        });

        // Payment Accordion Sync
        $('input[name="payment_method"]').on('change', function() {
            if ($(this).val() === 'cod') {
                $('#cash-on-delivery').slideDown();
                $('#online-payment').slideUp();
                $('#cod').closest('.payment-method-check').addClass('active');
                $('#online').closest('.payment-method-check').removeClass('active');
            } else {
                $('#cash-on-delivery').slideUp();
                $('#online-payment').slideDown();
                $('#online').closest('.payment-method-check').addClass('active');
                $('#cod').closest('.payment-method-check').removeClass('active');
            }
        });

        // Initial active class
        $('#cod').closest('.payment-method-check').addClass('active');

        // Form Validation
        $('#checkout-form').on('submit', function(e) {
            if ($('input[name="payment_method"]:checked').val() === 'online') {
                if (!$('input[name="transaction_id"]').val()) {
                    alert('Please enter your Transaction ID for bKash payment.');
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endpush

@push('css')
<style>
    .bg-light { background-color: #f8f9fa !important; }
    .promo-card {
        background: #fff;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
    }
    .promo-card i { color: #222; font-size: 18px; }
    .promo-card a { color: #222; font-weight: bold; text-decoration: underline; }
    
    .modern-checkout-table th { font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
    .modern-checkout-table td { font-size: 14px; }
    .qty-badge {
        background: #eee;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 12px;
    }
    
    .modern-input {
        border: 1px solid #eee !important;
        border-radius: 6px !important;
        padding: 10px 15px !important;
        background: #fafafa !important;
    }
    .modern-input:focus {
        background: #fff !important;
        border-color: #222 !important;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05) !important;
    }
    
    .fs-3 { font-size: 2.2rem; }
    .fs-5 { font-size: 1.6rem; }
    
    .payment-method-check {
        border: 1px solid #eee;
        transition: all 0.3s;
        cursor: pointer;
    }
    .payment-method-check.active {
        border-color: #222;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .payment-method-check input { width: 18px; height: 18px; cursor: pointer; }
    .payment-method-check label { cursor: pointer; margin-bottom: 0; }
    
    .btn-rounded { border-radius: 50px; }
    .label-sm { font-size: 12px; font-weight: bold; color: #666; display: block; margin-bottom: 5px; }
    
    .sticky-sidebar { top: 100px; }

    /* Step tracker refinement */
    .step-by-step a { font-weight: 500; color: #999; }
    .step-by-step a.active { color: #222; font-weight: 700; border-bottom: 2px solid #222; }
</style>
@endpush
