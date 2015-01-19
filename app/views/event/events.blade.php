@extends('templates.default')

@section('content')
<h2>Events Page</h2>
<hr>

@include('home.nav')
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
				<td>Event Name: </td>
				<td>{{ Form::text('e_name', Input::old('e_name')) }}</td>
			</tr>
			<tr>
				<td>Event Type: </td>
				<td>{{ Form::text('e_type', Input::old('e_type')) }}</td>
			</tr>
			<tr>
				<td>Date: </td>
				<td>{{ Form::input('date', 'e_date', Input::old('e_date')) }}</td>
			</tr>
			<tr>
				<td>Total Attendees</td>
				<td>{{ Form::input('number', 'tt_attendees') }}</td>
			</tr>
			<tr>
				<td>Location: </td>
				<td>{{ Form::text('e_location', Input::old('e_location')) }}</td>
			</tr>
			<tr>
				<td>Distance: </td>
				<td>{{ Form::text('e_distance', Input::old('e_distance')) }}</td>
			</tr>
			<tr>
				<td>Organizer: </td>
				<td>
					<p>{{ Form::radio('e_organizer', 'Student', true) }} Student</p>
					<p>{{ Form::radio('e_organizer', 'Organization', true) }} Organization</p>
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
		@foreach ($events as $event)
		<tr>
			<td>{{ $event->id }}</td>
			<td>{{ $event->e_type }}</td>
			<td>{{ $event->e_name }}</td>
			<td>{{ $event->e_date }}</td>
			<td>{{ $event->e_location }}</td>
			<td>0/{{ $event->total_attendees }}</td>
			<td>{{ $event->status }}</td>
			<td>{{ $event->created_at }}</td>
			<td><a href="">Join</a></td>
		</tr>
		@endforeach
		<tr class="events_buttons">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="2">{{ Form::submit('Refresh List') }}</td>
			<td colspan="3">{{ Form::submit('Host Event') }}</td>
		</tr>
	</table>
</aside>

</article>
<hr>

@stop