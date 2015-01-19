<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Big Tents :: {{$title}}</title>
	{{ HTML::style('css/default.css') }}
</head>
<body>
	@yield('content')
	@include('home.footer')
</body>
</html>