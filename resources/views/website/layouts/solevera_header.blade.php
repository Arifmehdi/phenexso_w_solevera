            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            {{-- ==@if(!Route::is('home'))
			<div class="py-2 bg-dark">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
							<div class="top_first"><a href="callto:{{ $ws->phone }}" class="medium text-light">{{ $ws->contact_mobile }}</a></div>
						</div>
						
						<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
							<div class="top_second text-center"><p class="medium text-light m-0 p-0">Get Free delivery from ৳2000 <a href="{{ route('shop') }}" class="medium text-light text-underline">Shop Now</a></p></div>
						</div>
						
						<!-- Right Menu -->
						<div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">

							<div class="currency-selector dropdown js-dropdown float-right">
								<a href="javascript:void(0);" data-bs-toggle="dropdown" class="popup-title"  title="Currency" aria-label="Currency dropdown">
									<span class="hidden-xl-down medium text-light">Currency:</span>
									<span class="iso_code medium text-light">৳BDT</span>
									<i class="fa fa-angle-down medium text-light"></i>
								</a>
								<ul class="popup-content dropdown-menu">  
									<li><a title="Euro" href="#" class="dropdown-item medium text-medium">EUR €</a></li>
									<li class="current"><a title="US Dollar" href="#" class="dropdown-item medium text-medium">USD $</a></li>
								</ul>
							</div>
							
							<!-- Choose Language -->
						
							<div class="language-selector-wrapper dropdown js-dropdown float-right me-3">
								<a class="popup-title" href="javascript:void(0)" data-bs-toggle="dropdown" title="Language" aria-label="Language dropdown">
									<span class="hidden-xl-down medium text-light">Language:</span>
									<span class="iso_code medium text-light">English</span>
									<i class="fa fa-angle-down medium text-light"></i>
								</a>
								<ul class="dropdown-menu popup-content link">
									<li class="current"><a href="javascript:void(0);" class="dropdown-item medium text-medium"><span>English</span></a></li>
								</ul>
							</div>
							
							<div class="currency-selector dropdown js-dropdown float-right me-3">
								<a href="{{ route('wishlist.index') }}" class="text-light medium">Wishlist</a>
							</div>
							
							<div class="currency-selector dropdown js-dropdown float-right me-3">
								<a href="{{ route('login') }}" class="text-light medium">My Account</a>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
            @endif --}}

            <!-- Start Navigation -->
			<div class="header {{ Route::is('home') ? 'header-transparent' : 'header-light' }} dark-text">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="{{ route('home') }}">
								<img src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo_alt()]) }}" class="logo" alt="{{ $ws->name }}" />
							</a>
							<div class="nav-toggle"></div>
							<div class="mobile_nav">
								<ul>
									<li>
									<a href="#" onclick="openSearch()">
										<i class="lni lni-search-alt"></i>
									</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="modal" data-bs-target="#login">
										<i class="lni lni-user"></i>
									</a>
								</li>
								<li>
									<a href="#" onclick="openWishlist()">
										<i class="lni lni-heart"></i><span class="dn-counter">{{ $wishlistCount }}</span>
									</a>
								</li>
								<li>
									<a href="#" onclick="openCart()">
										<i class="lni lni-shopping-basket"></i><span class="dn-counter">{{ $cartCount }}</span>
									</a>
								</li>
								</ul>
							</div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu">
							
								<li><a href="{{ route('home') }}">Home</a></li>
								
								<li><a href="{{ route('shop') }}">Shop</a></li>
								
								<li><a href="{{ route('news') }}">Blog</a></li>
								<li><a href="{{ route('about-us') }}">About Us</a></li>
								<li><a href="{{ route('contact') }}">Contact</a></li>
								
							</ul>
							
							<ul class="nav-menu nav-menu-social align-to-right">
								<li>
									<a href="#" onclick="openSearch()">
										<i class="lni lni-search-alt"></i>
									</a>
								</li>
								<li>
									<a href="#" data-bs-toggle="modal" data-bs-target="#login">
										<i class="lni lni-user"></i>
									</a>
								</li>
								<li>
									<a href="#" onclick="openWishlist()">
										<i class="lni lni-heart"></i><span class="dn-counter">{{ $wishlistCount }}</span>
									</a>
								</li>
								<li>
									<a href="#" onclick="openCart()">
										<i class="lni lni-shopping-basket"></i><span class="dn-counter">{{ $cartCount }}</span>
									</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
