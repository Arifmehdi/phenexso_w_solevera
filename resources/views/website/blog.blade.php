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
									<li class="active" aria-current="page">Blog</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Blog Start ============================ -->
			<section class="middle">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Latest News</h2>
								<h3 class="ft-bold pt-3">New Updates</h3>
							</div>
						</div>
					</div>
					
					<div class="row">
						
                        @foreach($news as $post)
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
							<div class="_blog_wrap">
								<div class="_blog_thumb mb-2">
									<a href="{{ route('singleNews', $post->id) }}" class="d-block"><img src="{{ route('imagecache', ['template'=>'original','filename' => $post->fi()]) }}" class="img-fluid rounded" alt="" /></a>
								</div>
								<div class="_blog_caption">
									<span class="text-muted">{{ $post->created_at->format('d M Y') }}</span>
									<h5 class="bl_title lh-1"><a href="{{ route('singleNews', $post->id) }}">{{ $post->title }}</a></h5>
									<p>{{ Str::limit(strip_tags($post->description), 150) }}</p>
									<a href="{{ route('singleNews', $post->id) }}" class="text-dark fs-sm">Continue Reading..</a>
								</div>
							</div>
						</div>
                        @endforeach
						
					</div>
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="position-relative text-center">
								{{ $news->links('pagination::bootstrap-4') }}
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Blog Start ============================ -->
@endsection
