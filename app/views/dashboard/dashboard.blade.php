@extends('templates.v1')

@section('content')
<h2>{{ $title }}</h2>
<hr>

@include('common.message')

<!-- If there's error, show errors -->
@include('common.errors')

<table>
	<tr>
		<td>Event(s) you have joined:</td>
		<td>
			@foreach($joined_events as $je)
				<li><a href="event/{{ $je->event->first()->id }}">{{ e($je->event->first()->e_name) }}</a></li>
			@endforeach
		</td>
	</tr>
	<tr>
		<td>Event(s) you have hosted:</td>
		<td>
			@foreach($hosted_events as $he)
				<li><a href="event/{{ $he->event->first()->id }}">{{ e($he->event->first()->e_name) }}</a></li>
			@endforeach
		</td>
	</tr>
</table>
<hr/>

<hr>
@stop
