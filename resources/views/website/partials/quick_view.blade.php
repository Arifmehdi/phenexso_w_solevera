<div class="quick_view_wrap">

    <div class="quick_view_thmb">
        <div class="quick_view_slide">
            <div class="single_view_slide"><img src="{{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}" class="img-fluid" alt="{{ $product->name_en }}" /></div>
            @foreach($product->media as $m)
            <div class="single_view_slide"><img src="{{ route('imagecache', ['template' => 'original', 'filename' => $m->file_name]) }}" class="img-fluid" alt="{{ $product->name_en }}" /></div>
            @endforeach
        </div>
    </div>
    
    <div class="quick_view_capt">
        <div class="prd_details">
            
            <div class="prt_01 mb-1">
                @foreach($product->categories as $category)
                <span class="text-light bg-info rounded px-2 py-1">{{ $category->name_en }}</span>
                @endforeach
            </div>
            <div class="prt_02 mb-2">
                <h2 class="ft-bold mb-1">{{ $product->name_en }}</h2>
                <div class="text-left">
                    <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                        @php $rating = $product->averageRating(); @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $rating)
                                <i class="fas fa-star filled"></i>
                            @else
                                <i class="fas fa-star"></i>
                            @endif
                        @endfor
                        <span class="small">({{ $product->reviews->count() }} Reviews)</span>
                    </div>
                    <div class="elis_rty">
                        @if($product->discount_price > 0)
                            <span class="ft-medium text-muted line-through fs-md me-2">৳{{ $product->selling_price }}</span>
                            <span class="ft-bold theme-cl fs-lg me-2">৳{{ $product->selling_price - $product->discount_price }}</span>
                        @else
                            <span class="ft-bold theme-cl fs-lg me-2">৳{{ $product->selling_price }}</span>
                        @endif

                        @if($product->stock > 0)
                            <span class="ft-regular text-success bg-light-success py-1 px-2 fs-sm">In Stock</span>
                        @else
                            <span class="ft-regular text-danger bg-light-danger py-1 px-2 fs-sm">Out of Stock</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="prt_03 mb-3">
                <p>{{ Str::limit(strip_tags($product->description_en), 200) }}</p>
            </div>
            
            <div class="prt_05 mb-4">
                <div class="form-row row g-3 mb-7">
                    <div class="col-12 col-md-6 col-lg-3">
                        <!-- Quantity -->
                        <select class="mb-2 custom-select" id="qv-quantity">
                          <option value="1" selected="">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <!-- Submit -->
                        <button type="button" data-id="{{ $product->id }}" class="btn btn-block custom-height bg-dark mb-2 w-100 add-to-cart-btn-modal">
                            <i class="lni lni-shopping-basket me-2"></i>Add to Cart 
                        </button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <!-- Wishlist -->
                        <button class="btn custom-height btn-default btn-block mb-2 text-dark add-to-wishlist" data-id="{{ $product->id }}">
                            <i class="lni lni-heart me-2"></i>Wishlist
                        </button>
                    </div>
              </div>
            </div>
            
            <div class="prt_06">
                <p class="mb-0 d-flex align-items-center">
                  <span class="me-4">Share:</span>
                  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted me-2" href="https://twitter.com/intent/tweet?url={{ route('productDetails', $product->slug) }}&text={{ $product->name_en }}" target="_blank">
                    <i class="fab fa-twitter position-absolute"></i>
                  </a>
                  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted me-2" href="https://www.facebook.com/sharer/sharer.php?u={{ route('productDetails', $product->slug) }}" target="_blank">
                    <i class="fab fa-facebook-f position-absolute"></i>
                  </a>
                  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted" href="https://pinterest.com/pin/create/button/?url={{ route('productDetails', $product->slug) }}&media={{ route('imagecache', ['template' => 'original', 'filename' => $product->fi()]) }}&description={{ $product->name_en }}" target="_blank">
                    <i class="fab fa-pinterest-p position-absolute"></i>
                  </a>
                </p>
            </div>
            
        </div>
    </div>
</div>
