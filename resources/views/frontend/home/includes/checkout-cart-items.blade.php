<header class="py-2 px-3" style="background: #699403">
    <h2 class="text-white h5 d-flex align-items-center gap-2 mb-0">
        <i class="fa fa-shopping-cart"></i> Cart Items
        <span class="badge bg-white text-success ms-2">{{ $cartItems->count() }}</span>
    </h2>
</header>

<div class="p-3 overflow-auto cart-action-wrapper">
    @if($cartItems->isEmpty())
        <p class="text-center text-muted py-5 fs-5">Your cart is empty 🛒</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-sm mb-0">
                <thead class="table-success text-success fw-semibold">
                    <tr>
                        <th class="text-center w-5"></th>
                        <th class="w-15">Thumbnail</th>
                        <th>Product</th>
                        <th class="w-25">Price</th>
                        <th class="w-25">Quantity</th>
                        <th class="text-end w-25">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cart)
                        <tr class="cart-item" data-cart="{{ $cart->id }}">
                            <td class="text-center align-middle">
                                <button title="Remove Product"
                                        class="btn btn-sm deleteCartItem"
                                        data-url="{{ route('cartRemoveItem', $cart->id) }}"><i class="fas fa-trash-alt text-danger"></i></button>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('productDetails', ['slug' => $cart->product->slug, 'id' => $cart->product_id]) }}">
                                    <img src="{{ route('imagecache', ['template'=>'ppsm','filename' => $cart->product->fi()]) }}"
                                         class="img-thumbnail" style="width:40px; height:40px; object-fit:cover;" loading="lazy">
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('productDetails', ['slug' => $cart->product->slug, 'id' => $cart->product_id]) }}"
                                   class="text-success text-decoration-none fw-medium">
                                    {{ Str::limit($cart->product->name_en, 25, '...') }}
                                </a>
                            </td>
                            <td class="align-middle text-success fw-semibold">
                                @if($cart->product->discount > 0)
                                    <div class="text-muted text-decoration-line-through small">
                                        Tk. {{ number_format($cart->product->price, 2) }}
                                    </div>
                                @endif
                                Tk. {{ number_format($cart->product->selling_price, 2) }}
                            </td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center gap-2 cart-action-wrapper">
                                    <button class="btn btn-sm btn-outline-secondary minus updateCartItem"
                                            data-url="{{ route('cartUpdateQty') }}"
                                            data-cart="{{ $cart->id }}"
                                            data-qty="{{ $cart->quantity }}">−</button>
                                    <span class="cartQtyDisplay border text-center rounded px-3 py-1 mx-2">
                                        {{ $cart->quantity }}
                                    </span>
                                    <button class="btn btn-sm btn-outline-secondary plus updateCartItem"
                                            data-url="{{ route('cartUpdateQty') }}"
                                            data-cart="{{ $cart->id }}"
                                            data-qty="{{ $cart->quantity }}">+</button>
                                </div>
                            </td>
                            <td class="text-end align-middle fw-semibold text-primary itemTotalPrice"
                                data-unit-price="{{ $cart->product->final_price }}">
                                Tk. {{ number_format($cart->quantity * $cart->product->final_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@php
    $totalCartPrice = \App\Models\Cart::totalCartPrice();
    $totalDiscountAmount = \App\Models\Cart::totalDiscountAmount();
    // Get shipping charge from provider (WebsiteParameter)
    $shippingCharge = isset($ws) && isset($ws->shipping_charge) ? $ws->shipping_charge : 0;
    // Calculate initial total (subtotal - discount + shipping)
    $initialTotal = $totalCartPrice - $totalDiscountAmount + $shippingCharge;
@endphp

@if(!$cartItems->isEmpty())
<div class="p-3 border-top  bg-opacity-10 rounded">
    <div class="text-center  text-white rounded py-1 fw-semibold mb-3 small" style="background: #699403">
        You are saving Tk. {{ number_format($totalDiscountAmount, 2) }} in this order.
    </div>

    <div class="d-flex justify-content-between fw-semibold text-success mb-1">
        <span>Subtotal</span>
        <span class="subtotal" data-value="{{ $totalCartPrice }}">Tk. {{ number_format($totalCartPrice, 2) }}</span>
    </div>

    <div class="d-flex justify-content-between fw-semibold text-danger mb-2">
        <span>Discount applied</span>
        <span class="discount" data-value="{{ $totalDiscountAmount }}">-Tk. {{ number_format($totalDiscountAmount, 2) }}</span>
    </div>

    <div class="d-flex justify-content-between fw-semibold text-success mb-1">
        <span>Shipping</span>
        <div>
            <span class="shipping" id="shipping-price" data-value="{{ $shippingCharge }}">Tk. {{ number_format($shippingCharge, 2) }}</span>
        </div>
    </div>

    <div class="d-flex justify-content-between fw-semibold text-danger mb-1" id="shipping-discount-container" style="display: none;">
        <span>Shipping Discount</span>
        <span id="shipping-discount">-Tk. 0.00</span>
    </div>
    
    <div id="address-selection-form" style="display: none;">
        <div class="col-md-6 mt-3">
            <div class="mb-3">
                <label for="district" class="form-label">District</label>
                <select class="form-select" id="district">
                    <option selected disabled>Select a district</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="thana" class="form-label">Thana/Upazila</label>
                <select class="form-select" id="thana">
                    <option selected disabled>Select a thana</option>
                </select>
            </div>
        </div>
        <div class="col-12 mt-3">
            <p id="selected-address" class="text-muted small">Please select thana to confirm delivery location.</p>
        </div>
    </div>

    <hr class="border-success">

    <div class="d-flex justify-content-between fw-bold fs-5 text-success mt-2">
        <span>Total Amount</span>
        <span class="payable">
            Tk. {{ number_format($initialTotal, 2) }}
        </span>
    </div>
</div>
@endif

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const thanaSelect = document.getElementById('thana');
        const selectedAddress = document.getElementById('selected-address');

        // Initialize shipping charge from data attribute (set by PHP)
        const shippingPriceElement = document.getElementById('shipping-price');
        const subtotalElement = document.querySelector('.subtotal');
        const discountElement = document.querySelector('.discount');
        const payableElement = document.querySelector('.payable');

        // Function to update totals correctly (shipping is now fixed from provider)
        function updateTotals() {
            const subtotal = parseFloat(subtotalElement.getAttribute('data-value'));
            const discount = parseFloat(discountElement.getAttribute('data-value'));
            const shippingCost = parseFloat(shippingPriceElement.getAttribute('data-value'));
            const grandTotal = subtotal - discount + shippingCost;

            payableElement.textContent = `Tk. ${grandTotal.toFixed(2)}`;
        }

        // Thana select event listener (only for address, not shipping cost)
        if (thanaSelect) {
            thanaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    selectedAddress.textContent = `Delivery location set to ${selectedOption.text}.`;
                } else {
                    selectedAddress.textContent = 'Please select a thana to confirm delivery location.';
                }
            });
        }

        // Initialize totals on page load
        updateTotals();
    });
</script>
@endpush