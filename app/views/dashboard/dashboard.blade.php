@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<!-- Joined Events -->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Event(s) You have joined:</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			@foreach($joined_events as $je)
				<tr>
					<td><a href="event/{{ $je->event->first()->id }}">{{ e($je->event->first()->e_name) }}</a></td>
					<td>{{ link_to_action('invite-remove', 'Leave Event', array('user' => $je->host_id, 'event' => $je->event_id )) }}</td>				</tr>
			@endforeach
		</table>
	</div>
</div>


<hr>

<!-- Hosted Events -->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Event(s) You have hosted:</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			@foreach($hosted_events as $he)
				<tr>
					<td>
					<a href="event/{{ $he->id }}">
					{{ $he->e_name }} ({{ count(json_decode($he['attendees'], true)) }})
					</a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>


<hr>

<!-- Friends -->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Your Friend(s):</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			@foreach($friends as $fr)
				<tr>
					<td>{{  $fr->username }}</td>
					<td>{{ link_to_action('friend-remove', 'Remove', array('id' => $fr->id)) }}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>


@stop
