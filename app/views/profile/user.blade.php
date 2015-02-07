@extends('templates.v1')

@section('content')
<h2>{{ ucfirst($title) }}</h2>
<hr>

@include('common.message')

<!-- User Profile Area -->
<table>
	<tr>
		<td>
			<img style="width: 100px; height: 100px;" src="{{$profile->image}}"/>
			<center>{{ e($profile->profile_name) }}</center>
		</td>
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
		<td><center><a href="{{ e(URL::route('profile-edit')) }}"/>Edit Profile</a></center></td>
	</tr>
</table>
<!-- User Profile Area Ends -->

<hr>
@stop