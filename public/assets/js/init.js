$().ready(function(){

	//DEFINE BASE URL
	var BASE_URL = $('meta[name="BASE_URL"]').attr('content');

	//	PATH :: event/host
	//	Input name = event_type 
	$("#e_type").keyup(function(){
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
	});

	//	PATH :: eventsv2
	//Initilize
	getEvents();

	$("#filter").keyup(function(){
		getEvents();
	});

	//Get Events
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

			    	var date = new Date(e.e_date * 1000);
			    	var ddmmyyyy = date.getDate() +'/'+ (date.getMonth()+1) +'/'+ date.getFullYear();

			    	if(e.joined==1){
			    		var tr = '<tr class="active">';
			    		var button = '<a href="event/' + e.id + '" class="btn btn-warning">View</a>';
			    	}else if(e.hosting==1){
			    		var tr = '<tr class="active">';
			    		var button = '<a href="event/' + e.id + '" class="btn btn-danger">Hosting</a>';
			    	}else{
			    		var tr = '<tr>';
			    		var button = '<a href="event/' + e.id + '" class="btn btn-success">Join</a>';
			    	}

			    	table.append(tr +
			    	"<td>" + e.id + "</td>" + 
			    	"<td>" + e.type + "</td>" + 
			    	"<td>" + e.audience + "</td>" + 
			    	"<td>" + e.e_name + "</td>" + 
			    	"<td>" + ddmmyyyy + "</td>" + 
			    	"<td>" + e.e_location + "</td>" + 
			    	"<td>" + e.total_attendees + "</td>" + 
			    	"<td>" + e.created_at + "</td>" + 
			    	"<td>" + button + "</td>" + 
			    	"</tr>");
			    });
			 }
		});
	}
	
	//	Input name = event_location
	$("#event_location").change(getGeoLocationFromMap);
});