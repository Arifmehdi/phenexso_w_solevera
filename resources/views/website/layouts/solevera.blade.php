<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Themezhub" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>@yield('title', $ws->name ?? 'Solevera')</title>
		 
        <!-- Custom CSS -->
        <link href="{{ asset('solevera/assets/css/styles.css') }}" rel="stylesheet">
		
        @stack('css')
    </head>
	
    <body>
	
		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
       <div class="preloader"></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            @include('website.layouts.solevera_header')

            @yield('content')

            @include('website.layouts.solevera_footer')
			
			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{ asset('solevera/assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/popper.min.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/ion.rangeSlider.min.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/slick.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/slider-bg.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/lightbox.js') }}"></script> 
		<script src="{{ asset('solevera/assets/js/smoothproducts.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/snackbar.min.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/jQuery.style.switcher.js') }}"></script>
		<script src="{{ asset('solevera/assets/js/custom.js') }}"></script>
		
        @include('website.layouts.solevera_js')
        @stack('js')

	</body>
</html>
