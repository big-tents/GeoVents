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
	{{ HTML::script('//maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=geometry') }}

	
	<!-- ========== INTERNAL ========== -->
	<!-- Default CSS -->
	{{ HTML::style('assets/css/default.css') }}

	<!-- jQuery -->
	{{ HTML::script('assets/js/jquery-1.11.2.min.js') }}
	{{ HTML::script('assets/js/jquery-ui.js') }}

	<!-- Google Maps (Get Geolocation) -->
	{{ HTML::script('assets/js/getGeolocation.js') }}
    
    <!-- jQuery cookie -->
    {{ HTML::script('assets/js/jquery.cookie.js') }}
    
	<!-- Initilization -->
	{{ HTML::script('assets/js/init.js') }}

	<!-- Bootstrap Core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}

    <!-- Bootstrap Core javaScript -->
    {{ HTML::script('js/bootstrap.min.js') }}

    <!-- Custom CSS -->    
    {{ HTML::style('assets/css/custom.css') }}
    
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



	<!-- HEADER STARTS -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<div id="iconSwitch" class="toggle-btn-nav navbar-header pull-left">
				<a href="#menu-toggle" class="btn btn-default " id="menu-toggle"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
			</div>
			<img class="hidden-xs navbar-header" style="margin-top: 4px; max-width=100px" src="{{ asset('assets/images/logo.png') }}"> 
			<a class="navbar-brand ">{{ $app_name }}</a>
			
        </div>
    </div>




    <!-- Wrapper Starts -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('templates.nav')
        <!-- /#sidebar-wrapper -->




        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel">
							<!-- CONTENT AREA STARTS -->
							@yield('content')
							<!-- CONTENT AREA ENDS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->




    </div>
     <!-- /#wrapper -->
	


    <!-- Menu Toggle Script -->
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
		$("#iconSwitch .entries").toggle();
		$(this).find('span').toggleClass('glyphicon glyphicon-chevron-left glyphicon glyphicon-chevron-right', 200);
    });
    </script>
    <!-- Menu Toggle Script Ends -->



    <!-- Footer Starts -->
	<!-- @include('templates.footer') -->
	<!-- Footer Ends -->



</body>
</html>