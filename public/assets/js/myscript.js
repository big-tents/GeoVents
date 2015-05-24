function showBackgroundMap(){
    var map;
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();
    var style = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
    var iconMe = BASE_URL + "/assets/images/me_marker.png";
    var icon = BASE_URL + "/assets/images/marker.png";
    
    //Default location if cookies not set
    if(typeof $.cookie('client_latitude') === 'undefined'){
        var client_latitude = 54.0103;
        var client_longitude = -2.7877;
        console.log("IF " + client_latitude);
        console.log("IF " + client_longitude);
    }else{
        var client_latitude = $.cookie('client_latitude');
        var client_longitude = $.cookie('client_longitude');
        console.log("ELSE " + client_latitude);
        console.log("ELSE " + client_longitude);       
    }

    var Options = {
        zoom: 14,
        maxZoom: 16,
        center:  new google.maps.LatLng(client_latitude, client_longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        styles: style
    };
    
    //Display a map on the page
    var map = new google.maps.Map($('#map')[0], Options);

    //When cookies is set
    if(typeof $.cookie('client_latitude') !== 'undefined'){

        //Display multiple locations on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        //Loop through our array of locations & place each one on the map
        for(var i=0; i<locations.length;i++){
            var position = new google.maps.LatLng(locations[i][1], locations[i][2]);
            bounds.extend(position);

            if(locations[i][0] == "YOU"){
                marker = new google.maps.Marker({
                position: position,
                map: map,
                title: locations[i][0],
                icon: iconMe,
                id: locations[i][0]
                });  
            }else{
                marker = new google.maps.Marker({
                position: position,
                map: map,
                title: locations[i][0],
                icon: icon,
                id: locations[i][3]
                });  
            }
                markers.push(marker);
            
             // Allow each marker to have an info window    
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(locations[i][4]);
                    infoWindow.open(map, marker);
                    map.panTo(marker.getPosition());
                }
            })(marker, i));

        }

        var circle = new google.maps.Circle({
            center:  new google.maps.LatLng(client_latitude, client_longitude),
            radius: setDistance * 1000,
            fillColor: "#000",
            fillOpacity: 0.1,
            strokeOpacity: 0.5,
            strokeWeight: 0.5,
            map: map
        });
        map.fitBounds(circle.getBounds());
        map.fitBounds(bounds);
    }
}
/**
 * Get list of events with just lat/lng values
 */
function getNearbyEvents(){
    locations.length = 1;
    markers.length = 1;
    var noOfFoundEvents = 0;
    $.ajax({
         type: "GET",
         url: BASE_URL + "/api/events-nearby/",
         dataType: "json",
         success: function(data){
            $.each(data, function(index, e){
                
                var client_latitude = temp1;
                var client_longitude = temp2;

                // Events Information
                var lat = e.e_lat;
                var lng = e.e_lng;
                
                //Client infomation
                var pos1 = new google.maps.LatLng(client_latitude, client_longitude);
                var pos2 = new google.maps.LatLng(lat, lng);

                var distance = calculateDistance(pos1, pos2);

                if(distance <= setDistance){
                    noOfFoundEvents++;
                    locations.push(['Hidden', lat, lng, 'Hidden', 'Hidden']);
                }
            });
            $("#x_events_founded").html(noOfFoundEvents-1);
            showBackgroundMap();
         }
    });
    
}//End of getNearbyEvents()