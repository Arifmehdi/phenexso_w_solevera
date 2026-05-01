@extends('website.layouts.sungoods')

@section('title', 'Checkout - Sungoods')

@section('content')

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

<div class="sgc-page">

    <!-- ── Hero Strip ── -->
    <div class="sgc-hero">
        <div class="sgc-hero__inner container">
            <p class="sgc-hero__eyebrow">Almost there</p>
            <h1 class="sgc-hero__title">Checkout</h1>
            <!-- Step Tracker -->
            <div class="sgc-steps">
                <a href="{{ route('cart') }}" class="sgc-step sgc-step--done">
                    <span class="sgc-step__num">01</span>
                    <span class="sgc-step__label">Shopping Cart</span>
                </a>
                <span class="sgc-step__line"></span>
                <a href="{{ route('new.checkout') }}" class="sgc-step sgc-step--active">
                    <span class="sgc-step__num">02</span>
                    <span class="sgc-step__label">Checkout</span>
                </a>
                <span class="sgc-step__line"></span>
                <span class="sgc-step sgc-step--pending">
                    <span class="sgc-step__num">03</span>
                    <span class="sgc-step__label">Order Complete</span>
                </span>
            </div>
        </div>
    </div>

    <div class="container sgc-body">

        <!-- ── Promo / Login Banners ── -->
        <div class="sgc-banners">
            <div class="sgc-banner" id="banner-login">
                <div class="sgc-banner__bar js-toggle-banner" data-target="login-panel">
                    <i class="fas fa-user-circle"></i>
                    <span>Returning customer? <strong>Login here</strong></span>
                    <i class="fas fa-chevron-down sgc-banner__arrow"></i>
                </div>
                <div class="sgc-banner__panel" id="login-panel">
                    <form action="{{ route('login') }}" method="POST" class="sgc-inline-form">
                        @csrf
                        <div class="sgc-field">
                            <label class="sgc-label">Username or email *</label>
                            <input type="text" class="sgc-input" name="email" required>
                        </div>
                        <div class="sgc-field">
                            <label class="sgc-label">Password *</label>
                            <input type="password" class="sgc-input" name="password" required>
                        </div>
                        <div class="sgc-inline-form__actions">
                            <button type="submit" class="sgc-btn sgc-btn--sm">Login</button>
                            <a href="#" class="sgc-link">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="sgc-banner" id="banner-coupon">
                <div class="sgc-banner__bar js-toggle-banner" data-target="coupon-panel">
                    <i class="fas fa-tag"></i>
                    <span>Have a coupon? <strong>Enter your code</strong></span>
                    <i class="fas fa-chevron-down sgc-banner__arrow"></i>
                </div>
                <div class="sgc-banner__panel" id="coupon-panel">
                    <form action="#" class="sgc-coupon-form">
                        <input type="text" class="sgc-input" name="coupon_code" placeholder="Coupon code" required>
                        <button type="submit" class="sgc-btn sgc-btn--sm">Apply</button>
                    </form>
                </div>
            </div>
        </div>

        @if($cartItems->isEmpty())
            <!-- ── Empty Cart ── -->
            <div class="sgc-empty">
                <div class="sgc-empty__icon">
                    <i class="d-icon-bag"></i>
                </div>
                <h2 class="sgc-empty__title">Your cart is empty</h2>
                <p class="sgc-empty__text">Add some products to your cart before checking out.</p>
                <a href="{{ route('shop') }}" class="sgc-btn">Go To Shop</a>
            </div>
        @else
            <form action="{{ route('codOrderStore') }}" method="POST" id="checkout-form">
                @csrf

                <!-- ── Order Review ── -->
                <div class="sgc-card sgc-card--table">
                    <div class="sgc-card__head">
                        <span class="sgc-card__tag">Review</span>
                        <h2 class="sgc-card__title">Your Order</h2>
                    </div>
                    <div class="sgc-table-wrap">
                        <table class="sgc-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th class="text-right">Subtotal</th>
                                    <th class="text-center">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="sgc-cart-tbody">
                                @foreach($cartItems as $item)
                                    @php 
                                        $price = $item->product->selling_price - $item->product->discount_price;
                                        $lineTotal = $price * $item->quantity;
                                    @endphp
                                    <tr class="sgc-cart-row" data-item-id="{{ $item->id }}" data-product-id="{{ $item->product->id }}" data-price="{{ $price }}">
                                        <td>
                                            <div class="sgc-product-cell">
                                                <div class="sgc-product-cell__img">
                                                    <img src="{{ route('imagecache', ['template'=>'ppsm','filename' => $item->product->fi()]) }}" 
                                                         width="56" height="56" alt="{{ $item->product->name_en }}">
                                                </div>
                                                <a href="{{ route('productDetails', $item->product->slug) }}" class="sgc-product-cell__name">
                                                    {{ $item->product->name_en }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="sgc-price">৳{{ number_format($price, 2) }}</td>
                                        <td>
                                            <div class="sgc-qty-ctrl">
                                                <button type="button" class="sgc-qty-btn sgc-qty-btn--minus" data-item-id="{{ $item->id }}" data-product-id="{{ $item->product->id }}">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span class="sgc-qty-val">{{ $item->quantity }}</span>
                                                <button type="button" class="sgc-qty-btn sgc-qty-btn--plus" data-item-id="{{ $item->id }}" data-product-id="{{ $item->product->id }}">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="sgc-price sgc-price--bold text-right sgc-line-total">৳{{ number_format($lineTotal, 2) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('cart.remove', $item->id) }}" class="sgc-remove-btn sgc-cart-remove" data-item-id="{{ $item->id }}" title="Remove item">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ── Two-column Layout ── -->
                <div class="sgc-grid">

                    <!-- LEFT: Billing Details -->
                    <div class="sgc-grid__main">
                        <div class="sgc-card">
                            <div class="sgc-card__head">
                                <span class="sgc-card__tag">Ship to</span>
                                <h2 class="sgc-card__title">Billing Details</h2>
                            </div>
                            <div class="sgc-card__body">
                                <div class="sgc-fields">
                                    <div class="sgc-field sgc-field--full">
                                        <label class="sgc-label">Full Name <span class="req">*</span></label>
                                        <input type="text" class="sgc-input" name="name"
                                            value="{{ $dl ? $dl->name : ($me ? $me->name : '') }}"
                                            placeholder="Enter your full name" required>
                                    </div>
                                    <div class="sgc-field">
                                        <label class="sgc-label">Phone Number <span class="req">*</span></label>
                                        <input type="tel" class="sgc-input" name="mobile"
                                            value="{{ $dl ? $dl->mobile : ($me ? $me->mobile : '') }}"
                                            placeholder="e.g. 01700000000" required>
                                    </div>
                                    <div class="sgc-field">
                                        <label class="sgc-label">Email Address</label>
                                        <input type="email" class="sgc-input" name="email"
                                            value="{{ $dl ? $dl->email : ($me ? $me->email : '') }}"
                                            placeholder="Enter your email">
                                    </div>
                                    <div class="sgc-field sgc-field--full">
                                        <label class="sgc-label">Shipping Address <span class="req">*</span></label>
                                        <textarea class="sgc-input sgc-textarea" name="billing_address" rows="3"
                                            placeholder="House / Road / Area" required>{{ $dl ? $dl->address_title : '' }}</textarea>
                                    </div>
                                    <div class="sgc-field sgc-field--full">
                                        <label class="sgc-label">Order Notes <span class="sgc-optional">(optional)</span></label>
                                        <textarea class="sgc-input sgc-textarea" name="order_note" rows="4"
                                            placeholder="e.g. Call before delivery"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Order Summary Sidebar -->
                    <aside class="sgc-grid__aside">
                        <div class="sgc-aside-inner">

                            <!-- Summary Numbers -->
                            <div class="sgc-summary">
                                <h3 class="sgc-summary__title">Order Summary</h3>
                                <div class="sgc-summary__rows">
                                    <div class="sgc-summary__row">
                                        <span>Subtotal</span>
                                        <strong id="sgc-subtotal-val">৳{{ number_format($subtotal, 2) }}</strong>
                                    </div>
                                    <div class="sgc-summary__row">
                                        <span>Shipping Fee</span>
                                        <strong id="sgc-shipping-val" data-raw="{{ $shippingCharge }}">৳{{ number_format($shippingCharge, 2) }}</strong>
                                    </div>
                                </div>
                                <div class="sgc-summary__total">
                                    <span>Total</span>
                                    <strong id="sgc-grand-val">৳{{ number_format($grandTotal, 2) }}</strong>
                                </div>
                            </div>

                            <!-- Payment Methods -->
                            <div class="sgc-payment">
                                <h4 class="sgc-payment__heading">Payment Method</h4>

                                <label class="sgc-payment__option" id="label-cod">
                                    <input type="radio" name="payment_method" value="cod" checked class="sgc-payment__radio">
                                    <span class="sgc-payment__icon"><i class="fas fa-money-bill-wave"></i></span>
                                    <span class="sgc-payment__meta">
                                        <strong>Cash on Delivery</strong>
                                        <small>Pay when you receive your order</small>
                                    </span>
                                    <span class="sgc-payment__check"><i class="fas fa-check"></i></span>
                                </label>
                                <div class="sgc-payment__detail" id="cash-on-delivery">
                                    <p>Pay securely with cash upon receiving your items at your doorstep.</p>
                                </div>

                                <label class="sgc-payment__option" id="label-online">
                                    <input type="radio" name="payment_method" value="online" class="sgc-payment__radio">
                                    <span class="sgc-payment__icon sgc-payment__icon--bkash">
                                        <i class="fas fa-mobile-alt"></i>
                                    </span>
                                    <span class="sgc-payment__meta">
                                        <strong>Online Payment</strong>
                                        <small>bKash mobile banking</small>
                                    </span>
                                    <span class="sgc-payment__check"><i class="fas fa-check"></i></span>
                                </label>
                                <div class="sgc-payment__detail" id="online-payment" style="display:none;">
                                    <p class="sgc-payment__merchant">
                                        <i class="fas fa-phone-alt"></i> Merchant bKash: <strong>01790552864</strong>
                                    </p>
                                    <p>Send money to the number above then enter your Transaction ID below.</p>
                                    <input type="text" class="sgc-input" name="transaction_id" placeholder="Transaction ID">
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="sgc-terms">
                                <label class="sgc-checkbox">
                                    <input type="checkbox" class="custom-checkbox" id="terms-condition" name="terms-condition" required>
                                    <span class="sgc-checkbox__box"></span>
                                    <span class="sgc-checkbox__text">
                                        I agree to the <a href="{{ route('terms') }}" class="sgc-link">Terms &amp; Conditions</a>
                                    </span>
                                </label>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="sgc-btn sgc-btn--submit">
                                Confirm Order
                                <i class="fas fa-arrow-right"></i>
                            </button>

                            <!-- Trust Badges -->
                            <div class="sgc-trust">
                                <div class="sgc-trust__item"><i class="fas fa-lock"></i><span>Secure</span></div>
                                <div class="sgc-trust__item"><i class="fas fa-shipping-fast"></i><span>Fast Delivery</span></div>
                                <div class="sgc-trust__item"><i class="fas fa-undo"></i><span>Easy Return</span></div>
                            </div>

                        </div>
                    </aside>

                </div><!-- /.sgc-grid -->
            </form>
        @endif

    </div><!-- /.container -->
</div><!-- /.sgc-page -->

@endsection

@push('js')
<script>
$(document).ready(function () {

    /* ── Banner Toggle ── */
    $('.js-toggle-banner').on('click', function () {
        var target = '#' + $(this).data('target');
        $(target).slideToggle(280);
        $(this).find('.sgc-banner__arrow').toggleClass('sgc-banner__arrow--open');
    });

    /* ── Payment Method Toggle ── */
    $('input[name="payment_method"]').on('change', function () {
        if ($(this).val() === 'cod') {
            $('#cash-on-delivery').slideDown(240);
            $('#online-payment').slideUp(240);
            $('#label-cod').addClass('sgc-payment__option--active');
            $('#label-online').removeClass('sgc-payment__option--active');
        } else {
            $('#cash-on-delivery').slideUp(240);
            $('#online-payment').slideDown(240);
            $('#label-online').addClass('sgc-payment__option--active');
            $('#label-cod').removeClass('sgc-payment__option--active');
        }
    });

    /* ── Initial active state ── */
    $('#label-cod').addClass('sgc-payment__option--active');

    /* ── Form Validation ── */
    $('#checkout-form').on('submit', function (e) {
        if ($('input[name="payment_method"]:checked').val() === 'online') {
            if (!$('input[name="transaction_id"]').val().trim()) {
                alert('Please enter your Transaction ID for bKash payment.');
                e.preventDefault();
            }
        }
    });

    /* ── Input focus float effect ── */
    $('.sgc-input').on('focus', function () {
        $(this).closest('.sgc-field').addClass('sgc-field--focused');
    }).on('blur', function () {
        $(this).closest('.sgc-field').removeClass('sgc-field--focused');
    });

    /* ════════════════════════════════════════
       CART — Quantity & Remove Controls
       Uses same AJAX routes as the header cart
       ════════════════════════════════════════ */

    /* Helper: recalculate totals from all rows */
    function recalcTotals() {
        var subtotal = 0;
        $('#sgc-cart-tbody .sgc-cart-row').each(function () {
            var price = parseFloat($(this).data('price'));
            var qty   = parseInt($(this).find('.sgc-qty-val').text());
            subtotal += price * qty;
        });
        var shipping = parseFloat($('#sgc-shipping-val').data('raw')) || 0;
        var grand    = subtotal + shipping;

        $('#sgc-subtotal-val').text('৳' + subtotal.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2}));
        $('#sgc-grand-val').text('৳' + grand.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2}));

        /* also sync header cart count/price */
        var totalQty = 0;
        $('#sgc-cart-tbody .sgc-cart-row').each(function () {
            totalQty += parseInt($(this).find('.sgc-qty-val').text());
        });
        $('.cart-count').text(totalQty);
        $('.cart-price').text('৳' + subtotal.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2}));
    }

    /* ── PLUS button ── */
    $(document).on('click', '.sgc-qty-btn--plus', function () {
        var $btn       = $(this);
        var productId  = $btn.data('product-id');
        var $row       = $btn.closest('.sgc-cart-row');
        var $qtySpan   = $row.find('.sgc-qty-val');
        var currentQty = parseInt($qtySpan.text());
        var newQty     = currentQty + 1;

        $btn.prop('disabled', true).addClass('sgc-qty-btn--loading');

        $.ajax({
            url: "{{ route('cart.quick.add') }}",
            type: 'GET',
            data: { id: productId, quantity: 1 },
            success: function (res) {
                $qtySpan.text(newQty);
                var price     = parseFloat($row.data('price'));
                var lineTotal = price * newQty;
                $row.find('.sgc-line-total').text('৳' + lineTotal.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2}));
                recalcTotals();
                /* sync header dropdown if available */
                if (res.cartDropdownHtml) {
                    $('.cart-dropdown .dropdown-box').html(res.cartDropdownHtml);
                }
            },
            error: function () {
                alert('Could not update quantity. Please try again.');
            },
            complete: function () {
                $btn.prop('disabled', false).removeClass('sgc-qty-btn--loading');
            }
        });
    });

    /* ── MINUS button ── */
    $(document).on('click', '.sgc-qty-btn--minus', function () {
        var $btn       = $(this);
        var $row       = $btn.closest('.sgc-cart-row');
        var itemId     = $btn.data('item-id');
        var $qtySpan   = $row.find('.sgc-qty-val');
        var currentQty = parseInt($qtySpan.text());

        if (currentQty <= 1) {
            /* qty would hit 0 — treat as remove */
            removeRow($btn, $row, itemId);
            return;
        }

        var newQty = currentQty - 1;
        $btn.prop('disabled', true).addClass('sgc-qty-btn--loading');

        /* Remove once then re-add at newQty to stay in sync with backend */
        $.ajax({
            url: "{{ route('cart.remove', '') }}/" + itemId,
            type: 'GET',
            success: function () {
                var productId = $btn.data('product-id');
                $.ajax({
                    url: "{{ route('cart.quick.add') }}",
                    type: 'GET',
                    data: { id: productId, quantity: newQty },
                    success: function (res) {
                        $qtySpan.text(newQty);
                        var price     = parseFloat($row.data('price'));
                        var lineTotal = price * newQty;
                        $row.find('.sgc-line-total').text('৳' + lineTotal.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2}));
                        recalcTotals();
                        if (res.cartDropdownHtml) {
                            $('.cart-dropdown .dropdown-box').html(res.cartDropdownHtml);
                        }
                    },
                    complete: function () {
                        $btn.prop('disabled', false).removeClass('sgc-qty-btn--loading');
                    }
                });
            },
            error: function () {
                alert('Could not update quantity. Please try again.');
                $btn.prop('disabled', false).removeClass('sgc-qty-btn--loading');
            }
        });
    });

    /* ── REMOVE button ── */
    $(document).on('click', '.sgc-cart-remove', function (e) {
        e.preventDefault();
        var $btn   = $(this);
        var $row   = $btn.closest('.sgc-cart-row');
        var itemId = $btn.data('item-id');
        removeRow($btn, $row, itemId);
    });

    function removeRow($btn, $row, itemId) {
        $btn.addClass('sgc-removing');
        $.ajax({
            url: "{{ route('cart.remove', '') }}/" + itemId,
            type: 'GET',
            success: function (res) {
                $row.addClass('sgc-row--removing');
                setTimeout(function () {
                    $row.remove();
                    recalcTotals();

                    /* if cart is now empty, show empty state */
                    if ($('#sgc-cart-tbody .sgc-cart-row').length === 0) {
                        location.reload();
                    }

                    if (res.cartDropdownHtml) {
                        $('.cart-dropdown .dropdown-box').html(res.cartDropdownHtml);
                    }
                    if (res.cartCount !== undefined) {
                        $('.cart-count').text(res.cartCount);
                    }
                }, 350);
            },
            error: function () {
                alert('Could not remove item. Please try again.');
                $btn.removeClass('sgc-removing');
            }
        });
    }

});
</script>
@endpush

@push('css')
<style>
/* ================================================================
   SGC — Sungoods Checkout  |  Luxury Refined Aesthetic
   ================================================================ */

@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --sgc-ink:       #1a1a1a;
    --sgc-ink-2:     #4a4a4a;
    --sgc-ink-3:     #8a8a8a;
    --sgc-primary:   #1E5891;
    --sgc-primary-dk:#174878;
    --sgc-primary-lt:#e8f0f9;
    --sgc-secondary: #DD391F;
    --sgc-secondary-lt:#fdecea;
    --sgc-cream:     #f4f7fb;
    --sgc-white:     #ffffff;
    --sgc-border:    #dde6f0;
    --sgc-shadow:    0 4px 24px rgba(30,88,145,0.08);
    --sgc-shadow-lg: 0 12px 48px rgba(30,88,145,0.14);
    --sgc-radius:    12px;
    --sgc-font-body: 'DM Sans', sans-serif;
    --sgc-font-disp: 'Cormorant Garamond', Georgia, serif;
    --sgc-transition: 0.25s ease;
}

/* ── Reset inside page ── */
.sgc-page * { box-sizing: border-box; }
.sgc-page { font-family: var(--sgc-font-body); color: var(--sgc-ink); background: var(--sgc-cream); }

/* ── Hero Strip ── */
.sgc-hero {
    background: linear-gradient(135deg, #174878 0%, var(--sgc-primary) 60%, #2a6faa 100%);
    padding: 52px 0 44px;
    position: relative;
    overflow: hidden;
}
.sgc-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 40px,
        rgba(255,255,255,0.025) 40px,
        rgba(255,255,255,0.025) 41px
    );
}
.sgc-hero__inner { position: relative; }
.sgc-hero__eyebrow {
    font-family: var(--sgc-font-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.75);
    margin: 0 0 8px;
}
.sgc-hero__title {
    font-family: var(--sgc-font-disp);
    font-size: 42px;
    font-weight: 700;
    color: var(--sgc-white);
    margin: 0 0 28px;
    line-height: 1.1;
}

/* Steps */
.sgc-steps {
    display: flex;
    align-items: center;
    gap: 0;
}
.sgc-step {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: rgba(255,255,255,0.35);
    transition: color var(--sgc-transition);
}
.sgc-step__num {
    font-family: var(--sgc-font-disp);
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
}
.sgc-step__label {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.sgc-step--done { color: rgba(255,255,255,0.55); }
.sgc-step--active { color: #fff; font-weight: 700; border-bottom: 2px solid rgba(255,255,255,0.6); padding-bottom: 2px; }
.sgc-step__line {
    flex: 0 0 48px;
    height: 1px;
    background: rgba(255,255,255,0.15);
    margin: 0 16px;
}

/* ── Body ── */
.sgc-body { padding-top: 40px; padding-bottom: 80px; }

/* ── Banners ── */
.sgc-banners {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 36px;
}
@media(max-width:767px){ .sgc-banners { grid-template-columns: 1fr; } }

.sgc-banner {
    background: var(--sgc-white);
    border: 1px solid var(--sgc-border);
    border-radius: var(--sgc-radius);
    overflow: hidden;
}
.sgc-banner__bar {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    cursor: pointer;
    font-size: 14px;
    color: var(--sgc-ink);
    user-select: none;
}
.sgc-banner__bar i:first-child { color: var(--sgc-primary); font-size: 16px; }
.sgc-banner__bar strong { color: var(--sgc-primary); }
.sgc-banner__arrow {
    margin-left: auto;
    font-size: 11px;
    color: var(--sgc-ink-3);
    transition: transform var(--sgc-transition);
}
.sgc-banner__arrow--open { transform: rotate(180deg); }
.sgc-banner__panel {
    display: none;
    padding: 20px 24px 24px;
    border-top: 1px solid var(--sgc-border);
    background: var(--sgc-cream);
}

/* ── Card ── */
.sgc-card {
    background: var(--sgc-white);
    border: 1px solid var(--sgc-border);
    border-radius: var(--sgc-radius);
    overflow: hidden;
    margin-bottom: 28px;
    box-shadow: var(--sgc-shadow);
}
.sgc-card__head {
    padding: 24px 28px 20px;
    border-bottom: 1px solid var(--sgc-border);
    background: var(--sgc-white);
}
.sgc-card__tag {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--sgc-primary);
    margin-bottom: 4px;
}
.sgc-card__title {
    font-family: var(--sgc-font-disp);
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    color: var(--sgc-ink);
}
.sgc-card__body { padding: 28px; }

/* ── Table ── */
.sgc-table-wrap { overflow-x: auto; }
.sgc-table {
    width: 100%;
    border-collapse: collapse;
}
.sgc-table thead th {
    padding: 14px 20px;
    text-align: left;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--sgc-ink-3);
    background: var(--sgc-cream);
    border-bottom: 1px solid var(--sgc-border);
}
.sgc-table thead th.text-right { text-align: right; }
.sgc-table tbody tr { border-bottom: 1px solid var(--sgc-border); transition: background var(--sgc-transition); }
.sgc-table tbody tr:last-child { border-bottom: none; }
.sgc-table tbody tr:hover { background: rgba(184,150,90,0.03); }
.sgc-table td { padding: 16px 20px; font-size: 14px; vertical-align: middle; }

.sgc-product-cell { display: flex; align-items: center; gap: 14px; }
.sgc-product-cell__img {
    width: 56px; height: 56px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid var(--sgc-border);
    flex-shrink: 0;
}
.sgc-product-cell__img img { width: 100%; height: 100%; object-fit: cover; }
.sgc-product-cell__name {
    font-size: 14px;
    font-weight: 500;
    color: var(--sgc-ink);
    text-decoration: none;
    line-height: 1.4;
}
.sgc-product-cell__name:hover { color: var(--sgc-primary); }

.sgc-price { font-size: 14px; color: var(--sgc-ink-2); }
.sgc-price--bold { font-weight: 700; color: var(--sgc-ink); }
.text-right { text-align: right; }

.sgc-qty {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px; height: 32px;
    border-radius: 50%;
    background: var(--sgc-primary-lt);
    color: var(--sgc-primary);
    font-size: 12px;
    font-weight: 700;
}

/* ── Two-column Grid ── */
.sgc-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 28px;
    align-items: start;
}
@media(max-width:1023px){ .sgc-grid { grid-template-columns: 1fr; } }

/* ── Aside sticky (pure CSS, no JS plugin) ── */
.sgc-grid__aside {
    /* sit sticky relative to the scroll container */
    position: sticky;
    top: 90px;
    /* must NOT use sticky-sidebar-wrapper JS here */
}
.sgc-aside-inner {
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* ── Fields ── */
.sgc-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.sgc-field--full { grid-column: 1 / -1; }

.sgc-field { position: relative; }
.sgc-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--sgc-ink-3);
    margin-bottom: 8px;
    transition: color var(--sgc-transition);
}
.sgc-field--focused .sgc-label { color: var(--sgc-primary); }
.req { color: var(--sgc-secondary); }
.sgc-optional { font-weight: 400; text-transform: none; letter-spacing: 0; }

.sgc-input {
    width: 100%;
    padding: 12px 16px;
    font-family: var(--sgc-font-body);
    font-size: 14px;
    color: var(--sgc-ink);
    background: var(--sgc-cream);
    border: 1.5px solid var(--sgc-border);
    border-radius: 8px;
    outline: none;
    transition: border-color var(--sgc-transition), box-shadow var(--sgc-transition), background var(--sgc-transition);
    appearance: none;
}
.sgc-input:focus {
    background: var(--sgc-white);
    border-color: var(--sgc-primary);
    box-shadow: 0 0 0 3px rgba(30,88,145,0.12);
}
.sgc-textarea { resize: vertical; min-height: 90px; }

/* ── Summary ── */
.sgc-summary {
    background: var(--sgc-white);
    border: 1px solid var(--sgc-border);
    border-radius: var(--sgc-radius);
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: var(--sgc-shadow);
}
.sgc-summary__title {
    font-family: var(--sgc-font-disp);
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 20px;
    color: var(--sgc-ink);
    padding-bottom: 16px;
    border-bottom: 1px solid var(--sgc-border);
}
.sgc-summary__rows { margin-bottom: 16px; }
.sgc-summary__row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    font-size: 14px;
    border-bottom: 1px dashed var(--sgc-border);
    color: var(--sgc-ink-2);
}
.sgc-summary__row strong { color: var(--sgc-ink); font-weight: 600; }
.sgc-summary__total {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding-top: 16px;
}
.sgc-summary__total span {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--sgc-ink-3);
}
.sgc-summary__total strong {
    font-family: var(--sgc-font-disp);
    font-size: 32px;
    font-weight: 700;
    color: var(--sgc-secondary);
}

/* ── Payment ── */
.sgc-payment {
    background: var(--sgc-white);
    border: 1px solid var(--sgc-border);
    border-radius: var(--sgc-radius);
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: var(--sgc-shadow);
}
.sgc-payment__heading {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--sgc-ink-3);
    margin: 0 0 16px;
}
.sgc-payment__option {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 16px;
    border: 1.5px solid var(--sgc-border);
    border-radius: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: border-color var(--sgc-transition), background var(--sgc-transition), box-shadow var(--sgc-transition);
    position: relative;
}
.sgc-payment__option--active {
    border-color: var(--sgc-primary);
    background: var(--sgc-primary-lt);
    box-shadow: 0 2px 12px rgba(30,88,145,0.10);
}
.sgc-payment__radio { display: none; }
.sgc-payment__icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    background: var(--sgc-cream);
    border: 1px solid var(--sgc-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
    color: var(--sgc-ink-3);
    flex-shrink: 0;
    transition: background var(--sgc-transition), color var(--sgc-transition);
}
.sgc-payment__option--active .sgc-payment__icon { background: var(--sgc-primary); color: #fff; border-color: var(--sgc-primary); }
.sgc-payment__icon--bkash { }
.sgc-payment__meta { flex: 1; }
.sgc-payment__meta strong { display: block; font-size: 14px; font-weight: 600; color: var(--sgc-ink); }
.sgc-payment__meta small { font-size: 12px; color: var(--sgc-ink-3); }
.sgc-payment__check {
    width: 22px; height: 22px;
    border-radius: 50%;
    border: 2px solid var(--sgc-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px;
    color: transparent;
    transition: all var(--sgc-transition);
}
.sgc-payment__option--active .sgc-payment__check {
    background: var(--sgc-primary);
    border-color: var(--sgc-primary);
    color: #fff;
}
.sgc-payment__detail {
    background: var(--sgc-cream);
    border: 1px solid var(--sgc-border);
    border-radius: 8px;
    padding: 14px 16px;
    margin-bottom: 10px;
    font-size: 13px;
    color: var(--sgc-ink-2);
    line-height: 1.6;
}
.sgc-payment__detail p { margin: 0 0 8px; }
.sgc-payment__detail p:last-child { margin-bottom: 0; }
.sgc-payment__merchant {
    font-size: 13px;
    font-weight: 600;
    color: var(--sgc-ink);
}
.sgc-payment__merchant i { color: var(--sgc-primary); margin-right: 4px; }

/* ── Terms ── */
.sgc-terms {
    padding: 0 0 20px;
}
.sgc-checkbox {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    cursor: pointer;
}
.sgc-checkbox input { display: none; }
.sgc-checkbox__box {
    width: 20px; height: 20px; flex-shrink: 0;
    border: 2px solid var(--sgc-border);
    border-radius: 5px;
    background: var(--sgc-white);
    display: flex; align-items: center; justify-content: center;
    transition: all var(--sgc-transition);
    position: relative;
    top: 1px;
}
.sgc-checkbox input:checked ~ .sgc-checkbox__box {
    background: var(--sgc-primary);
    border-color: var(--sgc-primary);
}
.sgc-checkbox input:checked ~ .sgc-checkbox__box::after {
    content: '';
    display: block;
    width: 5px; height: 9px;
    border: 2px solid #fff;
    border-top: 0; border-left: 0;
    transform: rotate(45deg);
    margin-top: -2px;
}
.sgc-checkbox__text { font-size: 13px; color: var(--sgc-ink-2); line-height: 1.5; }

/* ── Buttons ── */
.sgc-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 28px;
    font-family: var(--sgc-font-body);
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    color: var(--sgc-white);
    background: var(--sgc-primary);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background var(--sgc-transition), transform var(--sgc-transition), box-shadow var(--sgc-transition);
}
.sgc-btn:hover { background: var(--sgc-primary-dk); color: #fff; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(30,88,145,0.25); }
.sgc-btn--sm { padding: 9px 20px; font-size: 12px; }
.sgc-btn--submit {
    width: 100%;
    justify-content: center;
    background: var(--sgc-secondary);
    font-size: 14px;
    padding: 16px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(221,57,31,0.25);
    margin-bottom: 20px;
}
.sgc-btn--submit:hover { background: #bf2f16; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(221,57,31,0.35); }

/* ── Trust Badges ── */
.sgc-trust {
    display: flex;
    gap: 0;
    border: 1px solid var(--sgc-border);
    border-radius: 10px;
    overflow: hidden;
    background: var(--sgc-white);
}
.sgc-trust__item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 12px 8px;
    font-size: 11px;
    color: var(--sgc-ink-3);
    text-align: center;
    border-right: 1px solid var(--sgc-border);
}
.sgc-trust__item:last-child { border-right: none; }
.sgc-trust__item i { font-size: 16px; color: var(--sgc-primary); }
.sgc-trust__item span { font-weight: 600; letter-spacing: 0.3px; }

/* ── Empty ── */
.sgc-empty {
    text-align: center;
    background: var(--sgc-white);
    border: 1px solid var(--sgc-border);
    border-radius: var(--sgc-radius);
    padding: 80px 40px;
    box-shadow: var(--sgc-shadow);
}
.sgc-empty__icon { font-size: 64px; color: var(--sgc-border); margin-bottom: 20px; }
.sgc-empty__title {
    font-family: var(--sgc-font-disp);
    font-size: 30px; font-weight: 700;
    margin-bottom: 12px;
}
.sgc-empty__text { color: var(--sgc-ink-2); margin-bottom: 32px; }

/* ── Inline Forms ── */
.sgc-inline-form { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.sgc-inline-form__actions { grid-column: 1/-1; display: flex; align-items: center; gap: 20px; }
.sgc-coupon-form { display: flex; gap: 12px; align-items: flex-end; }
.sgc-coupon-form .sgc-input { margin: 0; }
.sgc-link { color: var(--sgc-primary); text-decoration: none; font-weight: 600; }
.sgc-link:hover { text-decoration: underline; }

/* ── Qty Controls ── */
.sgc-qty-ctrl {
    display: inline-flex;
    align-items: center;
    gap: 0;
    border: 1.5px solid var(--sgc-border);
    border-radius: 8px;
    overflow: hidden;
    background: var(--sgc-white);
}
.sgc-qty-btn {
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--sgc-ink-3);
    font-size: 11px;
    transition: background var(--sgc-transition), color var(--sgc-transition);
    flex-shrink: 0;
}
.sgc-qty-btn:hover {
    background: var(--sgc-primary-lt);
    color: var(--sgc-primary);
}
.sgc-qty-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}
.sgc-qty-btn--loading {
    opacity: 0.5;
    pointer-events: none;
}
.sgc-qty-val {
    min-width: 36px;
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    color: var(--sgc-ink);
    padding: 0 4px;
    border-left: 1.5px solid var(--sgc-border);
    border-right: 1.5px solid var(--sgc-border);
    line-height: 32px;
    display: inline-block;
}

/* ── Remove Button ── */
.sgc-remove-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: 1.5px solid #fdd;
    background: var(--sgc-secondary-lt);
    color: var(--sgc-secondary);
    font-size: 13px;
    text-decoration: none;
    transition: background var(--sgc-transition), border-color var(--sgc-transition), transform var(--sgc-transition);
}
.sgc-remove-btn:hover {
    background: var(--sgc-secondary);
    border-color: var(--sgc-secondary);
    color: #fff;
    transform: scale(1.08);
}
.sgc-remove-btn.sgc-removing {
    opacity: 0.4;
    pointer-events: none;
}

/* ── Row remove animation ── */
.sgc-cart-row {
    transition: opacity 0.35s ease, transform 0.35s ease;
}
.sgc-cart-row.sgc-row--removing {
    opacity: 0;
    transform: translateX(20px);
}

/* ── Mobile ── */
@media(max-width:575px){
    .sgc-hero__title { font-size: 30px; }
    .sgc-steps { flex-wrap: wrap; gap: 8px; }
    .sgc-step__line { display: none; }
    .sgc-fields { grid-template-columns: 1fr; }
    .sgc-inline-form { grid-template-columns: 1fr; }
}
</style>
@endpush