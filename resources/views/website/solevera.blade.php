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
					<div class="row g-0">
						@if(isset($categories[0]))
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class="single_cats">
								<a href="{{ route('productCategory', $categories[0]->slug) }}" class="cards card-overflow card-scale lg_height">
									<div class="bg-image" style="background:url({{ route('imagecache', ['template'=>'original','filename' => $categories[0]->fi()]) }})no-repeat;"></div>
									<div class="ct_body">
										<div class="ct_body_caption left">	
											<h2 class="m-0 ft-bold lh-1 fs-md text-upper">{{ $categories[0]->name_en }}</h2>
											<span>{{ $categories[0]->products->count() }} Items</span>
										</div>
										<div class="ct_footer left">
											<span class="stretched-link fs-md">Browse Items <i class="ti-arrow-circle-right"></i></span>
										</div>
									</div>
								</a>
							</div>
							@if(isset($categories[1]))
							<div class="single_cats">
								<a href="{{ route('productCategory', $categories[1]->slug) }}" class="cards card-overflow card-scale md_height">
									<div class="bg-image" style="background:url({{ route('imagecache', ['template'=>'original','filename' => $categories[1]->fi()]) }})no-repeat;"></div>
									<div class="ct_body">
										<div class="ct_body_caption left">	
											<h2 class="m-0 ft-bold lh-1 fs-md text-upper">{{ $categories[1]->name_en }}</h2>
											<span>{{ $categories[1]->products->count() }} Items</span>
										</div>
										<div class="ct_footer left">
											<span class="stretched-link fs-md">Browse Items <i class="ti-arrow-circle-right"></i></span>
										</div>
									</div>
								</a>
							</div>
							@endif
						</div>
						@endif
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<!-- row -->
							<div class="row no-gutters">
								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									@if(isset($categories[2]))
									<div class="single_cats">
										<a href="{{ route('productCategory', $categories[2]->slug) }}" class="cards card-overflow card-scale md_height">
											<div class="bg-image" style="background:url({{ route('imagecache', ['template'=>'original','filename' => $categories[2]->fi()]) }})no-repeat;"></div>
											<div class="ct_body">
												<div class="ct_body_caption left">	
													<h2 class="m-0 ft-bold lh-1 fs-md text-upper">{{ $categories[2]->name_en }}</h2>
													<span>{{ $categories[2]->products->count() }} Items</span>
												</div>
												<div class="ct_footer left">
													<span class="stretched-link fs-md">Browse Items <i class="ti-arrow-circle-right"></i></span>
												</div>
											</div>
										</a>
									</div>
									@endif
									@if(isset($categories[3]))
									<div class="single_cats">
										<a href="{{ route('productCategory', $categories[3]->slug) }}" class="cards card-overflow card-scale lg_height">
											<div class="bg-image" style="background:url({{ route('imagecache', ['template'=>'original','filename' => $categories[3]->fi()]) }})no-repeat;"></div>
											<div class="ct_body">
												<div class="ct_body_caption left">	
													<h2 class="m-0 ft-bold lh-1 fs-md text-upper">{{ $categories[3]->name_en }}</h2>
													<span>{{ $categories[3]->products->count() }} Items</span>
												</div>
												<div class="ct_footer left">
													<span class="stretched-link fs-md">Browse Items <i class="ti-arrow-circle-right"></i></span>
												</div>
											</div>
										</a>
									</div>
									@endif
								</div>
								
							</div>
							<!-- /row -->
							
						</div>
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
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#mens" id="mens-tab" data-bs-toggle="tab" role="tab" aria-controls="mens" aria-selected="false">Men's</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#women" id="women-tab" data-bs-toggle="tab" role="tab" aria-controls="women" aria-selected="false">Women</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#kids" id="kids-tab" data-bs-toggle="tab" role="tab" aria-controls="kids" aria-selected="false">Kids</a>
								</li>
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
															<div class="product-hover-overlay d-flex align-items-center justify-content-between">
																<div class="edlio"><a href="javascript:void(0);" data-id="{{ $product->id }}" class="text-underline fs-sm ft-bold add-to-cart-btn">Add To Cart</a></div>
																<div class="edlio d-flex align-items-center">
																	<button class="btn auto btn_love me-2 add-to-wishlist" data-id="{{ $product->id }}"><i class="far fa-heart"></i></button>
																	<a href="#" class="text-underline" data-bs-toggle="modal" data-bs-target="#quickview"><i class="fas fa-expand-arrows-alt"></i></a>
																</div>
															</div>
														</div>
													</div>
													<div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
														<div class="text-left">
															<div class="text-left">
																<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
																	<i class="fas fa-star filled"></i>
																	<i class="fas fa-star filled"></i>
																	<i class="fas fa-star filled"></i>
																	<i class="fas fa-star filled"></i>
																	<i class="fas fa-star"></i>
																	<span class="small">({{ $product->reviews->count() }} Reviews)</span>
																</div>
																<h5 class="fs-md mb-0 lh-1 mb-1"><a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a></h5>
																<div class="elis_rty">
                                                                    @if($product->discount_price > 0)
                                                                    <span class="ft-bold text-dark fs-sm">৳{{ $product->discount_price }}</span>
                                                                    <span class="text-muted line-through small">৳{{ $product->price }}</span>
                                                                    @else
                                                                    <span class="ft-bold text-dark fs-sm">৳{{ $product->price }}</span>
                                                                    @endif
                                                                </div>
															</div>
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
					</div>
					
				</div>
			</section>
			<!-- ======================= Products List ======================== -->
			
			<!-- ======================= Customer Review ======================== -->
			<section class="gray">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Testimonials</h2>
								<h3 class="ft-bold pt-3">Client Reviews</h3>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
							<div class="reviews-slide px-3">
								
								@foreach($testimonials as $testimonial)
								<!-- single review -->
								<div class="single_review">
									<div class="sng_rev_thumb"><figure><img src="{{ asset($item->image ?? 'sungoods/images/default-users.png') }}" class="img-fluid circle" alt="" /></figure></div>
									<div class="sng_rev_caption text-center">
										<div class="rev_desc mb-4">
											<p class="fs-md">{!! $testimonial->text_en !!}</p>
										</div>
										<div class="rev_author">
											<h4 class="mb-0">{{ $testimonial->name }}</h4>
											<span class="fs-sm">{{ $testimonial->designation }}</span>
										</div>
									</div>
								</div>
                                @endforeach
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Customer Review ======================== -->
			
			<!-- ======================= Blog Start ============================ -->
			<section class="space min">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Latest News</h2>
								<h3 class="ft-bold pt-3">New Updates</h3>
							</div>
						</div>
					</div>
					
					<div class="row">
						
						@foreach($newses as $news)
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
							<div class="_blog_wrap">
								<div class="_blog_thumb mb-2">
									<a href="{{ route('singleNews', $news->id) }}" class="d-block"><img src="{{ route('imagecache', ['template'=>'original','filename' => $news->fi()]) }}" class="img-fluid rounded" alt="" /></a>
								</div>
								<div class="_blog_caption">
									<span class="text-muted">{{ $news->created_at->format('d M Y') }}</span>
									<h5 class="bl_title lh-1"><a href="{{ route('singleNews', $news->id) }}">{{ $news->title }}</a></h5>
									<p>{{ Str::limit(strip_tags($news->description), 150) }}</p>
									<a href="{{ route('singleNews', $news->id) }}" class="text-dark fs-sm">Continue Reading..</a>
								</div>
							</div>
						</div>
                        @endforeach
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Blog Start ============================ -->
			
			<!-- ======================= Instagram Start ============================ -->
			<section class="p-0">
				<div class="container-fluid p-0">
					
					<div class="row no-gutters">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Instagram Gallery</h2>
								<span class="fs-lg ft-bold theme-cl pt-3">@mahak_71</span>
								<h3 class="ft-bold lh-1">From Instagram</h3>
							</div>
						</div>
					</div>
					
					<div class="row no-gutters">
						
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-1.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-2.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-3.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-7.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-8.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-4.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-5.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="_insta_wrap">
								<div class="_insta_thumb">
									<a href="javascript:void(0);" class="d-block"><img src="{{ asset('solevera/assets/img/i-6.png') }}" class="img-fluid" alt="" /></a>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Instagram Start ============================ -->
@endsection
