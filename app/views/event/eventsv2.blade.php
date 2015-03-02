@extends('templates.v1')

@section('content')
@include('common.message')

<!-- Onload JavaScript -->
<script>
$().ready(function(){
	getLocation();
	getEvents();
	$("#filter").keyup(function(){
		getEvents();
	});
});
</script>
<!-- End/ onload JavaScript -->

<!--Geolocation Message-->
<p id="msg"></p>

<div class="input-group"> 
	<span class="input-group-addon">Filter</span>
	<input id="filter" name="filter" type="text" class="form-control" placeholder="Type your keywords here...">
</div>

<!-- Events Table -->
<table class="table table-hover .table-condensed">
	
	<!-- Events Table Header -->
	<thead>
		<tr>
			<th>lat</th>
			<th>lng</th>
			<th>#</th>
			<th>Event Type</th>
			<th>Restriction</th>
			<th>Event Name</th>
			<th>Date</th>
			<th>Location</th>
			<th>Max. Attendees</th>
			<th>Created at</th>
			<th></th>
		</tr>
	</thead>
	
	<!-- Events Table Body -->
	<tbody id="events-table-body"></tbody>

</table>
{{ Form::input('hidden', 'eLat', null, ['id'=>'eLat']) }}
{{ Form::input('hidden', 'eLag', null, ['id'=>'eLag']) }}

<!-- /Events Table -->

@stop