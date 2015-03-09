@extends('templates.v1')

@section('content')
<h2>{{ $title }}
</h2>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- FORM FIELDS -->
{{ Form::open(['url'=>URL::route('event-delete'), 'method'=>'POST']) }}

<table class="table table-hover">

    <tr>
        <td>{{ Form::label('event_name', 'Event Name: ') }}</td>
        <td>{{ Form::text('event_name', e($e->e_name)) }}</td>
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
        <td>{{ Form::label('event_description', 'Description: ') }}</td>
        <td>{{ Form::textarea('event_description', e($e->e_description)) }}</td>
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

        {{ Form::submit('Delete Event', ['class'=>'btn btn-block btn-danger']) }}
        {{ Form::submit('Delete Event', ['class'=>'btn btn-block btn-danger']) }}

        </td>
    </tr>
    </table>

<!-- HIDDEN VALUES -->
{{ Form::input('hidden', 'event_id', $e->id) }}
{{ Form::input('hidden', 'audience', $e->audience) }}
{{ Form::input('hidden', 'EventLongitude', $e->e_lng, ['id'=>'EventLongitude']) }}
{{ Form::input('hidden', 'EventLatitude', $e->e_lat, ['id'=>'EventLatitude']) }}

{{ Form::close() }}

@stop
