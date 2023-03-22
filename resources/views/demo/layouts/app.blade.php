<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  <meta name="csrf-token" content="{{ csrf_token() }}">


		<!-- Bootstrap CSS -->
		<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{asset('css/tiny-slider.css')}}" rel="stylesheet">
		<link href="{{asset('css/style.css')}}" rel="stylesheet">
		<title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
	</head>

	<body>

		<!-- Start Header/Navigation -->

        @include('demo.layouts.header')
		
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
        @yield('hero')
		@yield('product-section')
			
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
        @yield('why-choose-section')
		
		<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
        @yield('we-help-section')
		
		<!-- End We Help Section -->

		<!-- Start Popular Product -->
        @yield('popular-product')
        
		<!-- End Popular Product -->

		<!-- Start Testimonial Slider -->
        @yield('testimonial-section')
		
		<!-- End Testimonial Slider -->

		<!-- Start Blog Section -->
        @yield('blog-section')
		
		<!-- End Blog Section -->

		<!-- Start Team Section -->
		@yield('untree_co-section')
		<!-- End Team Section -->

		<!-- Start Contact Form -->
		@yield('contact-form')
		<!-- End Contact Form -->

		@yield('before-footer-section')
		@yield('check-out')
        @yield('content')
		<!-- Start Footer Section -->
		@if (Auth::check())
        @include('demo.layouts.footer')
		@endif
		<!-- End Footer Section -->	




		<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('js/tiny-slider.js')}}"></script>
		<script src="{{asset('js/custom.js')}}"></script>
		@yield('script')
	</body>

</html>
