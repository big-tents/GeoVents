<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="BASE_URL" content="{{ URL::route('home') }}">

    <title>{{ $app_name }} :: {{$title}}</title>

    <!-- ========== EXTERNAL ========== -->
    <!-- Google font -->
    {{ HTML::style('//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700') }}
    
    <!-- jQuery UI CSS -->
    {{ HTML::style('//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') }}
    
    <!-- Modernzr -->
    {{ HTML::script('//modernizr.com/downloads/modernizr-latest.js') }}
    
    <!-- Google Maps API -->
    {{ HTML::script('//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry') }}

    
    <!-- ========== INTERNAL ========== -->
    <!-- Default CSS -->
    {{ HTML::style('assets/css/default.css') }}

    <!-- jQuery -->
    {{ HTML::script('//code.jquery.com/jquery-1.11.3.min.js') }}
    {{ HTML::script('assets/js/jquery-ui.js') }}

    <!-- Google Maps (Get Geolocation) -->
    {{ HTML::script('assets/js/getGeolocation.js') }}
    
    <!-- jQuery cookie -->
    {{ HTML::script('assets/js/jquery.cookie.js') }}
    
    <!-- Initilization -->
    {{ HTML::script('assets/js/myscript.js') }}
    {{ HTML::script('assets/js/init.js') }}

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}

    <!-- Bootstrap Core javaScript -->
    {{ HTML::script('assets/js/bootstrap.min.js') }}

    <!-- Custom CSS -->    
    {{ HTML::style('assets/css/custom.css') }}
    {{ HTML::style('assets/css/main.css') }}
    
    <!-- Table Sorter -->    
    {{ HTML::script('assets/js/vendors/Tablesorter/jquery.tablesorter.js') }}
    {{ HTML::script('assets/js/vendors/Tablesorter/jquery.tablesorter.min.js') }}
    {{ HTML::script('assets/js/vendors/Tablesorter/jquery.tablesorter.pager.js') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Map -->
<div id="map"></div>

<!-- Main Container -->
<main>
    <!--Events Near -->
    <article id="events_near">
        <h1><span>4</span> events</h1><br/>
        <h2>near your location</h2>
    </article><!-- /Events Near -->
    
    <!-- Search Events -->
    <article id="events_search">
        <h3>Search events</h3>
        <input type="text" name="filter" placeholder="Type your keywords here..." class="bs-input bs-search">
        <button id="search" class="bs-input bs-btn-search">Search!</button>
        <button id="sort_distance" class="bs-input bs-small">Sort by distance</button>
        <button id="update_location" class="bs-input bs-small">Update my location</button>

    </article><!-- /Search Events -->
    
    <!-- Content Holder -->
    <article id="content-holder">
    @yield('content')
    </article><!-- /Content Holder -->

    <!-- Nav -->
    <header id="header-main">
        <span id="logo">Geovents</span>
        <nav>
            <p>
              <span><a href="{{ URL::route('home') }}">Home</a></span>
              <span><a href="{{ URL::route('account-register') }}">Register</a></span>
              <span><a href="{{ URL::route('events') }}">Find Events</a></span>
            </p>
        </nav>
    </header>

</main><!-- /Main Container -->

</body>
</html>