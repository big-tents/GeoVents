@extends('templates.v2')


@section('content')


@include('common.message')
<img style="width: 200px; height: 200px; float:left;" src="{{{$profile->image}}}" class="thumbnail"/> 
<h2 style="float:right;">{{ ucfirst($title) }}</h2>


@if (Auth::check() && Auth::user()->id == $user_id)
<a href="{{ e(URL::route('profile-edit')) }}" class="btn btn-primary" style="float:right; margin-right:16px;" />Edit Profile</a>
@else
<a href="{{ e(URL::route('friend-request', array('id' => $user_id))) }}" style="float:right; margin-right:16px;">Befriend</a>
@endif


<div class="table-responsive col-md-4" style="width:100%;float:left;">


@if (count($hosted_events) > 0)
<div class="table-responsive col-md-4">
	<table class="table table-hover.table-condensed">
		<thead>
			<tr>
				<th>Event(s) Hosted:</th>
			</tr>
		</thead>

		<tbody>

			@foreach($hosted_events as $he)
			<tr>
				<td>
					<a href="../event/{{ $he->id }}">{{ $he->e_name }} ({{ count(json_decode($he['attendees'], true)) }})</a>
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>
</div>
@endif


@if (count($joined_events) > 0)
<div class="table-responsive col-md-4">
	<table class="table table-hover.table-condensed">
		<thead>
			<tr>

				<th>Event(s) Joined:</th>
				@if (Auth::check() && Auth::user()->id == $user_id)
					<th>Leave event:</th>
				@endif

			</tr>
		</thead>

		<tbody>

			@foreach($joined_events as $je)
			<tr>

				<td><a href="../event/{{ $je->event->first()->id }}">{{ e($je->event->first()->e_name) }}</a></td>

				@if (Auth::check() && Auth::user()->id == $user_id)
					<td>{{ link_to_action('invite-remove', 'Leave', array('user' => $je->host_id, 'event' => $je->event_id )) }}</td>			
				@endif

			</tr>
			@endforeach

		</tbody>
	</table>
</div>
@endif


@if (count($friends) > 0)
<div class="table-responsive col-md-4">
	<table class="table table-hover.table-condensed">
		<thead>
			<tr>

				<th>Your Friend(s):</th>
				@if (Auth::check() && Auth::user()->id == $user_id)
					<th>Remove Friend</th>
				@endif

			</tr>
		</thead>

		<tbody>

			@foreach($friends as $fr)
			<tr>
				<td><a href="{{ $fr->username }}">{{  $fr->username }}</a></td>

				@if (Auth::check() && Auth::user()->id == $user_id)
					<td>{{ link_to_action('friend-remove', 'Remove', array('id' => $fr->id)) }}</td>
				@endif
			</tr>
			@endforeach

		</tbody>
	</table>
</div>
@endif

</div>

@stop
