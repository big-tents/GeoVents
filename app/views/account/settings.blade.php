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

<p>
	{{ Form::label('old_password', 'Old password: ') }}
	{{ Form::password('old_password') }}
</p>

<p>
	{{ Form::label('new_password', 'New password: ') }}
	{{ Form::password('new_password') }}
</p>

<p>
	{{ Form::label('new_password_again', 'New password again: ') }}
	{{ Form::password('new_password_again') }}
</p>

<p>
	{{ Form::submit('Update Settings') }}
</p>

{{ Form::close() }}
<hr>

@stop