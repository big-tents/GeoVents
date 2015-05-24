$().ready(function(){
	$("#e_type").keyup(function(){
		$.ajax({
		     type: "GET",
		     url: "/GeoVents/public/api/event-types/" + $("input[name=event_type]").val(),
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
	$("#event_location").change(getGeoLocationFromMap);
});