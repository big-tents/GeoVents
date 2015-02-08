@extends('templates.v1')

@section('content')
<h2>{{ $title }} @if($isJoined) <span style="color:green;font-weight:bold;">(Joined)</span> @endif</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
<hr/>
<!-- If user has alread joined this event -->
@if(!$isJoined)
	{{ Form::open(['url'=>URL::route('event-join-request'), 'method'=>'POST']) }}
@else
	{{ Form::open(['url'=>URL::route('event-leave-request'), 'method'=>'POST']) }}
<!-- If user has NOT joined this event -->

@endif

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

	<tr>
	
	<!-- If user has alread joined this event -->
	@if(!$isJoined)
		<td colspan="2">
		{{ Form::submit('Join', ['style'=>'width:100%;height:100px;']) }}
		</td>
	@else
		<td colspan="2" align='right'>
		{{ Form::submit('Leave Event') }}
		</td>
	@endif

	</tr>
	</table>

<!-- HIDDEN VALUES -->
{{ Form::input('hidden', 'event_id', $e->id) }}
{{ Form::input('hidden', 'audience', $e->audience) }}
{{ Form::input('hidden', 'EventLongitude', $e->e_lng, ['id'=>'EventLongitude']) }}
{{ Form::input('hidden', 'EventLatitude', $e->e_lat, ['id'=>'EventLatitude']) }}

{{ Form::close() }}

@stop
