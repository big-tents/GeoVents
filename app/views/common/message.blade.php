<!-- If there's message  -->
@if(Session::has('message'))

	<span class="message">{{ Session::get('message') }}</span>
@endif