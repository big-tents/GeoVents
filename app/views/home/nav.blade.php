<h4>Navigation</h4>
<ul>
	<!-- General Navigations -->
	<li><a href="{{ URL::route('home') }}">Home</a></li>
	<li><a href="{{ URL::route('events') }}">Find Events</a></li>

	<!-- If Logged -->
	@if(Auth::check())
		<li><a href="{{ URL::route('account-logout') }}">Logout</a></li>
		<li><a href="{{ URL::route('account-settings') }}">Account Settings</a></li>
		<li><a href="{{ URL::route('my-profile') }}">My Profile</a></li>
	
	<!-- If NOT Logged -->
	@else
		<li><a href="{{ URL::route('account-login') }}">Login</a></li>
		<li><a href="{{ URL::route('account-register') }}">Register</a></li>

	@endif
</ul>
<hr>