//DEFINE BASE URL
var BASE_URL = $('meta[name="BASE_URL"]').attr('content');



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
	$.ajax({
	     type: "GET",
	     url: BASE_URL + "/api/events/" + $("input[name=filter]").val(),
		 dataType: "json",
		 success: function(data){
	 		var table = $("#events-table-body");
	 		table.empty();
	 		if(!data.length){
	 			table.html('No results were found.');
	 		}
		    $.each(data, function(index, e){
		    	var lat = e.e_lat;
		    	var lng = e.e_lng;
		    	var id = e.id;
		    	var type = e.type;
		    	var audience = e.audience;
		    	var eName = e.e_name;

		    	var date = new Date(e.e_date * 1000);
		    	var ddmmyyyy = date.getDate() +'/'+ (date.getMonth()+1) +'/'+ date.getFullYear();
		    	
		    	var location = e.e_location;
		    	var ttAttendees = e.total_attendees;
		    	var createdAt = e.created_at;
				var button = '<a href="event/' + e.id + '" class="btn btn-success">Join</a>';

		    	var tr = '<tr>';
		    		
		    	if(e.joined==1){
		    		tr = '<tr class="active">';
		    		button = '<a href="event/' + e.id + '" class="btn btn-warning">View</a>';
		    	}else if(e.hosting==1){
		    		tr = '<tr class="active">';
		    		button = '<a href="event/' + e.id + '" class="btn btn-danger">Hosting</a>';
		    	}

		    	table.append(tr +
		    	"<td>" + lat + "</td>" + 
		    	"<td>" + lng + "</td>" + 
		    	"<td>" + id + "</td>" + 
		    	"<td>" + type + "</td>" + 
		    	"<td>" + audience + "</td>" + 
		    	"<td>" + eName + "</td>" + 
		    	"<td>" + ddmmyyyy + "</td>" + 
		    	"<td>" + location + "</td>" + 
		    	"<td>" + ttAttendees + "</td>" + 
		    	"<td>" + createdAt + "</td>" + 
		    	"<td>" + button + "</td>" + 
		    	"</tr>");
		    });
		 }
	});
}//End of getEvents()

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        $("#msg").innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
   $("#eLat").val(position.coords.latitude);
   $("#eLag").val(position.coords.longitude);
}

