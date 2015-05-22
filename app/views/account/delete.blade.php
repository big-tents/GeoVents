@extends('templates.v2')

@section('content')
<section class="page-general">
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- Change Password Form -->
{{ Form::open(['url'=>URL::route('account-delete'), 'method'=>'POST']) }}
{{ Form::token() }}
	
	
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title"><b>Warning!!!</b></h3>
	</div>
	<div class="panel-body">
	<p>There is no way back, are you sure you want to do that :(?</p>
	{{ Form::submit('DELETE MY ACCOUNT', ['class'=>'btn btn-large btn-danger']) }}
	</div>
</div>
	
	{{ Form::close() }}

{{ Form::close() }}

<hr>
</section>
@stop