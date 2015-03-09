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
		<td>Host: </td>
		<td>{{ HTML::link('user/' . $host->username, $host->username) }}</td>

	</tr>
	<tr>
		<td>Event Name</td>
		<td>{{{ e($e->e_name) }}}</td>
	</tr>
	<tr>
		<td>Start Date</td>
		<td>{{{ e(date('d/m/Y', $e->e_date)) }}}</td>
	</tr>
	<tr>
		<td>End Date</td>
		<td>{{{ e(date('d/m/Y', $e->e_endDate)) }}}</td>
	</tr>
	<tr>
		<td>Description</td>
		<td><div class="read-more-content">{{{ e($e->e_description) }}}</div> <a href="#" class="read-more">Read More...</a></td>
	</tr>
	<tr>
		<td>Event Location</td>
		<td>{{{ e($e->e_location) }}}</td>
	</tr>
	<tr>
		<td colspan="2"><div id="map-canvas"></div></td>
	</tr>
	<tr>
		<td>Total Attendees</td>
		<td>{{ e($totalJoined) }} / <b>{{ e($e->total_attendees) }}</b></td>
	</tr>
	
	<tr>
		<td>Attendees</td>
		<td>@foreach($joinedAttendees as $attendee)
		<li>{{ HTML::link('user/' . $attendee->username, $attendee->username) }}</li>
		@endforeach</td>
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

<script>

//Initilize google map
google.maps.event.addDomListener(window, 'load', initialize('map-canvas'));

//Read More 
$('.read-more').click(function(){
	content = $('.read-more-content');
	height = '35px';
	if(content.css('height') != height){
		content.stop().animate({height: height}, 100);
		$(this).text('Read More...');
	}else{
		content.css({height: '100%'});
		var xx = content.height();
		content.css({height:height});
        content.stop().animate({height: xx}, 300);
        $(this).text('Less...');
	}
});
</script>
@stop
