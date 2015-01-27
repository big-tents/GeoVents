<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="BASE_URL" content="{{ URL::route('home') }}">

	<title>GeoVents :: {{$title}}</title>

	<!-- ========== EXTERNAL ========== -->
	<!-- Google font -->
	{{ HTML::style('http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700') }}

	<!-- Modernzr -->
	{{ HTML::script('http://modernizr.com/downloads/modernizr-latest.js') }}

	<!-- Google Maps API -->
	{{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true') }}

	
	<!-- ========== INTERNAL ========== -->
	<!-- Default CSS -->
	{{ HTML::style('assets/css/default.css') }}

	<!-- jQuery -->
	{{ HTML::script('assets/js/jquery-1.11.2.min.js') }}

	<!-- Google Maps (Get Geolocation) -->
	{{ HTML::script('assets/js/getGeolocation.js') }}

	<!-- Initilization -->
	{{ HTML::script('assets/js/init.js') }}

</head>
<body>
	@yield('content')
	@include('home.footer')
</body>
</html>