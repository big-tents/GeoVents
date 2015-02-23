@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<table class="table table-hover .table-condensed">
	<thead>
		<tr>
			<th>Friend Request(s)</th>
			<th>Accept</th>
			<th>Decline</th>
	</thead>

	<tbody>

		@foreach ($afr as $fuser)

			<tr>	
				<td><a href="user/{{ $fuser->username }}">{{ $fuser->username }}</a></td>
				<td>{{ link_to_action('friend-accept', 'Accept', array('id' => $fuser->id)) }}</td>
				<td>{{ link_to_action('friend-remove', 'Decline', array('id' => $fuser->id)) }}</td>
			</tr>


		@endforeach


	</tbody>
</table>

<hr>

<table class="table table-hover .table-condensed">
	<thead>
		<tr>
			<th>Befriend User</th>
			<th>Invite</th>
	</thead>

	<tbody>

		@foreach ($nfr as $fuser)

			<tr>
				<td><a href="user/{{ $fuser->username }}">{{ $fuser->username }}</a></td>
				<td>{{ link_to_action('friend-request', 'Send', array('id' => $fuser->id)) }}</td>
			</tr>

		@endforeach

	</tbody>
</table>


@stop
