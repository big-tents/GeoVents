@extends('templates.v1')

@section('content')
@include('common.message')

<!-- Onload JavaScript -->
<script>
$().ready(function(){

	getEvents();

	$("#search").click(function(){
		getEvents();
	});


	$("#sort_distance").click(function(){
		sortByDistance();
	});

});

</script>
<!-- End/ onload JavaScript -->

<!--Geolocation Message-->
<p id="msg"></p>

<div class="input-group btn-group"> 
	<span class="input-group-addon">Filter</span>
	<input id="filter" name="filter" type="text" class="form-control" placeholder="Type your keywords here...">
		<button id="search" class="btn btn-default">Search</button>
		<button id="sort_distance" class="btn btn-default btn-info">Sort by distance</button>
</div>
<hr>

<!-- Sort Buttons-->


<!-- Events Table -->
<div id="tableless">
<table id="events_table" class="table table-hover .table-condensed">
	
	<!-- Events Table Header -->
	<thead>
		<tr>
			<th>Event Type</th>
			<th>Restriction</th>
			<th>Event Name</th>
			<th>Date</th>
			<th>Location</th>
			<th>Max. Attendees</th>
			<th id="header_distance">Distance</th>
			<th></th>
		</tr>
	</thead>
	
	<!-- Events Table Body -->
	<tbody id="events-table-body"></tbody>
</table>
</div>
<!-- /Events Table -->

@stop