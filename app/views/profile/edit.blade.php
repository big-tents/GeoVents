@extends('templates.default')

@section('content')
<h2>Edit Profile</h2>
<hr>

@include('home.nav')
@include('common.message')

<!-- If there's error -->
@if($errors->has())
	<ul class="errors">
		{{ $errors->first('description', '<li>:message</li>') }}
	</ul>
@endif

<!-- FORM FIELDS -->
<hr/>
{{ Form::open(['url'=>URL::route('profile-edit-post'), 'method'=>'POST']) }}

<table>
	<tr>
		<td>{{ Form::label('profile_name', 'Profile Name: ') }}</td>
		<td>{{ Form::label('profile_name', $profile_name)}}</td>
	</tr>
	<tr>
		<td>{{ Form::label('description', 'Description: ') }}</td>
		<td>{{ Form::textarea('description', $description)}}</td>
	</tr>
	<tr>
		<td>{{ Form::label('img_url', 'Image Url: ') }}</td>
		<td>{{ Form::text('img_url', $img_url)}}</td>
	</tr>
</table>
{{ Form::submit('Edit Profile') }}
{{ Form::close() }}
<hr>
@stop
