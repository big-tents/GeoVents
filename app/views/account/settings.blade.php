@extends('templates.v2')

@section('content')
<h2>{{ $title }}</h2>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- Change Password Form -->
{{ Form::open(['url'=>URL::route('account-settings'), 'method'=>'POST']) }}
{{ Form::token() }}

<table class="table table-hover">
	<tr>
		<td>Username: </td>
		<td>{{ $user->username }}</td>
	</tr>
	<tr>
		<td>Email: </td>
		<td>{{ $user->email }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('old_password', 'Old password: ') }}*</td>
		<td>{{ Form::password('old_password', ['class'=>'form-control']) }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('new_password', 'New password: ') }}*</td>
		<td>{{ Form::password('new_password', ['class'=>'form-control']) }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('new_password_again', 'New password again: ') }}*</td>
		<td>{{ Form::password('new_password_again', ['class'=>'form-control']) }}</td>
	</tr>
	<tr>
		<td></td>
		<td>{{ Form::submit('Update Settings', ['class'=>'btn btn-primary']) }}</td>
	</tr>
</table>

{{ Form::close() }}

<a href="{{ URL::route('account-delete') }}" class="btn btn-danger">Delete my account</a>

<hr>
@stop