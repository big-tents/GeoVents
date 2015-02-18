@extends('templates.v1')

@section('content')
@include('common.message')

<div class="input-group"> 
	<span class="input-group-addon">Filter</span>
	<input id="filter" name="filter" type="text" class="form-control" placeholder="Type your keywords here...">
</div>

<table class="table table-hover .table-condensed">
	<thead>
		<tr>
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

	<tbody id="events-table-body"></tbody>

</table>

@stop