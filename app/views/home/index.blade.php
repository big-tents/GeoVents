@extends('templates.default')

@section('content')
<h2>Home Page</h2>
<hr>
@include('home.nav')

<!-- If there's message  -->
@if(Session::has('message'))
	{{ Session::get('message') }}
@endif

<h3>Content</h3>
<hr>

@include('home.footer')
@stop