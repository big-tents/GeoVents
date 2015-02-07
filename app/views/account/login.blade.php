@extends('templates.v1')

@section('content')
<h2>Login Page</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

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

	<ul>
		<li><a href="{{ URL::route('account-forgot-password') }}">Forgot Password?</a></li>
	</ul>
<hr>

@stop