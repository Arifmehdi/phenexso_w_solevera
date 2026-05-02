@extends('website.layouts.solevera')

@section('content')
			<!-- ============================ Hero Banner  Start================================== -->
			<div class="home-slider margin-bottom-0">
                @foreach($sliders as $slider)
				<!-- Slide -->
				<div data-background-image="{{ route('imagecache', ['template'=>'original','filename' => $slider->fi()]) }}" class="item">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="home-slider-container">

									<!-- Slide Title -->
									<div class="home-slider-desc">
										<div class="home-slider-title mb-4">
											<h5 class="theme-cl fs-sm ft-ragular mb-0">Collection</h5>
											<h1 class="mb-1 ft-bold lg-heading">{!! $slider->title !!}</h1>
											<span class="trending">{{ $slider->description }}</span>
										</div>

										@if($slider->link)
										<a href="{{ $slider->link }}" class="btn stretched-links borders">Shop Now<i class="lni lni-arrow-right ms-2"></i></a>
										@endif
									</div>
									<!-- Slide Title / End -->

								</div>
							</div>
						</div>
					</div>
				</div>
                @endforeach

			</div>
			<!-- ============================ Hero Banner End ================================== -->
			
			<!-- ========================= Category Style ========================== -->
			<section class="middle">
				<div class="container">
					<div class="row g-3">
						@foreach($categories as $index => $category)
						<div class="col-xl-4 col-lg-4 col-md-6 col-6">
							<div class="single_cats">
								<a href="{{ route('productCategory', $category->slug) }}" class="cards card-overflow card-scale {{ $index % 3 == 0 ? 'lg_height' : 'md_height' }}">
									<div class="bg-image" style="background:url({{ route('imagecache', ['template'=>'original','filename' => $category->fi()]) }})no-repeat;"></div>
									<div class="ct_body">
										<div class="ct_body_caption left">
											<h2 class="m-0 ft-bold lh-1 fs-md text-upper">{{ $category->name_en }}</h2>
											<span>{{ $category->products->count() }} Items</span>
										</div>
										<div class="ct_footer left">
											<span class="stretched-link fs-md">Browse Items <i class="ti-arrow-circle-right"></i></span>
										</div>
									</div>
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</section>
			<!-- ============================ Category Style =============================== -->
			
			<!-- ======================= Products Lists ======================== -->
			<section class="space min pt-0">
				<div class="container">
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							
							<ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="all-tab" href="#all" data-bs-toggle="tab" role="tab" aria-controls="all" aria-selected="true">All</a>
								</li>
								@foreach($categories as $category)
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#cat-{{ $category->id }}" id="cat-{{ $category->id }}-tab" data-bs-toggle="tab" role="tab" aria-controls="cat-{{ $category->id }}" aria-selected="false">{{ $category->name_en }}</a>
								</li>
								@endforeach
								</ul>
							
							<div class="tab-content" id="myTabContent">
								
								<!-- All Content -->
									<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
										<div class="tab_product">
											<div class="row rows-products">
												@foreach($feature_products as $product)
												<!-- Single -->
												<div class="col-xl-3 col-lg-4 col-md-6 col-6">
													<div class="product_grid card b-0">
														@if($product->discount_price > 0)
														<div class="badge bg-sale text-white position-absolute ft-regular ab-left text-upper">Sale</div>
														@endif
														<div class="card-body p-0">
															<div class="shop_thumb position-relative">
																<a class="card-img-top d-block overflow-hidden" href="{{ route('productDetails', $product->slug) }}"><img class="card-img-top" src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="..."></a>
																<div class="product-hover-overlay d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.85);">
																	<div class="edlio"><a href="javascript:void(0);" data-id="{{ $product->id }}" class="text-white fs-sm ft-medium me-2 quick-view-btn"><i class="fas fa-eye me-1"></i>Quick View</a></div>
																	<div class="edlio"><a href="javascript:void(0);" data-id="{{ $product->id }}" class="text-white fs-sm ft-medium add-to-cart-btn"><i class="fas fa-shopping-basket me-1"></i>Add to Cart</a></div>
																</div>
															</div>
														</div>
														<div class="card-footer b-0 p-0 pt-2 bg-white">
															<div class="d-flex align-items-start justify-content-between">
																<div class="text-left">
																	<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star"></i>
																		<span class="small">({{ $product->reviews->count() }} Reviews)</span>
																	</div>
																	<h5 class="fw-normal fs-md mb-0 lh-1 mb-1"><a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a></h5>
																	<div class="elis_rty">
																		<span class="ft-medium text-dark fs-sm">৳{{ $product->selling_price }}</span>
																	</div>
																</div>
																<div class="text-right">
																	<button class="btn auto btn_love add-to-wishlist" data-id="{{ $product->id }}"><i class="far fa-heart"></i></button>
																</div>
															</div>
														</div>
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>
@foreach($categories as $category)
									<div class="tab-pane fade" id="cat-{{$category->id}}" role="tabpanel" aria-labelledby="cat-{{$category->id}}-tab">
										<div class="tab_product">
											<div class="row rows-products">
												@foreach($category->products as $product)
												<!-- Single -->
												<div class="col-xl-3 col-lg-4 col-md-6 col-6">
													<div class="product_grid card b-0">
														@if($product->discount_price > 0)
														<div class="badge bg-sale text-white position-absolute ft-regular ab-left text-upper">Sale</div>
														@endif
														<div class="card-body p-0">
															<div class="shop_thumb position-relative">
																<a class="card-img-top d-block overflow-hidden" href="{{ route('productDetails', $product->slug) }}"><img class="card-img-top" src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="..."></a>
																<div class="product-hover-overlay d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.85);">
																	<div class="edlio"><a href="javascript:void(0);" data-id="{{ $product->id }}" class="text-white fs-sm ft-medium me-2 quick-view-btn"><i class="fas fa-eye me-1"></i>Quick View</a></div>
																	<div class="edlio"><a href="javascript:void(0);" data-id="{{$product->id}}" class="text-white fs-sm ft-medium add-to-cart-btn"><i class="fas fa-shopping-basket me-1"></i>Add to Cart</a></div>
																</div>
															</div>
														</div>
														<div class="card-footer b-0 p-0 pt-2 bg-white">
															<div class="d-flex align-items-start justify-content-between">
																<div class="text-left">
																	<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star"></i>
																		<span class="small">({{ $product->reviews->count() }} Reviews)</span>
																	</div>
																	<h5 class="fw-normal fs-md mb-0 lh-1 mb-1"><a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a></h5>
																	<div class="elis_rty">
																		<span class="ft-medium text-dark fs-sm">৳{{ $product->selling_price }}</span>
																	</div>
																</div>
																<div class="text-right">
																	<button class="btn auto btn_love add-to-wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></button>
																</div>
															</div>
														</div>
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>
									@endforeach
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Blog Start ============================ -->
			
			<!-- ======================= Brand Start ============================ -->
			<section class="py-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center mb-5">
								<h2 class="off_title">Our Brands</h2>
								<h3 class="ft-bold lh-1">Trusted Brands</h3>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="smart-brand">
								@foreach($brands as $brand)
								<div class="single-brand">
									<div class="brand_thumb">
										<img src="{{ route('imagecache', ['template' => 'original', 'filename' => $brand->fi()]) }}" class="img-fluid" alt="{{ $brand->title }}" />
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Brand End ============================ -->

<style>
/* Test: Force product-hover-overlay to show on hover */
.product_grid:hover .product-hover-overlay {
    visibility: visible !important;
    opacity: 1 !important;
    transform: translateY(0) !important;
    display: flex !important;
}
</style>
@endsection

