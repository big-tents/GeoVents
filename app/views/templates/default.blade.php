<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);
	</style>
</head>
<body>
	@yield('content')
	@include('home.footer')
</body>
</html>