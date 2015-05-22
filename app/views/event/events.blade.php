@extends('templates.v2')

@section('content')

<!-- Onload JavaScript -->
<script>
$().ready(function(){
	// $("#lat").html($.cookie('client_latitude'));
	// $("#lng").html($.cookie('client_longitude'));
	
	getEvents();

	$("#search").click(function(){
		getEvents();
		// setInterval(function () {sortByDistance(0)}, 1000);
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

<style>
	#events_near{
		display:none;	
	}
	#content-holder{
		top:30px;
		max-height:750px
	}
</style>
<!--Geolocation Message-->
<p id="msg"></p>

<!-- Search Events -->
<article id="events_search">
    <h3>Search events<span id="noOfFoundEvents"></span></h3>
    <input type="text" name="filter" placeholder="Type your keywords here..." class="bs-input bs-search">
    <button id="search" class="bs-input bs-btn-search">Search!</button>
    <button id="sort_distance" class="bs-input bs-small">Sort by distance</button>
    <button id="update_location" class="bs-input bs-small">Update my location</button>

</article><!-- /Search Events -->



<!-- Events Table -->
<div id="tableless">
<table id="events_table" class="table table-hover">
	
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
	<tbody id="events-table-body">
		<span id="events-table-msg"></span>
	</tbody>
</table>
</div>
<!-- /Events Table -->

@stop