var geocoder;
var map;
var marker;

//Google Map Initialization
function initialize() {
	geocoder = new google.maps.Geocoder();

	var averageLatitude = $("#EventLatitude").val();
	var averageLongitude = $("#EventLongitude").val();

	var latlng = new google.maps.LatLng(averageLatitude, averageLongitude);

	mapOptions = {
		streetViewControl: false,
		zoom: 14,
		scrollwheel: false,
		center: latlng
	}

	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	marker = new google.maps.Marker({
		position: new google.maps.LatLng(averageLatitude, averageLongitude),
		draggable: true,
		map: map
	});

	google.maps.event.addListener(marker, "dragend", function () {
		var position = marker.getPosition();
		map.panTo(position);
		$("#EventLatitude").val(position.lat());
		$("#EventLongitude").val(position.lng());
	});

    google.maps.event.addListener(map, "center_changed", function() {
        var position = map.getCenter();
        marker.setPosition(position);
        $("#EventLatitude").val(position.lat());
        $("#EventLongitude").val(position.lng());
    });
}

//getGeoLocationFromMap
function getGeoLocationFromMap() {
  var address = document.getElementById('event_location').value;
  
  // North-East and South-West of the UK
   var ne = new google.maps.LatLng(59.00, 2.00);
   var sw = new google.maps.LatLng(50.00, -7.60);

   // Define bounding box for drawing
   var boundingBoxPoints = [
      ne, new google.maps.LatLng(ne.lat(), sw.lng()),
      sw, new google.maps.LatLng(sw.lat(), ne.lng()), ne
   ];

   // Show bounding box on map   
   new google.maps.Polyline({
      path: boundingBoxPoints,
      strokeColor: 'red',
      strokeOpacity: 0.5,
      strokeWeight: 5,
      map: map
   });


  geocoder.geocode( 
  	{
		'address': address,
		'region':  'uk',
		'bounds':  new google.maps.LatLngBounds(sw, ne)
  	}, 
  	function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {

      var location = results[0].geometry.location;

      map.setCenter(location);
      map.setZoom(16);
      marker.setPosition(location);

    }else{
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
