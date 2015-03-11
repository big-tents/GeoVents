@extends('templates.v1')

@section('content')
<h2>{{ $title }}
</h2>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
{{ Form::open(['url'=>URL::route('event-edit'), 'method'=>'POST']) }}

<!-- Google Map Canvas -->
<div id="map-canvas-fullscreen"></div>
<span id="btn-close-map" class="btn btn-primary">Close Map</span>

<!-- Table -->
<table class="table table-hover">
    

    <!--////////// Event Name //////////-->
    <tr>
        <td>{{ Form::label('event_name', 'Event Name: ') }}</td>
        <td>{{ Form::text('event_name', e($e->e_name), ['class' => 'form-control']) }}</td>
    </tr>

    <!--////////// Event Type //////////-->
    <tr>
        <td>{{ Form::label('event_type', 'Event Type: ') }}</td>
        <td>{{ Form::text('event_type', e($e_type), ['id'=>'e_type', 'list'=>'event_type', 'class'=>'form-control'], Input::old('event_type')) }}</td>
        <datalist id="event_type"></datalist>
    </tr>


    <!--////////// Start Date //////////-->
    <tr>
        <td>{{ Form::label('event_date', 'Start Date:') }}</td>
        <td>
            <div id="btn_event_date" class="btn btn-default">Pick Date</div>
            <span id="chosen_event_date">{{{ e(date('d-m-Y', $e->e_date)) }}}</span>
            <div class="start_datepicker"></div>
        </td>
        {{ Form::input('hidden', 'event_date') }}
    </tr>
   

    <!--////////// End Date //////////-->
    <tr>
        <td>{{ Form::label('event_end_date', 'End Date:') }}</td>
        <td>
            <div id="btn_event_end_date" class="btn btn-default">Pick Date</div>
            <span id="chosen_event_end_date">{{{ e(date('d-m-Y', $e->e_endDate)) }}}</span>
            <div class="end_datepicker"></div>
        </td>
        {{ Form::input('hidden', 'event_end_date') }}
    </tr>


    <!--////////// Description //////////-->
    <tr>
        <td>{{ Form::label('event_description', 'Description: ') }}</td>
        <td>{{ Form::textarea('event_description', e($e->e_description), ['class' => 'form-control']) }}</td>
    </tr>


    <!--////////// Location //////////-->
    <tr>
        <td>{{ Form::label('event_location', 'Location: ') }}</td>
        <td>
        {{ Form::text('event_location', e($e->e_location), ['class' => 'form-control']) }}

        </td>
    </tr>


    <!--////////// Map Canvas //////////-->
    <tr>
        <td colspan="2">
        {{ Form::input('button', null, 'Specify your location on the map', ['id'=>'btn_map', 'class'=>'btn btn-info btn-block']) }}
        </td>
    </tr>


    <!--////////// Total Attendees //////////-->
    <tr>
        <td>{{ Form::label('max_attendees', 'Maximum Attendees: ') }}</td>
        <td>{{ Form::text('max_attendees', e($e->total_attendees), ['class' => 'form-control']) }}</td>
    </tr>
    
<style>

</style>
    <!--////////// Attendees List //////////-->
    <tr>
        <td>Attendees <b>({{ e($totalJoined) }})</b></td>
        <td>
        <table>
        @foreach($joinedAttendees as $attendee)
        <tr>
            <td>        
                <div class="checkbox">
                    <label>
                        <input tabindex="1" type="checkbox" name="kicks[]" id="{{ $attendee->username }}" value="{{ $attendee->username }}">
                        <b>KICK</b> - {{$attendee->username }} 
                    </label>
                </div>
            </td>
            <td>({{ HTML::link('user/' . $attendee->username, 'view') }})</td>
        </tr>
        @endforeach

        </table>
        </td>
    </tr>

    <!--////////// Confirm Buttons //////////-->
    <tr>
        <td colspan="2">
        {{ Form::submit('Confirm', ['class'=>'btn btn-block btn-primary']) }}
        <!--{{ Form::submit('Delete Event', ['class'=>'btn btn-block btn-danger']) }}-->
        </td>
    </tr>
    </table>

<!-- HIDDEN VALUES -->
{{ Form::input('hidden', 'event_id', $e->id) }}
{{ Form::input('hidden', 'audience', $e->audience) }}
{{ Form::input('hidden', 'EventLongitude', $e->e_lng, ['id'=>'EventLongitude']) }}
{{ Form::input('hidden', 'EventLatitude', $e->e_lat, ['id'=>'EventLatitude']) }}

{{ Form::close() }}

<!-- Onloads JavaScript -->
<script>
$().ready(function(){

    //Get event types
    $("#e_type").keyup(function(){
        getEventTypes();
    });

    //Get geolocation after
    $("#event_location").blur(function(){
        getGeoLocationFromMap();
    });
    
    //Initilize date pickers
    $(".start_datepicker").datepicker({dateFormat: 'dd-mm-yy', altField: '#event_date', defaultDate : $("#chosen_event_date").text()}).hide();
    $(".end_datepicker").datepicker({dateFormat: 'dd-mm-yy', altField: '#event_end_date', defaultDate : $("#chosen_event_end_date").text()}).hide();

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

    //Toggle Map
    $("#btn_map").click(function(){
        $("#map-canvas-fullscreen").show();
        $("#btn-close-map").show();
        google.maps.event.addDomListener(window, 'load', initialize('map-canvas-fullscreen'));
    });

    //When 'close' button is clicked
    $("#btn-close-map").click(function(){
        $("#map-canvas-fullscreen").hide();
        $("#btn-close-map").hide();
    });

    //  Initilize google map
    google.maps.event.addDomListener(window, 'load', initialize('map-canvas-fullscreen'));
});
</script>
<!-- End/ onload JavaScript -->

@stop
