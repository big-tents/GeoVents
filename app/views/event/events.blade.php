@extends('templates.v1')

@section('content')
@include('common.message')

<!-- Onload JavaScript -->
<script>
$().ready(function(){
	// $("#lat").html($.cookie('client_latitude'));
	// $("#lng").html($.cookie('client_longitude'));
	
	getEvents();

	$("#search").click(function(){
		getEvents();
	});

	/*----- Sorting Options -----*/
	/*---------------------------*/
	$("#sort_distance").click(function(){
		sortByDistance(0);
	});

	/*Update client location*/
	$("#update_location").click(function(){
		getLocation();
	});

});

</script>
<!-- End/ onload JavaScript -->

<!--Geolocation Message-->
<p id="msg"></p>
<!-- <span id="lat">XX</span>
<span>, </span>
<span id="lng">YY</span> -->
<div class="input-group btn-group"> 
	<span class="input-group-addon">Filter</span>
	<input id="filter" name="filter" type="text" class="form-control" placeholder="Type your keywords here...">
		<button id="search" class="btn btn-default">Search</button>

		<!-- Sort Buttons-->
		<button id="sort_distance" class="btn btn-default btn-info">Sort by distance</button>
		<button id="update_location" class="btn btn-default btn-primary">Update my location</button>
</div>
<hr>




<!-- Events Table -->
<div id="tableless">
<table id="events_table" class="table table-hover .table-condensed">
	
	<!-- Events Table Header -->
	<thead>
		<tr>
			<th>Event Type</th>
			<th>Restriction</th>
			<th>Event Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Description</th>
			<th>Location</th>
			<th id="header_attendees">Max. Attendees</th>
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