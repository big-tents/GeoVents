@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>


<!-- Register Field -->
{{ Form::open(['url'=>URL::route('recommend-post'), 'method'=>'POST']) }}
{{ Form::token() }} 


@include('common.message')
<td>{{ Form::submit('Update Location', ['class'=>'btn btn-block btn-primary']) }}</td>
<hr>


<table class="table table-hover .table-condensed">
	<thead>
		<tr>
			<th>Locally Popular:</th>
			<th>Number of locals going to this event:</th>
		</tr>
	</thead>

	<tbody>

		@foreach($mostPvD as $key => $event)
		
			<tr>
				<td><a href="event/{{ $key }}">{{ EEvent::find($key)->e_name }}</a></td>
				<td>{{ $event }}</td>
			</tr>

		@endforeach

			<tr>
				<td>{{ Form::hidden('e_lat', '', ['id'=>'e_lat']) }}</td>
				<td>{{ Form::hidden('e_lng', '', ['id'=>'e_lng']) }}</td>
			</tr>

	</tbody>
</table>

<hr>

<table class="table table-hover .table-condensed">
	<thead>
		<tr>
			<th>Popular with friends:</th>
			<th>Number of friends going:</th>
		</tr>
	</thead>

	<tbody>

		@foreach($mostPvF as $event)

			<tr>
				<td><a href="event/{{ $event->event_id }}">{{ EEvent::find($event->event_id)->e_name }}</a></td>
				<td>{{ $event->event_count }}</td>
			</tr>

		@endforeach

	</tbody>
</table>



		
<script language="javascript" type="text/javascript">


	var e_lng = document.getElementById("e_lng");
	var e_lat = document.getElementById("e_lat");


	function getLocation() 
	{

	    if (navigator.geolocation)
	    {

	        navigator.geolocation.getCurrentPosition(setPosition);

	    } 
	    else 
	    {
	        alert("Geolocation is not supported by this browser.");
	    }

	}


	function setPosition(position)
	{
	    e_lat.value = position.coords.latitude;
	    e_lng.value = position.coords.longitude; 
	}


</script>
<script type="text/javascript">getLocation();</script>


{{ Form::close() }}



@stop
