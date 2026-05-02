						<div class="cart_select_items py-2">
							@foreach($cartItems as $item)
                            @if($item->product)
							<!-- Single Item -->
							<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="cart_selected_single_thumb">
										<a href="{{ route('productDetails', $item->product->slug) }}"><img src="{{ route('imagecache', ['template' => 'original', 'filename' => $item->product->fi()]) }}" width="60" class="img-fluid" alt="" /></a>
									</div>
									<div class="cart_single_caption ps-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{ $item->product->name_en }}</h4>
										<p class="mb-2"><span class="text-dark ft-medium small">{{ $item->quantity }} x </span> 
                                            @php
                                                $product = $item->product;
                                                if ($product->discount_price > 0) {
                                                    $price = $product->discount_price;
                                                } else {
                                                    $price = $product->price;
                                                }
                                            @endphp
                                            <span class="text-dark small">৳{{ number_format($price, 2) }}</span>
                                        </p>
										<h4 class="fs-md ft-medium mb-0 lh-1">৳{{ number_format($price * $item->quantity, 2) }}</h4>
									</div>
								</div>
								<div class="fls_last"><a href="javascript:void(0);" data-id="{{ $item->id }}" class="close_slide gray cart-remove-btn"><i class="ti-close"></i></a></div>
							</div>
                            @endif
							@endforeach
						</div>
						
						<div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
							<h6 class="mb-0">Subtotal</h6>
							<h3 class="mb-0 ft-medium">৳{{ number_format($cartItems->sum(function($item) {
                                if (!$item->product) return 0;
                                $product = $item->product;
                                $price = ($product->discount_price > 0) ? $product->discount_price : $product->price;
                                return $price * $item->quantity;
                            }), 2) }}</h3>
						</div>
						
						<div class="cart_action px-3 py-3">
							<div class="form-group mb-3">
								<a href="{{ route('new.checkout') }}" class="btn d-block full-width btn-dark">Checkout Now</a>
							</div>
							<div class="form-group">
								<a href="{{ route('new.checkout') }}" class="btn d-block full-width btn-dark-light">Edit or View</a>
							</div>
						</div>
