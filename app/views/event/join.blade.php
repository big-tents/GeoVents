@extends('templates.v1')

@section('content')
<h2>{{ $title }} 
	@if($isJoined) <span style="color:green;font-weight:bold;">(Joined)</span> @endif
	@if($isHost) <span style="color:red;font-weight:bold;">(Host)</span> @endif
</h2>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
<hr/>
<!-- If user has already joined this event -->
@if($isJoined)
	{{ Form::open(['url'=>URL::route('event-leave-request'), 'method'=>'POST']) }}

<!-- If user is a host -->
@elseif($isHost)
	{{ Form::open(['url'=>URL::route('event-delete'), 'method'=>'POST']) }}

<!-- If user has NOT joined this event -->
@else
	{{ Form::open(['url'=>URL::route('event-join-request'), 'method'=>'POST']) }}
@endif

<table class="table table-hover">
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
		<td colspan="2">

		<!-- If user has already joined this event -->
		@if($isJoined)
			{{ Form::submit('Leave Event', ['class'=>'btn btn-block btn-danger']) }}

		<!-- If user is the host of the event -->
		@elseif ($isHost)
			{{ Form::submit('Delete Event', ['class'=>'btn btn-block btn-danger']) }}

		<!-- If user has NOT joined this event -->
		@else
			{{ Form::submit('Join', ['class'=>'btn btn-block btn-primary']) }}
		@endif

		</td>
	</tr>
	</table>

<!-- HIDDEN VALUES -->
{{ Form::input('hidden', 'event_id', $e->id) }}
{{ Form::input('hidden', 'audience', $e->audience) }}
{{ Form::input('hidden', 'EventLongitude', $e->e_lng, ['id'=>'EventLongitude']) }}
{{ Form::input('hidden', 'EventLatitude', $e->e_lat, ['id'=>'EventLatitude']) }}

{{ Form::close() }}

<script>google.maps.event.addDomListener(window, 'load', initialize);</script>
@stop
