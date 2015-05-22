//DEFINE BASE URL
var BASE_URL = $('meta[name="BASE_URL"]').attr('content');
var locations = [['YOU', $.cookie('client_latitude'), $.cookie('client_longitude')]];

$().ready(function(){
	
	//Set client latlng cookies if not set
	if(typeof $.cookie('client_latitude') === 'undefined' || typeof $.cookie('client_longitude') === 'undefined'){
		getLocation();
		showBackgroundMap();
	}
	showBackgroundMap();
});
/**
 * Get event types
 * Path: event/host
 */
function getEventTypes(){
	$.ajax({
	     type: "GET",
	     url: BASE_URL + "/api/event-types/" + $("input[name=event_type]").val(),
		 dataType: "json",
		 success: function(json){
		 	var datalist = $("datalist");
		 	datalist.empty();
		    $.each(json, function(index, element){
		    	datalist.append("<option value='" + element.type + "'/>");
		    });
		 }
	});
}//End of getEventTypes()



/**
 * Get list of events
 * Path: event/eventsv2
 */
function getEvents(){
	locations.length = 1;
	var table = $("#events-table-body");
	table.html("Loading...");
	$.ajax({
	     type: "GET",
	     url: BASE_URL + "/api/events/" + $("input[name=filter]").val(),
		 dataType: "json",
		 success: function(data){
		 	
	 		table.empty();
	 		if(!data.length){
	 			$("#events-table-msg").html("No results were found.");
	 		}
		    $.each(data, function(index, e){
		    	var noOfFoundEvents = data.length;
		    	var client_latitude = $.cookie('client_latitude');
				var client_longitude = $.cookie('client_longitude');
		    	
		    	// Events Information
				var lat = e.e_lat;
		    	var lng = e.e_lng;
		    	var eName = e.e_name;

		    	var id = e.id;
		    	var type = e.type;
		    	var audience = (e.audience === 0) ? "Public" : (e.audience === 1) ? "Private" : "Restricted";
		    	
		    	var sdate = new Date(e.e_date * 1000);
		    	var edate = new Date(e.e_endDate * 1000);
		    	var sddmmyyyy = dateFormatter(sdate.getDate()) +'/'+ dateFormatter((sdate.getMonth()+1)) +'/'+ sdate.getFullYear();
		    	var eddmmyyyy = dateFormatter(sdate.getDate()) +'/'+ dateFormatter((sdate.getMonth()+1)) +'/'+ sdate.getFullYear();
		    	var description = htmlEntities(e.e_description).substr(0, 80) + '...';
		    	var location = e.e_location;
		    	var totalJoined = e.totalJoined;
		    	var maxAttendees = e.total_attendees;
		    	var isFull = totalJoined >= maxAttendees;
		    	var status =  isFull ? '<b><strike>' + totalJoined + ' / ' + maxAttendees + '</strike></b>' : totalJoined + ' / ' + maxAttendees;
		    	var createdAt = e.created_at;

		    	//Client infomation
		    	var pos1 = new google.maps.LatLng(client_latitude, client_longitude);
		    	var pos2 = new google.maps.LatLng(lat, lng);

		    	var distance = calculateDistance(pos1, pos2);

		    	//Cap within 5 km
		    	if(distance <= 5){
		    		locations.push([eName, lat, lng]);
		    	}
		    	
				var button = '<a href="event/' + e.id + '" class="btn btn-success">Join</a>';

		    	var tr = '<tr>';
		    	
		    	if(e.joined==1 || isFull){
		    		tr = '<tr class="active">';
		    		button = '<a href="event/' + e.id + '" class="btn btn-info">View</a>';
		    	}else if(e.hosting==1){
		    		tr = '<tr class="active">';
		    		button = '<a href="event/' + e.id + '" class="btn btn-primary">Hosting</a>';
		    	}

		    	table.append(tr +
		    	"<td>" + type + "</td>" + 
		    	"<td>" + audience + "</td>" + 
		    	"<td>" + eName + "</td>" + 
		    	"<td>" + sddmmyyyy + "</td>" + 
		    	"<td>" + eddmmyyyy + "</td>" + 
		    	"<td>" + description + "</td>" + 
		    	"<td>" + location + "</td>" + 
		    	"<td>" + status + "</td>" + 
		    	"<td>" + distance + " km"+ "</td>" + 
		    	"<td>" + button + "</td>" + 
		    	"</tr>");

		    	$("#events_table").trigger('update');
		    	$("#events-table-msg").html(noOfFoundEvents + " events found.");
		    });
			showBackgroundMap();
		 }
	});
	
}//End of getEvents()

/*
 * Escapte html entities
 * Snippet from: https://css-tricks.com/snippets/javascript/htmlentities-for-javascript/
 */
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
/**
 * Date Moth fixes
 */
function dateFormatter(date){
	return (date > 0 && date < 10) ? '0' + date : date;
}
/**
 * Get golocation 
 */
function getLocation() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }else {
        $("#msg").innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
	$.cookie('client_latitude', position.coords.latitude)
	$.cookie('client_longitude', position.coords.longitude);
}
function calculateDistance(pos1, pos2){
	return (google.maps.geometry.spherical.computeDistanceBetween(pos1, pos2) / 1000).toFixed(2);
}

/**
 * Table Sorter
 */
function findHeaderIndex(table_header){
	var index = null;
	$("#events_table thead tr th").each(function()
	{
		var colIndex = $(this).index();
		var colName = $(this).html();

		if(colName === table_header)
			index = colIndex;
	})
	return index;
}

function removeDuplicateRows(){
	var box = [];
	$("#events_table tbody .e_id").each(function(){
		var txt = $(this).text();
		if($.inArray(txt, box) !== -1){
			$(this).closest('tr').remove();
		}else{
			box.push(txt);
		}
	});
}

function sortByDistance(order){
	var order = (order==0) ? 0 : 1;
	var extractNumbersOnly = function(node)  {      
    	return $(node).text().replace(/[^0-9.]/g, ''); 
	}
	var thDistanceIndex = findHeaderIndex($("#header_distance").html());
	$("#events_table").tablesorter({
		sortList: [[thDistanceIndex, order]], 
		textExtraction: extractNumbersOnly
	});
}