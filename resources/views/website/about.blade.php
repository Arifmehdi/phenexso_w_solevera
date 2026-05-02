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
									<li class=" active" aria-current="page">About Us</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= About Us Detail ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-center justify-content-between">
					
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class="abt_caption">
								<h2 class="ft-medium mb-4">{{ $ws->about_title ?? 'We Have Everything You Need ?' }}</h2>
								<div class="mb-4">
									{!! $ws->about_subtitle ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.' !!}
								</div>
								<div class="form-group mt-4">
									<a href="{{ route('shop') }}" class="btn btn-dark">Shop Now</a>
								</div>
							</div>
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class="abt_caption">
								<img src="{{ $ws->about_img ? asset('storage/wp/' . $ws->about_img) : asset('solevera/assets/img/about-1.png') }}" class="img-fluid rounded" alt="" />
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ======================= About Us End ======================== -->
			
			<!-- ======================= About Us Detail ======================== -->
			{{--<section class="middle">
				<div class="container">
					<div class="row align-items-center justify-content-between">
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class="abt_caption">
								<img src="{{ asset('solevera/assets/img/about-2.png') }}" class="img-fluid rounded" alt="" />
							</div>
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class="abt_caption">
								<h2 class="ft-medium mb-4">Justin Lisiakir</h2>
								<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
								<p class="mb-4">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.</p>
								<div class="form-group mt-4">
									<a href="{{ route('contact') }}" class="btn btn-dark">Contact Us</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>--}}
			<!-- ======================= About Us End ======================== -->
			
			<!-- ============================= Customer Features =============================== -->
			{{--<section class="px-0 py-3 br-top">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shopping-basket theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Free Shipping</h5>
									<span class="text-muted">Capped at $10 per order</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="far fa-credit-card theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Secure Payments</h5>
									<span class="text-muted">Up to 6 months installments</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shield-alt theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">15-Days Returns</h5>
									<span class="text-muted">Shop with fully confidence</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-headphones-alt theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">24x7 Fully Support</h5>
									<span class="text-muted">Get friendly support</span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>--}}
			<!-- ======================= Customer Features ======================== -->
@endsection
