@extends('website.layouts.solevera')

@section('content')
			<!-- ======================= Shop Style 1 ======================== -->
			<section class="bg-cover" style="background:url({{ asset('solevera/assets/img/banner-2.png') }}) no-repeat;">
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="text-left py-5 mt-3 mb-3">
								<h1 class="ft-medium mb-3">Shop</h1>
								<ul class="shop_categories_list m-0 p-0">
                                    @foreach($allRootCategories->take(5) as $cat)
									<li><a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a></li>
                                    @endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Shop Style 1 ======================== -->
			
			
			<!-- ======================= Filter Wrap Style 1 ======================== -->
			<section class="py-3 br-bottom br-top">
				<div class="container">
					<div class="row align-items-center justify-content-between">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> /
									<li class=" active" aria-current="page">Shop</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- ============================= Filter Wrap ============================== -->
			
			
			<!-- ======================= All Product List ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
							<div class="search-sidebar sm-sidebar border">
								<div class="search-sidebar-body">
								
									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-header px-3">
											<h4 class="mt-3">Categories</h4>
										</div>
										<div class="widget-boxed-body">
											<div class="side-list no-border">
												<div class="filter-card" id="shop-categories">
													
                                                    @foreach($allRootCategories as $cat)
													<!-- Single Filter Card -->
													<div class="single_filter_card">
														<h5><a href="#cat-{{ $cat->id }}" data-bs-toggle="collapse" class="{{ $loop->first ? '' : 'collapsed' }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" role="button">{{ $cat->name_en }}<i class="accordion-indicator ti-angle-down"></i></a></h5>
														
														<div class="collapse {{ $loop->first ? 'show' : '' }}" id="cat-{{ $cat->id }}" data-parent="#shop-categories">
															<div class="card-body">
																<div class="inner_widget_link">
																	<ul>
                                                                        @foreach($cat->children as $sub)
																		<li><a href="{{ route('productCategory', $sub->slug) }}">{{ $sub->name_en }}<span>{{ $sub->products->count() }}</span></a></li>
                                                                        @endforeach
																	</ul>
																</div>
															</div>
														</div>
													</div>
                                                    @endforeach
													
												</div>
											</div>
										</div>
									</div>
									
									<!-- Single Option -->
									<div class="single_search_boxed">
										<div class="widget-boxed-header">
											<h4><a href="#pricing" data-bs-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
										</div>
										<div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
											<div class="side-list no-border mb-4">
												<div class="rg-slider">
													 <input type="text" class="js-range-slider" name="my_range" value="" />
												</div>		
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
						<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
							
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="border mb-3 mfliud">
										<div class="row align-items-center py-2 m-0">
											<div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
												<h6 class="mb-0">{{ $products->total() }} Items Found</h6>
											</div>
											
											<div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
												<div class="filter_wraps d-flex align-items-center justify-content-end m-start">
													<div class="single_fitres me-2 br-right">
														<select class="custom-select simple" onchange="location = this.value;">
														  <option value="{{ request()->fullUrlWithQuery(['sort' => 1]) }}" {{ request('sort') == 1 ? 'selected' : '' }}>Latest</option>
														  <option value="{{ request()->fullUrlWithQuery(['sort' => 4]) }}" {{ request('sort') == 4 ? 'selected' : '' }}>Price: Low to High</option>
														  <option value="{{ request()->fullUrlWithQuery(['sort' => 3]) }}" {{ request('sort') == 3 ? 'selected' : '' }}>Price: High to Low</option>
														</select>
													</div>
													<div class="single_fitres">
														<a href="#" class="simple-button active me-1"><i class="ti-layout-grid2"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- row -->
							<div class="row align-items-center rows-products">
								
                                @foreach($products as $product)
								<!-- Single -->
								<div class="col-xl-4 col-lg-4 col-md-6 col-6">
									<div class="product_grid card b-0">
                                        @if($product->discount_price > 0)
										<div class="badge bg-sale text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                        @endif
										<div class="card-body p-0">
											<div class="shop_thumb position-relative">
												<a class="card-img-top d-block overflow-hidden" href="{{ route('productDetails', $product->slug) }}"><img class="card-img-top" src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="..."></a>
												<div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
													<div class="edlio"><a href="#" data-bs-toggle="modal" data-bs-target="#quickview" class="text-white fs-sm ft-medium me-2"><i class="fas fa-eye me-1"></i>Quick View</a></div>
                                                    <div class="edlio"><a href="javascript:void(0);" data-id="{{ $product->id }}" class="text-white fs-sm ft-medium add-to-cart-btn"><i class="fas fa-shopping-basket me-1"></i>Add to Cart</a></div>
												</div>
											</div>
										</div>
										<div class="card-footer b-0 p-0 pt-2 bg-white">
											<div class="d-flex align-items-start justify-content-between">
												<div class="text-left">
                                                    <!-- Color variants could be dynamic if model supports it -->
												</div>
												<div class="text-right">
													<button class="btn auto btn_love snackbar-wishlist" data-id="{{ $product->id }}"><i class="far fa-heart"></i></button> 
												</div>
											</div>
											<div class="text-left">
												<h5 class="fw-normal fs-md mb-0 lh-1 mb-1"><a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a></h5>
												<div class="elis_rty">
                                                    @if($product->discount_price > 0)
                                                    <span class="ft-medium text-dark fs-sm">৳{{ $product->discount_price }}</span>
                                                    <span class="text-muted line-through small">৳{{ $product->price }}</span>
                                                    @else
                                                    <span class="ft-medium text-dark fs-sm">৳{{ $product->price }}</span>
                                                    @endif
                                                </div>
											</div>
										</div>
									</div>
								</div>
                                @endforeach
								
							</div>
							<!-- row -->
							
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 text-center">
									{{ $products->links('pagination::bootstrap-4') }}
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ======================= All Product List ======================== -->
@endsection
