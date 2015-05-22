@extends('templates.v2')

@section('content')
<section class="page-general">
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')
	
<!-- FORM FIELDS -->
{{ Form::open(['url'=>URL::route('profile-edit-post'), 'method'=>'POST']) }}

<table class="table">
	<tr>
		<td>{{ Form::label('profile_name', 'Profile Name: ') }}</td>
		<td>{{ Form::label('profile_name', $profile_name)}}</td>
	</tr>
	<tr>
		<td>{{ Form::label('description', 'Description: ') }}</td>
		<td>{{ Form::textarea('description', $description, ['class'=>'form-control'])}}</td>
	</tr>
	<tr>
		<td>{{ Form::label('img_url', 'Image Url: ') }}</td>
		<td>{{ Form::text('img_url', $img_url, ['class'=>'form-control'])}}</td>
	</tr>
</table>
{{ Form::submit('Edit Profile' , ['class'=>'btn btn-danger']) }}
{{ Form::close() }}
</section>
@stop