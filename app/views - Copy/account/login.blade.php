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
	<table class="table">
		<tr>
			<td>{{ Form::label('email', 'Email: ') }}</td>
			<td>{{ Form::email('email', Input::old('email'), ['class'=>'form-control']) }}</td>
		</tr>
		<tr>
			<td>{{ Form::label('password', 'Password: ') }}</td>
			<td>{{ Form::password('password', ['class'=>'form-control']) }}</td>
		</tr>
		<tr>
			<td>{{ Form::label('remember', 'Remember me: ') }}</td>
			<td>{{ Form::checkbox('remember', 'remember', false) }}</td>
		</tr>
		<tr>
			<td></td>
			<td>{{ Form::submit('Log in', ['class'=>'btn btn-primary btn-block']) }}</td>
		</tr>
		<tr>
			<td align="right" colspan="2"><a href="{{ URL::route('account-forgot-password') }}" class="btn btn-warning">Forgot Password?</a></td>
		</tr>
	</table>
	{{ Form::close()}}

@stop