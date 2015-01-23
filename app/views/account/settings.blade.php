@extends('templates.default')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('home.nav')
@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- Change Password Form -->
{{ Form::open(['url'=>URL::route('account-settings'), 'method'=>'POST']) }}
{{ Form::token() }}

<table>
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
		<td>{{ Form::password('old_password') }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('new_password', 'New password: ') }}*</td>
		<td>{{ Form::password('new_password') }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('new_password_again', 'New password again: ') }}*</td>
		<td>{{ Form::password('new_password_again') }}</td>
	</tr>
	<tr>
		<td></td>
		<td>{{ Form::submit('Update Settings') }}</td>
	</tr>
</table>

{{ Form::close() }}

<a href="{{ URL::route('account-delete') }}">Delete my account</a>

<hr>
@stop