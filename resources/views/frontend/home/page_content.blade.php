@extends('website.layouts.sungoods')

@section('title', $page->name_en ?? 'Page')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('sungoods/css/style.min.css') }}">
<style>
    /* Force full width override */
    .main,
    .page-wrapper .main,
    .page-content {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
    }

    .dynamic-content-section {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
    }

    .dynamic-content-inner {
        width: 100%;
    }

    /* ── FORCE ALL CMS COLUMNS TO FULL WIDTH ── */
    .dynamic-content-inner [class*="col-"] {
        flex: 0 0 100% !important;
        max-width: 100% !important;
        width: 100% !important;
    }

    .dynamic-content-inner .container,
    .dynamic-content-inner .container-fluid {
        max-width: 100% !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .dynamic-content-inner .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    /* Make sure any media inside CMS content also goes full width */
    .dynamic-content-inner img,
    .dynamic-content-inner video,
    .dynamic-content-inner iframe {
        width: 100% !important;
        max-width: 100% !important;
        display: block;
    }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<nav class="breadcrumb-nav">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
            <li>{{ $page->name_en }}</li>
        </ul>
    </div>
</nav>

{{-- Page Header --}}
<div class="page-header pl-4 pr-4"
     style="background-image: url({{ asset('sungoods/images/page-header/about-us.jpg') }})">
    <h3 class="page-subtitle font-weight-bold">Welcome to {{ env('APP_NAME') }}</h3>
    <h1 class="page-title font-weight-bold lh-1 text-white text-capitalize">{{ $page->name_en }}</h1>
    <p class="page-desc text-white mb-0">We provide perfect and practical services to our valued customers.</p>
</div>

{{-- ── DYNAMIC CONTENT (Full Width) ── --}}
<section class="dynamic-content-section appear-animate mt-5">
    <div class="container ">
    @if($page->pageItems->count() > 0)
        @php
            $content = $page->pageItems->first()->description_en;

            // Replace all Bootstrap col-*-* classes with col-12 (full width)
            $content = preg_replace('/\bcol-(xs|sm|md|lg|xl|xxl)-\d+\b/', 'col-12', $content);

            // Remove any inline max-width or width style restrictions on sections/divs
            $content = preg_replace('/style="([^"]*)max-width\s*:\s*[^;"]+(;)?([^"]*)"/i', 'style="$1$3"', $content);
        @endphp
        <div class="dynamic-content-inner">
            {!! $content !!}
        </div>
    @else
        <div class="dynamic-content-inner"
             style="width:100%;min-height:420px;background:linear-gradient(135deg,#1a1208,#2a1f0d);
                    display:flex;flex-direction:column;align-items:center;justify-content:center;
                    text-align:center;padding:80px 24px;">
            <p style="font-size:11px;letter-spacing:.25em;text-transform:uppercase;color:#c9a84c;margin-bottom:16px;">
                ── Welcome ──
            </p>
            <h2 style="font-family:serif;font-size:clamp(2rem,5vw,3.8rem);font-weight:900;color:#fff;
                       line-height:1.1;margin-bottom:20px;">
                Welcome to Our World
            </h2>
            <p style="font-size:1rem;color:rgba(255,255,255,.6);max-width:520px;
                      line-height:1.8;margin-bottom:36px;">
                We are dedicated to providing the best service to our customers
                with high-quality products and exceptional support.
            </p>
            <a href="{{ route('shop') }}"
               style="display:inline-flex;align-items:center;gap:10px;background:#c9a84c;
                      color:#1a1208;padding:14px 36px;font-size:.82rem;letter-spacing:.14em;
                      text-transform:uppercase;text-decoration:none;font-weight:700;">
                Shop Now &rarr;
            </a>
        </div>
    @endif
    </div>

</section>

@endsection

@push('js')
<script src="{{ asset('sungoods/vendor/jquery.count-to/jquery-numerator.min.js') }}"></script>
@endpush