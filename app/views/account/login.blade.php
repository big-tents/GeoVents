@extends('templates.default')

@section('content')
<h2>Login Page</h2>
<hr>
@include('home.nav')

	<!-- If there's message  -->
	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif

	<!-- If there's error -->
	@if($errors->has())
		<ul>
			{{ $errors->first('email', '<li>:message</li>') }}
			{{ $errors->first('password', '<li>:message</li>') }}
		</ul>
	@endif

	<!-- Login Field -->
	{{ Form::open(['url'=>URL::route('account-login-post'), 'method'=>'POST']) }}
	
	{{ Form::token() }}

	<p>
		{{ Form::label('email', 'Email: ') }}
		{{ Form::email('email', Input::old('email')) }}
	</p>

	<p>
		{{ Form::label('password', 'Password: ') }}
		{{ Form::password('password') }}
	</p>

	<p>
		{{ Form::label('remember', 'Remember me: ') }}
		{{ Form::checkbox('remember', 'remember', false) }}
	</p>

	<p>
		{{ Form::submit('Log in') }}
	</p>

	{{ Form::close()}}
<hr>

@stop