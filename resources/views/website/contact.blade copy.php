@extends('website.layouts.sungoods')

@section('title', 'Contact Us - '. ($ws->name ?? env('APP_NAME')))

@section('body_class', 'contact-page')

@section('meta')
    <meta name="description" content="Contact us for inquiries, support, or business partnerships. Get in touch with our team today.">
    <meta name="keywords" content="contact, support, customer service, help desk, business inquiries">
    <meta property="og:title" content="Contact Us - {{ $ws->name ?? env('APP_NAME') }}">
    <meta property="og:description" content="Get in touch with our team for any inquiries or support.">
    <meta property="og:type" content="website">
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('sungoods/css/contact.min.css') }}">
<style>
    .contact-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 120px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('{{ asset('sungoods/images/contact/contact-pattern.png') }}') no-repeat;
        background-size: cover;
        opacity: 0.1;
    }

    .contact-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .contact-hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .contact-info-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .contact-info-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .contact-info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .contact-info-card i {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .contact-info-card h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .contact-info-card p {
        color: #666;
        margin: 0;
    }

    .contact-form-section {
        padding: 80px 0;
        background: white;
    }

    .contact-form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .contact-form-title {
        text-align: center;
        color: white;
        margin-bottom: 2rem;
    }

    .contact-form-title h2 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .contact-form-title p {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-control {
        background: rgba(255,255,255,0.9);
        border: none;
        border-radius: 10px;
        padding: 1rem;
        color: #333;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.5);
        border-color: transparent;
    }

    .form-control::placeholder {
        color: #999;
    }

    .btn-submit {
        background: white;
        color: #667eea;
        border: none;
        border-radius: 10px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .alert {
        border-radius: 10px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .map-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .map-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .map-container iframe {
        width: 100%;
        height: 500px;
        border: none;
    }

    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 2rem;
        }

        .contact-hero p {
            font-size: 1rem;
        }

        .contact-form-container {
            padding: 2rem;
        }

        .contact-form-title h2 {
            font-size: 2rem;
        }

        .map-container iframe {
            height: 300px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1>Get in Touch</h1>
        <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>
</section>

<!-- Contact Info Section -->
<section class="contact-info-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="contact-info-card">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>{{ $ws->contact_email ?? 'info@example.com' }}</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="contact-info-card">
                    <i class="fas fa-phone"></i>
                    <h3>Phone</h3>
                    <p>{{ $ws->contact_mobile ?? '+880 1234 567890' }}</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="contact-info-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Address</h3>
                    <p>{{ $ws->contact_address ?? 'Dhaka, Bangladesh' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-container">
                    <div class="contact-form-title">
                        <h2>Send us a Message</h2>
                        <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form id="contact-form" action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="subject" required>
                                <option value="" {{ old('subject') == '' ? 'selected' : '' }}>Select Service Type</option>
                                <option value="Transport" {{ old('subject') == 'Transport' ? 'selected' : '' }}>Transport</option>
                                <option value="Product Delay" {{ old('subject') == 'Product Delay' ? 'selected' : '' }}>Product Delay</option>
                                <option value="Update Product/Price" {{ old('subject') == 'Update Product/Price' ? 'selected' : '' }}>Update Product/Price</option>
                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" value="{{ old('phone') }}" required>
                        </div>

                        <div class="form-group">
                            <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }}>
                            <label class="form-check-label" for="agree">
                                Save my name, email, and website in this browser for the next time I comment.
                            </label>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14602.79920425715!2d90.39505561023496!3d23.793702090776875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c70e61c0dcf3%3A0xfc162eac4282aa4a!2sDhaka%201213!5e0!3m2!1sen!2sbd!4v1763294719745!5m2!1sen!2sbd"
                        frameborder="0"
                        allowfullscreen=""
                        aria-hidden="false"
                        tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    // Form submission handling
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();

        // Basic validation
        let isValid = true;
        $(this).find('.form-control').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            // Show loading state
            let submitBtn = $(this).find('.btn-submit');
            let originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Sending...').prop('disabled', true);

            // Submit form
            this.submit();
        }
    });

    // Input validation on keyup
    $('#contact-form .form-control').on('keyup', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        }
    });
</script>
@endpush