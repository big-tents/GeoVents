function showBackgroundMap(){
    var map;
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();
    console.log(locations);
    //Set greyscale style
    var style = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
    
    //Set Icon
    var iconMe = BASE_URL + "/assets/images/me_marker.png";
    var icon = BASE_URL + "/assets/images/marker.png";

    var Options = {
        zoom: 14,
        maxZoom: 16,
        center:  new google.maps.LatLng($.cookie('client_latitude'), $.cookie('client_longitude')),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        // draggable: false,
        // scrollwheel: false,
        styles: style
    };
    
    //Display a map on the page
    var map = new google.maps.Map($('#map')[0], Options);

    // var locations = [];
    // locations.push( {name:"Sport Centre", latlng: new google.maps.LatLng(54.010475,-2.786893)} );
    
    // locations.push( {name:"Cartmel College", latlng: new google.maps.LatLng(54.003834,-2.789039)} );
    // locations.push( {name:"Lancaster Brewery", latlng: new google.maps.LatLng(54.03936725175427,-2.7814599369262396)} );

    //Multiple Markers
    // var locations = [
        // ['Sport Centre', 54.010475, -2.786893],
        // ['Pendle College', 54.006237, -2.785228],
        // ['Cartmel College', 54.003834, -2.789039],
        // ['Lancaster Brewery', 54.039367, -2.781459]
    // ];

    //Info Window Content
    // var infoWindowContent = [
    //     ['<div class="info_content">' +
    //     '<h3>3London Eye</h3>' +
    //     '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
    //     ['<div class="info_content">' +
    //     '<h3>2London Eye</h3>' +
    //     '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
    //     ['<div class="info_content">' +
    //     '<h3>1London Eye</h3>' +
    //     '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
    //     ['<div class="info_content">' +
    //     '<h3>Palace of Westminster</h3>' +
    //     '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
    //     '</div>']
    // ];


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
                // console.log(locations[0][0]);
                // console.log(locations[1][0]);
                // console.log(locations[2][0]);
                // console.log(locations[3][0]);
                infoWindow.setContent(locations[i][4]);
                infoWindow.open(map, marker);
                // map.setCenter(marker.getPosition());
                map.panTo(marker.getPosition());
            }
        })(marker, i));

        // Automatically center the map fitting all locations on the screen
       

    }

    var circle = new google.maps.Circle({
        center:  new google.maps.LatLng($.cookie('client_latitude'), $.cookie('client_longitude')),
        radius: setDistance * 1000,
        fillColor: "#000",
        fillOpacity: 0.1,
        strokeOpacity: 0.5,
        strokeWeight: 0.5,
        map: map
    });
     map.fitBounds(circle.getBounds());
        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        // var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            // this.setZoom(14);
            // google.maps.event.removeListener(boundsListener);
        // });
    map.fitBounds(bounds);
    // locations.length = 1;
}
