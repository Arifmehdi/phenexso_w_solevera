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
									<li class=""><a href="{{ route('news') }}">Blog</a></li> /
									<li class=" active" aria-current="page">{{ $news->title }}</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ============================ Blog Detail Start ================================== -->
			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row">
					
						<!-- Blog Detail -->
						<div class="col-lg-8 col-md-12 col-sm-12 col-12">
							<div class="article_detail_wrapss single_article_wrap format-standard">
								<div class="article_body_wrap">
								
									<div class="article_featured_image">
										<img class="img-fluid" src="{{ route('imagecache', ['template'=>'original','filename' => $news->fi()]) }}" alt="">
									</div>
									
									<div class="article_top_info">
										<ul class="article_middle_info">
											<li><a href="#"><span class="icons"><i class="ti-user"></i></span>by {{ $news->addedBy->name ?? 'Admin' }}</a></li>
											<li><a href="#"><span class="icons"><i class="ti-eye"></i></span>{{ $news->view_count }} Views</a></li>
										</ul>
									</div>
									<h2 class="post-title">{{ $news->title }}</h2>
									{!! $news->description !!}
								</div>
							</div>
							
							<!-- Related Posts if needed or Author Detail -->
							<div class="article_detail_wrapss single_article_wrap format-standard">
								
								<div class="article_posts_thumb">
									<span class="img"><img class="img-fluid" src="{{ asset('img/avatar.png') }}" alt=""></span>
									<h3 class="pa-name">{{ $news->addedBy->name ?? 'Admin' }}</h3>
									<p class="pa-text">Contributor and Editor at {{ config('app.name') }}. Passionate about sharing the latest trends and news.</p>
								</div>
								
							</div>
							
						</div>
						
						<!-- Sidebar -->
						<div class="col-lg-4 col-md-12 col-sm-12 col-12">
							
							<!-- Searchbard -->
							<div class="single_widgets widget_search">
								<h4 class="title">Search</h4>
								<form action="#" class="sidebar-search-form">
									<input type="search" name="search" placeholder="Search..">
									<button type="button"><i class="ti-search"></i></button>
								</form>
							</div>

							<!-- Categories (Static for now, can be made dynamic) -->
							<div class="single_widgets widget_category">
								<h4 class="title">Related Posts</h4>
								<ul>
                                    @foreach($relatedPosts as $rp)
									<li><a href="{{ route('singleNews', $rp->id) }}">{{ $rp->title }}</a></li>
                                    @endforeach
								</ul>
							</div>
							
						</div>
						
					</div>
					<!-- /row -->					
					
				</div>
						
			</section>
			<!-- ============================ Blog Detail End ================================== -->
@endsection
