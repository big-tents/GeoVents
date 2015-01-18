@extends('templates.default')

@section('content')
<h2>Settings</h2>
<hr>

@include('home.nav')
@include('common.message')

<!-- If there's error -->
@if($errors->has())
	<ul class="errors">
		{{ $errors->first('old_password', '<li>:message</li>') }}
		{{ $errors->first('new_password', '<li>:message</li>') }}
		{{ $errors->first('new_password_again', '<li>:message</li>') }}
	</ul>
@endif

<!-- Change Password Form -->
{{ Form::open(['url'=>URL::route('account-settings'), 'method'=>'POST']) }}
{{ Form::token() }}

<table>
	<tr>
		<td>{{ Form::label('old_password', 'Old password: ') }}</td>
		<td>{{ Form::password('old_password') }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('new_password', 'New password: ') }}</td>
		<td>{{ Form::password('new_password') }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('new_password_again', 'New password again: ') }}</td>
		<td>{{ Form::password('new_password_again') }}</td>
	</tr>
	<tr>
		<td></td>
		<td>{{ Form::submit('Update Settings') }}</td>
	</tr>
</table>

{{ Form::close() }}
<hr>

@stop