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
									<li class=" active" aria-current="page">Contact Us</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Contact Page Detail ======================== -->
			<section class="middle">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center mb-5">
								<h2 class="off_title">Contact Us</h2>
								<h3 class="ft-bold pt-3">Get In Touch</h3>
							</div>
						</div>
					</div>
					
					<div class="row align-items-start justify-content-between">
					
						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
							<div class="card-wrap-body mb-4 gray p-4 rounded">
								<h4 class="ft-medium mb-3 theme-cl">Address</h4>
								<p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>{{ $ws->contact_address }}</p>
								<p class="lh-1"><i class="fas fa-envelope me-2"></i><span class="text-dark ft-medium">Email:</span> {{ $ws->contact_email }}</p>
							</div>
							
							<div class="card-wrap-body mb-4 gray p-4 rounded">
								<h4 class="ft-medium mb-3 theme-cl">Make a Call</h4>
								<h6 class="ft-medium mb-1">Phone:</h6>
								<p class="mb-2"><i class="fas fa-phone-alt me-2"></i>{{ $ws->contact_mobile }}</p>
                                @if($ws->phone_alt)
								<h6 class="ft-medium mb-1">Alternative:</h6>
								<p><i class="fas fa-phone me-2"></i>{{ $ws->phone_alt }}</p>
                                @endif
							</div>
							
							<div class="card-wrap-body mb-3 gray p-4 rounded">
								<h4 class="ft-medium mb-3 theme-cl">Support</h4>
								<p>Fill out our form and we will contact you within 24 hours.</p>
								<p class="lh-1 text-dark"><i class="fas fa-headset me-2"></i>{{ $ws->contact_email }}</p>
							</div>
						</div>
						
						<div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
							<form action="{{ route('contact.store') }}" method="POST" class="row g-3">
								@csrf	
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium mb-2">Your Name *</label>
										<input type="text" name="name" class="form-control" placeholder="Your Name" required>
									</div>
								</div>
								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium mb-2">Your Email *</label>
										<input type="email" name="email" class="form-control" placeholder="Your Email" required>
									</div>
								</div>
								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium mb-2">Subject</label>
										<input type="text" name="subject" class="form-control" placeholder="Type Your Subject">
									</div>
								</div>
								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium mb-2">Message</label>
										<textarea name="message" class="form-control ht-80" placeholder="Your Message" required></textarea>
									</div>
								</div>
								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<button type="submit" class="btn btn-dark full-width">Send Message</button>
									</div>
								</div>
								
							</form>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ======================= Contact Page End ======================== -->

            @if($ws->iframe_map)
            <!-- ======================= Contact Map ======================== -->
            <section class="p-0">
                <div class="container-fluid p-0">
                    <div class="row g-0">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="map-container" style="height: 450px; width: 100%; overflow: hidden;">
                                @if(strpos($ws->iframe_map, '<iframe') !== false)
                                    {!! $ws->iframe_map !!}
                                @else
                                    <iframe src="{{ $ws->iframe_map }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ======================= Contact Map End ======================== -->
            <style>
                .map-container iframe {
                    width: 100% !important;
                    height: 100% !important;
                    border: 0;
                    display: block;
                }
            </style>
            @endif
			
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
