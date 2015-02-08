@extends('templates.v1')

@section('content')
<h2>Register Page</h2>
<hr>


	<!-- If there's error, show errors -->
	@include('common.errors')

	<!-- Register Field -->
	{{ Form::open(['url'=>URL::route('account-register-post'), 'method'=>'POST']) }}
	
	{{ Form::token() }}
		<table class="table">
			<tr>
				<td>{{ Form::label('account_type', 'Account type: ') }}</td>
				<td>
					{{ Form::select('account_type', [
						'0'=>'Student',
						'1'=>'Organization'
					]) }}
				</td>
			</tr>
			<tr>
				<td>{{ Form::label('username', 'Username: ') }}</td>
				<td>{{ Form::text('username', Input::old('username'), ['class'=>'form-control']) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('password', 'Password: ') }}</td>
				<td>{{ Form::password('password', ['class'=>'form-control'])}}</td>
			</tr>
			<tr>
				<td>{{ Form::label('password', 'Password again: ') }}</td>
				<td>{{ Form::password('password_again', ['class'=>'form-control'])}}</td>
			</tr>
			<tr>
				<td>{{ Form::label('email', 'Email: ') }}</td>
				<td>{{ Form::email('email', Input::old('email'), ['class'=>'form-control']) }}</td>
			</tr>
			<tr>
				<td></td>
				<td>{{ Form::submit('Register account', ['class'=>'btn btn-block btn-primary']) }}</td>
			</tr>
		</table>

	{{ Form::close() }}
<!-- Register Field Ends-->

<hr>
@stop