<h4>Navigation</h4>
<ul>

	<li><a href="{{ URL::route('home') }}">Home</a></li>

	<!-- If Logged -->
	@if(Auth::check())
		<li><a href="{{ URL::route('account-logout') }}">Logout</a></li>
		<li><a href="{{ URL::route('account-settings') }}">Account Settings</a></li>
		<li><a href="{{ URL::route('profile') }}/{{ Auth::user()->username }}">My Profile</a></li>

	<!-- If NOT Logged -->
	@else
		<li><a href="{{ URL::route('account-login') }}">Login</a></li>
		<li><a href="{{ URL::route('account-register') }}">Register</a></li>
	@endif
</ul>
<hr>