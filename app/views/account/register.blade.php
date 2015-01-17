@extends('templates.default')

@section('content')
<h2>Register Page</h2>
<hr>
@include('home.nav')

	<!-- If there's error -->
	@if($errors->has())
		<ul>
			{{ $errors->first('username', '<li>:message</li>') }}
			{{ $errors->first('profile_name', '<li>:message</li>') }}
			{{ $errors->first('password', '<li>:message</li>') }}
			{{ $errors->first('password_again', '<li>:message</li>') }}
			{{ $errors->first('email', '<li>:message</li>') }}
			{{ $errors->first('account_type', '<li>:message</li>') }}
		</ul>
	@endif

	<!-- Register Field -->
	{{ Form::open(['url'=>URL::route('account-register-post'), 'method'=>'POST']) }}
	
	{{ Form::token() }}
		<p>
			{{ Form::label('account_type', 'Account type: ') }}
			{{ Form::select('account_type', [
				'0'=>'Student',
				'1'=>'Organization'
			]) }}
		</p>
		<p>
			{{ Form::label('username', 'Username: ') }}
			{{ Form::text('username', Input::old('username')) }}
		</p>
		<p>
			{{ Form::label('profile_name', 'Profile Name: ') }}
			{{ Form::text('profile_name', Input::old('profile_name'))}}
		</p>
		<p>
			{{ Form::label('password', 'Password: ') }}
			{{ Form::password('password')}}
		</p>		

		<p>
			{{ Form::label('password', 'Password again: ') }}
			{{ Form::password('password_again')}}
		</p>

		<p>
			{{ Form::label('email', 'Email: ') }}
			{{ Form::email('email', Input::old('email')) }}
		</p>
		
		{{ Form::submit('Register account') }}

	{{ Form::close() }}
<!-- Register Field Ends-->

<hr>
@include('home.footer')
@stop