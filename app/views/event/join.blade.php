@extends('templates.default')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('home.nav')
@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
<hr/>
{{ Form::open(['url'=>URL::route('event-join-request'), 'method'=>'POST']) }}
<table width=100%>
	<tr>
		<td>Event Name</td>
		<td>{{ e($e->e_name)}}</td>
	</tr>
	<tr>
		<td>Date</td>
		<td>{{ e(date('d/m/Y', $e->e_date))}}</td>
	</tr>
	<tr>
		<td>Event Location</td>
		<td>{{ e($e->e_location) }}</td>
	</tr>
	<tr>
		<td colspan="2"><div id="map-canvas"></div></td>
	</tr>
	<tr>
		<td>Total Attendees</td>
		<td>{{ e($e->total_attendees) }}</td>
	</tr>

	{{ Form::input('hidden', 'event_id', $e->id) }}
	{{ Form::input('hidden', 'audience', $e->audience) }}
	{{ Form::input('hidden', 'EventLongitude', $e->e_lng, ['id'=>'EventLongitude']) }}
	{{ Form::input('hidden', 'EventLatitude', $e->e_lat, ['id'=>'EventLatitude']) }}
	<tr>
		<td colspan="2">{{ Form::submit('Join', ['style'=>'width:100%;height:100px;']) }}</td>
	</tr>
	</table>
{{ Form::close() }}
<hr>
@stop
