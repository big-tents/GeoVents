@extends('templates.v2')

@section('content')
<h2>{{ $title }}</h2>


@include('common.message')


<!-- If there's error, show errors -->
@include('common.errors')


<!-- FORM FIELDS -->
{{ Form::open(['url'=>URL::route('invite-post'), 'method'=>'POST']) }}


	
	<table class="table table-hover .table-condensed">
		<thead>
			<tr>
				<th>Event Invites: </th>
				<th>Accept </th>
				<th>Decline </th>
		</thead>

		<tbody>

			@foreach($event_invites as $einvites)
				<tr>
					<td><a href="event/{{$einvites->pivot->event_id}}">{{ EEvent::find($einvites->pivot->event_id)->e_name }}</a></td>
					<td>{{ link_to_action('invite-accept', 'Accept', array('user' => $einvites->id, 'event' => $einvites->pivot->event_id )) }}</td>
					<td>{{ link_to_action('invite-remove', 'Decline', array('user' => $einvites->id, 'event' => $einvites->pivot->event_id )) }}</td>
				</tr>
			@endforeach

		</tbody>
	</table>


	<table class="table table-hover .table-condensed">
		<thead>
			<tr>
				<th>Hosted Events</th>
				<th>Select</th>
		</thead>

		<tbody>

			<!-- Foreach hosted event -->
			@foreach($hosted_events as $he)
				<tr>
					<td><a href="event/{{ $he->id }}">{{ $he->e_name }}</a></td>
					<td>{{ Form::checkbox('events[]',   $he->id  ) }}</td>
				</tr>
			@endforeach


		</tbody>
	</table>


	<hr>


	<table class="table table-hover .table-condensed">
		<thead>
			<tr>
				<th>Friends</th>
				<th>Invite</th>
		</thead>

		<tbody>

			<!-- Foreach friend of the current user -->
			@foreach ($friends as $fuser)
				<tr>
					<td><a href="user/{{ $fuser->username }}">{{ $fuser->username }}</a></td>
					<td>{{ Form::checkbox('friends[]', $fuser->id ) }}</td>
				</tr>
			@endforeach

		</tbody>
	</table>

	

{{ Form::submit('Send Invites', ['class'=>'btn btn-primary btn-block']) }}
{{ Form::close() }}


@stop
