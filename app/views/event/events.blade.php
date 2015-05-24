@extends('templates.v2')

@section('content')
<section id="page-events">
<!-- Onload JavaScript -->
<script>
$().ready(function(){
    // $("#lat").html($.cookie('client_latitude'));
    // $("#lng").html($.cookie('client_longitude'));
    
    getEvents();

    $("#search").click(function(){
        getEvents();
    });

    /*----- Sorting Options -----*/
    /*---------------------------*/
    $("#sort_distance").click(function(){
        sortByDistance(0);
    });

    /*Update client location*/
    $("#update_location").click(function(){
        getLocation();
    });

});

</script>
<!-- End/ onload JavaScript -->

<style>
    #events_near{
        display:none;   
    }
    #content-holder{
        top:30px;
        max-height:750px
    }
</style>
<!--Geolocation Message-->
<p id="msg"></p>

<!-- Search Events -->
<article id="events_search">
    <h3>Search events<span id="noOfFoundEvents"></span></h3>
    <input type="text" name="filter" placeholder="Type your keywords here..." class="bs-input bs-search">
    <button id="search" class="bs-input bs-btn-search">Search!</button>
    <button id="sort_distance" class="bs-input bs-small">Sort by distance</button>
    <button id="update_location" class="bs-input bs-small">Update my location</button>

  <!-- Distance Selector -->
  <span id="distance-value">4 km</span>
  <script>
  $(function() {
    var max = 15;
    var select = $( "#min-distance" );
    for(i=1;i<max+1;i++)
        $('#min-distance').append($("<option></option>").attr("value",i).text(i)); 
    
    var slider = $( "<div id='slider'></div>" ).insertBefore( select ).slider({
      min: 1,
      max: max,
      range: "min",
      value: 4,
      slide: function( event, ui ) {
        select[ 0 ].selectedIndex = ui.value - 1;
        $("#distance-value").html(ui.value + " km");
        setDistance = ui.value;
        // showBackgroundMap();
        getEvents();
      }
    });
    $( "#min-distance" ).change(function() {
      slider.slider( "value", this.selectedIndex + 1 );
    });
  });
  </script>
  <select style="display:none;" name="min-distance" id="min-distance" value="5"></select>
  <!-- /Distance Selector -->

</article><!-- /Search Events -->



<!-- Events Table -->
<div id="tableless">
<table id="events_table" class="table table-hover">
    
    <!-- Events Table Header -->
    <thead>
        <tr>
<!--            <th>Event Type</th>
            <th>Restriction</th> -->
            <th>Event Name</th>
<!--            <th>Start Date</th>
            <th>End Date</th>
            <th>Description</th>
            <th>Location</th>
            <th id="header_attendees">Max. Attendees</th> -->
            <th id="header_distance">Distance</th>
            <th></th>
        </tr>
    </thead>
    
    <!-- Events Table Body -->
    <tbody id="events-table-body">
        <span id="events-table-msg"></span>
    </tbody>
</table>
</div>
<!-- /Events Table -->
</section>
@stop