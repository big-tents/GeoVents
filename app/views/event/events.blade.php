@extends('templates.default')

@section('content')
<h2>Events Page</h2>
<hr>

@include('home.nav')
@include('common.message')

<!-- EVENTS TABLE -->
<table>
	<tr>
		<th>id</th>
		<th>Event Type</th>
		<th>Event Name</th>
		<th>Date</th>
		<th>Location</th>
		<th>Total Attendees</th>
		<th>Status</th>
		<th>Created at</th>
	</tr>
	
	<!--FOR LOOP-->
	@foreach ($events as $event)
	<tr>
		<td>{{ $event->id }}</td>
		<td>{{ $event->e_type }}</td>
		<td>{{ $event->e_name }}</td>
		<td>{{ $event->e_date }}</td>
		<td>{{ $event->e_location }}</td>
		<td>{{ $event->total_attendees }}</td>
		<td>{{ $event->status }}</td>
		<td>{{ $event->created_at }}</td>
		<td><a href="">Join</a></td>
	</tr>
	@endforeach
</table>
<hr>

@stop