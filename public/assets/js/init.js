//DEFINE BASE URL
var BASE_URL = $('meta[name="BASE_URL"]').attr('content');
var locations = [['YOU', $.cookie('client_latitude'), $.cookie('client_longitude')]];
var markers = [];
var setDistance = 4;

var temp1 = 54.0103;
var temp2 = -2.7877;

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
	markers.length = 1;
	var noOfFoundEvents = 0;
	var table = $("#events-table-body");
	table.html("Loading...");
	$.ajax({
	     type: "GET",
	     url: BASE_URL + "/api/events/" + $("input[name=filter]").val(),
		 dataType: "json",
		 success: function(data){
	 		table.empty();
		    $.each(data, function(index, e){
		    	
		    	var client_latitude = $.cookie('client_latitude');
				var client_longitude = $.cookie('client_longitude');

		    	// Events Information
				var lat = e.e_lat;
		    	var lng = e.e_lng;
				
		    	//Client infomation
		    	var pos1 = new google.maps.LatLng(client_latitude, client_longitude);
		    	var pos2 = new google.maps.LatLng(lat, lng);

		    	var distance = calculateDistance(pos1, pos2);

		    	if(distance <= setDistance){

		    		noOfFoundEvents++;
			    	var eName = e.e_name;
			    	var id = e.id;
			    	var type = e.type;
			    	var audience = (e.audience === 0) ? "Public" : (e.audience === 1) ? "Private" : "Restricted";
			    	
			    	var sdate = new Date(e.e_date * 1000);
			    	var edate = new Date(e.e_endDate * 1000);
			    	var sddmmyyyy = dateFormatter(sdate.getDate()) +'/'+ dateFormatter((sdate.getMonth()+1)) +'/'+ sdate.getFullYear();
			    	var eddmmyyyy = dateFormatter(edate.getDate()) +'/'+ dateFormatter((edate.getMonth()+1)) +'/'+ edate.getFullYear();
			    	var description = htmlEntities(e.e_description).substr(0, 80) + '...';
			    	var location = e.e_location;
			    	var totalJoined = e.totalJoined;
			    	var maxAttendees = e.total_attendees;
			    	var isFull = totalJoined >= maxAttendees;
			    	var status =  isFull ? '<b><strike>' + totalJoined + ' / ' + maxAttendees + '</strike></b>' : totalJoined + ' / ' + maxAttendees;
			    	var createdAt = e.created_at;


					var btnView = '<span class="btn btn-info btnView" id="view_' + noOfFoundEvents +'" >View</span>';

					var btnJoin = '<a href="event/' + e.id + '" class="btn btn-success">Join</a>';

			    	var tr = '<tr>';
			    	
			    	if(e.joined==1){
			    		// tr = '<tr class="active">';
			    		btnJoin = '<a href="event/' + e.id + '" class="btn btn-info">Going</a>';
			    	}else if(e.hosting==1){
			    		// tr = '<tr class="active">';
			    		btnJoin = '<a href="event/' + e.id + '" class="btn btn-primary">Hosting</a>';
			    	}

			    	locations.push(
			    		[eName, 
			    		lat, 
			    		lng, 
			    		id, 
				    		'<div id="iw-container">' +
                    '<div class="iw-title">'+eName+' (' + sddmmyyyy + ' - '+eddmmyyyy+')</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle">'+type+'</div>' +
                      '<p>'+description+'</p>'+
                      '<p>'+btnJoin+'</p>'+
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>'
 						]);

			    	table.append(tr +
			    	// "<td>" + type + "</td>" + 
			    	// "<td>" + audience + "</td>" + 
			    	"<td>" + eName + "</td>" + 
			    	// "<td>" + sddmmyyyy + "</td>" + 
			    	// "<td>" + eddmmyyyy + "</td>" + 
			    	// "<td>" + description + "</td>" + 
			    	// "<td>" + location + "</td>" + 
			    	// "<td>" + status + "</td>" + 
			    	"<td>" + distance + " km"+ "</td>" + 
			    	"<td>" + btnView + '<span class="btnJoin">' + btnJoin +  "</span></td>" + 
			    	"</tr>");

		    	}
		    });
				for(i=1;i<=noOfFoundEvents;i++)
					addView(i);

		    	$("#events_table").trigger('update');
		    	var message = (noOfFoundEvents==0) ? ("No results were found") : (noOfFoundEvents + " events found.");
		    	$("#events-table-msg").html(message);

			showBackgroundMap();
		 }
	});
	
}//End of getEvents()

function addView(i){
	$('#view_' + i).click(function(){
		google.maps.event.trigger(markers[i+1], 'click');
	})
}
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