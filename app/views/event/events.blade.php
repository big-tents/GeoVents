@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- <article role="events_container">
<header role="events_header">
	<span>Events List</span>
	<span>Active Events: 100</span>
</header> -->

<!-- <small class="little_note">** Bare in mind this page is not functional yet.</small> -->

<!-- Events Filter-->
<!-- <aside role="events_filter">
	<h4>Filter Events</h4>
	<p>Using the filters below limit the events displayed to match only your desired parameters.</p>
	<table class="table">
			<tr>
				<td>{{ Form::label('e_name', 'Event Name:') }}</td>
				<td>{{ Form::text('e_name', Input::old('e_name')) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('e_type', 'Event Type:') }}</td>
				<td>{{ Form::text('e_type', Input::old('e_type')) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('e_date', 'Date: ') }}</td>
				<td>{{ Form::input('date', 'e_date', Input::old('e_date')) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('tt_attendees', 'Total Attendees: ') }}</td>
				<td>{{ Form::input('number', 'tt_attendees') }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('e_location', 'Location:') }}</td>
				<td>{{ Form::text('e_location', Input::old('e_location')) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('e_distance', 'Distance:') }}</td>
				<td>{{ Form::text('e_distance', Input::old('e_distance')) }}</td>
			</tr>
			<tr>
				<td>Organizer: </td>
				<td>
					<p>{{ Form::radio('e_organizer', 'Student', false, ['id'=>'e_student']) }} {{ Form::label('e_student', 'Student') }}</p>
					<p>{{ Form::radio('e_organizer', 'Organization', false, ['id'=>'e_organizer']) }} {{ Form::label('e_organizer', 'Organization') }}</p>
				</td>
			</tr>
			<tr>
				<td colspan="2">{{ Form::submit('Filter Events', ['style'=>'float:right;']) }}</td>
			</tr>
		</table>	
</aside>
 -->
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