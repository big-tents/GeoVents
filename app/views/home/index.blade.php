@extends('templates.default')

@section('content')
<h2>Home Page</h2>
<hr>

@include('home.nav')
@include('common.message')

@if(Auth::check())

@else
	<h3>Content</h3>
@endif

<hr>

@stop