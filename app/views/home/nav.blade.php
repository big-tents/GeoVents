<h4>Navigation</h4>
<ul>
	<!-- <li><a href="/home">Home</a></li> -->
	<!-- <li><a href="/signin">Sign in</a></li> -->
	<li><a href="{{ URL::route('home') }}">Home</a></li>
	<!-- <li><a href="/findevents">Find Events</a></li> -->
	@if(Auth::check())

	@else
		<li><a href="{{ URL::route('account-register') }}">Register</a></li>
	@endif
</ul>
<hr>