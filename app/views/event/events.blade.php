@extends('templates.v1')

@section('content')
@include('common.message')

<!-- EVENTS TABLE -->
<!-- <aside role="events_all"> -->
	<table class="table table-hover .table-condensed">
	<thead>
		<tr>
			<th>#</th>
			<th>Event Type</th>
			<th>Restriction</th>
			<th>Event Name</th>
			<th>Date</th>
			<th>Location</th>
			<th>Max. Attendees</th>
			<th>Status</th>
			<th>Created at</th>
		</tr>
	</thead>

	<tbody>

		<!--FOR LOOP-->
		@foreach ($events as $e)
		
		<!-- IF LOGGED -->
		@if(Auth::check())
			<!--If you're the host-->
			@if($e->user_id == Auth::user()->id)
				<tr class="active">

			<!-- If you've already joined the event -->
			@elseif(in_array($e->id, $joined_events_id))
				<tr class="active">
			@else
				<tr>
			@endif
		@endif

			<td>{{ $e->id }}</td>
			<td>{{ e($e->eventType->type) }}</td>
			<td>{{ e($e->audience) }}</td>
			<td>{{ e($e->e_name) }}</td>
			<td>{{ date('d/m/Y', $e->e_date) }}</td>
			<td>{{ e($e->e_location) }}</td>
			<td>{{ $e->total_attendees }}</td>
			<td>{{ $e->status }}</td>
			<td>{{ $e->created_at }}</td>
		
		<!-- IF LOGGED -->
		@if(Auth::check())
			<!--If you're the host-->
			@if($e->user_id == Auth::user()->id)
				<td><a href="event/{{ $e->id }}" class="btn btn-danger">Host</a></td>

			<!-- If you've already joined the event -->
			@elseif(in_array($e->id, $joined_events_id))
				<td><a href="event/{{ $e->id }}" class="btn btn-warning">View</a></td>
			@else
				<td><a href="event/{{ $e->id }}" class="btn btn-success">Join</a></td>
			@endif
		@endif

		</tr>

		@endforeach
		<tr class="events_buttons">
			<td colspan="5"></td>
			<td colspan="2"><a class="btn btn-default btn-block" href="{{ URL::route('events') }}">Refersh List</a></td>
			
			<!-- If Logged -> Show host event button -->
			@if(Auth::check())
				<td colspan="3"><a class="btn btn-default btn-block btn-primary" href="{{ URL::route('event-host') }}">Host Event</a></td>
			@endif
		</tr>
	</tbody>
	</table>
<!-- </aside> -->

</article>
<hr>

@stop