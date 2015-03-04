@extends('templates.v1')

@section('content')
@include('common.message')

<!-- Onload JavaScript -->
<script>
$().ready(function(){
	getEvents();
	$("#filter").keyup(function(){
		getEvents();
	});

	var extractNumbersOnly = function(node)  {      
    	return $(node).text().replace(/[^0-9.]/g, ''); 
	}

	$("#sort_distance").click(function(){
		$("#events_table").tablesorter({
			sortList: [[11, 0]], 
			textExtraction: extractNumbersOnly
		}); 
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

<!-- Sort Buttons-->
<button id="sort_distance">Sort by distance</button>

<!-- Events Table -->
<table id="events_table" class="table table-hover .table-condensed">
	
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
			<th>Distance</th>
		</tr>
	</thead>
	
	<!-- Events Table Body -->
	<tbody id="events-table-body"></tbody>

</table>
<!-- /Events Table -->

@stop