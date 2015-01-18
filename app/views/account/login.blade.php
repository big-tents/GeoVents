@extends('templates.default')

@section('content')
<h2>Login Page</h2>
<hr>

@include('home.nav')
@include('common.message')

	<!-- If there's error -->
	@if($errors->has())
		<ul class="errors">
			{{ $errors->first('email', '<li>:message</li>') }}
			{{ $errors->first('password', '<li>:message</li>') }}
		</ul>
	@endif

	<!-- Login Field -->
	{{ Form::open(['url'=>URL::route('account-login-post'), 'method'=>'POST']) }}
	
	{{ Form::token() }}
	<table>
		<tr>
			<td>{{ Form::label('email', 'Email: ') }}</td>
			<td>{{ Form::email('email', Input::old('email')) }}</td>
		</tr>
		<tr>
			<td>{{ Form::label('password', 'Password: ') }}</td>
			<td>{{ Form::password('password') }}</td>
		</tr>
		<tr>
			<td>{{ Form::label('remember', 'Remember me: ') }}</td>
			<td>{{ Form::checkbox('remember', 'remember', false) }}</td>
		</tr>
		<tr>
			<td></td>
			<td>{{ Form::submit('Log in') }}</td>
		</tr>
	</table>
	{{ Form::close()}}
<hr>

@stop