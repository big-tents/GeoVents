<div id="sidebar-wrapper">
	<ul class="sidebar-nav">
		<!-- General Navigations -->
		<li><a href="{{ URL::route('home') }}">Home</a></li>
		<li><a href="{{ URL::route('events') }}">Find Events</a></li>
		<!-- <li><a href="{{ URL::to('/eventsv2/') }}">Find Events v2</a></li> -->
        @if(Auth::check())
            <li><a href="{{ URL::route('event-host') }}">Host Event</a></li>
        @endif


		<!-- If Logged -->
		@if(Auth::check())
			<li><a href="{{ URL::to('user', Auth::user()->username) }}">My Profile</a></li>
			<li><a href="{{ URL::to('friend') }}">Friends</a></li>
			<li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
			<li class="divider"></li>
			<li><a href="{{ URL::route('account-settings') }}">Account Settings</a></li>
			<li><a href="{{ URL::route('account-logout') }}">Logout</a></li>
		
		<!-- If NOT Logged -->
		@else
			<li class="divider"></li>
			<li><a href="{{ URL::route('account-login') }}">Login</a></li>
			<li><a href="{{ URL::route('account-register') }}">Register</a></li>
		@endif
	</ul>
</div>
