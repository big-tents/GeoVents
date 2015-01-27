$().ready(function(){

	//DEFINE BASE URL
	var BASE_URL = $('meta[name="BASE_URL"]').attr('content');

	//	PATH: event/host
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

	//	Input name = event_location
	$("#event_location").change(getGeoLocationFromMap);
});