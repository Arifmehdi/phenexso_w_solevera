@extends('website.layouts.solevera')

@section('content')
			<!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> /
									<li class=""><a href="{{ route('shop') }}">Shop</a></li> /
									<li class=" active" aria-current="page">{{ $product->name_en }}</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Product Detail ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-center">
					
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
							<div class="sp-loading"><img src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt=""><br>LOADING IMAGES</div>
							<div class="sp-wrap">
                                @if($product->media->count() > 0)
                                    @foreach($product->media as $med)
								    <a href="#"><img src="#" alt=""></a>
                                    @endforeach
                                @else
								<a href="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}"><img src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt=""></a>
                                @endif
							</div>
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
							<div class="prd_details ps-xl-5">
								
								<div class="prt_01 mb-1">
                                    @foreach($product->categories as $cat)
                                    <span class="text-purple bg-light-purple rounded py-1 px-2">{{ $cat->name_en }}</span>
                                    @endforeach
                                </div>
								<div class="prt_02 mb-3">
									<h2 class="ft-bold mb-1">{{ $product->name_en }}</h2>
									<div class="text-left">
										<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="small">({{ $product->reviews->count() }} Reviews)</span>
										</div>
										<div class="elis_rty">
                                            {{--@if($product->discount_price > 0)
                                            <span class="ft-medium text-muted line-through fs-md me-2">৳{{ $product->price }}</span>
                                            <span class="ft-bold theme-cl fs-lg me-2">৳{{ $product->discount_price }}</span>
                                            @else
                                            <span class="ft-bold theme-cl fs-lg me-2">৳{{ $product->price }}</span>
                                            @endif--}}
                                            <span class="ft-bold theme-cl fs-lg me-2">৳{{ $product->selling_price }}</span>
                                            <span class="ft-regular text-light bg-success py-1 px-2 fs-sm">In Stock</span>
                                        </div>
									</div>
								</div>
								
								<div class="prt_03 mb-4">
									<p>{!! $product->description_en !!}</p>
								</div>
								
								<div class="prt_05 mb-4">
									<div class="form-row row g-3 mb-7">
										<div class="col-12 col-md-6 col-lg-3">
											<!-- Quantity -->
											<select class="mb-2 custom-select quantity">
											  <option value="1" selected="">1</option>
											  <option value="2">2</option>
											  <option value="3">3</option>
											  <option value="4">4</option>
											  <option value="5">5</option>
											</select>
										</div>
										<div class="col-12 col-md-12 col-lg-6 product-form-group">
											<!-- Submit -->
											<button type="button" data-id="{{ $product->id }}" class="btn btn-block custom-height bg-dark mb-2 w-100 add-to-cart-btn">
												<i class="lni lni-shopping-basket me-2"></i>Add to Cart 
											</button>
										</div>
										<div class="col-12 col-md-6 col-lg-3">
											<!-- Wishlist -->
											<button class="btn custom-height btn-default btn-block mb-2 text-dark w-100 add-to-wishlist" data-id="{{ $product->id }}">
												<i class="lni lni-heart me-2"></i>Wishlist
											</button>
										</div>
								  </div>
								</div>
								
								<div class="prt_06">
									<p class="mb-0 d-flex align-items-center">
									  <span class="me-4">Share:</span>
									  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted me-2" href="#!">
										<i class="fab fa-twitter position-absolute"></i>
									  </a>
									  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted me-2" href="#!">
										<i class="fab fa-facebook-f position-absolute"></i>
									  </a>
									  <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted" href="#!">
										<i class="fab fa-pinterest-p position-absolute"></i>
									  </a>
									</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->
			
			
			<!-- ======================= Product Description ======================= -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
							<ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="description-tab" href="#description" data-bs-toggle="tab" data-bs-target="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#information" id="information-tab" data-bs-toggle="tab" role="tab" data-bs-target="#information" aria-controls="information" aria-selected="false">Additional information</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" href="#reviews" id="reviews-tab" data-bs-toggle="tab" role="tab" data-bs-target="#reviews" aria-controls="reviews" aria-selected="false">Reviews</a>
								</li>
							</ul>
							
							<div class="tab-content" id="myTabContent">
								
								<!-- Description Content -->
								<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
									<div class="description_info">
										{!! $product->description_en !!}
									</div>
								</div>
								
								<!-- Additional Content -->
								<div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
									<div class="additionals">
										<table class="table">
											<tbody>
												<tr>
												  <th class="ft-medium text-dark">SKU</th>
												  <td>{{ $product->sku }}</td>
												</tr>
												<tr>
												  <th class="ft-medium text-dark">Category</th>
												  <td>
                                                    @foreach($product->categories as $cat)
                                                    {{ $cat->name_en }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                  </td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
								<!-- Reviews Content -->
								<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
									<div class="reviews_info">
                                        @foreach($product->reviews as $rev)
										<div class="single_rev d-flex align-items-start br-bottom py-3">
											<div class="single_rev_thumb"><img src="{{ asset('img/avatar.png') }}" class="img-fluid circle" width="90" alt="" /></div>
											<div class="single_rev_caption d-flex align-items-start ps-3">
												<div class="single_capt_left">
													<h5 class="mb-0 fs-md ft-medium lh-1">{{ $rev->user->name ?? 'Guest' }}</h5>
													<span class="small">{{ $rev->created_at->format('d M Y') }}</span>
													<p>{{ $rev->comment }}</p>
												</div>
												<div class="single_capt_right">
													<div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                        @for($i=1; $i<=5; $i++)
														<i class="fas fa-star {{ $i <= $rev->rating ? 'filled' : '' }}"></i>
                                                        @endfor
													</div>
												</div>
											</div>
										</div>
                                        @endforeach
										
									</div>
									
									<div class="reviews_rate">
										<form class="row g-3">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<h4>Submit Rating</h4>
											</div>
											
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded">
													<div class="srt_013">
														<div class="submit-rating">
														  <input id="star-5" type="radio" name="rating" value="5" />
														  <label for="star-5" title="5 stars">
															<i class="active fa fa-star" aria-hidden="true"></i>
														  </label>
														  <input id="star-4" type="radio" name="rating" value="4" />
														  <label for="star-4" title="4 stars">
															<i class="active fa fa-star" aria-hidden="true"></i>
														  </label>
														  <input id="star-3" type="radio" name="rating" value="3" />
														  <label for="star-3" title="3 stars">
															<i class="active fa fa-star" aria-hidden="true"></i>
														  </label>
														  <input id="star-2" type="radio" name="rating" value="2" />
														  <label for="star-2" title="2 stars">
															<i class="active fa fa-star" aria-hidden="true"></i>
														  </label>
														  <input id="star-1" type="radio" name="rating" value="1" />
														  <label for="star-1" title="1 star">
															<i class="active fa fa-star" aria-hidden="true"></i>
														  </label>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="form-group">
													<label class="medium text-dark ft-medium mb-2">Description</label>
													<textarea class="form-control rounded-2"></textarea>
												</div>
											</div>
											
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="form-group m-0">
													<button type="button" class="btn btn-white stretched-links hover-black rounded-2">Submit Review <i class="lni lni-arrow-right"></i></button>
												</div>
											</div>
											
										</form>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ======================= Product Description End ==================== -->
			
			
			<!-- ======================= Similar Products Start ============================ -->
			<section class="middle pt-0">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Similar Products</h2>
								<h3 class="ft-bold pt-3">Matching Products</h3>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="slide_items">
								
                                @foreach($relatedProducts as $related)
								<!-- single Item -->
								<div class="single_itesm">
									<div class="product_grid card b-0 mb-0">
                                        @if($related->discount_price > 0)
										<div class="badge bg-sale text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                        @endif
										<button class="snackbar-wishlist btn btn_love position-absolute ab-right add-to-wishlist" data-id="{{ $related->id }}"><i class="far fa-heart"></i></button> 
										<div class="card-body p-0">
											<div class="shop_thumb position-relative">
												<a class="card-img-top d-block overflow-hidden" href="{{ route('productDetails', $related->slug) }}"><img class="card-img-top" src="{{ route('imagecache', ['template'=>'original','filename' => $related->fi()]) }}" alt="..."></a>
												<div class="product-hover-overlay bg-dark d-flex align-items-center justify-content-center">
													<div class="edlio"><a href="#" data-bs-toggle="modal" data-bs-target="#quickview" class="text-white fs-sm ft-medium"><i class="fas fa-eye me-1"></i>Quick View</a></div>
												</div>
											</div>
										</div>
										<div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
											<div class="text-left">
												<div class="text-center">
													<h5 class="fw-normal fs-md mb-0 lh-1 mb-1"><a href="{{ route('productDetails', $related->slug) }}">{{ $related->name_en }}</a></h5>
													<div class="elis_rty">
                                                        {{--@if($related->discount_price > 0)
                                                        <span class="ft-medium fs-md text-dark">৳{{ $related->discount_price }}</span>
                                                        @else
                                                        <span class="ft-medium fs-md text-dark">৳{{ $related->price }}</span>
                                                        @endif--}}
                                                        <span class="ft-medium fs-md text-dark">৳{{ $related->selling_price }}</span>
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
			</section>
			<!-- ======================= Similar Products Start ============================ -->
@endsection
