			<!-- ============================ Footer Start ================================== -->
			<footer class="light-footer">
				<div class="footer-middle">
					<div class="container">
						<div class="row">
							
							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
								<div class="footer_widget">
									<img src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo_alt()]) }}" class="img-footer small mb-2" alt="{{ $ws->website_title }}" />
									
									<div class="address mt-3">
										{{ $ws->contact_address }}	
									</div>
									<div class="address mt-3">
										{{ $ws->contact_mobile }}<br>{{ $ws->contact_email }}
									</div>
									<div class="address mt-3">
										<ul class="list-inline">
											@if($ws->fb_url)
											<li class="list-inline-item"><a href="{{ $ws->fb_url }}" target="_blank"><i class="lni lni-facebook-filled"></i></a></li>
											@endif
											@if($ws->twitter_url)
											<li class="list-inline-item"><a href="{{ $ws->twitter_url }}" target="_blank"><i class="lni lni-twitter-filled"></i></a></li>
											@endif
											@if($ws->youtube_url)
											<li class="list-inline-item"><a href="{{ $ws->youtube_url }}" target="_blank"><i class="lni lni-youtube"></i></a></li>
											@endif
											@if($ws->instagram_url)
											<li class="list-inline-item"><a href="{{ $ws->instagram_url }}" target="_blank"><i class="lni lni-instagram-filled"></i></a></li>
											@endif
										</ul>
									</div>
								</div>
							</div>
							
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Shop Categories</h4>
									<ul class="footer-menu">
										@foreach($productCategories->take(6) as $cat)
										<li><a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a></li>
										@endforeach
										<li><a href="{{ route('shop') }}">View All</a></li>
									</ul>
								</div>
							</div>
									
							@foreach($footerMenus as $menu)
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">{{ $menu->name_en }}</h4>
									<ul class="footer-menu">
										@foreach($menu->pages as $page)
										<li><a href="{{ route('page', $page->slug) }}">{{ $page->name_en }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
							@endforeach

							@if($footerMenus->isEmpty())
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Useful Links</h4>
									<ul class="footer-menu">
										<li><a href="{{ route('about-us') }}">About Us</a></li>
										<li><a href="{{ route('contact') }}">Contact Us</a></li>
										<li><a href="{{ route('news') }}">Latest News</a></li>
										<li><a href="{{ route('shop') }}">Special Offers</a></li>
									</ul>
								</div>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Supports</h4>
									<ul class="footer-menu">
										<li><a href="{{ route('contact') }}">Contact Us</a></li>
										<li><a href="{{ route('about-us') }}">About Page</a></li>
										<li><a href="#">Shipping & Returns</a></li>
										<li><a href="#">FAQ's Page</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div>
							</div>
							@endif
							
							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Subscribe</h4>
									<p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
									<div class="foot-news-last">
										<div class="input-group">
										  <input type="text" class="form-control" placeholder="Email Address">
											<div class="input-group-append">
												<button type="button" class="input-group-text bg-dark b-0 text-light"><i class="lni lni-arrow-right"></i></button>
											</div>
										</div>
									</div>
									<div class="address mt-3">
										<h5 class="fs-sm">Secure Payments</h5>
										<div class="scr_payment"><img src="{{ asset('solevera/assets/img/card.png') }}" class="img-fluid" alt="" /></div>
									</div>
								</div>
							</div>
								
						</div>
					</div>
				</div>
				
				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-lg-12 col-md-12 text-center">
								<p class="mb-0">© <?php echo date('Y'); ?> <a href="https://phenexsoft.com/" target="_blank">Phenexsoft IT</a>.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->
			
			<!-- Product View Modal -->
			<div class="modal fade lg-modal" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickviewmodal" aria-hidden="true">
				<div class="modal-dialog modal-xl login-pop-form" role="document">
					<div class="modal-content" id="quickviewmodal">
						<div class="modal-headers">
							<button type="button" class="border-0 close" data-bs-dismiss="modal" aria-label="Close">
							  <span class="ti-close"></span>
							</button>
						  </div>
					
						<div class="modal-body">
							<!-- Content will be loaded here via AJAX -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
			
			<!-- Log In Modal -->
			<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
				<div class="modal-dialog login-pop-form" role="document">
					<div class="modal-content" id="loginmodal">
						<div class="modal-headers">
							<button type="button" class="border-0 close" data-bs-dismiss="modal" aria-label="Close">
							  <span class="ti-close"></span>
							</button>
						  </div>
					
						<div class="modal-body p-5">
							<div class="text-center mb-4">
								<h2 class="m-0 ft-regular">Login</h2>
							</div>
							
							<form>				
								<div class="form-group mb-3">
									<label class="mb-2">User Name</label>
									<input type="text" class="form-control" placeholder="Username*">
								</div>
								
								<div class="form-group mb-3">
									<label class="mb-2">Password</label>
									<input type="password" class="form-control" placeholder="Password*">
								</div>
								
								<div class="form-group mb-3">
									<div class="d-flex align-items-center justify-content-between">
										<div class="flex-1">
											<input id="dd" class="checkbox-custom" name="dd" type="checkbox">
											<label for="dd" class="checkbox-custom-label">Remember Me</label>
										</div>	
										<div class="eltio_k2">
											<a href="#">Lost Your Password?</a>
										</div>	
									</div>
								</div>
								
								<div class="form-group mb-3">
									<button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
								</div>
								
								<div class="form-group text-center mb-0">
									<p class="extra">Not a member?<a href="#et-register-wrap" class="text-dark"> Register</a></p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
			
			<!-- Search -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Search">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Search Products</h4>
						<button onclick="closeSearch()" class="close_slide"><i class="ti-close"></i></button>
					</div>
						
					<div class="cart_action px-3 py-4">
						<form action="{{ route('search') }}" method="GET" class="form m-0 p-0">
							<div class="form-group mb-3">
								<input type="text" name="parameter" class="form-control" placeholder="Product Keyword.." />
							</div>
							
							<div class="form-group mb-3">
								<select class="custom-select">
								  <option value="1" selected="">Choose Category</option>
								  @foreach($productCategories as $cat)
								  <option value="{{ $cat->slug }}">{{ $cat->name_en }}</option>
								  @endforeach
								</select>
							</div>
							
							<div class="form-group mb-0">
								<button type="submit" class="btn d-block full-width btn-dark">Search Product</button>
							</div>
						</form>
					</div>
					
					<div class="d-flex align-items-center justify-content-center br-top br-bottom py-2 px-3">
						<h4 class="cart_heading fs-md mb-0">Hot Categories</h4>
					</div>
						
					<div class="cart_action px-3 py-3">
						<div class="row">
                            @foreach($productCategories->take(6) as $cat)
							<div class="col-xl-4 col-lg-4 col-md-4 col-4 mb-3">
								<div class="cats_side_wrap text-center">
									<div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-3 circle mb-2 gray"><a href="{{ route('productCategory', $cat->slug) }}" class="d-block"><img src="{{ route('imagecache', ['template' => 'original', 'filename' => $cat->fi()]) }}" class="img-fluid" width="40" alt="" /></a></div></div>
									<div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a></h6></div>
								</div>
							</div>
                            @endforeach
						</div>
					</div>
					
				</div>
			</div>
			
			<!-- Wishlist -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
						<button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
					</div>
					<div class="right-ch-sideBar">
						
						<div class="cart_select_items py-2">
							<!-- Static placeholders for wishlist, ideally should be dynamic -->
                            @if(isset($wishlistItems))
                            @foreach($wishlistItems as $item)
							<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="cart_selected_single_thumb">
										<a href="{{ route('productDetails', $item->product->slug) }}"><img src="{{ route('imagecache', ['template' => 'original', 'filename' => $item->product->fi()]) }}" width="60" class="img-fluid" alt="" /></a>
									</div>
									<div class="cart_single_caption ps-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{ $item->product->name_en }}</h4>
										<h4 class="fs-md ft-medium mb-0 lh-1">৳{{ number_format($item->product->price, 2) }}</h4>
									</div>
								</div>
								<div class="fls_last"><a href="{{ route('wishlist.remove', $item->id) }}" class="close_slide gray"><i class="ti-close"></i></a></div>
							</div>
                            @endforeach
                            @endif
							
						</div>
						
						<div class="cart_action px-3 py-3">
							<div class="form-group mb-3">
								<a href="{{ route('wishlist.index') }}" class="btn d-block full-width btn-dark">Move To Cart</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			<!-- Cart -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
						<button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
					</div>
					<div class="right-ch-sideBar">
						@include('website.layouts.solevera_cart_items')
					</div>
				</div>
			</div>
