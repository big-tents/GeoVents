@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
<hr/>
{{ Form::open(['url'=>URL::route('profile-create-post'), 'method'=>'POST']) }}

<table>
	<tr>
		<td>{{ Form::label('profile_name', 'Profile Name: ') }}</td>
		<td>{{ Form::text('profile_name', Input::old('profile_name'))}}</td>
	</tr>
	<tr>
		<td>{{ Form::label('description', 'Description: ') }}</td>
		<td>{{ Form::textarea('description', Input::old('description'))}}</td>
	</tr>
	<tr>
		<td>{{ Form::label('img_url', 'Image Url: ') }}</td>
		<td>{{ Form::text('img_url', Input::old('img_url'))}}</td>
	</tr>
</table>

{{ Form::submit('Create Profile') }}
{{ Form::close() }}
<hr>
@stop
