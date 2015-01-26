<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeoVents :: {{$title}}</title>

	<!-- ========== EXTERNAL ========== -->
	<!-- Google font -->
	{{ HTML::style('http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700') }}

	<!-- jQuery -->
	{{ HTML::script('js/jquery-1.11.2.min.js') }}

	<!-- Modernzr -->
	{{ HTML::script('http://modernizr.com/downloads/modernizr-latest.js') }}

	<!-- Google Maps API -->
	{{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true') }}

	
	<!-- ========== INTERNAL ========== -->
	<!-- Default CSS -->
	{{ HTML::style('css/default.css') }}
	
	<!-- Google Maps (Get Geolocation) -->
	{{ HTML::script('js/getGeolocation.js') }}

	<!-- Initilization -->
	{{ HTML::script('js/init.js') }}
	

</head>
<body>
	@yield('content')
	@include('home.footer')
</body>
</html>