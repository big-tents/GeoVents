<!-- If there's message  -->
@if(Session::has('message'))
	<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Message:</span>

		{{ Session::get('message') }}
	</div>
@endif