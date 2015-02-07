@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- Change Password Form -->
{{ Form::open(['url'=>URL::route('account-delete'), 'method'=>'POST']) }}
{{ Form::token() }}

	<div class="warning">
		
		<p>WARNING: Deleteing your account will completely remove ALL content associated with it.</p>
		<p>There is no way back, are you sure you want to do that :(?</p>
		<hr>
		{{ Form::submit('DELETE MY ACCOUNT', ['class'=>'form']) }}
		{{ Form::close() }}
	</div>
{{ Form::close() }}

<hr>
@stop