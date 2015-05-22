@extends('templates.v2')

@section('content')
<section class="page-general">
<h2>{{ $title }}</h2>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
{{ Form::open(['url'=>URL::route('event-host-post'), 'method'=>'POST']) }}

<!-- <div id="map-canvas"></div> -->
<div id="map-canvas-fullscreen"></div>
<span id="btn-close-map" class="btn btn-primary">Confirm Location</span>
<table class="table">
	
	<!--////////// Event Location //////////-->
	<tr>
		<td>{{ Form::label('event_location', 'Event Location: ') }}</td>
		<td>
			{{ Form::text('event_location', Input::old('event_location'), ['class'=>'bs-input bs-max'])}}
			<!-- default Lancaster's LatLng values -->
			{{ Form::input('hidden', 'EventLatitude', 54.0103942, ['id'=>'EventLatitude']) }}
			{{ Form::input('hidden', 'EventLongitude', -2.78772939999998932, ['id'=>'EventLongitude']) }}
		</td>
	</tr>
	
	{{ Form::text('event-address', Input::old('event-address'), ['id'=>'event-address', 'class'=>'bs-input bs-max']) }}

	<div id="event-alert" class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span id="event-address-alert"></span>
	</div>

	<!--////////// Event Map //////////-->
	<tr>
		<td colspan=2>
			{{ Form::input('button', null, 'Specify your location on the map', ['id'=>'btn_map', 'class'=>'btn btn-info btn-block']) }}
		</td>
	</tr>
	


	<!--////////// Event Name //////////-->
	<tr>
		<td>{{ Form::label('event_name', 'Event Name: ') }}</td>
		<td>{{ Form::text('event_name', Input::old('event_name'), ['class'=>'bs-input bs-max'])}}</td>
	</tr>

	

	<!--////////// Event Type //////////-->
	<tr>

		<td>{{ Form::label('event_type', 'Event Type: ') }}</td>
		<td>{{ Form::text('event_type', null, ['id'=>'e_type', 'list'=>'event_type', 'class'=>'bs-input bs-max'], Input::old('event_type')) }}</td>
		<datalist id="event_type"></datalist>
	</tr>
	


	<!--////////// Event Start Date //////////-->
	<tr>
		
		<td>{{ Form::label('event_date', 'Start Date:') }}</td>
		<!-- <td>{{ Form::input('text', 'event_date', null, ['class'=>'datepicker']) }}</td> -->
		<td>
			<div id="btn_event_date" class="btn btn-default">Pick Date</div>
			<span id="chosen_event_date"></span>
			<div class="start_datepicker"></div>
		</td>
		{{ Form::input('hidden', 'event_date') }}
	</tr>
	


	<!--////////// Event End Date //////////-->
	<tr>
		
		<td>{{ Form::label('event_end_date', 'End Date:') }}</td>
		<!-- <td>{{ Form::input('text', 'event_date', null, ['class'=>'datepicker']) }}</td> -->
		<td>
			<div id="btn_event_end_date" class="btn btn-default">Pick Date</div>
			<span id="chosen_event_end_date"></span>
			<div class="end_datepicker"></div>
		</td>
		{{ Form::input('hidden', 'event_end_date') }}
	</tr>
	

	<!--////////// Event Description //////////-->
	<tr>
		<td>{{ Form::label('event_description', 'Description: ') }}</td>
		<td>{{ Form::textarea('event_description', Input::old('event_description'), ['class'=>'bs-input bs-max'])}}</td>
	</tr>
	


	<!--////////// Event Max Attendees //////////-->
	<tr>
		<td>{{ Form::label('max_attendees', 'Maximum Attendees: ') }}</td>
		<td>{{ Form::input('number', 'max_attendees', 8, ['class'=>'bs-input bs-max']) }}</td>
	</tr>
	


	<!--////////// Event Autience //////////-->
	<tr>
		<td>{{ Form::label('audience', 'Audience: ') }}</td>
		<td>

		  {{ Form::radio('audience', 0, false, ['id'=>'e_public']) }} {{ Form::label('e_public', 'Public') }}<br/>
		  {{ Form::radio('audience', 1, false, ['id'=>'e_private']) }} {{ Form::label('e_private', 'Private') }}<br/>
		  {{ Form::radio('audience', 2, false, ['id'=>'e_restricted']) }} {{ Form::label('e_restricted', 'Restricted') }}
		</td>
	</tr>
</table>

{{ Form::submit('Create Event', ['class'=>'btn btn-primary btn-block']) }}
{{ Form::close() }}
<hr>

<!-- Onload JavaScript -->
<script>
$().ready(function(){

	//Get event types
	$("#e_type").keyup(function(){
		getEventTypes();
	});

	//Get geolocation after
	$("#event-address").keyup(function(){
		getGeoLocationFromMap();
	});

	//Initilize date pickers
	$(".start_datepicker").datepicker({dateFormat: 'dd-mm-yy', altField: '#event_date'}).hide();
	$(".end_datepicker").datepicker({dateFormat: 'dd-mm-yy', altField: '#event_end_date'}).hide();

	//Toggle start date
	$("#btn_event_date").click(function(){
		$(".start_datepicker").slideToggle();
		var text = $("#btn_event_date").html() === 'Pick Date' ? "Confirm" : "Pick Date";
		$("#btn_event_date").html(text);
		$("#chosen_event_date").html($("#event_date").val()).toggle();
	});

	//Toggle end date
	$("#btn_event_end_date").click(function(){
		$(".end_datepicker").slideToggle();
		var text = $("#btn_event_end_date").html() === 'Pick Date' ? "Confirm" : "Pick Date";
		$("#btn_event_end_date").html(text);
		$("#chosen_event_end_date").html($("#event_end_date").val()).toggle();
	});
	
	// Initilize google map
	google.maps.event.addDomListener(window, 'load', initialize('map-canvas-fullscreen'));
	
	//Toggle map
	$("#btn_map").click(function(){
		$("#map-canvas-fullscreen").show();
		$("#btn-close-map").show();
		$("#event-address").show();
		google.maps.event.addDomListener(window, 'load', initialize('map-canvas-fullscreen'));

	});

	//When 'close' button is clicked
	$("#btn-close-map").click(function(){
		$("#map-canvas-fullscreen").hide();
		$("#btn-close-map").hide();
		$("#event-address").hide();
		$("#event-alert").hide();
	});

});
</script>
<!-- End/ onload JavaScript -->
</section>
@stop