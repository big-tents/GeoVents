@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
<hr/>
{{ Form::open(['url'=>URL::route('event-host-post'), 'method'=>'POST']) }}

<table class="table">
	<tr>
		<td>{{ Form::label('event_name', 'Event Name: ') }}</td>
		<td>{{ Form::text('event_name', Input::old('event_name'), ['class'=>'form-control'])}}</td>
	</tr>
	<tr>

		<td>{{ Form::label('event_type', 'Event Type: ') }}</td>
		<td>{{ Form::text('event_type', null, ['id'=>'e_type', 'list'=>'event_type', 'class'=>'form-control'], Input::old('event_type')) }}</td>
		<datalist id="event_type"></datalist>
	</tr>
	<tr>
		
	<script>
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy', altField: '#event_date'});
  });
  </script>
		<td>{{ Form::label('event_date', 'Event Date:') }}</td>
		<!-- <td>{{ Form::input('text', 'event_date', null, ['class'=>'datepicker']) }}</td> -->
		<td><div class="datepicker"></div></td>
		{{ Form::input('hidden', 'event_date') }}
	</tr>
	<tr>
		<td>{{ Form::label('event_location', 'Event Location: ') }}</td>
		<td>
			{{ Form::text('event_location', Input::old('event_location'), ['class'=>'form-control'])}}

			<!-- default Lancaster's LatLng values -->
			<br/>{{ Form::input('hidden', 'EventLatitude', 54.0103942, ['id'=>'EventLatitude']) }}
			<br/>{{ Form::input('hidden', 'EventLongitude', -2.78772939999998932, ['id'=>'EventLongitude']) }}
		</td>
	</tr>
	<tr>
		<td colspan="2">
			*Drag the marker on the map to indicate your location
			<div id="map-canvas"></div>
		</td>
	</tr>
	<tr>
		<td>{{ Form::label('max_attendees', 'Maximum Attendees: ') }}</td>
		<td>{{ Form::input('number', 'max_attendees', 8, ['class'=>'form-control']) }}</td>
	</tr>
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
@stop
