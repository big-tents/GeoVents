@extends('templates.v2')


@section('content')
<section class="page-general">

@include('common.message')

<section id="profile-left">
	<aside id="profile-pic">
		<h2 style="float:right;">{{ ucfirst($title) }}</h2>
		<img style="width: 200px; height: 200px; float:left;" src="{{{$profile->image}}}" class="thumbnail"/> 
		
		<!--Edit Button-->
		@if (Auth::check() && Auth::user()->id == $user_id)
		<a href="{{ e(URL::route('profile-edit')) }}" class="profile-edit" />Edit Profile</a>
		<a href="{{ URL::route('account-settings') }}" class="profile-settings">Settings</a>
		<a href="{{ URL::route('friend') }}" class="profile-settings">Find Friends</a>
		@else
		<a href="{{ e(URL::route('friend-request', array('id' => $user_id))) }}" class="profile-edit">Befriend</a>
		@endif

	</aside>

	<!-- Friends -->
	@if (count($friends) > 0)
	<aside id="profile-friends">
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
	</aside>
	@endif
	<!-- /Friends -->

</section>

<section id="profile-right">
	<!-- Hosted Events -->
	@if (count($hosted_events) > 0)
	<aside id="profile-hosting">
		<table class="table table-hover.table-condensed">
			<thead>
				<tr>
					<th>Event(s) Hosting:</th>
					<th>People Going:</th>
				</tr>
			</thead>

			<tbody>

				@foreach($hosted_events as $he)
				<tr>
					<td>
						<a href="../event/{{ $he->id }}">{{ $he->e_name }} </a>
					</td>
					<td>
						{{ count(json_decode($he['attendees'], true)) }}
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>
	</aside>
	@endif
	<!-- /Hosted Events -->

	<!-- Joined Events -->
	@if (count($joined_events) > 0)
	<aside id="profile-joining">
		<table class="table table-hover.table-condensed">
			<thead>
				<tr>

					<th>Event(s) Going:</th>
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
	</aside>
	@endif
	<!-- Joined Events -->
	</section>
</section>
@stop
