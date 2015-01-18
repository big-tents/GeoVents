@extends('templates.default')

@section('content')
<h2>Home Page</h2>
<hr>

@include('home.nav')
@include('common.message')

@if(Auth::check())
	<p>This is what user will see when they login</p>
	<p>[[you can edit this page at views/home/index.blade.php]]</p>
@else
	<p>When user is not logged, this message will be here FOREVER.</p>
	<p>[[you can edit this page at views/home/index.blade.php]]</p>
@endif

<hr>

@stop