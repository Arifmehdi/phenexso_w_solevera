@extends('website.layouts.sungoods')

@section('title', 'All Categories - '. ($ws->name ?? env('APP_NAME')))

@section('content')
<div class="page-content">
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="d-icon-home"></i></a></li>
                <li>All Categories</li>
            </ul>
        </div>
    </nav>

    <section class="mt-10 mb-10">
        <div class="container">
            <h2 class="title title-center mb-5">Our All Categories</h2>
            <div class="row">
                @foreach($categories as $cat)
                <div class="col-xs-6 col-md-4 col-lg-3 mb-4">
                    <div class="category category-default1 category-absolute banner-radius overlay-zoom">
                        <a href="{{ route('productCategory', $cat->slug) }}">
                            <figure class="category-media">
                                <img src="{{ route('imagecache', ['template'=>'original','filename' => $cat->fi()]) }}" alt="{{ $cat->name_en }}" width="280"
                                    height="280" style="background-color: #8c8c8d;" />
                            </figure>
                        </a>
                        <div class="category-content">
                            <h4 class="category-name font-weight-bold ls-l text-uppercase"><a href="{{ route('productCategory', $cat->slug) }}">{{ $cat->name_en }}</a></h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
