<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Big Tents :: {{$title}}</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);
		body{
			font-family:Lato;
		}
		.errors{
			color:rgb(24, 2, 2);
			border:1px solid rgb(255, 0, 45);
			border-radius:3px;
			list-style-type:lower-roman;
			padding-left:35px;
			background-color:rgb(255, 135, 135);
		}
		.message{
			padding: 5px;
			border: 1px solid black;
			border-radius: 5px;
		}
		table, tr, td{
			border:1px solid lightgrey;
			border-radius:3px;
		}
	</style>
</head>
<body>
	@yield('content')
	@include('home.footer')
</body>
</html>