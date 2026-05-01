@extends('website.layouts.sungoods')

@section('title', 'Contact Us - ' . ($ws->name ?? env('APP_NAME')))

@section('body_class', 'contact-us')

@section('meta')
    <meta name="description" content="Contact us for inquiries, support, or business partnerships. Get in touch with our team today.">
    <meta name="keywords" content="contact, support, customer service, help desk, business inquiries">
    <meta property="og:title" content="Contact Us - {{ $ws->name ?? env('APP_NAME') }}">
    <meta property="og:description" content="Get in touch with our team for any inquiries or support.">
    <meta property="og:type" content="website">
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('sungoods/css/style.min.css') }}">
@endpush

@section('content')
<nav class="breadcrumb-nav">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
            <li>{{ 'Contact Us' }}</li>
        </ul>
    </div>
</nav>
<div class="page-header" style="background-image: url({{ asset('sungoods/images/page-header/contact-us.jpg') }})">
    <h1 class="page-title font-weight-bold text-capitalize ls-l">Contact Us</h1>
</div>

<div class="page-content mt-10 pt-5">
    <section class="contact-from-section">
        <div class="container">
            <header class="section-header with-subtitle text-center">
                <h3 class="section-subtitle text-uppercase">Contact Us</h3>
                <h2 class="section-title">Let’s Keep In Touch</h2>
                <p class="section-desc">Do you have a question or some feedback? We’d love to hear from you.
                </p>
            </header>
            
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-5 ls-m pb-10">
                    <div class="grey-section d-flex align-items-center h-100">
                        <div>
                            <h4 class="mb-2 text-capitalize">Office Address</h4>
                            <p>{{ $ws->contact_address ?? '121 King Street, Melbourne Victoria 3000 Australia' }}</p>

                            <h4 class="mb-2 text-capitalize">Phone Number</h4>
                            <p>
                                <a href="tel:{{ $ws->contact_mobile ?? '#' }}">{{ $ws->contact_mobile ?? '1-800-456-789' }}</a>
                            </p>

                            <h4 class="mb-2 text-capitalize">Email</h4>
                            <p class="mb-4">
                                <a href="mailto:{{ $ws->contact_email ?? '#' }}">{{ $ws->contact_email ?? 'support@example.com' }}</a><br>
                                <a href="#">Help Center</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <form id="contact-form" action="{{ route('contact.store') }}" method="post" class="pl-lg-10">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <input type="text" name="name" class="form-control" placeholder="Name*" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <input type="email" name="email" class="form-control" placeholder="Email*" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <input type="text" name="phone" class="form-control" placeholder="Phone*" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="form-control" name="subject" required>
                                    <option value="" {{ old('subject') == '' ? 'selected' : '' }}>Select Service Type</option>
                                    <option value="Transport" {{ old('subject') == 'Transport' ? 'selected' : '' }}>Transport</option>
                                    <option value="Product Delay" {{ old('subject') == 'Product Delay' ? 'selected' : '' }}>Product Delay</option>
                                    <option value="Update Product/Price" {{ old('subject') == 'Update Product/Price' ? 'selected' : '' }}>Update Product/Price</option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <textarea name="message" class="form-control" required placeholder="Comment or Message*">{{ old('message') }}</textarea>
                            </div>
                            <!-- <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="agree">
                                        Save my name, email, and website in this browser for the next time I comment.
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <button type="submit" class="btn btn-dark btn-rounded">Send Message<i class="d-icon-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="store-section mt-10 pt-10 pb-10 border-top">
        <div class="container">
            <h2 class="section-title banner-title-f text-center ls-m mb-8">Our Store</h2>
            <div class="row cols-sm-2 cols-lg-4">
                <div class="store">
                    <figure>
                        <img src="{{ asset('sungoods/images/subpages/store-1.jpg') }}" alt="Store" width="280" height="280">
                        <h4 class="overlay-visible">New York</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mailto:{{ $ws->contact_email ?? '#' }}">{{ $ws->contact_email ?? 'info@example.com' }}</a>
                            <a href="tel:{{ $ws->contact_mobile ?? '#' }}">Phone: {{ $ws->contact_mobile ?? '(123) 456-7890' }}</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="store">
                    <figure>
                        <img src="{{ asset('sungoods/images/subpages/store-2.jpg') }}" alt="Store" width="280" height="280">
                        <h4 class="overlay-visible">London</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mailto:{{ $ws->contact_email ?? '#' }}">{{ $ws->contact_email ?? 'info@example.com' }}</a>
                            <a href="tel:{{ $ws->contact_mobile ?? '#' }}">Phone: {{ $ws->contact_mobile ?? '(123) 456-7890' }}</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="store">
                    <figure>
                        <img src="{{ asset('sungoods/images/subpages/store-3.jpg') }}" alt="Store" width="280" height="280">
                        <h4 class="overlay-visible">Oslo</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mailto:{{ $ws->contact_email ?? '#' }}">{{ $ws->contact_email ?? 'info@example.com' }}</a>
                            <a href="tel:{{ $ws->contact_mobile ?? '#' }}">Phone: {{ $ws->contact_mobile ?? '(123) 456-7890' }}</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="store">
                    <figure>
                        <img src="{{ asset('sungoods/images/subpages/store-4.jpg') }}" alt="Store" width="280" height="280">
                        <h4 class="overlay-visible">Stockholm</h4>
                        <div class="overlay overlay-transparent">
                            <a class="mt-8" href="mailto:{{ $ws->contact_email ?? '#' }}">{{ $ws->contact_email ?? 'info@example.com' }}</a>
                            <a href="tel:{{ $ws->contact_mobile ?? '#' }}">Phone: {{ $ws->contact_mobile ?? '(123) 456-7890' }}</a>
                            <div class="social-links mt-1">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-linkedin fab fa-linkedin-in"></a>
                            </div>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </section> -->

<!-- Google Maps Section -->
<div class="grey-section google-map" id="googlemaps" style="height: 386px; overflow: hidden;">
    
    <iframe 
        src="{{ $ws->iframe_map ?? '#' }}"
        width="100%" 
        height="100%" 
        style="border:0;"
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>

</div>
<!-- End Map Section -->
</div>
@endsection

@push('js')
{{--<script src="{{ asset('sungoods/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key="></script>--}}
<script>
    /*
    Map Settings
        Find the Latitude and Longitude of your address:
            - https://www.latlong.net/
            - http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/
    */

    // Map Markers
    var mapMarkers = [ {
        address: "New York, NY 10017",
        html: "<strong>New York Office<\/strong><br>New York, NY 10017",
        popup: true
    } ];

    // Map Initial Location
    var initLatitude = 40.75198;
    var initLongitude = -73.96978;

    // Map Extended Settings
    var mapSettings = {
        controls: {
            draggable: !window.Riode.isMobile,
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true
        },
        scrollwheel: false,
        markers: mapMarkers,
        latitude: initLatitude,
        longitude: initLongitude,
        zoom: 11
    };

    var map = $( '#googlemaps' ).gMap( mapSettings );

    // Map text-center At
    var mapCenterAt = function ( options, e ) {
        e.preventDefault();
        $( '#googlemaps' ).gMap( "centerAt", options );
    }
</script>
@endpush
