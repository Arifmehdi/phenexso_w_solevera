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
                <style>
                    .header-search-wrap {
                        flex: 1;
                        max-width: 500px;
                        margin: 0 30px;
                        position: relative;
                    }
                    .header-search-form {
                        position: relative;
                        width: 100%;
                    }
                    .header-search-form input {
                        width: 100%;
                        height: 45px;
                        border: 1px solid #e1e1e1;
                        border-radius: 30px;
                        padding: 0 50px 0 20px !important;
                        outline: none;
                        transition: all 0.3s;
                        background: #f9f9f9;
                    }
                    .header-search-form input:focus {
                        background: #fff;
                        border-color: #151515;
                        box-shadow: 0 0 10px rgba(0,0,0,0.05);
                    }
                    .header-search-form button {
                        position: absolute;
                        right: 5px;
                        top: 5px;
                        width: 35px;
                        height: 35px;
                        border: none;
                        background: #151515;
                        color: #fff;
                        border-radius: 50%;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                    .header-search-results {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        right: 0;
                        background: #fff;
                        z-index: 1000;
                        border-radius: 10px;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                        margin-top: 10px;
                        max-height: 400px;
                        overflow-y: auto;
                        display: none;
                    }
                    .search-item {
                        display: flex !important;
                        align-items: center !important;
                        padding: 10px 15px !important;
                        border-bottom: 1px solid #f1f1f1 !important;
                        transition: background 0.2s;
                    }
                    .search-item:last-child {
                        border-bottom: none !important;
                    }
                    .search-item:hover {
                        background: #f9f9f9 !important;
                        text-decoration: none !important;
                    }
                    .search-item img {
                        width: 50px !important;
                        height: 50px !important;
                        object-fit: cover !important;
                        border-radius: 5px !important;
                        margin-right: 15px !important;
                    }
                    .search-item .info h4 {
                        font-size: 14px !important;
                        margin: 0 !important;
                        color: #151515 !important;
                        font-weight: 600 !important;
                    }
                    .search-item .info span {
                        font-size: 13px !important;
                        color: #777 !important;
                    }

                    @media (max-width: 991px) {
                        .header-search-wrap {
                            display: none !important;
                        }
                        #mobile-search-bar {
                            position: absolute;
                            top: 100%;
                            left: 0;
                            right: 0;
                            width: 100%;
                            z-index: 999;
                        }
                    }
                </style>
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
								@auth
								<li class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown">
										<i class="lni lni-user"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="lni lni-dashboard me-2"></i>Member Panel</a></li>
										@if(auth()->user()->hasRole('admin'))
										<li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="lni lni-user me-2"></i>Admin Panel</a></li>
										@endif
										<li><a class="dropdown-item" href="{{ route('logout') }}"><i class="lni lni-log-out me-2"></i>Logout</a></li>
									</ul>
								</li>
								@else
								<li>
									<a href="{{ route('login') }}" >
										<i class="lni lni-user"></i>
									</a>
								</li>
								@endauth
								<li>
									<a href="{{ route('wishlist.index') }}">
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
								@auth
								<li class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown">
										<i class="lni lni-user"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="lni lni-dashboard me-2"></i>Member Panel</a></li>
										@if(auth()->user()->hasRole('admin'))
										<li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="lni lni-user me-2"></i>Admin Panel</a></li>
										@endif
										<li><a class="dropdown-item" href="{{ route('logout') }}"><i class="lni lni-log-out me-2"></i>Logout</a></li>
									</ul>
								</li>
								@else
								<li>
									<!-- <a href="#" data-bs-toggle="modal" data-bs-target="#login"> -->
									<a href="{{ route('login') }}">
										<i class="lni lni-user"></i>
									</a>
								</li>
								@endauth
								<li>
									<a href="{{ route('wishlist.index') }}">
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
