@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<article role="events_container">
<header role="events_header">
	<span>Events List</span>
	<span>Active Events: 100</span>
</header>

<small class="little_note">** Bare in mind this page is not functional yet.</small>

<!-- Events Filter-->
<aside role="events_filter">
	<h4>Filter Events</h4>
	<p>Using the filters below limit the events displayed to match only your desired parameters.</p>
	<table>
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

<!-- EVENTS TABLE -->
<aside role="events_all">
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
		@foreach ($events as $e)
		<tr>
			<td>{{ $e->id }}</td>
			<td>{{ e($e->eventType->type) }}</td>
			<td>{{ e($e->e_name) }}</td>
			<td>{{ date('d/m/Y', $e->e_date) }}</td>
			<td>{{ e($e->e_location) }}</td>
			<td>{{ $e->total_attendees }}</td>
			<td>{{ $e->status }}</td>
			<td>{{ $e->created_at }}</td>
			<td><a href="event/{{ $e->id }}">Join</a></td>
		</tr>
		@endforeach
		<tr class="events_buttons">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="2"><a class="input_pretend" href="{{ URL::route('events') }}">Refersh List</a></td>
			<td colspan="3"><a class="input_pretend" href="{{ URL::route('event-host') }}">Host Event</a></td>
		</tr>
	</table>
</aside>

</article>
<hr>

@stop