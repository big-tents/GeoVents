@extends('templates.v1')

@section('content')
<h2>{{ ucfirst($title) }}</h2>
<hr>

@include('common.message')

<!-- User Profile Area -->
<table class="table .table-hover">
	<tr>
		<td colspan="2" align="center">
			<img style="width: 200px; height: 200px;" src="{{{$profile->image}}}" class="thumbnail"/>
		</td>
	</tr>
	<tr>
		<td>Profile Name: </td>
		<td>{{ e($profile->profile_name) }}</td>	
	</tr>
	<tr>
		<td>Description: </td>
		<td>{{ e($profile->description) }}</td>
	</tr>
	<tr>
		<td>Created at: </td>
		<td>{{ e($profile->created_at) }}</td>
	</tr>
	<tr>
		<td>Updated at: </td>
		<td>{{ e($profile->updated_at) }}</td>
	</tr>
	<tr>
		<!-- If Logged -->
		@if (Auth::check() && Auth::user()->id == $user_id)
		<td colspan="2"><a href="{{ e(URL::route('profile-edit')) }}" class="btn btn-primary"/>Edit Profile</a></td>
		@endif
	</tr>
</table>
<!-- User Profile Area Ends -->

<hr>
@stop